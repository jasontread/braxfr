#!/usr/bin/php -q
<?php
require_once('/var/www/sierra/lib/core/SRA_Controller.php');
SRA_Controller::init('cloudbench');
$dao =& SRA_DaoFactory::getDao('CB_ComputeResource');
ch_include('CH_GeoIpUtil.php');
$hosts = array();
foreach(file('probes.txt') as $host) {
  $resource =& $dao->find(trim($host));
  $hosts[] = sprintf("%s,%s", trim($host), CH_GeoIpUtil::getContinent($resource->getLocation()));
}
shuffle($hosts);
print(implode("\n", $hosts));
?>
