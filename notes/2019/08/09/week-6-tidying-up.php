<!DOCTYPE html>

<html lang="en">

    <head>
    	<title>Curtis Thompson - Week 6: Tidying Up</title>
    	<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
    	<link rel="stylesheet" type="text/css" href="/stylesheets/notes.css" />
    	<meta name="author" content="Curtis Thompson" />
    	<meta name="description" content="When I initially accepted the job this was meant to be my last week. In the time between me accepting and starting the job they realised that the release date of the website was going to be pushed back. During my mid-job review they asked me to stay on for an extra two weeks. So this now isn't my last week. Either way, the website is soon to be released and we are in the tidying up phase. I'll be talking about some points of that in these notes." />
    	<meta name="keywords" content="student union, website, content, assurance, executive, summer, week 6, web development, javascript, accessibility, internet explorer" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
    </head>
    
    
    <body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
    		<h1 id="small-header-box">Week 6: Tidying Up</h1>
    		<div class="notes-text">
        		<div class="notes-details"><span class="author">Curtis Thompson</span><span class="date">Friday 9th August 2019</span><span class="topic">Personal</span></div>		
        		<p>When I initially accepted the job this was meant to be my last week. In the time between me accepting and starting the job they realised that the release date of the website was going to be pushed back. During my mid-job review they asked me to stay on for an extra two weeks. So this now isn't my last week. Either way, the website is soon to be released and we are in the tidying up phase. I'll be talking about some points of that in these notes.</p>
        		<p>The few points I'll touch on are:</p>
        		<ul>
        		    <li>Finding images without the alt attribute</li>
        		    <li>Backwards compatibility with Internet Explorer</li>
        		    <li>Combining word breaks</li>
        		</ul>
        		<p>A simple JQuery command can be used to find all of the images without an alt tag: $('img:not([alt])'). This allows one of the guidelines of the Web Content Accessibility Guidelines to be met. Overall there are four principles, 13 guidelines, and 78 sub-guidelines. Meeting all 78 sub-guidelines would reward an AAA rating, meaning that the website provides a complete accessible experience. AA and A ratings are more common, and only require some sub-guidelines to be met. All non-text content having a text alternative (such as an alt tag) is required for an A rating.</p>
        		<p>Backwards compatibility with Internet Explorer is a big issue. Fourtunately these old versions of Internet Explorer are being used less frequently by users, but if you are developing a big website then you still need to accommodate these users. There are many issues we faced on Internet Explorer, but I'll only mention one. We were using width: fit-content for many divs and buttons, but this css property does not work on IE. To get around this, you can give the elements display: table. It is a strange fix, but it works. The important moral of this is to test your website on a variety of browsers and devices, as they will all work differently and your users will be using a wide variety of browsers and devices.</p>
        		<p>Sometimes you need to use the word-break attribute, it's quite common, particularly when you are making a responsive design. There are various options, the two I used most often were break-word (to break the text between words if needed) and break-all (to break the text anywhere). Now sometimes they might both be required, and luckily you can combine them with word-break: break-all; word-break: break-word. This will use break-word, and then break-all as a fallback if the former doesn't work.</p>
        	    <p>So there is three things I learnt this week, just for future reference. Next week should be the exciting one, as the website goes live! Stay tuned for that.</p>
        	</div>
            
            <div class="notes-others">
        		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/other-notes.php'); ?>
            </div>
    	</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
    </body>

</html>