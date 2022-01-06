#!/usr/bin/php -q
<?php
require_once('/var/www/sierra/lib/core/SRA_Controller.php');
SRA_Controller::init('cloudharmony');
ch_include('CH_GeoIpUtil.php');
for($i=1; $i<count($argv); $i++) {
  if (is_file($argv[$i])) {
    $fp = fopen($argv[$i] . '.tmp', 'w');
    foreach(file($argv[$i]) as $line) {
      $pieces = explode(',', trim($line));
      $geoip = preg_match('/^[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+$/', $pieces[4]) ? CH_GeoIpUtil::getIpInfo($pieces[4], CH_GEOIP_UTIL_IP2LOCATION) : NULL;
      $pieces[] = $geoip ? $geoip['continent_code'] : '';
      fwrite($fp, sprintf("%s\n", implode(',', $pieces)));
    }
    fclose($fp);
    exec(sprintf('rm -f %s', $argv[$i]));
    exec(sprintf('mv %s.tmp %s', $argv[$i], $argv[$i]));
  }
}
?>
