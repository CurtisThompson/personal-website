<!DOCTYPE html>

<html lang="en">

	<head>
		<head>
		<title>Curtis Thompson - Analysis and Generation of Rap Lyrics</title>
		<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
		<link rel="stylesheet" type="text/css" href="/stylesheets/projects.css" />
		<meta name="author" content="Curtis Thompson" />
		<meta name="description" content="This project explores techniques used to artificially generate rap lyrics and presents a new technique for lyric generation centred around iterative improvements upon random text, akin to a hill-climbing algorithm. The resulting software is able to generate lyrics with a higher rhyme density than existing Markov chain and word substitution lyric generation models." />
		<meta name="keywords" content="curtis thompson, university of warwick, dissertation, rap, hip hop, generation of lyrics, natural language generation, markov chains, analysis" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
		<script src="/js/spoiler-change.js"></script>
	</head>
	
	
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
			<h1 id="small-header-box">Analysis and Generation of Rap Lyrics</h1>
			
			<div class="project-text-box">
				<div class="info-row"><span class="info-head">Date</span><span class="info-body">October 2018 - May 2019</span></div>
				<div class="info-row"><span class="info-head">Role</span><span class="info-body">Solo Project</span></div>
				<div class="info-row"><span class="info-head">Technologies</span><span class="info-body">Python</span></div>
				<div class="info-row"><span class="info-head">Description</span><span class="info-body">This project explores techniques used to artificially generate rap lyrics and presents a new technique for lyric generation centred around iterative improvements upon random text, akin to a hill-climbing algorithm. 21 metrics were implemented in a Python tool for songwriters to analyse their rap lyrics, including a new algorithm for rhyme detection. Random text is generated via a Markov chain-based approach using lyrics taken from Genius and classified as rap lyrics with 96% accuracy. The metrics are then used to suggest improvements to the lyrics, bringing each metric closer to the means found in existing lyrics. The resulting software is able to generate lyrics with a higher rhyme density than existing Markov chain and word substitution lyric generation models.</span></div>
			</div>
			
			<div class="project-text-box project-image-container">
			    <img src="generation-of-rap-rect.png" class="project-image" alt="Rap Lyric Analysis Interface" />
			</div>
			
			<div class="project-text-box">
				<h2>Features</h2>
				<ul>
					<li>Web interface for analysing lyrics based upon 21 metrics</li>
					<li>Random forest classifier able to quantify a text's similarity to existing rap lyrics</li>
					<li>Markov chain for generating single lines of text, trained on over 20000 song lyrics (over 1,500,000 lines)</li>
					<li>Generation of lyrics through iterative improvement of existing text</li>
				</ul>
			</div>
			
			<div class="project-text-box">
				<h2>Questions</h2>
				<div class="spoiler-button spoilerbutton">What was the result of your work?</div>
				<div id="spoiler1" class="spoiler">Overall, my new method of generating lyrics appeared more similar to existing rap lyrics than the other three methods studied in the dissertation (based upon the created 'rap likeness' classifier). In terms of the rhyme factor feature, the created system was able to outperform 15 of the 98 professional rappers used in the study - whereas two of the three existing systems would not beat any of these rappers. The dissertation also received 80% at the end of the year.</div>
				<div class="spoiler-button spoilerbutton">What was the motivation for this project?</div>
				<div id="spoiler2" class="spoiler">During the third year of university we all have to do a large solo project. I wanted to combine one of my interests or hobbies with an exciting area of Computer Science, as I believe this is possible for most interests if you take the right approach. While looking for inspirations I cam across the work of Eric Malmi, and his algorithm for detecting rhymes. From there I got lots of ideas for natural language processing, and ultimately came up with my system for generating rap lyrics. This is how "Analysis and Generation of Rap Lyrics" was born.</div>
				<div class="spoiler-button spoilerbutton">How does the generation system work?</div>
				<div id="spoiler3" class="spoiler">The system begins with initial random words or lyrics (specifically a single line generated via Markov Chains trained on existing lyrics). From there the system will analyse the lyrics based upon several features, and select a feature to improve that will make the lyrics appear more like existing lyrics (determined by the output of a random forest classifier). The system will then improve that feature in the lyrics. This cycle of analysis-improvement is repeated until the lyrics are satisfactory (the likeness threshold is reached) or enough iterations have passed.</div>
				<div class="spoiler-button spoilerbutton">Are there any disadvantages to using your system for generating lyrics?</div>
				<div id="spoiler4" class="spoiler">Obviously in terms of rhyming this is not the best existing system, but it does make up for it by structuring the lyrics similar to existing human-written lyrics. A potentially big disadvantage of the system is that it will adapt to the structure (and take the vocabulary) of the lyrics that the system is trained on. So if the quality of the training lyrics is low, then the final output will likely be low quality too. Similarly, if only 80s rap is used to train the system then the system will produce lyrics similar to 80s rap. This can be beneficial if the user wants to produce lyrics of a certain style, but in general it would be important to use a wide variety of lyrics to train the system.</div>
				<div class="spoiler-button spoilerbutton">What is the most important thing you learnt from this project?</div>
				<div id="spoiler5" class="spoiler">I did not struggle with project management of the overall project but there was a specific time where I fell behind on work and needed to adapt the plan to get back on track. Although I put in some mitigations to help, I still learnt a lot about juggling tasks. Not everything will be completed in the planned time, particularly when you also need to learn new information about tools or domain-specific knowledge. In a project like this, extra planning or research near the beginning will save more time during development.</div>
				<div class="spoiler-button spoilerbutton">What metrics can the analysis system use to quantify rap lyrics?</div>
				<div id="spoiler6" class="spoiler">There is a large variety of metrics, including:<ul><li>Rhyme density</li><li>Profanity count</li><li>Line syllable similarity</li><li>Reading age</li></ul></div>
			</div>
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
	</body>
</html>