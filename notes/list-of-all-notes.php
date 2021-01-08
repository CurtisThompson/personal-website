<?php

// Make connection to the database
ini_set("include_path", '/home/cthomp98/php:' . ini_get("include_path") );
$con = mysql_connect("localhost","cthomp98_cmntr","TheCommenter");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("cthomp98_web_pages", $con);

// Get notes URLs
$query = "SELECT URL FROM Notes";
$res = mysql_query($query);

// Output URLs
while($row = mysql_fetch_array($res, MYSQL_ASSOC))
{
	echo '<p>' . $row['URL'] . '</p>';
}

// Close database connection
mysql_close($con);

?>