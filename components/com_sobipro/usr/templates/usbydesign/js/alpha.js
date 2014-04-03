/**
 * @version: $Id: alpha.js 1403 2011-05-24 07:47:50Z Sigrid Suski $
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
 * $Date: 2011-05-24 09:47:50 +0200 (Di, 24 Mai 2011) $
 * $Revision: 1403 $
 * $Author: Sigrid Suski $
 */




try{ jQuery.noConflict(); } catch( e ) {}
function SPAlphaSwitch( cid )
{
        jQuery( document ).ready( function() {
                sid = '#' + cid + 'Switch';
                jQuery( sid ).bind( 'change', function() {
                        jQuery( sid ).disabled = true;
                        jQuery( '#' + cid + 'Progress' ).html( '<img src="' + SPLiveSite + '/media/sobipro/styles/progress.gif" style="margin: 5px;" alt="loading"/>' );
                        jQuery.ajax( {
                                url: SobiProUrl.replace( '%task%', 'list.alpha.switch.'+ jQuery( this ).val() ),
                                data: { sid: SobiProSection, tmpl: "component", format: "raw" },
                          success: function( jsonObj ) {
                                  jQuery( sid ).disabled = false;
                                  jQuery( '#' + cid + 'Progress' ).html( '' );
                                  jQuery( '#' + cid ).html( jsonObj.index );
                          }                            
                        } );
                } );
        } );
}



