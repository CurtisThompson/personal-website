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


def get_header(template):
    try:
        return re.findall('<!HEADCONTENT!>[\s\S]*<!HEADCONTENT!>', template)[0].replace('<!HEADCONTENT!>', '')
    except:
        return ''

def get_body(template):
    try:
        return re.findall('<!BODYCONTENT!>[\s\S]*<!BODYCONTENT!>', template)[0].replace('<!BODYCONTENT!>', '')
    except:
        return ''


def fill_file(file, template):
    data = get_file_contents(file)
    header = get_header(data)
    body = get_body(data)
    
    results = re.sub('<!HEADCONTENT!>', header, template)
    results = re.sub('<!BODYCONTENT!>', body, results)
    return results


# Get template parts
COREHEADER = get_file_contents('templates/core-header.html').replace('\n', '\n\t\t')
MENU = get_file_contents('templates/menu.html').replace('\n', '\n\t\t')
FOOTER = get_file_contents('templates/footer.html').replace('\n', '\n\t\t')

# Get the templates
GENERIC_TEMPLATE = get_file_contents('templates/general.html')

# Fill in the template with common parts
PREFILLED_TEMPLATE = re.sub('<!COREHEADER!>', COREHEADER, GENERIC_TEMPLATE)
PREFILLED_TEMPLATE = re.sub('<!MENU!>', MENU, PREFILLED_TEMPLATE)
PREFILLED_TEMPLATE = re.sub('<!FOOTER!>', FOOTER, PREFILLED_TEMPLATE)

# Go through files and merge with templates, then output
for file in html_files:
    if '\\notes\\' not in file:
        print(file)
        data = fill_file(file, PREFILLED_TEMPLATE)
        new_path = file.replace('\\no_public_html\\', '\\public_html\\')
        write_file_contents(new_path, data)
    
