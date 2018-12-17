<?php
$file = file_get_contents("day3.txt");
$claims = explode("\n", $file);
$fabric_w = 0;
$fabric_h = 0;

$dict = [];

for ($claimcount=0; $claimcount < count($claims); $claimcount++) {
  
  $claim = parseClaim($claims[$claimcount]);
  for ($i=0; $i<$claim['h']; $i++) {
    for ($k=0; $k<$claim['w']; $k++) {

      if (!array_key_exists("T" . strval($claim['top'] + $i), $dict)) {
        $dict["T" . strval($i + $claim['top'])] = array();
      }

      if (!array_key_exists("T" . strval($k + $claim['left']), $dict["T" . strval($i + $claim['top'])])) {
        $dict["T" . strval($i + $claim['top'])]["T" . strval($k + $claim['left'])] = 0;
      } 

      $dict["T" . strval($i + $claim['top'])]["T" . strval($k + $claim['left'])]++;
    }
  }
}

$total = 0;
foreach ($dict as $k => $data) {
  foreach ($data as $k2 => $val) {
    if ($val > 1) $total++;
  }
}

echo $total;

for ($claimcount=0; $claimcount < count($claims); $claimcount++) {
  $single = true;
  $claim = parseClaim($claims[$claimcount]);
  for ($i=0; $i<$claim['h']; $i++) {
    for ($k=0; $k<$claim['w']; $k++) {  

      if ($dict["T" . strval($i + $claim['top'])]["T" . strval($k + $claim['left'])] > 1) {
        $single = false;
      }
    }
  }
  if ($single) var_dump($claim);
}

function parseClaim($claim) {
  $parts = explode(" ", $claim);
  $spaces = explode(",", $parts[2]);
  $size = explode("x", $parts[3]);

  return [
    "id" => intval(str_replace("#", "", $parts[0])),
    "left" => intval($spaces[0]),
    "top" => intval(str_replace(":", "", $spaces[1])),
    "w" => intval($size[0]),
    "h" => intval($size[1])
  ];
}

?>