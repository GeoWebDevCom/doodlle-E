<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<form id="sobiProSearchFormContainer" class="btn-group" onsubmit="resetSobiProCookies();" accept-charset="<?php echo $iso[1];?>" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="get" name="sobiProSearchFormContainer">
    <ul>
		<div class="sobiPro-checkbox"><h3 class="font4">Select Category</h3>
        <?php
		// $currentSection new SPFactory::currentSection();
		// $types = $currentSection->types();
		// echo $types;

		foreach($catsLists as $list){
			foreach($list as $id => $aCidIcon) {
						$checked = '';
						if(JRequest::getVar('field_category'))
							$checked = in_array($aCidIcon[0], JRequest::getVar('field_category')) ? 'checked ' : '';
						echo '<li><label class="btn btn-cat font3"><input class="checkbox" name="field_category[]" value="' . $id .'"type="checkbox"  '.$checked.'/>'. $aCidIcon[0] .'
						<img id="icon' . $id . '" class="spCatIcon" alt="" src="media/sobipro/images/' . $aCidIcon[1] . '">
						<span><img id="icon' . $id . '" class="spCatIcon spCatIconHover" alt="" src="media/sobipro/images/' . substr($aCidIcon[1],0 ,-4) . 'SLD.png"></span>
						</label></li>';
			}	
		}
		?>
        </div>
		</ul>
		<ul>
        <div class="sobi-checkbox"><h3 class="font4">Select State</h3>
        <?php

		foreach($statesLists as $list){
			foreach($list as $id => $cid) {
						$checked = '';
						if(JRequest::getVar('field_state'))
							$checked = in_array($cid, JRequest::getVar('field_state')) ? 'checked ' : '';
						echo '<li><label class="btn btn-state font3"><input name="field_state[]" value="' . $id .'"type="checkbox" value="'. $cid .'" '.$checked.'/>'. $cid .'</label></li>';
			}
		}
?>
        </div>
        <div class="sobi-submit">
            <input type="submit" value="Search" class="btn font3" name="search" id="sobiSearchSubmitBtBt"/> 
        </div>
    </ul>  
    <input type="hidden" name="option" value="com_sobipro"/>
    <input type="hidden" name="task" value="search.search"/>
	<input type="hidden" name="sid" value="<?php  echo $sid;?>"/>   
</form>
