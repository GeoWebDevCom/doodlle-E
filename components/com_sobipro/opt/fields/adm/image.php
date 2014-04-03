<?php
/**
 * @version: $Id: image.php 3225 2013-02-25 12:30:01Z Radek Suski $
 * @package: SobiPro Component for Joomla!

 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET

 * @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license GNU/GPL Version 3
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 3 as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 * See http://www.gnu.org/licenses/gpl.html and http://sobipro.sigsiu.net/licenses.

 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

 * $Date: 2013-02-25 13:30:01 +0100 (Mon, 25 Feb 2013) $
 * $Revision: 3225 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/opt/fields/adm/image.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadClass( 'opt.fields.image' );

/**
 * @author Radek Suski
 * @version 1.0
 * @created 28-Nov-2009 20:06:47
 */
class SPField_ImageAdm extends SPField_Image {

	/**
	 * @var string
	 */
	public $cssClass = "inputbox";
}
