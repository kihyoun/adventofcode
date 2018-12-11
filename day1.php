<?php
$file = file_get_contents("freq.txt");
$numbers = explode("\n", $file);

$sum = 0;
$strippedlist = array(0);

while(true) {
	foreach ($numbers as $key => $number) {
		$stripped = trim(intval($number));	
		$sum += $stripped;
			
		if (in_array($sum, $strippedlist)) {
				echo $sum . 'is the first double';
				exit;
		}
		
		$strippedlist[] = $sum;	
	}
}

//echo $sum;
//if (in_array(56, $strippedlist)) echo "FOUND";

?>
