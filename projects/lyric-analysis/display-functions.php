<?php

function display_two_column_list($array) {
	foreach($array as $word => $word_count) {
		echo "<div class='two-columns'><span class='column'>" . $word . "</span><span class='column'>" . $word_count . "</span></div>";
	}
}

?>