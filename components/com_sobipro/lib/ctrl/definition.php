<?php
defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadController( 'controller' );
class SPDefinition extends SPController
{
/**
* @var string
*/
	protected $_type = 'definition';
	public function execute()
	{
	   $this->_task = strlen( $this->_task ) ? $this->_task : $this->_defTask;
	   switch ( $this->_task ) {
			case 'sideMenu':
	         	$this->sideMenu();
	         	break;
			case 'searchResults':
	         	$this->searchResults();
	         	break;
	   		default:
	        	Sobi::Error( 'SPDefinition', 'Task not found', SPC::WARNING, 404, __LINE__, __FILE__ );
	        	break;
	            }
	}
		
	public function cleanArray($array){
		$aClean_array = preg_replace('/-/', " ", $array);						// replaces '-' with ' '
		$aClean_array = array_map('ucwords', $aClean_array); 					// Upper Case first words
		$aClean_array = array_filter($aClean_array); 							// removes empty array elements						
		return $aClean_array;										
	}

	public function sideMenu() {

		// load category icons
		$db = SPFactory::db();
		$db->select( array('id', 'icon'), 'spdb_category', array( 'id>' => '40') );	
		$aRawCatIcons = $db->loadAssocList();										// loads category results from DB
		sort($aRawCatIcons);

		$aResCatIcons = array();
		foreach ($aRawCatIcons as $aValue){
			if (!empty($aValue) && !in_array($aValue, $aResCatIcons)){			// checks for duplicates and empty cells
				$aResCatIcons[$aValue['id']] = $aValue['icon'];
			}
		}
		// print_r ($aResCatIcons);
		
		// load Categories
		$db = SPFactory::db();
		$db->select( array('id', 'name'), 'spdb_object', array( 'parent' => '40') );
		$aRawCats = $db->loadAssocList();										// loads category results from DB
		sort($aRawCats);
		$aResCats = array();
		foreach ($aRawCats as $aValue){
			$aValue = $this->cleanArray($aValue);								
			if (!empty($aValue) && !in_array($aValue, $aResCats)){				// checks for duplicates and empty cells
				array_push($aResCats,array($aValue['id'] => array($aValue['name'], $aResCatIcons[$aValue['id']])));	// organise array
			}
		}
		// print_r($aResCats);
						
		// load states		
		$db = SPFactory::db();
		$db->select( 'optValue', 'spdb_field_option', array('fid' => '30') );
		$aRawStates = $db->loadAssocList();											// loads state results from DB
		$aResStates = array();
		foreach ($aRawStates as $aValue){
			$cleanedaValue = $this->cleanArray($aValue);
			if (!empty($aValue) && !in_array($aValue, $aResStates)){				// checks for duplicates and empty cells
				array_push($aResStates,array($aValue['optValue'] => $cleanedaValue['optValue']));	// organise array
			}
		}		

		// print results
		$result = 	'<form id="form" class="btn-group" data-toggle="buttons">';
		$result .= 	'<ul>';
		$result .= 	'<h3 class="font4">Categories</h3>';
		foreach ($aResCats as $list){
			foreach ($list as $id => $aCidIcon){
				$result .=  '<li><label class="btn-cat btn font3"><input type="checkbox" class="category_checkbox hide" id="'.$id.'"> ' . $aCidIcon[0] ;
				$result .= '<img id="icon' . $id . '" class="spCatIcon" alt="" src="media/sobipro/images/' . $aCidIcon[1] . '">
				<span><img id="icon' . $id . '" class="spCatIcon spCatIconHover" alt="" src="media/sobipro/images/' . substr($aCidIcon[1],0 ,-4) . 'SLD.png"></span>
				</label></li>';
			
			}
		}
		$result .= 	'</ul><ul>';
		$result .= 	'<h3 class="font4">States</h3>';
		foreach ($aResStates as $array){
			foreach ($array as $sStateId => $sState){
				$result .=  '<li><label class="btn btn-state font3"><input type="checkbox" class="state_checkbox hide" id="' . $sStateId . '"> ' . $sState . '</label></li>';
			}
		}		
		$result .= 	'</ul>';
		$result .= 	'</form>';
		echo $result;
	}
	
	public function searchResults(){
		$db = SPFactory::db();
		$db->select( 'sid', 'spdb_field_data', array( 'section' => '40') );
		$test = $db->loadResultArray();		
		$array = array_unique($test);
		// print_r($array);
		// echo "</br>";
		$aSearchResults = array();
		foreach($array as $sid){
			$db = SPFactory::db();
			$db->select( 'optValue', 'spdb_field_option_selected', array( 'sid' => $sid) );
			$stateId = $db->loadResultArray();

			$db = SPFactory::db();
			$db->select( 'pid', 'spdb_relations', array( 'id' => $sid) );
			$categoryId = $db->loadResultArray();

			if (!empty($stateId) || !empty($categoryId)){
				$aSearchResults += array($sid => array('states' => $stateId, 'cid' => $categoryId ));
			}
		}
		echo json_encode($aSearchResults);
	}
}