<?php
$file = file_get_contents("day2.txt");
$words = explode("\n", $file);
$two = 0;
$three = 0;
foreach ($words as $word) {
	$letters = str_split(trim($word));
	sort($letters);
	
	$isThree=false;
	$isTwo=false;
	
	while (count($letters) > 1) {
		// Vergleiche "cur" mit restlichen buchstaben
		$cur = array_pop($letters);
		$count_cur = 1;
		
		foreach ($letters as $k => $letter) {
			if ($cur == $letter) {
				$count_cur++;
				unset($letters[$k]);
			}
		}		
		
		if ($count_cur == 3 && !$isThree) {
			$three++;
			$isThree = true;
		}
		
		if ($count_cur == 2 && !$isTwo) {
			$two++;
			$isTwo = true;
		}
		
		if ($isTwo && $isThree) break;
		
		$tmp = array_values($letters);
		$letters = $tmp;		
	}	
}

$code = $two * $three;
echo "Code " . $code;

?>
