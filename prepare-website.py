import os
import re
from bs4 import BeautifulSoup

import numpy as np
import pandas as pd
from nltk.corpus import stopwords
import string
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.feature_extraction.text import CountVectorizer


def get_file_contents(file):
    """
    Returns the contents of a file as a string.
    
    Args:
        file: the file path to read.
    
    Returns:
        A string of the data in the file.
    """
    fin = open(file, 'rt')
    data = fin.read()
    fin.close()
    return data


def write_file_contents(file, data):
    """
    Writes the given string to a file.
    
    Args:
        file: the file path to write to.
        data: the string to write.
    """
    fin = open(file, 'wt')
    fin.write(data)
    fin.close()


def get_tag(template, tag):
    """
    Finds and returns the contents of a given tag.
    
    Args:
        template: the string with contents.
        tag: the tag being read (only the opening bracket).
    
    Returns:
        The contents of the tag, or an empty string if the tag is not found.
    """
    try:
        return re.findall(tag + '[\s\S]*' + tag, template)[0].replace(tag, '')
    except:
        return ''


def note_other_html(url):
    """
    Returns the recommended notes HTML for a given notes URL.
    
    Args:
        url: the URL of the notes from root.
    
    Returns:
        The HTML for the recommended notes section of the notes.
    """
    try:
        r = recommend(url.replace('.\\no_public_html', ''))
        html = '<h2>Recommended Notes</h2>'
        for u in r:
            html += recommendation_html(u)
        return html
    except Exception as e:
        print(e)
        return ''


def fill_file(file, template):
    """
    Merges the contents of a file with a template.
    
    Args:
        file: the file path of the contents.
        template: the template to merge contents into.
    
    Returns:
        The merged contents.
    """
    data = get_file_contents(file)
    
    results = template
    for tag in ['<!HEADCONTENT!>', '<!BODYCONTENT!>', '<!NOTETITLE!>',
                '<!NOTEAUTHOR!>', '<!NOTEDATE!>', '<!NOTETOPIC!>',
                '<!PROJECTNAME!>', '<!PROJECTDATE!>', '<!PROJECTROLE!>',
                '<!PROJECTTECH!>', '<!PROJECTDESC!>', '<!PROJECTLINKS!>',
                '<!PROJECTFEATURES!>', '<!PROJECTQUESTIONS!>']:
        results = re.sub(tag, get_tag(data, tag), results)
    if '\\notes\\' in file and file != '.\\no_public_html\\notes\\index.html':
        results = results.replace('<!NOTEOTHERS!>', note_other_html(file))
    return results

#########################################################################
# Create List of All Notes
#########################################################################

# File path to the notes folder
NOTES_PATH = '.\\no_public_html\\notes\\'

# Get a list of all notes file paths
notes_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(NOTES_PATH) for f in filenames if os.path.splitext(f)[1] == '.html']
notes_files.remove('.\\no_public_html\\notes\\index.html')

# Get a list of all notes
notes = []
for file in notes_files:
    # Get file data
    data = get_file_contents(file)
    
    # Get tags
    url = file.replace('.\\no_public_html', '')
    title = get_tag(data, '<!NOTETITLE!>')
    author = get_tag(data, '<!NOTEAUTHOR!>')
    date = get_tag(data, '<!NOTEDATE!>')
    topic = get_tag(data, '<!NOTETOPIC!>')
    content = get_tag(data, '<!BODYCONTENT!>')
    content = BeautifulSoup(content, 'html.parser').get_text()
    
    notes.append([url, title, author, date, topic, content])
notes = notes[::-1]

# Create JS file with a list of dictionaries of all notes
note_js = 'var notes_list = ['
for n in notes:
    n_js = '{'
    n_js += '"URL" : "' + n[0].replace('\\','\\\\') + '", '
    n_js += '"Title" : "' + n[1] + '", '
    n_js += '"Author" : "' + n[2] + '", '
    n_js += '"Date" : "' + n[3] + '", '
    n_js += '"Topic" : "' + n[4] + '", '
    n_js += '"Content" : "' + n[5].replace('\n', ' ').replace('\r', '').replace('"', '\\"').lstrip()[:250].rstrip() + '...", '
    n_js += '}, '
    note_js += n_js
note_js += '];'
write_file_contents('.\\public_html\\js\\notes_list.js', note_js)


#########################################################################
# Notes Recommender System
#########################################################################

# Put data in a frame
articles = pd.DataFrame(np.array(notes), columns = ['URL', 'Title', 'Author', 'Date', 'Topic', 'Content'])

