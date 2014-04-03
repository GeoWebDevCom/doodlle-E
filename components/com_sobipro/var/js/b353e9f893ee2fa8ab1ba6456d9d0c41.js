
/* Created at: Tue Mar 11 21:30:53 UTC 2014 */

// ========
// File: /components/com_sobipro/lib/js/sobipro.js
// ========

function SobiPro(){this.fns=new Array();this.jQuery=null;this.lang=null;this.DebOut=function(a){try{console.log(a)}catch(e){}};this.Json=function(a,b){try{return new Json.Remote(a,b)}catch(e){b.url=a;return new Request.JSON(b)}};this.Request=function(a,b){try{return new Ajax(a,b)}catch(e){b.url=a;var r=new Request(b);r.request=function(){this.send()};return r}};this.setLang=function(a){this.lang=a};this.setJq=function(j){this.jQuery=j};this.onReady=function(f){this.fns.push(f)};this.Ready=function(){for(var i=0,j=this.fns.length;i<j;i++){f=this.fns[i];f()}};this.Txt=function(a){string=a.toUpperCase();string=string.replace(/ /g,'_');string=string.replace(/[^A-Z0-9_]/g,'');if(this.lang!=null&&this.lang[string]){return this.lang[string].replace('{newline}',"\n")}else{return this.Translate(a)}};this.Translate=function(b){var c=this;SobiPro.jQuery.ajax({url:'index.php',data:{'option':'com_sobipro','task':'txt.translate','term':b,'sid':SobiProSection,'format':'json'},type:'post',dataType:'json',async:false,success:function(a){if(a.translation){c.lang[b]=a.translation;b=a.translation}}});return b};this.StripSlashes=function(a){a=a.replace(/\\'/g,'\'');a=a.replace(/\\"/g,'"');a=a.replace(/\\0/g,'\0');a=a.replace(/\\\\/g,'\\');return a};this.htmlEntities=function(a){var e=document.createElement('pre');a=a.replace(/<\/?[^>]+>/gi,'');e.innerHTML=a;try{r=e.firstChild.nodeValue.replace(/^\s*/,'').replace(/\s*$/,'')}catch(e){try{r=e.nodeValue.replace(/^\s*/,'').replace(/\s*$/,'')}catch(e){r=a}}return r};this.Alert=function(a){alert(this.Txt(a))}}var SobiPro=new SobiPro();function SPinclude(a){var b=window.document.createElement('script');b.setAttribute('src',a);b.setAttribute('type','text/javascript');window.document.head.appendChild(b)}function SP_node(a){if(!a){a=document}return a}function SP_id(a,b){return SP_node(b).getElementById(a)}function SP_name(a,b){return SP_node(b).getElementsByName(a)}function SP_tag(a,b){return SP_node(b).getElementsByTagName(a)}function SP_class(a,b){var c=[];var d=new RegExp('\\b'+a+'\\b');var e=SP_node(b).getElementsByTagName("*");for(var i=0,j=e.length;i<j;i++){if(d.test(e[i].className)){c.push(e[i])}}return c}function SPForm(){this.values=new Array();this.request=function(){string='';for(i=0;i<this.values.length;i++){string=string+this.values[i][0]+'='+encodeURI(this.values[i][1])+'&'}return string};this.parse=function(a){for(var i=0;i<a.childNodes.length;i++){tagName=new String(a.childNodes[i].tagName).toLowerCase();var e=a.childNodes[i];if(tagName=='input'){tagName=e.type}switch(tagName){case'text':case'textarea':this.values.push(new Array(e.name,e.value));break;case'radio':case'checkbox':if(e.checked==true){this.values.push(new Array(e.name,e.value))}break;case'select':var b=e.options;var c=false;for(var j=0;j<b.length;j++){if((b[j].value!=0&&b[j].value!='')&&b[j].selected==true){this.values.push(new Array(e.name,b[j].value));break}}break;default:if(a.childNodes[i].childNodes.length>0){r=this.parse(e)}break}}return this}}function SPValidator(){this.radio=[];this.labels=[];this.background='red';this.escape=function(a,b){if(!b){b=a.id}b=b.replace(/[^\a-z0-9\-\_\.]/g,'');this.highlight(SP_id(b));alert(SobiPro.Txt('ADD_ENTRY_FIELD_REQUIRED').replace('$field','"'+this.label(b)+'"'));return false};this.highlight=function(a){currStyle=a.style.backgroundColor;if(a.attachEvent){a.attachEvent('onclick',function(){this.style.backgroundColor=currStyle})}else{a.addEventListener('click',function(){this.style.backgroundColor=currStyle},false)}a.style.backgroundColor=this.background};this.label=function(a){var b=SobiPro.Txt('RED_HIGHLIGHTED_FIELD');for(var j=0;j<this.labels.length;j++){if(this.labels[j].getAttribute('for')==a){temp=SobiPro.htmlEntities(this.labels[j].innerHTML).replace(/\s\s/g,'');if(temp!=''){b=temp}break}}return b};this.filter=function(e){r=true;try{for(var f=0;f<=SPFilter.length;f++){if(e.name==SPFilter[f].name){val=SP_id(SPFilter[f].name).value;var a=eval("new RegExp("+SPFilter[f].filter+")");if(val!=''&&(a.test(val)==false)){this.highlight(e);alert(SPFilter[f].msg.replace('$field','"'+this.label(e.id)+'"'));r=false;break}}}}catch(ex){}return r};this.validate=function(b){this.labels=SP_tag('label');var r=true;for(var i=0;i<b.childNodes.length;i++){tagName=new String(b.childNodes[i].tagName);tagName=tagName.toLowerCase();var e=b.childNodes[i];if(tagName=='input'){tagName=e.type}if(tagName=='text'||tagName=='textarea'){r=this.filter(e)}switch(tagName){case'text':if(e.className.indexOf('required')!=-1){if(e.value==''){r=this.escape(e);break}}break;case'radio':case'checkbox':if(e.className.indexOf('required')!=-1){if(!(this.radio.some(function(a){return a==e.name}))){r=false;index=SP_name(e.name).length;re=SP_name(e.name);for(var i=0;i<index;i++){if(re[i].checked==true){r=true;break}}if(r==true){this.radio.push(e.name)}else{this.escape(e,e.name)}}}break;case'textarea':if(e.className.indexOf('required')!=-1){if(e.value==''){r=this.escape(e);break}}break;case'select':if(e.className.indexOf('required')!=-1){var c=e.options;var d=false;for(var j=0;j<c.length;j++){if((c[j].value!=0&&c[j].value!='')&&c[j].selected==true){d=true;break}}if(d==false){r=this.escape(e);break}}break;default:if(b.childNodes[i].childNodes.length>0){r=this.validate(e)}break}if(r==false){break}}return r}}function SPValidateForm(){return new SPValidator().validate(SP_id('SPAdminForm'))}function SPValidate(a){return new SPValidator().validate(a)}function SP_parentPath(a){}function SPcancelEdit(){SP_id('SP_task').value='entry.cancel';SP_id('spEntryForm').submit()}
;

// ========
// File: /components/com_sobipro/lib/js/jqnc.js
// ========

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
;

// ========
// File: /components/com_sobipro/usr/templates/usbydesign/js/alpha.js
// ========

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



;

// ========
// File: /components/com_sobipro/usr/templates/usbydesign/js/v-card_custom.js
// ========


jQuery(document).ready(function(){



	jQuery(document).on('change', ".btn", (function(){							//makes checkbox buttons active when clicked
				jQuery(this).toggleClass('active');
	}));
	
	jQuery('.moduletable').html('<div id="searchSP"></div>');						//create id to receive js menu
	
	jQuery('#sobiProSearchFormContainer').html('');
	jQuery('#content').attr({class: "span9"});
	
	function xhr_post($task, $async, $dataType){								//ajax request function
		if (typeof($async)==='undefined')	{$async = 'true'};
		if (typeof($dataType)==='undefined'){$async = 'html'};
	
		return jQuery.ajax({
			type: 'post',
			async: false,
		  	url: SobiProUrl.replace( '%task%', $task ),
			data: {'sid': SobiProSection,
					format: 'raw'},
		  	dataType: $dataType,
		  	beforeSend: function( xhr ) {
		    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		  	}
		})
	}
	// console.log(spCatListIcon);
	
	xhr_post('definition.sideMenu').done(function(data){ 						//create side menu on class txtHint
		jQuery("#searchSP").html(data );							
	});
	
	
	var searchResultsObj = 			xhr_post('definition.searchResults', false, 'json');		
	var searchObj = 				jQuery.parseJSON( searchResultsObj.responseText);	//gets json object	
														
	var exSpEntriesListContainer = 	jQuery('.spEntriesListContainer').clone(true);
	var aSpEntriesListCell = 		jQuery('.spEntriesListCell').clone(true);
	var spEntriesListRow = 			jQuery('<div/>', { 'class' : 'spEntriesListRow'});
	
	
	jQuery('#searchSP').on('change',(function(){										// on checkbox click - change searched items
		var valuesCheckbox = jQuery('input:checkbox:checked').map(function(){
			return this.id;
		});	

		spEntriesListRow = jQuery('<div/>', { 'class' : 'spEntriesListRow'});			//clears var val after each click
		
		// console.log(valuesCheckbox)
		if (valuesCheckbox.length > 0){
			var $aCurrentSid = [];
			jQuery.each(valuesCheckbox, function(key, id){
				jQuery.each(searchObj, function(sid, aObjects){
					if (jQuery.inArray(id, aObjects.cid) > -1 || jQuery.inArray(id, aObjects.states) > -1){
						if (jQuery.inArray(sid, $aCurrentSid) === -1){
							$aCurrentSid.push(sid);
							
						}
					}
				})	
				jQuery.each($aCurrentSid, function(index, iSid){
					jQuery.each(aSpEntriesListCell, function(index2, SpEntriesListCell){
						if (jQuery(this).attr('id')=== iSid ){
							spEntriesListRow.append(this);
							// console.log(spEntriesListRow.clone());
							jQuery('.spEntriesListContainer').html('');					//clears existing content
							jQuery('.spEntriesListContainer').append(spEntriesListRow);
						}
					})
				})
				
			})
		} else{
			jQuery('.spEntriesListContainer').replaceWith(exSpEntriesListContainer.clone(true));		//clears existing content
		}		
	}))
	
});
;
