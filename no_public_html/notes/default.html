<!DOCTYPE html>

<html>

	<head>
		<title>Curtis Thompson - Notes</title>
		<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
		<link rel="stylesheet" type="text/css" href="/stylesheets/notes.css" />
		<meta name="author" content="Curtis Thompson" />
		<meta name="description" content="On this page you can find all of my notes - writing which I have published to my website." />
		<meta name="keywords" content="curtis, thompson, about, contact, programmer, student, portfolio, notes, education, writing, artificial, intelligence" />
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
	</head>
	
	
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content" class="about-text">
			<h1 id="small-header-box">Notes</h1>
			<p class="intro-text">On this page you can find all of my notes - writing which I have published to my website.</p>	
			<h2>Latest Notes</h2>
			<?php
                
                // Make connection to the database
                ini_set("include_path", '/home/cthomp98/php:' . ini_get("include_path") );
				$con = mysql_connect("localhost","cthomp98_cmntr","TheCommenter");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}
				mysql_select_db("cthomp98_web_pages", $con);
				
				// Get total number of results
				$count = mysql_query("SELECT Count(*) AS count FROM Notes");
				$count = mysql_fetch_row($count)[0];
				
				// Get the page to retrieve
				$limit = 5;
				$page = $_GET['page'];
				$page_offset = $page * $limit - $limit;
				$max_page = ceil($count / 5);
				// If page past limit, set to oldest pages
				if ($page_offset > $count) {
				    $page_offset = $count - $limit;
				    $page = $max_page;
				}
				if ($page_offset < 0) {
				    $page_offset = 0;
				    $page = 1;
				}
                
                // Get page of notes
				$query = "SELECT * FROM `Notes` ORDER BY `Notes`.`ID` DESC LIMIT " . $limit . " OFFSET " . $page_offset;
				$res = mysql_query($query);
				
				/*
				$query = "SELECT * FROM `Notes` ORDER BY `Notes`.`ID` DESC LIMIT ? OFFSET ?";
				$stmt = mysqli_prepare($con, $query);
				mysqli_stmt_bind_param($stmt, "i", $limit);
				mysqli_stmt_bind_param($stmt, "i", $page);
				mysqli_stmt_execute($stmt);
				echo "A" . phpversion();
				$res = mysqli_stmt_get_result($stmt);
				echo "D";
				*/
	
	            // Output notes summaries to page
				while($row = mysql_fetch_array($res, MYSQL_ASSOC))
				{
					$date = $row['Date'];  		
  					$timestamp = date("l jS F Y", strtotime($date));
					$title = htmlspecialchars($row['Title'],ENT_QUOTES);
					$author = htmlspecialchars($row['Author'],ENT_QUOTES);
					$url = htmlspecialchars($row['URL'],ENT_QUOTES);
					$desc = htmlspecialchars($row['Description'],ENT_QUOTES);
				
					echo"<div class='notes-indiv-container'>
					<a href='$url'><h3 class='notes-title'>$title</h3></a>
					<p class='notes-author'>$author</p><p class='notes-time'>$timestamp</p>
					<p class='notes-desc'>$desc</p>
					<a class='read-article' href='$url'>Read Notes</a>
					</div>";
				}
				
				// Close database connection
				mysql_close($con);
				echo '</div>';
				echo '<div class="max-width">';
				
				function notes_page_link($page_num, $is_current, $text) {
				    $current_page = '';
				    if ($is_current) {
				        $current_page = " style='font-weight:bold;text-decoration:none;'";
				    }
				    echo "<a class='notes-page-changer' href='.?page=$page_num'$current_page>$text</a>";
				}
				
				echo "<div class='notes-page-changer-container'>";
				// Output page links
				if ($page > 3) {
				    notes_page_link(1, False, "<<");
				}
				if ($page > 2) {
				    notes_page_link($page - 2, False, $page - 2);
				}
				if ($page > 1) {
				    notes_page_link($page - 1, False, $page - 1);
				}
				notes_page_link($page, True, $page);
				if ($page < $max_page) {
				    notes_page_link($page + 1, False, $page + 1);
				}
				if ($page < $max_page - 1) {
				    notes_page_link($page + 2, False, $page + 2);
				}
				if ($page < $max_page - 2) {
				    notes_page_link($max_page, False, ">>");
				}
				echo "</div>";

			?>	
		</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
	</body>
	
</html>