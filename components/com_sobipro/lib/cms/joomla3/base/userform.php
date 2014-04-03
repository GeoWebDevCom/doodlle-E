<?php
/**
 * @version: $Id: userform.php 3225 2013-02-25 12:30:01Z Radek Suski $
 * @package: SobiPro Library

 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET

 * @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license GNU/LGPL Version 3
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License version 3 as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 * See http://www.gnu.org/licenses/lgpl.html and http://sobipro.sigsiu.net/licenses.

 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

 * $Date: 2013-02-25 13:30:01 +0100 (Mon, 25 Feb 2013) $
 * $Revision: 3225 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/lib/cms/joomla3/base/userform.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
jimport( 'joomla.form.helper' );
JFormHelper::loadFieldClass( 'user' );
/**
 * @property mixed input
 */
class SPFormFieldUser extends JFormFieldUser
{
	public function setup( $data )
	{
		foreach ( $data as $k => $v ) {
			$this->$k = $v;
		}
	}
}
