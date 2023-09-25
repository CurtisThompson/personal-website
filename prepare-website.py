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
    return results


def prefill_template(temp, header, footer, menu):
    """
    Fills in the common parts of all templates.
    
    Args:
        temp: the template to fill in
        header: the HTML string for the site header
        footer: the HTML string for the site footer
        menu: the HTML string for the site menu
    
    Returns:
        The prefilled template.
    """
    temp = re.sub('<!COREHEADER!>', header, temp)
    temp = re.sub('<!MENU!>', menu, temp)
    temp = re.sub('<!FOOTER!>', footer, temp)
    return temp


def clear_old_html():
    """Removes all previous HTML files to prepare for new build. Does not delete templates and assets."""
    html_folder = '.\\public_html'
    html_files = [os.path.join(dp, f) for dp, _, filenames in os.walk(html_folder) for f in filenames
                  if (os.path.splitext(f)[1] == '.html')]
    for h in html_files:
        if '\\php-assets\\' not in h:
            os.remove(h)


def build_website():
    """Builds all HTML pages for the website from templates."""
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

    # Fill in the templates with common parts
    PREFILLED_TEMPLATE = prefill_template(GENERIC_TEMPLATE, COREHEADER, FOOTER, MENU)
    PREFILLED_NOTES = prefill_template(NOTES_TEMPLATE, COREHEADER, FOOTER, MENU)
    PREFILLED_PROJECTS = prefill_template(PROJECTS_TEMPLATE, COREHEADER, FOOTER, MENU)

    # Remove old HTML files
    clear_old_html()

    # Go through files and merge with templates, then output
    for file in html_files:
        if '\\notes\\' in file and file != '.\\no_public_html\\notes\\index.html':
            data = fill_file(file, PREFILLED_NOTES)
        elif '\\projects\\' in file and file != '.\\no_public_html\\projects\\index.html':
            data = fill_file(file, PREFILLED_PROJECTS)
        else:
            data = fill_file(file, PREFILLED_TEMPLATE)
        
        new_path = file.replace('\\no_public_html\\', '\\public_html\\')
        write_file_contents(new_path, data)


if __name__ == "__main__":
    build_website()