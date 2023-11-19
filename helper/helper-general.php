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

function getVariablesFromUrl($url)
{
  $parsed = parse_url($url);
  if (!$parsed || !isset($parsed['host']) || !isset($parsed['path'])) {
    return false;
  }

  // Extract the path component
  $path = $parsed['path'];

  $parts = explode('/', $path);
  $firstValue = $parts[1];

  $lastValue = end($parts);

  return ["toko" => $firstValue, "id_produk" => $lastValue];
}

// Example usage:
$url = 'https://www.tokopedia.com/unilever/molto-pewangi-pakaian-fresh-hygiene-780ml?src=topads';
$variables = getVariablesFromUrl($url);
print_r($variables);
