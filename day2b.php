<?php
$file = file_get_contents("day2.txt");
$words = explode("\n", $file);
$best = -1;

for ($k=0; $k < count($words); $k++) {
	$myword = $words[$k];
	
	for ($i=$k+1; $i < count($words); $i++) {		
		$dist = levenshtein($myword, $words[$i]);
		if ($dist < 2) {
			echo "Words: \n". $myword . "\n" . $words[$i];
		}
	}
}

?>
