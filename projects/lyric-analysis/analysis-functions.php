<?php
function stopwords() {
    return array("i", "me", "my", "myself", "we", "our", "ours", "ourselves", "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself", "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their", "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these", "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has", "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if", "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about", "against", "between", "into", "through", "during", "before", "after", "above", "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under", "again", "further", "then", "once", "here", "there", "when", "where", "why", "how", "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no", "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can", "will", "just", "don", "should", "now");
}

// Converts the lyrics to lowercase
function lowercase($lyrics) {
    return strtolower($lyrics);
}

// Replaces new line characters with spaces
function lines_to_text($lyrics) {
    return str_replace("\n", " ", $lyrics);
}

function remove_punctuation($lyrics) {
    return preg_replace("#[[:punct:]]#", "", $lyrics);
}

function remove_spaces($word) {
    return preg_replace('/\s/', '', $word);
}

// Converts text into an array of tokens (space separated)
function tokenise($lyrics) {
    // Create empty array and tokeniser
    $tokens = array();
    $tokeniser = strtok($lyrics, " ");
    $count = 0;
    
    // Extract tokens
    while ($tokeniser !== false) {
        $tokens[$count] = trim($tokeniser);
        $tokeniser = strtok(" ");
        $count++;
    }
    
    return $tokens;
}

// Converts text into an array of lines (new line separated)
function line_split($lyrics) {
    $tokens = explode("\n", $lyrics);
    return $tokens;
}

// Counts the number of words in the lyrics
function word_count($lyrics) {
    $lyrics = lines_to_text($lyrics);
    $tokens = tokenise($lyrics);
    $words = sizeof($tokens);
    return $words;
}

// Counts the number of unique words in the lyrics
function unique_word_count($lyrics) {
    $lyrics = lines_to_text($lyrics);
    $lyrics = lowercase($lyrics);
    
    $tokens = tokenise($lyrics);
    $u_tokens = array_unique($tokens);
    $words = sizeof($u_tokens);
    return $words;
}

// Count the number of characters in the text
function character_count($lyrics) {
    if ($lyrics == "") {
        return 0;
    } else {
        $chars = str_split($lyrics);
        $count = sizeof($chars);
        return $count - line_count($lyrics) + 1;
    }
}

// Count the number of letters in the text
function letter_count($lyrics) {
    $lyrics = str_split($lyrics);
    $letters = array_filter($lyrics, "ctype_alpha");
    $count = sizeof($letters);
    return $count;
}

// Count the number of numbers in the text
function number_count($lyrics) {
    $lyrics = str_split($lyrics);
    $numbers = array_filter($lyrics, "is_numeric");
    $count = sizeof($numbers);
    return $count;
}

function is_new_line($char) {
    return $char == "\n";
}

// Count the number of lines in the text
function line_count($lyrics) {
    if ($lyrics == "") {
        return 0;
    } else {
        $lyrics = str_split($lyrics);
        $lines = array_filter($lyrics, "is_new_line");
        $count = sizeof($lines);
        return $count + 1;
    }
}

// Count the number of syllables in a specific word
function syllables_in_word($word, $ipa_array) {
    if (array_key_exists($word, $ipa_array)) {
        return character_count($ipa_array[$word]);
    } else {
        return max(round(letter_count($word) / 2.5), 1);
    }
}

// Count the number of syllables in a whole sentence/lyrics
function syllable_count($lyrics, $ipa_array) {
    // Prepare
    $lyrics = lines_to_text($lyrics);
    $lyrics = lowercase($lyrics);
    
    // Tokenise and count syllables in each word
    $tokens = tokenise($lyrics);
    $syllables = 0;
    foreach ($tokens as $word) {
        $syllables += syllables_in_word($word, $ipa_array);
    }
    
    return $syllables;
}

// Calculate the flesch reading ease of a text
function flesch_reading_ease($lyrics, $ipa_array) {
    // Calculate required statistics
    $words = word_count($lyrics);
    $syllables = syllable_count($lyrics, $ipa_array);
    $lines = line_count($lyrics);
    
    // Formula
    $reading_ease = 206.835;
    if ($words > 0 && $lines > 0) {
        $reading_ease =  206.835 - (1.015 * ($words / $lines)) - (84.6 * ($syllables / $words));
    }
    
    return $reading_ease;
}

function flesch_reading_ease_text($lyrics, $ipa_array) {
    $number = flesch_reading_ease($lyrics, $ipa_array);
    $age = 'Unknown';
    
    if (word_count($lyrics) > 10) {
        if ($number >= 90) {
            $age = 'Very Easy';
        } elseif ($number >= 80) {
            $age = 'Easy';
        } elseif ($number >= 70) {
            $age = 'Fairly Easy';
        } elseif ($number >= 60) {
            $age = 'Plain English';
        } elseif ($number >= 50) {
            $age = 'Fairly Difficult';
        } elseif ($number >= 30) {
            $age = 'Difficult';
        } else {
            $age = 'Very Difficult';
        }
    }
    
    return $age . ' (' . strval(round($number, 2)) . ')';
}

// Convert a line of text into vowel representation
function line_to_vowels($line, $ipa_array) {
    $vowel_line = "";
    $tokens = tokenise($line);
    
    foreach ($tokens as $word) {
        $nword = remove_spaces($word);
        if (array_key_exists($nword, $ipa_array)) {
            $vowel_line .= strval($ipa_array[$nword]);
        }
    }
    return $vowel_line;
}

