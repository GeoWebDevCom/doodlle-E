<?php
/**
 * @version: $Id: init.php 3483 2013-06-26 16:51:26Z Radek Suski $
 * @package: SobiPro Review & Rating Application
 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET
 * @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license GNU/GPL Version 3
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 3
 * as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 * See http://www.gnu.org/licenses/gpl.html and http://sobipro.sigsiu.net/licenses.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * $Date: 2013-06-26 18:51:26 +0200 (Mi, 26 Jun 2013) $
 * $Revision: 3483 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );

/**
 * @author Radek Suski
 * @version 1.0
 */
class SPRr extends SPApplication
{
	private static $methods = array( 'CreateAdmMenu', 'EntryViewDetails', 'ListEntry', 'AfterDisplayEntryAdmView' );

	public function __construct()
	{
		self::$methods = array_unique( self::$methods );
	}

	public function AfterDisplayEntryAdmView()
	{
//		echo "<div style='clear:both'>&nbsp;</div>";
	}

	/* (non-PHPdoc)
	 * @see Site/lib/plugins/SPPlugin#provide($action)
	 */
	public function provide( $action )
	{
		// when loaded
		static $lang = false;
		if ( !( $lang ) && class_exists( 'SPLang' ) ) {
			SPLang::load( 'SpApp.review_rating' );
			$lang = true;
		}
		return in_array( $action, self::$methods );
	}

	public function CreateAdmMenu( &$menu )
	{
		if ( ( Sobi::Section() ) ) {
			$this->CreateMenu( $menu );
		}
	}

	private function CreateMenu( &$menu )
	{
		if ( isset( $menu[ 'AMN.SEC_CFG' ] ) ) {
			$menu[ 'AMN.SEC_CFG' ][ 'review' ] = self::Txt( 'MENU_SPRR' );
		}
		if ( isset( $menu[ 'AMN.ENT_CAT' ] ) ) {
			$menu[ 'AMN.ENT_CAT' ][ 'review.list' ] = self::Txt( 'MENU_SPRR_ALL' );
		}
	}

	public function EntryViewDetails( &$data )
	{
		$css = array( 'review', 'bootstrap.bootstrap' );
		$js = array( 'jquery', 'rating', 'review', 'bootstrap', 'bootstrap.bootbox', 'bootstrap.tooltips', 'bootstrap.popover', 'review-tags' );
		SPFactory::header()->addCssFile( $css );
		SPFactory::header()->addJsFile( $js );
		$site = SPRequest::int( 'site', 1 );
		SPFactory::Model( 'review' )
				->setSid( $data[ 'entry' ][ '_attributes' ][ 'id' ] )
				->setDetails( $data, $site );
	}

	public function ListEntry( &$data )
	{
		SPFactory::header()->addCssFile( array( 'review' ) );
		SPFactory::Model( 'review' )
				->setSid( $data[ 'id' ] )
				->setList( $data );
	}

	public static function Txt( $txt )
	{
		return Sobi::Txt( 'SPRRA.' . $txt );
	}
}
