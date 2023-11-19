<?php
function generateRandomCode()
{
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = '';

  for ($i = 0; $i < 5; $i++) {
    $randomIndex = mt_rand(0, strlen($characters) - 1);
    $code .= $characters[$randomIndex];
  }
  return $code;
}

function extractID($inputString)
{
  $pattern = '/ID\s([A-Z0-9]+)/';
  preg_match($pattern, $inputString, $matches);

  if (isset($matches[1])) {
    return $matches[1];
  } else {
    return "gak dapat"; // ID not found in the input string
  }
}

$inputString = 'Sukses disimpan dengan ID 1S4F8 asdfasdf asdfasdfasdf asdf';
$extractedID = extractID($inputString);
echo $extractedID;
