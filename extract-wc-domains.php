<?php
ini_set('memory_limit', '1g');
$output = array();
$domains = array();
foreach(file('top-1m.csv') as $line) {
  $pieces = explode(',', trim($line));
  $domains[$pieces[1]] = $pieces[0];
}
foreach(file('host-counts.csv') as $line) {
  $pieces = explode(',', trim($line));
  $domain = $pieces[0];
  $hosts = $pieces[1]*1;
  if ($hosts >= 10 && !isset($output[$domain])) {
    $output[$domain] = TRUE;
    printf("%d,%s\n", $domains[$domain], $domain);
  }
}
?>