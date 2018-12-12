<?php
$file = file_get_contents("day3.txt");
$claims = explode("\n", $file);
$fabric_w = 0;
$fabric_h = 0;

for ($claimcount=0; $claimcount < count($claims); $claimcount++) {
  $claim = parseClaim($claims[$claimcount]);
  $w = $claim["left"] + $claim['w'];
  $h = $claim['top'] + $claim['h'];
  $fabric_w = max($fabric_w, $w);
  $fabric_h = max($fabric_h, $h);
}

$matrices = [];

foreach ($claims as $input) {
  $claim = parseClaim($input);
  $matrix = createMatrixFromClaim($claim);
  $matrices[] = $matrix;
}

$a = createMatrixFromClaim(parseClaim($claims[0]));
$b = createMatrixFromClaim(parseClaim($claims[1]));

toStringMatrix($a);
echo "\n\n";
toStringMatrix($b);
//toStringMatrix(createMatrixFromClaim(parseClaim($claims[0])));


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

function createMatrixFromClaim($claim) {
  global $fabric_h, $fabric_w;
  $matrix = createMatrix($fabric_w, $fabric_h);

  for($i = $claim['top']; $i < $claim['h']; $i++) {
    for ($k=$claim['left']; $k < $claim['w']; $k++) {
      $matrix[$i][$k] = 1;
    }
  }

  return $matrix;
}

function createMatrix($h, $w) {
  $matrix = [];
  for ($i=0; $i < $h; $i++) {
    $sub = [];
    for ($k=0; $k < $w; $k++) {
      $sub[] = 0;
    }
    $matrix[] = $sub;
  }
  return $matrix;
}

function matsum($a, $b) {
  $matrix = [];
  for ($i=0; $i < count($a); $i++) {
    $sub = [];
    for ($k=0; $k < count($a[0]); $k++) {
      $sub[] = $a[$i][$k] + $b[$i][$k];
    }
    $matrix[] = $sub;
  }
  return $matrix;
}

function toStringMatrix($m) {
  for ($i=0; $i < count($m); $i++) {
    $line = $m[$i];
    for ($k=0; $k < count($line); $k++) {
      echo $line[$k] . " ";
    }
    echo "\n";
  }
}


?>