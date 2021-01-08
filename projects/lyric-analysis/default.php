<?php
    include 'analysis-functions.php';
    include 'display-functions.php';
    include 'ipa-vowels.php';
    $lyrics = "";
    if (isset($_POST['lyric-input'])) {
        $lyrics = $_POST['lyric-input'];
    }
?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<title>Curtis Thompson - Lyric Analysis</title>
		<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
		<meta name="author" content="Curtis Thompson" />
		<meta name="description" content="An online lyric analysis application. Music lyrics can be analysed with metrics such as word count, readability, and rhyme patterns." />
		<meta name="keywords" content="curtis, thompson, lyrics, analysis, word count, hip hop, genre, music, readability, rhyme" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
		<link rel="stylesheet" type="text/css" href="lyric-styling.css" />
		<script>
		    $(document).ready(function(){
		        $("#small-header-box").get(0).scrollIntoView();
		    });
		</script>
	</head>
	
	
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
		    <h1 id="small-header-box">Lyric Analysis</h1>
		    <span style="clear:both"></span>
			<div id="lyric-analysis-container">
        		<div class="left-pane">
        			<form id="lyrics" method="post">
        				<textarea name="lyric-input" placeholder="Lyrics can be inputted here..."><?php echo $lyrics; ?></textarea>
        				<input type="submit" value="Analyse Lyrics" />
        			</form>
        		</div>
        		
        		<div class="right-pane">
        			<h2>Word Counts</h2>
        			<div class="stat-section">
        				<div class="analysis-2">
        					<div class="analysis-1"><h3>Total Words</h3><p><?php echo word_count($lyrics); ?></p></div>
        					<div class="analysis-1"><h3>Unique Words</h3><p><?php echo unique_word_count($lyrics); ?></p></div>
        				</div>
        				<div class="analysis-3">
        					<div class="analysis-1"><h3>Characters</h3><p><?php echo character_count($lyrics); ?></p></div>
        					<div class="analysis-1"><h3>Numbers</h3><p><?php echo number_count($lyrics); ?></p></div>
        					<div class="analysis-1"><h3>Letters</h3><p><?php echo letter_count($lyrics); ?></p></div>
        				</div>
        			</div>
        			
        			<h2>Readability</h2>
        			<div class="stat-section">
        			    <div class="analysis-1"><h3>Reading Difficulty</h3><p><?php echo flesch_reading_ease_text($lyrics, $ipa_array); ?></p></div>
        				<div class="analysis-2">
        					<div class="analysis-1"><h3>Syllables</h3><p><?php echo syllable_count($lyrics, $ipa_array); ?></p></div>
        					<div class="analysis-1"><h3>Lines</h3><p><?php echo line_count($lyrics); ?></p></div>
        				</div>
        			</div>
        			
        			<h2>Rhyme Patterns</h2>
        			<div class="stat-section">
        				<div class="analysis-3">
        					<div class="analysis-1"><h3>AA</h3><p><?php echo rhyme_aa($lyrics, $ipa_array); ?></p></div>
        					<div class="analysis-1"><h3>AABB</h3><p><?php echo rhyme_aabb($lyrics, $ipa_array); ?></p></div>
        					<div class="analysis-1"><h3>ABAB</h3><p><?php echo rhyme_abab($lyrics, $ipa_array); ?></p></div>
        				</div>
        				<div class="analysis-2">
        					<div class="analysis-1"><h3>ABBA</h3><p><?php echo rhyme_abba($lyrics, $ipa_array); ?></p></div>
        					<div class="analysis-1"><h3>AAAA</h3><p><?php echo rhyme_aaaa($lyrics, $ipa_array); ?></p></div>
        				</div>
        			</div>
        			
        			<?php
        			if (strlen($lyrics) > 20) {
            			echo '<h2>Frequent Words</h2>';
            			echo '<div class="stat-section">';
            			display_two_column_list(most_frequent_words($lyrics));
            			echo '</div>';
        			}
        			?>
        			
        			<p class="analyser-small-text">Thank you for using my basic lyric analyser. I hope it's useful to you. If you find any bugs then please let me know... or if you have any suggestions then I am welcome to them as well.</p>
        		</div>
        		<span style="clear:both"></span>
        	</div>
		<div style="clear:both;margin-bottom:2em;"></div>
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
	</body>
	
</html>