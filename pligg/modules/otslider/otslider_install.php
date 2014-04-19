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
$module_info['name'] = 'OTslider';
$module_info['desc'] = 'An image and content slider to showcase featured articles and stories.';
$module_info['version'] = 1.0;
$module_info['settings_url'] = '../module.php?module=otslider';
$module_info['homepage_url'] = 'http://www.oxythemes.com/products/modules/otslider.html';

$module_info['db_add_table'][]=array(
'name' => table_prefix . "otslider",
'sql' => "CREATE TABLE `".table_prefix . "otslider` (
	`otslider_id` tinyint(4) NOT NULL AUTO_INCREMENT,
	`otslider_user_id` int(11) NOT NULL,
	`otslider_rank` tinyint(4) NOT NULL,
	`otslider_type` enum('photo','video','rich') NOT NULL DEFAULT 'photo',
	`otslider_title` varchar(255) NOT NULL,
	`otslider_link` varchar(255) NOT NULL,
	`otslider_link_target` enum('_blank','_self','_top','_parent') NOT NULL,
	`otslider_link_rel` enum('dofollow','nofollow','external','bookmark') NOT NULL DEFAULT 'dofollow',
	`otslider_content` text,
	`otslider_image` varchar(255) NOT NULL,
	`otslider_image_alt` varchar(255) DEFAULT NULL,
	`otslider_image_thumb` varchar(255) DEFAULT NULL,		
	`otslider_status` enum('Enabled','Disabled') NOT NULL,
	`otslider_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`otslider_date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`otslider_id`)
) ENGINE=MyISAM ");
/*
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderMimeType','image/*')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderImgMaxWidth','960')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderImgMinWidth','660')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderImgMaxHeight','367')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderImgMinHeight','156')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderDataDir','/modules/otslider/data/uploads')";
$module_info['db_sql'][] =  "INSERT  into " . table_misc_data . " (name,data) VALUES ('otsliderDataThumbDir','/modules/otslider/data/thumbs')";
*/
?>