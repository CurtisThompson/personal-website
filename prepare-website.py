import os
import re
from bs4 import BeautifulSoup

#########################################################################
# Build Static Pages From Templates
#########################################################################

PATH = '.\\no_public_html'

html_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(PATH) for f in filenames if os.path.splitext(f)[1] == '.html']


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


def fill_file(file, template):
    data = get_file_contents(file)
    
    results = template
    for tag in ['<!HEADCONTENT!>', '<!BODYCONTENT!>', '<!NOTETITLE!>',
                '<!NOTEAUTHOR!>', '<!NOTEDATE!>', '<!NOTETOPIC!>',
                '<!NOTEOTHERS!>']:
        results = re.sub(tag, get_tag(data, tag), results)
    return results


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
    print(file)
    if '\\notes\\' not in file or file == '.\\no_public_html\\notes\\index.html':
        data = fill_file(file, PREFILLED_TEMPLATE)
    else:
        data = fill_file(file, PREFILLED_NOTES)
    
    new_path = file.replace('\\no_public_html\\', '\\public_html\\')
    write_file_contents(new_path, data)



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
    n_js += '"Content" : "' + n[5].replace('\n', ' ').replace('\r', '').replace('"', '\\"').strip()[:250] + '...", '
    n_js += '}, '
    note_js += n_js
note_js += '];'
write_file_contents('.\\public_html\\js\\notes_list.js', note_js)