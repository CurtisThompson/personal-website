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
    fin = open(file, 'rt')
    data = fin.read()
    fin.close()
    return data


def write_file_contents(file, data):
    fin = open(file, 'wt')
    fin.write(data)
    fin.close()


def get_tag(template, tag):
    try:
        return re.findall(tag + '[\s\S]*' + tag, template)[0].replace(tag, '')
    except:
        return ''


def note_other_html(url):
    try:
        r = recommend(url.replace('.\\no_public_html', ''))
        html = '<h2>Recommended Notes</h2>'
        for u in r:
            html += recommendation_html(u)
        return html
    except:
        return ''


def fill_file(file, template):
    data = get_file_contents(file)
    
    results = template
    for tag in ['<!HEADCONTENT!>', '<!BODYCONTENT!>', '<!NOTETITLE!>',
                '<!NOTEAUTHOR!>', '<!NOTEDATE!>', '<!NOTETOPIC!>']:
        results = re.sub(tag, get_tag(data, tag), results)
    if '\\notes\\' in file and file != '.\\no_public_html\\notes\\index.html':
        results = results.replace('<!NOTEOTHERS!>', note_other_html(file))
    return results

#########################################################################
# Create List of All Notes
#########################################################################

PATH = '.\\no_public_html\\notes\\'

notes_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(PATH) for f in filenames if os.path.splitext(f)[1] == '.html']
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

# Create JS file
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
    data[0] = data[0].replace('.\\no_public_html', '')
    html = "<div class='notes-indiv-container'>"
    html += "<a href='" + data[0] + "'><img class='notes-image' alt='" + data[1] + "' src='" + '\\'.join(data[0].split('\\')[:-1]) + "\\thumb.png'/></a>"
    html += "<a href='" + data[0] + "'><h3 class='notes-title'>" + data[1] + "</h3></a>"
    html += "<p class='notes-time'>" + data[3] + "</p>"
    html += "<a class='read-article' href='" + data[0] + "'>Read Notes</a>"
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

PATH = '.\\no_public_html'

html_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(PATH) for f in filenames if os.path.splitext(f)[1] == '.html']


# Get template parts
COREHEADER = get_file_contents('templates/core-header.html').replace('\n', '\n\t\t')
MENU = get_file_contents('templates/menu.html').replace('\n', '\n\t\t')
FOOTER = get_file_contents('templates/footer.html').replace('\n', '\n\t\t')

# Get the templates
GENERIC_TEMPLATE = get_file_contents('templates/general.html')
NOTES_TEMPLATE = get_file_contents('templates/notes.html')

# Fill in the generic template with common parts
PREFILLED_TEMPLATE = re.sub('<!COREHEADER!>', COREHEADER, GENERIC_TEMPLATE)
PREFILLED_TEMPLATE = re.sub('<!MENU!>', MENU, PREFILLED_TEMPLATE)
PREFILLED_TEMPLATE = re.sub('<!FOOTER!>', FOOTER, PREFILLED_TEMPLATE)

# Fill in the notes template with common parts
PREFILLED_NOTES = re.sub('<!COREHEADER!>', COREHEADER, NOTES_TEMPLATE)
PREFILLED_NOTES = re.sub('<!MENU!>', MENU, PREFILLED_NOTES)
PREFILLED_NOTES = re.sub('<!FOOTER!>', FOOTER, PREFILLED_NOTES)

# Go through files and merge with templates, then output
for file in html_files:
    #print(file)
    if '\\notes\\' not in file or file == '.\\no_public_html\\notes\\index.html':
        data = fill_file(file, PREFILLED_TEMPLATE)
    else:
        data = fill_file(file, PREFILLED_NOTES)
    
    new_path = file.replace('\\no_public_html\\', '\\public_html\\')
    write_file_contents(new_path, data)
