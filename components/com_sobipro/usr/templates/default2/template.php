<?php
/**
 * @version: $Id: template.php 3300 2013-03-15 10:11:27Z Sigrid Suski $
 * @package: SobiPro Component for Joomla!

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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

 * $Date: 2013-03-15 11:11:27 +0100 (Fri, 15 Mar 2013) $
 * $Revision: 3300 $
 * $Author: Sigrid Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/usr/templates/default2/template.php $
 */

/* Warning:
 * If you have added here your own functions accessing the database and you experience that SobiPro is slow,
 * it is HIGHLY recommended to remove these functions.
 * The more you add your own code, especially if accessing the database, the more you slow down SobiPro!
 * The functions here are not cached by SobiPro caching mechanisms.
 * Keep in mind that you bypass SobiPro speed acceleration measures!
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );

abstract class TplFunctions
{

	public static function Cfg(  $key, $def = null, $section = 'general'  )
	{
		return Sobi::Cfg( $key, $def, $section );
	}

	/**
	 * Set of possible simple plug-ins/hookup functions
	 * which allow manipulate data while adding
	 * a new or saving an existing entry
	 */

	/**
	 * Called right at the beginning of the submit process
	 * Allow for example to modify the $_REQUEST data
	 * @param $model SPEntry
	 * */
//	public static function BeforeSubmitEntry( SPEntry &$model )
//	{
//	}

	/**
	 * Called at the end of the submit process
	 * @param $model SPEntry
	 * */
//	public static function AfterSubmitEntry( SPEntry &$model )
//	{
//	}

	/**
	 * Called right at the beginning of the save process
	 * Allow for example to modify the $request data
	 * @param $model SPEntry
	 * @param $request string - type of the request where the data is stored
	 * */
//	public static function BeforeStoreEntry( SPEntry &$model, $request )
//	{
//	}

	/**
	 * Called right at the end of the save process
	 * @param $model SPEntry
	 * */
//	public static function AfterStoreEntry( SPEntry &$model )
//	{
//	}

	/**
	 * Called right before the payment is being stored in the
	 * payment registry - SPFactory::payment()->store( $sid );
	 * @param $sid integer - id of the entry
	 * */
//	public static function BeforeStoreEntryPayment( $sid )
//	{
//	}

	/**
	 * Called right before the payment view
	 * Inside the submit and the save action
	 * @param array $data
	 */
//	public static function BeforePaymentView( &$data )
//	{
//	}
}
