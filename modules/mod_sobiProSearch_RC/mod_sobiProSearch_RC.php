<?php
// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$catsLists = mod_sobiProSearchHelper::getCatsList();
$statesLists = mod_sobiProSearchHelper::getStatesList();
// $Itemid = mod_sobiProSearchHelper::getItemid();
// $sid = SPRequest::sid();
$jinput = JFactory::getApplication()->input;
$sid = $jinput->get('sid');

require(JModuleHelper::getLayoutPath('mod_sobiProSearch_RC'));

?>