<?php
/**
 *
 * @version 	$Id: helper.php 2010-08-04 10:19:55 svn $
 * @author		Hardi Utomo
 * @author mail	soetomboz@yahoo.com
 * @website		http://soetombozweb.id/
 * @package		Joomla
 * @subpackage	TzMonials
 * @license		GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

// SPLoader::loadController( 'controller' );

class mod_sobiProSearchHelper {
	
	public static function cleanArray($array){
		$aClean_array = preg_replace('/-/', " ", $array);						// replaces '-' with ' '
		$aClean_array = array_map('ucwords', $aClean_array); 					// Upper Case first words
		$aClean_array = array_filter($aClean_array); 							// removes empty array elements						
		return $aClean_array;										
	}

	public static function getCatsList() {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select($db->quoteName(array('id', 'name')))
				->from($db->quoteName('zn5a1_sobipro_object'))
				->where($db->quoteName('parent') . '=40');
		$db->setQuery($query);													// Prepare the query
		$aRawCats = $db->loadAssocList();										// Load the row
		sort($aRawCats);

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select($db->quoteName(array('id', 'icon')))
				->from($db->quoteName('zn5a1_sobipro_category'))
				->where($db->quoteName('id') . '>40');
		$db->setQuery($query);													// Prepare the query
		$aRawCatIcons = $db->loadAssocList();										// Load the row
		sort($aRawCatIcons);
		$aResCatIcons = array();

		foreach ($aRawCatIcons as $aValue){
			// $class_category = new mod_sobiProSearchHelper;
			// $aValue = $class_category->cleanArray($aValue);								
			if (!empty($aValue) && !in_array($aValue, $aResCatIcons)){			// checks for duplicates and empty cells
				// array_push($aResCatIcons,array($aValue['id'] =>$aValue['icon']));	// organise array
				$aResCatIcons[$aValue['id']] = $aValue['icon'];
			}
		}

		$aResCats = array();
		foreach ($aRawCats as $aValue){
			$class_category = new mod_sobiProSearchHelper;
			$aValue = $class_category->cleanArray($aValue);								
			if (!empty($aValue) && !in_array($aValue, $aResCats)){				// checks for duplicates and empty cells
				array_push($aResCats,array($aValue['id'] => array($aValue['name'], $aResCatIcons[$aValue['id']])));	// organise array
			}
		}

		return $aResCats;
	}	
		
	public static function getStatesList() {
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);

		$query	->select($db->quoteName('optValue'))
				->from($db->quoteName('zn5a1_sobipro_field_option'))
				->where($db->quoteName('fid') . '=30'); 

		$db->setQuery($query);													// Prepare the query
		
		$aRawStates = $db->loadAssocList();										// Load the row
		sort($aRawStates);
		$aResStates = array();
				foreach ($aRawStates as $aValue){
					$class_state = new mod_sobiProSearchHelper;
					$cleanedaValue = $class_state->cleanArray($aValue);
					if (!empty($aValue) && !in_array($aValue, $aResStates)){				// checks for duplicates and empty cells
						array_push($aResStates,array($aValue['optValue'] => $cleanedaValue['optValue']));	// organise array
					}
				}		
		// print_r($aResStates);
		
		return $aResStates;				
	}
	
	// public static function getItemid(){
	// 	$db		=& JFactory::getDbo();
	// 	$query = 'SELECT id FROM #__menu WHERE type="component" AND link like "%index.php?option=com_sobipro%" and published =1';
	// 	$db->setQuery($query);
	// 	$load = $db->loadColumn();
	// 	return $load;
	// }

}
?>