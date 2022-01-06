#!/usr/bin/php -q
<?php
require_once('/var/www/sierra/lib/core/SRA_Controller.php');
SRA_Controller::init('cloudbench');
$dao =& SRA_DaoFactory::getDao('CB_ComputeResourceGroup');
$group =& $dao->find('ch-probes');
foreach($group->getResources() as $resource) {
  printf("%s\n", $resource->getIpOrHostname());
}
?>
