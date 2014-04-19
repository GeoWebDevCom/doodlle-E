<?php
// +------------------------------------------------------------------------+
// | OTslider Pligg Module                                                  |
// +------------------------------------------------------------------------+
// | Copyright ©2013 OxyThemes.com                                          |
// | Version	1.0                                                         |
// | Email		support@oxythemes.com                                       |
// | Web		http://www.oxythemes.com/products/modules/otslider.html     |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify   |
// | it under the terms of the GNU General Public License version 2 as      |
// | published by the Free Software Foundation.                             |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the                          |
// | Free Software Foundation, Inc., 59 Temple Place, Suite 330,            |
// | Boston, MA 02111-1307 USA                                              |
// |                                                                        |
// +------------------------------------------------------------------------+
function otsliderShowpage() {
	global $db, $current_user, $main_smarty;
	
	$main_smarty = do_sidebar($main_smarty);
	
	force_authentication();
	$canIhaveAccess = 0;
	$canIhaveAccess = $canIhaveAccess + checklevel('admin');
	
	if($canIhaveAccess == 1) {		
		define('modulename', 'otslider');
		$main_smarty->assign('modulename', modulename);
		
		/* Breadcrumb
		$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel');
		$navwhere['link1'] = getmyurl('admin', '');
		$navwhere['text2'] = "OTslider Administration";
		$navwhere['link2'] = my_pligg_base . otsliderPath;
		$main_smarty->assign('navbar_where', $navwhere);
		$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
		*/
		
		$otsliderAction = isset($_GET['do']) ? $_GET['do'] : '';
		$otsliderDataDir = './modules/' . basename(dirname(__FILE__)) . '/data/uploads';
		$otsliderThumbDir = './modules/' . basename(dirname(__FILE__)) . '/data/thumbs';
		
		switch ($otsliderAction) {
			case "addSlide":
				define('pagename', 'otsliderAdd');
				$main_smarty->assign('pagename', pagename);
				
				if ((isset($_POST['addSlide']) ? $_POST['addSlide'] : (isset($_GET['addSlide']) ? $_GET['addSlide'] : '')) == 'submitSlide') {
					include_once('lib/class.upload.php');
					
					$slideTitle = mysql_real_escape_string($_POST['inputSlideTitle']);
					$slideURL = mysql_real_escape_string($_POST['inputSlideURL']);	
					$slideURLTarget = mysql_real_escape_string($_POST['inputSlideURLTarget']);
					$slideStatus = mysql_real_escape_string($_POST['inputSlideStatus']);
					$slideOrder = (int)($_POST['inputSlideOrder']);
					$slideImageAlt = mysql_real_escape_string($_POST['inputSlideImageAlt']);
					$slideImage = new Upload($_FILES['inputSlideImage']);
					// Allowed File Parameters
					$slideImage->allowed = array('image/*');
					$slideImage->image_min_width = 660;
					$slideImage->image_min_height = 156;
					$slideImage->image_max_width = 960;
					$slideImage->image_max_height = 400;
					
					$addSlideError = false;
					$addSlideErrorMsg = array();
					$addSlideImgError = false;
					$addSlidImgeErrorMsg = '';
					
					if (strlen(trim($slideTitle)) == 0) {
						$addSlideError = true;
						$addSlideErrorMsg[] = '<b>Slide Title</b> is required and must not be left blank.';
					}
					if (strlen(trim($slideURL)) == 0) {
						$addSlideError = true;
						$addSlideErrorMsg[] = '<b>Slide Full URL</b> is required and must not be left blank.';
					}
					if (strlen(trim($_POST['inputSlideOrder'])) == 0) {
						$addSlideError = true;
						$addSlideErrorMsg[] = '<b>Display Order</b> is required and must not be left blank.';
					}
					if (!preg_match('/^[1-9][0-9]{0,3}$/', $_POST['inputSlideOrder'])) {
						$addSlideError = true;
						$addSlideErrorMsg[] = '<b>Display Order</b> must be a numeric value greater than zero.';
					}
					if (strlen(trim($slideImageAlt)) == 0) {
						$addSlideError = true;
						$addSlideErrorMsg[] = '<b>Slide Image Alt Text</b> is required and must not be left blank.';
					}
					
					if($addSlideError) {
						$main_smarty->assign('addSlideError',$addSlideError);
						$main_smarty->assign('addSlideErrorMsg',$addSlideErrorMsg);
					}
					else {
						if ($slideImage->uploaded) {
							// Upload Original Image
							$slideImageNewName = substr(md5($slideImage->file_src_name), 0, 15);
							$slideImage->file_new_name_body = $slideImageNewName;
							$slideImage->Process($otsliderDataDir);
							
							if ($slideImage->processed) {
								// Generate Thumbnail
								$slideImage->image_resize = true;
								$slideImage->image_x = 80;
								$slideImage->image_y = 80;
								$slideImage->image_ratio = true;
								$slideImage->image_ratio_crop = true;
								$slideImageThumbNewName = substr(md5($slideImage->file_src_name), 0, 15).'-thumb';
								$slideImage->file_new_name_body = $slideImageThumbNewName;
								$slideImage->Process($otsliderThumbDir);
								
								// Insert DB Data
								$db->query("
									INSERT INTO ".table_prefix."otslider (otslider_user_id,otslider_title,otslider_link,otslider_link_target,otslider_status,otslider_rank,otslider_image,otslider_image_thumb,otslider_image_alt)
									VALUES ('$current_user->user_id','$slideTitle','$slideURL','$slideURLTarget','$slideStatus','$slideOrder','$slideImageNewName.$slideImage->file_src_name_ext','$slideImageThumbNewName.$slideImage->file_src_name_ext','$slideImageAlt')
								");
								
								// Back To Main
								header("Location: ".my_pligg_base."/module.php?module=otslider");
								die();
							}
							else {
								$addSlideImgError = true;
								$main_smarty->assign('addSlideImgError',$addSlideImgError);
								$main_smarty->assign('addSlidImgeErrorMsg',$slideImage->error);
							}			
							$slideImage->Clean();
						}
						else {
							$addSlideImgError = true;
							$main_smarty->assign('addSlideImgError',$addSlideImgError);
							$main_smarty->assign('addSlidImgeErrorMsg',$slideImage->error);
						}
					}
				}
				$main_smarty->assign('tpl_center', otsliderTplPath . 'otsliderAdd');
				$main_smarty->display($template_dir . '/admin/admin.tpl');
				break;
			
			case "editSlide":
				include_once('lib/class.upload.php');
				
				$slideID = (isset($_GET['slideID']) && is_numeric($_GET['slideID'])) ? (int)($_GET['slideID']) : 0;
				
				$slideRowQuery = $db->get_row("
					SELECT otslider_title, otslider_link, otslider_link_target, otslider_status, otslider_rank, otslider_image, otslider_image_alt, otslider_image_thumb
					FROM ".table_prefix."otslider
					WHERE otslider_user_id=".$current_user->user_id." AND otslider_id=".$slideID."
				");
				$slideRow = object_2_array($slideRowQuery);
				
				if($slideRow) {
					if ((isset($_POST['editSlide']) ? $_POST['editSlide'] : (isset($_GET['editSlide']) ? $_GET['editSlide'] : '')) == 'updateSlide') {
						
						$slideTitle = mysql_real_escape_string($_POST['inputSlideTitle']);
						$slideURL = mysql_real_escape_string($_POST['inputSlideURL']);	
						$slideURLTarget = mysql_real_escape_string($_POST['inputSlideURLTarget']);
						$slideStatus = mysql_real_escape_string($_POST['inputSlideStatus']);
						$slideOrder = (int)($_POST['inputSlideOrder']);
						$slideImageAlt = mysql_real_escape_string($_POST['inputSlideImageAlt']);
						
						$editSlideError = false;
						$editSlideErrorMsg = array();
						$editSlideImgError = false;
						$editSlidImgeErrorMsg = '';
						
						if (strlen(trim($slideTitle)) == 0) {
							$editSlideError = true;
							$editSlideErrorMsg[] = '<b>Slide Title</b> is required and must not be left blank.';
						}
						if (strlen(trim($slideURL)) == 0) {
							$editSlideError = true;
							$editSlideErrorMsg[] = '<b>Slide Full URL</b> is required and must not be left blank.';
						}
						if (strlen(trim($_POST['inputSlideOrder'])) == 0) {
							$editSlideError = true;
							$editSlideErrorMsg[] = '<b>Display Order</b> is required and must not be left blank.';
						}
						if (!preg_match('/^[1-9][0-9]{0,3}$/', $_POST['inputSlideOrder'])) {
							$editSlideError = true;
							$editSlideErrorMsg[] = '<b>Display Order</b> must be a numeric value greater than zero.';
						}
						if (strlen(trim($slideImageAlt)) == 0) {
							$editSlideError = true;
							$editSlideErrorMsg[] = '<b>Slide Image Alt Text</b> is required and must not be left blank.';
						}
						
						if($editSlideError) {
							$main_smarty->assign('editSlideError',$editSlideError);
							$main_smarty->assign('editSlideErrorMsg',$editSlideErrorMsg);
						}
						else {
							if($_FILES["inputSlideImage"]["error"] == 4) {
								// Update DB Data Only
								$db->query("
									UPDATE ".table_prefix."otslider
									SET otslider_title = '$slideTitle',
										otslider_link = '$slideURL',
										otslider_link_target = '$slideURLTarget',
										otslider_status = '$slideStatus',
										otslider_rank = '$slideOrder',
										otslider_image_alt = '$slideImageAlt',
										otslider_date_modified = now()
									WHERE otslider_user_id = '$current_user->user_id' AND otslider_id = '$slideID'
								");
								// Back To Main
								header("Location: ".my_pligg_base."/module.php?module=otslider");
								die();
							}
							else {
								$slideImage = new Upload($_FILES['inputSlideImage']);
								// Allowed File Parameters
								$slideImage->allowed = array('image/*');
								$slideImage->image_min_width = 660;
								$slideImage->image_min_height = 156;
								$slideImage->image_max_width = 960;
								$slideImage->image_max_height = 400;
								
								if ($slideImage->uploaded) {									
									// Replace Current Image
									$slideImageNewName = substr(md5($slideImage->file_src_name), 0, 15);
									$slideImage->file_new_name_body = $slideImageNewName;
									$slideImage->Process($otsliderDataDir);
									
									if ($slideImage->processed) {
										// Delete Current Thumbnail
										unlink('modules/otslider/data/uploads/'.$slideRowQuery->otslider_image);
										unlink('modules/otslider/data/thumbs/'.$slideRowQuery->otslider_image_thumb);
										
										// Generate New Thumbnail
										$slideImage->image_resize = true;
										$slideImage->image_x = 80;
										$slideImage->image_y = 80;
										$slideImage->image_ratio = true;
										$slideImage->image_ratio_crop = true;
										$slideImageThumbNewName = substr(md5($slideImage->file_src_name), 0, 15).'-thumb';
										$slideImage->file_new_name_body = $slideImageThumbNewName;
										$slideImage->Process($otsliderThumbDir);
										
										// Update DB Data
										$db->query("
											UPDATE ".table_prefix."otslider
											SET otslider_title = '$slideTitle',
												otslider_link = '$slideURL',
												otslider_link_target = '$slideURLTarget',
												otslider_status = '$slideStatus',
												otslider_rank = '$slideOrder',
												otslider_image = '$slideImageNewName.$slideImage->file_src_name_ext',
												otslider_image_alt = '$slideImageAlt',
												otslider_image_thumb = '$slideImageThumbNewName.$slideImage->file_src_name_ext',
												otslider_date_modified = now()
											WHERE otslider_user_id = '$current_user->user_id' AND otslider_id = '$slideID'
										");
										// Back To Main
										header("Location: ".my_pligg_base."/module.php?module=otslider");
										die();
									}
									else {
										$addSlideImgError = true;
										$main_smarty->assign('editSlideImgError',$addSlideImgError);
										$main_smarty->assign('editSlidImgeErrorMsg',$slideImage->error);
									}			
									$slideImage->Clean();
								}
								else {
									$addSlideImgError = true;
									$main_smarty->assign('editSlideImgError',$addSlideImgError);
									$main_smarty->assign('editSlidImgeErrorMsg',$slideImage->error);
								}
							}
						}
					}
					$main_smarty->assign('slideRow',$slideRow);				
					$main_smarty->assign('tpl_center', otsliderTplPath . 'otsliderEdit');
					$main_smarty->display($template_dir . '/admin/admin.tpl');
				}
				else {
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				break;
			
			case "deleteSlide":
				$slideID = (isset($_GET['slideID']) && is_numeric($_GET['slideID'])) ? (int)($_GET['slideID']) : 0;
				
				if ($slideID != 0) {										
					$dbFile = $db->get_row("SELECT otslider_image, otslider_image_thumb FROM ".table_prefix."otslider WHERE otslider_user_id=".$current_user->user_id." AND otslider_id=".$slideID."");
					
					unlink('modules/otslider/data/uploads/'.$dbFile->otslider_image);
					unlink('modules/otslider/data/thumbs/'.$dbFile->otslider_image_thumb);
					
					$db->query("DELETE FROM ".table_prefix."otslider WHERE otslider_user_id=".$current_user->user_id." AND otslider_id=".$slideID."");
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				else {
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				break;
			
			case "enableSlide":
				$slideID = (isset($_GET['slideID']) && is_numeric($_GET['slideID'])) ? (int)($_GET['slideID']) : 0;
				if ($slideID != 0) {					
					$db->query("UPDATE ".table_prefix."otslider SET otslider_status = 'Enabled' WHERE otslider_user_id=".$current_user->user_id." AND otslider_id=".$slideID."");
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				else {
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				break;
			
			case "disableSlide":
				$slideID = (isset($_GET['slideID']) && is_numeric($_GET['slideID'])) ? (int)($_GET['slideID']) : 0;
				if ($slideID != 0) {					
					$db->query("UPDATE ".table_prefix."otslider SET otslider_status = 'Disabled' WHERE otslider_user_id=".$current_user->user_id." AND otslider_id=".$slideID."");
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				else {
					header("Location: ".my_pligg_base."/module.php?module=otslider");
					die();
				}
				break;
			
			default:
				$slides = object_2_array($db->get_results("SELECT * FROM " . table_prefix . "otslider ORDER BY otslider_rank ASC"));
				$main_smarty->assign('slidesList',$slides);
				$main_smarty->assign('user_id', $current_user->user_id);
				
				$main_smarty->assign('tpl_center', otsliderTplPath . 'otsliderMain');
				$main_smarty->display($template_dir . '/admin/admin.tpl');
				break;
		}
	}
	else {
		header("Location: " . getmyurl('login', $_SERVER['REQUEST_URI']));
	}
}

function otsliderData(&$vars) {
	global $db, $main_smarty;
	
	$slides = $db->get_results("
		SELECT otslider_title, otslider_link, otslider_link_target, otslider_status, otslider_rank, otslider_image, otslider_image_alt FROM ".table_prefix."otslider
		WHERE otslider_status = 'Enabled'
		ORDER BY otslider_rank ASC
	");
	if ($slides) {
		$main_smarty->assign('slidesList', object_2_array($slides));
		$otSlider = $main_smarty->fetch(otsliderTplPath . 'otslider.tpl');
		$main_smarty->assign('otSlider',$otSlider);
	}
}
/*
function getOTsliderSettings() {
	return array(
		'allowedMimeType' => unserialize(get_misc_data('otsliderMimeType')), 
		'imageMaxWidth' => get_misc_data('otsliderImgMaxWidth'), 
		'imageMinWidth' => get_misc_data('otsliderImgMinWidth'), 
		'imageMaxHeight' => get_misc_data('otsliderImgMaxHeight'),
		'imageMinHeight' => get_misc_data('otsliderImgMinHeight'),
		'dataDir' => get_misc_data('otsliderDataDir'),
		'dataThumbDir' => get_misc_data('otsliderDataThumbDir')
	);
}
*/
?>