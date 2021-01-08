<!DOCTYPE html>

<html lang="en">
    
    <head>
    	<title>Curtis Thompson - The Positivity of 2019</title>
    	<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
    	<link rel="stylesheet" type="text/css" href="/stylesheets/notes.css" />
    	<meta name="author" content="Curtis Thompson" />
    	<meta name="description" content="In my personal opinion 2019 was a positive year, and it was getting even better as the year went on. But is there any way of measuring the positivity of my year through the vast amounts of data collected by the gadgets that I use? Perhaps I could look at my runs across the year and make the link that I run more on positive days, or an even more crazy assumption..." />
    	<meta name="keywords" content="2019, valence, positivity, emojis, facebook, messenger, vader, messages, grinning face with smiling eyes" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
    </head>


    <body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
    		<h1 id="small-header-box">The Positivity of 2019 (Through The Lens of Facebook Messenger)</h1>
    		<div class="notes-text">
        		<div class="notes-details"><span class="author">Curtis Thompson</span><span class="date">Wednesday 1st January 2020</span><span class="topic">Personal</span></div>		
        		<p>In my personal opinion 2019 was a positive year, and it was getting even better as the year went on. But is there any way of measuring the positivity of my year through the vast amounts of data collected by the gadgets that I use? Perhaps I could look at my runs across the year and make the link that I run more on positive days, or an even more crazy assumption would be that I play my Nintendo Switch on less positive days. But there is something I've used throughout the year to express my emotions... emojis!</p>
        		<p>In this article I use the data from Facebook Messenger to measure how my positivity has changed over 2019. This data can be downloaded directly from Facebook in either a HTML or JSON format. For this analysis I downloaded my 2019 messages in HTML format and used the Beautiful Soup library to extract information - then performing the analysis in Python.</p>
        		<p>I used 74 different emojis 4665 times in 2019, but which emoji was my favourite? 'Grinning Face With Smiling Eyes' was my most used emoji with 1011 uses, accounting for 21.67% of all uses of emojis. This was then followed by 'Grinning Squinting Face' with 695 uses and 'Smiling Face With Smiling Eyes' with 639 uses. My most frequently used emojis are shown in the figure below.</p>
        		<div class="captioned-image">
        		    <img alt="Most commonly used emojis" src="Most Commonly Used Emojis.png" />
        		    <p>My 15 most commonly used emojis on Facebook Messenger in 2019.</p>
        		</div>
        		<p>Interestingly, my seven most frequently used emojis are all positive emojis. Furthermore, 82.04% of emojis used were positive (8.75% were neutral and 9.07% were negative). The figure below shows the usage of positive, neutral, and negative emojis in each month of the year.</p>
        		<div class="captioned-image">
        		    <img alt="Usage of emojis by positivity each month" src="Usage of Emojis By Positivity Each Month.png" />
        		    <p>My split of positive, neutral, and negative emojis used in each month of 2019.</p>
        		</div>
        		<p>My most positive month (and least negative month) was December, with 87.48% of emojis being positive. In fact, four of the most positive five months were in the second half of the year (these months being December, August, November, February, and October). These statistics suggest an increase in the proporition of emojis used being positive. To further add to this suggestion, fitting a simple linear regressor to the data gives a positive slope (however it may be better modelled with a quadratic function). The most commonly used emoji in each month is shown in the figure below.</p>
        		<div class="captioned-image">
        		    <img alt="Monthly emojis" src="Monthly Emojis.png" />
        		    <p>My most commonly used emoji each month of the year.</p>
        		</div>
        	    <p>Through the statistics and figures presented so far it is evident that I am much more likely to use positive emojis, and the proportion of used emojis that are positive increases as the year goes on. But perhaps I just don't use negative emojis in negative times. So for further insight I wanted to look at my overall emoji usage. The problem with measuring this is that it is likely to be higher in periods where I send more messages, so I need to instead look at emojis per message. Looking at this statistic over the course of the year will give an insight into whether my usage of emojis has increased.</p>
        	    <p>This does not actually tell me whether I am using negative emojis as much in negative times. With this dataset I do not only need to look at emojis, but I can look at whole messages. With the Python NLTK library I am able to measure positivity with VADER (Valence Aware Dictionary and sEntiment Reasoner). Passing each message through VADER I can also see the positivity of my messages over the course of the year. A plot of emojis per message and average message positivity is given in the before figure.</p>
        	    <div class="captioned-image">
        		    <img alt="Message positivity and emojis per message" src="Message Positivity and Emojis Per Message.png" />
        		    <p>A plot of both average message positivity and average emojis per message over the course of the year.</p>
        		</div>
        	    <p>Over the course of the year my messages are positive, but the positivity stays relatively constant throughout the year. On the other hand, the number of emojis per message increases over the course of the year. A linear regression model fitted for emoji usage against message positivity does however suggest a positive trend. That is to say that positive messages are more likely to use more emojis. So it may be that instead of using negative emojis I am just using fewer emojis, but the analysis is inconclusive.</p>
        	    <p>The overall analysis seems to suggest that I mostly use positive emojis. My usage of positive emojis, and emojis overall, increased over the course of the year. The positivity of my messages was positive, but did not increase over the course of the year. However, there does seem to be a link between the positivity of messages and the use of emojis. This final statement does need more exploration.</p>
        	    <p>Most importantly... has 2019 been a positive year? Yes!</p>
        	</div>
            
            <div class="notes-others">
        		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/other-notes.php'); ?>
            </div>
    	</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
    </body>

</html>