function rhyme_prepare($lyrics, $ipa_array) {
    // Get each line of the lyrics
    $lyrics = lowercase($lyrics);
    $lines = line_split($lyrics);
    $vowel_lines = array();
    
    // Convert each line into vowel representation
    foreach ($lines as $line) {
        $vowel_lines[] = line_to_vowels($line, $ipa_array);
    }
    
    return $vowel_lines;
}

function rhyme_aa($lyrics, $ipa_array) {
    $vowel_lines = rhyme_prepare($lyrics, $ipa_array);
    
    // Go through each line and check for rhyming
    $rhyme_count = 0;
    $number_of_lines = count($vowel_lines);
    for ($i = 1; $i < $number_of_lines; $i++) {
        // Get lines to compare
        $line_1 = substr($vowel_lines[$i - 1], -1);
        $line_2 = substr($vowel_lines[$i], -1);
        
        // Compare lines
        if ((strlen($line_1) > 0) && ($line_1 == $line_2)) {
            $rhyme_count += 1;
        }
    }
    return $rhyme_count;
}

function rhyme_aabb($lyrics, $ipa_array) {
    $vowel_lines = rhyme_prepare($lyrics, $ipa_array);
    
    // Go through each line and check for rhyming
    $rhyme_count = 0;
    $number_of_lines = count($vowel_lines);
    for ($i = 3; $i < $number_of_lines; $i++) {
        // Get lines to compare
        $line_1 = substr($vowel_lines[$i - 3], -1);
        $line_2 = substr($vowel_lines[$i - 2], -1);
        $line_3 = substr($vowel_lines[$i - 1], -1);
        $line_4 = substr($vowel_lines[$i], -1);
        
        // Compare lines
        if ((strlen($line_1) > 0) && (strlen($line_3) > 0) && ($line_1 == $line_2) && ($line_3 == $line_4)) {
            $rhyme_count += 1;
        }
    }
    return $rhyme_count;
}

function rhyme_abab($lyrics, $ipa_array) {
    $vowel_lines = rhyme_prepare($lyrics, $ipa_array);
    
    // Go through each line and check for rhyming
    $rhyme_count = 0;
    $number_of_lines = count($vowel_lines);
    for ($i = 3; $i < $number_of_lines; $i++) {
        // Get lines to compare
        $line_1 = substr($vowel_lines[$i - 3], -1);
        $line_2 = substr($vowel_lines[$i - 2], -1);
        $line_3 = substr($vowel_lines[$i - 1], -1);
        $line_4 = substr($vowel_lines[$i], -1);
        
        // Compare lines
        if ((strlen($line_1) > 0) && (strlen($line_2) > 0) && ($line_1 == $line_3) && ($line_2 == $line_4)) {
            $rhyme_count += 1;
        }
    }
    return $rhyme_count;
}

function rhyme_abba($lyrics, $ipa_array) {
    $vowel_lines = rhyme_prepare($lyrics, $ipa_array);
    
    // Go through each line and check for rhyming
    $rhyme_count = 0;
    $number_of_lines = count($vowel_lines);
    for ($i = 3; $i < $number_of_lines; $i++) {
        // Get lines to compare
        $line_1 = substr($vowel_lines[$i - 3], -1);
        $line_2 = substr($vowel_lines[$i - 2], -1);
        $line_3 = substr($vowel_lines[$i - 1], -1);
        $line_4 = substr($vowel_lines[$i], -1);
        
        // Compare lines
        if ((strlen($line_1) > 0) && (strlen($line_3) > 0) && ($line_1 == $line_4) && ($line_2 == $line_3)) {
            $rhyme_count += 1;
        }
    }
    return $rhyme_count;
}

function rhyme_aaaa($lyrics, $ipa_array) {
    $vowel_lines = rhyme_prepare($lyrics, $ipa_array);
    
    // Go through each line and check for rhyming
    $rhyme_count = 0;
    $number_of_lines = count($vowel_lines);
    for ($i = 3; $i < $number_of_lines; $i++) {
        // Get lines to compare
        $line_1 = substr($vowel_lines[$i - 3], -1);
        $line_2 = substr($vowel_lines[$i - 2], -1);
        $line_3 = substr($vowel_lines[$i - 1], -1);
        $line_4 = substr($vowel_lines[$i], -1);
        
        // Compare lines
        if ((strlen($line_1) > 0) && ($line_1 == $line_2) && ($line_1 == $line_3) && ($line_1 == $line_4)) {
            $rhyme_count += 1;
        }
    }
    return $rhyme_count;
}

function most_frequent_words($lyrics) {
	// Extract words
	$lyrics = lowercase($lyrics);
	$lyrics = lines_to_text($lyrics);
	$lyrics = remove_punctuation($lyrics);
	$tokens = tokenise($lyrics);

	// Count words
	$word_counter = array();
	foreach($tokens as $word) {
	    if (!in_array($word, stopwords())) {
    		if (array_key_exists($word, $word_counter)) {
    			$word_counter[$word] += 1;
    		} else {
    			$word_counter[$word] = 1;
    		}
	    }
	}
    
	// Sort array and get first k words
	$k = 5;
	arsort($word_counter);
	$word_counter = array_slice($word_counter, 0, $k, true);

	return $word_counter;
}

?>