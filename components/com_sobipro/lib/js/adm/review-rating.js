/**
 * @version: $Id: review-rating.js 3540 2013-07-09 19:41:01Z Radek Suski $
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
 * $Date: 2013-07-09 21:41:01 +0200 (Di, 09 Jul 2013) $
 * $Revision: 3540 $
 * $Author: Radek Suski $
 */

SobiPro.jQuery( function ()
{
	SobiPro.jQuery( '#review-positives' ).tagsInput( { 'defaultText': SobiPro.jQuery( '#review-positives' ).prop( 'placeholder' ), 'width': '400px', 'height': null } );
	SobiPro.jQuery( '#review-negatives' ).tagsInput( { 'defaultText': SobiPro.jQuery( '#review-negatives' ).prop( 'placeholder' ), 'width': '400px', 'height': null } );
	SobiPro.jQuery( 'input.sprrstar' ).rating(
		{
			half: true,
			callback: function ( value )
			{
				SobiPro.jQuery( this ).parent().find( '.rating-value' ).html( value );
			}
		} );
	SobiPro.jQuery( '#SPAdminForm' ).on( 'AfterAjaxSubmit', function ( e, t, response )
	{
		if ( (typeof response.data.sets != 'undefined'  ) && ( typeof response.data.sets.oar != 'undefined'  ) ) {
//			SobiPro.jQuery( '.oar-value' ).html( response.data.sets.oar_txt );
//			SobiPro.jQuery( '.oar' ).rating( 'readOnly', false );
//			SobiPro.jQuery( '.oar' ).rating( 'select', Math.round( response.data.sets.oar ) );
		}
	} );
} );