# Preprocessing (lowercase, remove stopwords, remove punctuation, remove whitespace)
def remove_punc(s):
    return s.translate(str.maketrans('','',string.punctuation))
articles['Title'] = articles['Title'].apply(lambda xs: [remove_punc(x.lower()) for x in xs.split(' ') if remove_punc(x.lower()) not in stopwords.words('english')])
articles['Topic'] = articles['Topic'].apply(lambda xs: [remove_punc(x.lower()) for x in xs if remove_punc(x.lower()) not in stopwords.words('english')])
articles['Content'] = articles['Content'].apply(lambda xs: [remove_punc(x.lower().replace('\n', '')) for x in xs if remove_punc(x.lower().replace('\n', '')) not in stopwords.words('english')])

# Convert to bag-of-words
articles['Bag'] = ''
for index, row in articles.iterrows():
    words = ''
    for col in ['Title', 'Topic', 'Content']:
        words += ' '.join(row[col]) + ' '
    row['Bag'] = words
articles = articles[['URL', 'Bag']]

# Vectorise
count = CountVectorizer()
count_matrix = count.fit_transform(articles['Bag'])

# Similarity
cosine_sim = cosine_similarity(count_matrix, count_matrix)
indices = pd.Series(articles['URL'])

# Recommendation HTML
def recommendation_html(url):
    data = [n for n in notes if n[0] == url][0]
    data_url = data[0].replace('.\\no_public_html', '').replace('.html', '')
    html = "<div class='notes-indiv-container'>"
    html += "<a href='" + data_url + "'><img class='notes-image' alt='" + data[1] + "' src='" + '\\'.join(data[0].split('\\')[:-1]) + "\\thumb.png'/></a>"
    html += "<a href='" + data_url + "'><h3 class='notes-title'>" + data[1] + "</h3></a>"
    html += "<p class='notes-time'>" + data[3] + "</p>"
    html += "<a class='read-article' href='" + data_url + "'>Read Notes</a>"
    html += "</div>"
    return html

# Recommender
def recommend(url, cosine_sim = cosine_sim):
    recommendations = []
    idx = indices[indices == url].index[0]
    score_series = pd.Series(cosine_sim[idx]).sort_values(ascending = False)
    top_3 = list(score_series.iloc[1:4].index)
    for i in top_3:
        recommendations.append(list(articles['URL'])[i])
    return recommendations


#########################################################################
# Build Static Pages From Templates
#########################################################################

# Folder path to all file contents
PATH = '.\\no_public_html'

# Get a list of all file paths
html_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(PATH) for f in filenames if os.path.splitext(f)[1] == '.html']

# Get template parts
COREHEADER = get_file_contents('templates/core-header.html').replace('\n', '\n\t\t')
MENU = get_file_contents('templates/menu.html').replace('\n', '\n\t\t')
FOOTER = get_file_contents('templates/footer.html').replace('\n', '\n\t\t')

# Get the templates
GENERIC_TEMPLATE = get_file_contents('templates/general.html')
NOTES_TEMPLATE = get_file_contents('templates/notes.html')
PROJECTS_TEMPLATE = get_file_contents('templates/projects.html')

def prefill_template(temp):
    """
    Fills in the common parts of all templates.
    
    Args:
        temp: the template to fill in
    
    Returns:
        The prefilled template.
    """
    temp = re.sub('<!COREHEADER!>', COREHEADER, temp)
    temp = re.sub('<!MENU!>', MENU, temp)
    temp = re.sub('<!FOOTER!>', FOOTER, temp)
    return temp

# Fill in the templates with common parts
PREFILLED_TEMPLATE = prefill_template(GENERIC_TEMPLATE)
PREFILLED_NOTES = prefill_template(NOTES_TEMPLATE)
PREFILLED_PROJECTS = prefill_template(PROJECTS_TEMPLATE)

# Go through files and merge with templates, then output
for file in html_files:
    #print(file)
    if '\\notes\\' in file and file != '\\no_public_html\\notes\\index.html':
        data = fill_file(file, PREFILLED_NOTES)
    elif '\\projects\\' in file and file != '\\no_public_html\\projects\\index.html':
        data = fill_file(file, PREFILLED_PROJECTS)
    else:
        data = fill_file(file, PREFILLED_TEMPLATE)
    
    new_path = file.replace('\\no_public_html\\', '\\public_html\\')
    write_file_contents(new_path, data)
