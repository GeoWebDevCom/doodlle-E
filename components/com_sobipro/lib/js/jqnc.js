/**
 * @version: $Id: jqnc.js 3021 2013-01-19 13:14:46Z Radek Suski $
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

 * $Date: 2013-01-19 14:14:46 +0100 (Sat, 19 Jan 2013) $
 * $Revision: 3021 $
 * $Author: Radek Suski $
 * File location: components/com_sobipro/lib/js/jqnc.js $
 */

SobiPro.setJq( jQuery.noConflict() );
SobiPro.jQuery.fn.ScrollTo = function () {
	SobiPro.jQuery( this ).show();
	SobiPro.jQuery( 'html, body' ).animate( { scrollTop:( SobiPro.jQuery( this ).offset().top - 50 ) + 'px' }, 'fast' );
    return this;
};
