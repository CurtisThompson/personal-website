<!DOCTYPE html>

<html lang="en">

    <head>
    	<title>Curtis Thompson - Week 2: Let's Code Some Pages</title>
    	<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
    	<link rel="stylesheet" type="text/css" href="/stylesheets/notes.css" />
    	<meta name="author" content="Curtis Thompson" />
    	<meta name="description" content="Two weeks into my internship now. I was looking forward to this week as soon as I saw the work plan as it was going to involve a lot more coding than the previous week. Of course every task on the work plan is important to ensure the website launches on time and of high quality, but the challenges of coding always make me want to get stuck in." />
    	<meta name="keywords" content="student union, website, content, assurance, executive, accordion, job, internship, summer, week 2, web development, css, html, javascript" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
    </head>
    
    
    <body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
    		<h1 id="small-header-box">Week 2: Let's Code Some Pages</h1>
    		<div class="notes-text">
        		<div class="notes-details"><span class="author">Curtis Thompson</span><span class="date">Saturday 13th July 2019</span><span class="topic">Personal</span></div>		
        		<p>Two weeks into my internship now. I was looking forward to this week as soon as I saw the work plan as it was going to involve a lot more coding than the previous week. Of course every task on the work plan is important to ensure the website launches on time and of high quality, but the challenges of coding always make me want to get stuck in.</p>
        		<p>Okay, so the week did start off with checking lots of pages to ensure they were suitable quality. This went well, and the problems I spotted were reported. I did try to fix several of them. In particular, fixing the fixed width/height iframes remains stuck in my mind (probably because there were so many of them). When you add elements to a webpage and they are fixed size (i.e. you define the weidth and height in terms of pixels only), it will often not work well on a small screen such as a mobile. This is not a guarantee, but laptop/computer screens are much bigger so if you don't consider smaller devices then it can cause problems. Mobiles are being used much more frequently to view websites too, so it is something you should be considering. If you want to keep the fixed size on larger devices then something as simple as a media query for smaller devices could work.</p>
        		<p>Some of the deadlines for this week that I was more excited for involved creating templates for certain areas of the site, or applying mockups (designs) to specific pages. These tasks are similar, but slightly different. Each page has a template which defines elements that appear on many pages such as the menu, or a side navigation bar. A few similar templates will be used across the site. The specific content for that page (from the mockup) is then applied to individual pages.</p>
        		<p>One of the main parts of this website redesign is reducing the number of pages, so we need ways of having lots of content on a single page without overloading the users' brains. One method that will be used a lot on the new site is accordions (collapsible content), something I have used on my website. Although that is simple to code, the styling for it is what makes a huge impact on the users' experience (colours, font, transitions) - so it is important to get them right. Accordions don't fit into every page design, so there are other methods such as tabs too.</p>
        		<p>I want to drop in a quick lesson I learnt (or saw the importance of) this week. When making an update to a file, make a note of the changes in the version control software. If any changes need to be reverted it will become very important to know what has changed between each version of the file (and when working with many files, you are going to forget each change).</p>
        		<p>That's all for this week. Next week involves a lot more coding, but also some training that I will be leading, and a review of my work with my department.</p>
        	</div>
            
            <div class="notes-others">
        		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/other-notes.php'); ?>
            </div>
    	</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
    </body>

</html>