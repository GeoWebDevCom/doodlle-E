/**
 * @version: $Id: details.js 2445 2012-05-07 17:16:08Z Sigrid Suski $
 * @package: SobiPro Template SobiRestara
 * ===================================================
 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET
 * ===================================================
 * @copyright Copyright (C) 2012 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license Sigsiu.NET Template License V1.
 * ===================================================
 * $Date: 2012-05-07 19:16:08 +0200 (Mo, 07 Mai 2012) $
 * $Revision: 2445 $
 * $Author: Sigrid Suski $
 */
var sptplroot = SPLiveSite + 'components/com_sobipro/usr/templates/usbydesign/';
jQuery( function() {
	jQuery('#SPGallery a').lightBox();	
	jQuery("#stabs UL LI A").each(function() {
	    	jQuery(this).attr("href", location.href.toString()+jQuery(this).attr("href"));
		});
	jQuery( "#stabs" ).tabs();
	jQuery( '#stabs' ).bind( 'tabsshow', function( event, ui ) {
		if ( ui.panel.id == 'addr' ) {
	            try {
	                var handler = SPGeoMapsReg[ jQuery( 'div[id^=field_map_canvas_]' ).attr( 'id' ) ];
	                google.maps.event.trigger( handler.Map, 'resize' );
	                handler.Map.setCenter( handler.Position );
	            } catch (e) {}
	    }
	} );
} );

jQuery(document).ready(function(){
	jQuery('#sobiProSearchFormContainer').html('');
	jQuery('#content').attr({class: "span12"});
	jQuery('#SPGeomap').css({display: "block"});
	jQuery('#SPDisc_Target img').css({cursor: "pointer"});
	// make gallery sortable
	jQuery(function(){
		jQuery('#SPGallery').sortable();
		jQuery('#SPGallery').disableSelection();
	})
	
	// function to make big-image launch gallery on click
	jQuery('.SPGallery_preview a').on('click', function(e){
		e.preventDefault();
		jQuery('.SPGallery_cell:first-child a').trigger('click');
	})
	
	// function for replacing preview image with thumbs with mouseover
	jQuery('#SPGallery a').mouseover(function(e){ 		
		//prevent href link
		e.preventDefault();
		
		// create src and href vars from thumbs to transfer to preview
		var thumb_href = jQuery(this).first().attr('href');
		var thumb_src = jQuery(this).children('img').attr('src');
		
		// for fadeout image on change comment out line below and add lines above
		jQuery('.SPGallery_preview img').first().attr('src', thumb_src);
		jQuery('.SPGallery_preview a').first().attr('href', thumb_href);		
	})
	
	// function to toggle text description
	var varsToUndo = {
		curSPGalleryPos: jQuery('#SPGallery').position(),
		SPDescriptionTitle: jQuery('.SPDescription_container h3').text(),
		bigImagePos: (jQuery('.big-image').position()),
		bigImageHeight: (jQuery('.big-image').height())
	}				
	var objA = {
		SPDescription_container: jQuery('.SPDescription_container')
	}
	jQuery('#SPtitle').toggle(
			function(){
				jQuery(objA.SPDescription_container).addClass('height', 100);
				jQuery('.SPDescription_container div').each(function($key, $value){
					if ($key != 0){
						jQuery(this).hide(100);
					}else{
						jQuery(this).children().contents().filter(function () {
						     return this.nodeType === 3;
						}).remove();
					}
				}).promise().done(function(){
					jQuery('.SPDescription_container h3').addClass('width', 400);
					jQuery(objA.SPDescription_container).animate({width: "-=235", marginLeft: '-=60px'}, 400, function(){
						jQuery('.big-image').animate({width:'+=350px', left:'-=312px'}, 800, 'easeInOutBack');
						jQuery('#SPgallery_container .span6 h3, #SPgallery_container .span6 p').addClass('hide');
						// get coordinates of bottom of big-image
						jQuery('#SPGallery').animate({top: varsToUndo.bigImageHeight + varsToUndo.bigImagePos.top + 30}, 400);
					});
				});
			},
			function(){
				jQuery('#SPGallery').animate({top: varsToUndo.curSPGalleryPos.top}, 400);
				jQuery('#SPgallery_container .span6 h3, #SPgallery_container .span6 p').removeClass('hide');
				jQuery('.big-image').animate({left: '+=312px', width: '-=350px'},800, 'easeInBack', function(){
					jQuery('.SPDescription_container h3').removeClass('width', 400);
					jQuery('.SPDescription_container h3').append(varsToUndo.SPDescriptionTitle);
					jQuery(objA.SPDescription_container).animate({marginLeft: "+=60px", width: "+=235px"}, 400, function(){
						jQuery('.SPDescription_container div:not(:first-child)').show(400);
						jQuery(objA.SPDescription_container).removeClass('height', 400);
					});
				});	
			})		
})

