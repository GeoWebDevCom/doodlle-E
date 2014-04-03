/**
 * @version: $Id: tabs.js 3421 2013-06-06 15:32:11Z Radek Suski $
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

 * $Date: 2013-06-06 17:32:11 +0200 (Thu, 06 Jun 2013) $
 * $Revision: 3421 $
 * $Author: Radek Suski $
 * File location: components/com_sobipro/lib/js/uncompressed/bootstrap/tabs.js $
 */

SobiPro.jQuery( document ).ready( function ()
{
	SobiPro.jQuery( '.nav-tabs li a' ).click( function ( e )
	{
		e.preventDefault();
		SobiPro.jQuery( this ).tab( 'show' );
	} );
} );

