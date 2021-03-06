<?php
/**
 * @version: $Id: mainframe.php 3345 2013-04-08 07:51:26Z Radek Suski $
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

 * $Date: 2013-04-08 09:51:26 +0200 (Mon, 08 Apr 2013) $
 * $Revision: 3345 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/lib/cms/joomla15/base/mainframe.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
require_once dirname(__FILE__).'/../../joomla_common/base/mainframe.php';
/**
 * Interface between SobiPro and the used CMS
 * @author Radek Suski
 * @version 1.0
 * @created 10-Jan-2009 5:50:43 PM
 */
final class SPJ15MainFrame extends SPJoomlaMainFrame implements SPMainframeInterface
{
	public function setCookie( $name, $value, $expire = 0, $httponly = false, $secure = false, $path = '/', $domain = null )
	{
		setcookie( $name, $value, $expire, $path, $domain, $secure, $httponly );
	}
}
