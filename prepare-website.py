import os
import re


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
    if '\\notes\\' in file and file != '.\\no_public_html\\notes\\index.html':
        data = fill_file(file, PREFILLED_NOTES)
    elif '\\projects\\' in file and file != '.\\no_public_html\\projects\\index.html':
        data = fill_file(file, PREFILLED_PROJECTS)
    else:
        data = fill_file(file, PREFILLED_TEMPLATE)
    
    new_path = file.replace('\\no_public_html\\', '\\public_html\\')
    write_file_contents(new_path, data)
