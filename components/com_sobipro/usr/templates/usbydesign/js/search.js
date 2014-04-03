/**
 * @version: $Id: search.js 2449 2012-05-08 16:10:27Z Sigrid Suski $
 * @package: SobiPro Template SobiRestara
 * ===================================================
 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET
 * ===================================================
 * @copyright Copyright (C) 2006 - 2011 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license Sigsiu.NET Template License V1.
 * ===================================================
 * $Date: 2012-05-08 18:10:27 +0200 (Di, 08 Mai 2012) $
 * $Revision: 2449 $
 * $Author: Sigrid Suski $
 */
try{ jQuery.noConflict(); } catch( e ) {}
jQuery( document ).ready( function() {
    spSearchDefStr = jQuery( '#SPSearchBox' ).val();
    jQuery( '#SPSearchBox' ).bind( 'click', function() {
        if( jQuery( '#SPSearchBox' ).val() == spSearchDefStr ) {
            jQuery( '#SPSearchBox' ).val( '' );
        };
    } );
    jQuery( '#SPSearchBox' ).bind( 'blur', function() {
        if( jQuery( '#SPSearchBox' ).val() == '' ) {
            jQuery( '#SPSearchBox' ).val( spSearchDefStr );
        };
    } );
} );

var cache = {};
var lastXhr;
try {
  jQuery().ready( function() {
    jQuery( '#SPSearchBox' ).autocomplete( {
      minLength: 3,
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        } 
        lastXhr = jQuery.ajax( {
          url: SobiProUrl.replace( '%task%', 'search.suggest' ),
          data: {
            term: request.term,
            sid: SobiProSection,
            tmpl: "component",
            format: "raw"
          },
          success: function( data ) {
            cache[ term ] = data;
            response( data );
          }
        } );
      }
    });    
  });
} catch ( e ) {}