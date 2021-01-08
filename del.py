import os

PATH = '.\\public_html\\notes'
html_files = [os.path.join(dp, f) for dp, dn, filenames in os.walk(PATH) for f in filenames if os.path.splitext(f)[1] == '.php']

for f in html_files:
	os.remove(f)