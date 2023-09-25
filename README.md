# My Personal Website

You can find my website at [cwthompson.com](https://www.cwthompson.com).

This repository is for building the static pages of my website from template files.

## Building The Website

To build the website, call the `build_website()` method found within `./prepare-website.py`. If you run the whole Python file then the function will be called automatically.

## Editing The Website

To edit the pages, they must be edited within the `./no_public_html` directory and the the website must be rebuilt. If the edits are to the site header, footer, or menu then these edits must be made within `./templates`.

Stylesheet, Javascript, and image edits are made directly within `./public_html/stylesheets`, `./public_html/js`, and `./public_html/images` respectively.

All other site assets are likely to be found within `./public_html` as `./no_public_html` is used strictly for HTML documents and templates.

## Template Tags

Template tags can be found within the precompiled HTML documents, and are later replaced with actual HTML. The following tags are used.

|Tag|Description|In Use|
|---|---|---|
|<!COREHEADER!>|The global site header.|Yes|
|<!MENU!>|The global site menu.|Yes|
|<!FOOTER!>|The global site footer.|Yes|
|<!HEADCONTENT!>|HTML content to go within the head body of the specific page.|Yes|
|<!BODYCONTENT!>|HTML content to go within the body tags of the specific page.|Yes|
|<!NOTETITLE!>|The display title of the article.||
|<!NOTEAUTHOR!>|The name of the author of the article.||
|<!NOTEDATE!>|The date the article was first published.||
|<!NOTETOPIC!>|The main topic of the article.||
|<!PROJECTNAME!>|The display name of the tech project.|Yes|
|<!PROJECTDATE!>|The months and years the tech project was worked on.|Yes|
|<!PROJECTROLE!>|My role within the tech project if it was not a solo project.|Yes|
|<!PROJECTTECH!>|The programming languages, frameworks, and other technology I personally used within the project.|Yes|
|<!PROJECTDESC!>|A general description of the tech project.|Yes|
|<!PROJECTLINKS!>|Any external links for the tech project such as download links, GitHub code, or video demos.|Yes|
|<!PROJECTFEATURES!>|A list of features of the completed tech project.|Yes|
|<!PROJECTQUESTIONS!>|FAQ-style questions related to the tech project.|Yes|