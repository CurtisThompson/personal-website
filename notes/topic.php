<!DOCTYPE html>

<html>

	<head>
		<title>Curtis Thompson - Notes</title>
		<link rel="stylesheet" type="text/css" href="../styling.css" />
		<link rel="stylesheet" type="text/css" href="note-styling.css" />
		<meta name="author" content="Curtis Thompson" />
		<meta name="description" content="On this page you can find all of my notes - writing which I have published to my website." />
		<meta name="keywords" content="curtis, thompson, about, contact, programmer, student, portfolio, notes, education, writing, artificial, intelligence" />
		<meta charset="UTF-8" />
	</head>
	
	
	<body>
		<?php include('../menu.php'); ?>
		
		<div id="MainContent">
			<div id="SmallHeaderBox">Notes</div>
			<p class="NotesDefaultText">On this page you can find all of my notes - writing which I have published to my website.</p>	
			
			<?php
				$topic = htmlspecialchars($_GET['topic']);
				
				$con = mysql_connect("localhost","cthomp98_cmntr","TheCommenter");
	 
				if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}
	
				mysql_select_db("cthomp98_web_pages", $con);
				
				if (empty($topic)) {
					$query = "SELECT * FROM `Notes` ORDER BY `Notes`.`ID` DESC";
				} else {
					$query = "SELECT * FROM `Notes` WHERE `Topic` = '$topic' ORDER BY `Notes`.`ID` DESC";
				}
	
				$notes = mysql_query($query);
		
				while($row = mysql_fetch_array($notes, MYSQL_ASSOC))
				{
					$date = $row['Date'];  		
	  				$timestamp = date("d/m/y", strtotime($date));
					$title = htmlspecialchars($row['Title'],ENT_QUOTES);
					$url = htmlspecialchars($row['URL'],ENT_QUOTES);
					
					echo" <a href='$url'><div id='NotesHighlighter'>
					<span id='Name'>$title</span><span id='Time'>$timestamp</span><br />
					</div></a>";
				}
	
				mysql_close($con);
	
			?>
			
		</div>
	</body>
	
</html>