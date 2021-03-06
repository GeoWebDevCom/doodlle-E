/**
 * @version: $Id: field_category.js 2989 2013-01-15 16:32:42Z Sigrid Suski $
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

 * $Date: 2013-01-15 17:32:42 +0100 (Tue, 15 Jan 2013) $
 * $Revision: 2989 $
 * $Author: Sigrid Suski $
 * File location: components/com_sobipro/lib/js/opt/field_category.js $
 */

function SPCategoryChooser( opt )
{
	SobiPro.jQuery( document ).ready( function ()
	{
		SobiPro.jQuery( '#' + opt.id ).change( function ( e )
		{
			var selected = SobiPro.jQuery( this ).find( ':selected' );
			if ( selected.length > opt.limit ) {
				alert( SobiPro.Txt( 'FCC_LIMIT_REACHED' ).replace( '%d', opt.limit ) )
				for ( var i = opt.limit; i < selected.length; i++ ) {
					SobiPro.jQuery( selected[ i ] ).removeAttr( 'selected' );
				}
			}
		} );
	} );
}
