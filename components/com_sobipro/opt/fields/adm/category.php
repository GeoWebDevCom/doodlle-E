<?php
/**
 * @version: $Id: category.php 2983 2013-01-15 12:21:38Z Sigrid Suski $
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

 * $Date: 2013-01-15 13:21:38 +0100 (Tue, 15 Jan 2013) $
 * $Revision: 2983 $
 * $Author: Sigrid Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/opt/fields/adm/category.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadClass( 'opt.fields.category' );

/**
 * @author Radek Suski
 * @version 1.0
 * @created 09-Aug-2012 14:11:54
 */
class SPField_CategoryAdm extends SPField_Category
{
	/**
	 * @var string
	 */
	public $cssClass = "inputbox";
}
