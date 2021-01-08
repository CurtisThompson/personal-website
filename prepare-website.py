import os
import re

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
    for tag in ['<!HEADCONTENT!>', '<!BODYCONTENT!>', '<!NOTETITLE!>'
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
    if '\\notes\\' not in file:
        data = fill_file(file, PREFILLED_TEMPLATE)
    else:
        data = fill_file(file, PREFILLED_NOTES)
    
    new_path = file.replace('\\no_public_html\\', '\\public_html\\')
    write_file_contents(new_path, data)