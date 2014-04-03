
/* Created at: Tue Mar 11 21:30:48 UTC 2014 */

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
// File: /components/com_sobipro/var/js/efilter_3941e7e9adc7eb817399c085ff926090.js
// ========

/**
 * @version: $Id: efilter.js 2989 2013-01-15 16:32:42Z Sigrid Suski $
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
 * File location: components/com_sobipro/lib/js/efilter.js $
 */

var SPFilter = eval( "[{\"name\":\"field_telephone_direct\",\"filter\":\"\\/^(\\\\+\\\\d{1,3}\\\\s?)?(\\\\s?\\\\([\\\\d]\\\\)\\\\s?)?[\\\\d\\\\-\\\\s\\\\.]+$\\/\",\"msg\":\"Please enter a valid telephone number into $field field.\"},{\"name\":\"field_mobile\",\"filter\":\"\\/^(\\\\+\\\\d{1,3}\\\\s?)?(\\\\s?\\\\([\\\\d]\\\\)\\\\s?)?[\\\\d\\\\-\\\\s\\\\.]+$\\/\",\"msg\":\"Please enter a valid telephone number into $field field.\"},{\"name\":\"field_email_address\",\"filter\":\"\\/^[\\\\w\\\\.-]+@[\\\\w\\\\.-]+\\\\.[a-zA-Z]{2,5}$\\/\",\"msg\":\"Please enter an email address into the $field field\"},{\"name\":\"field_website\",\"filter\":\"\\/^[\\\\w\\\\.-]+\\\\.{1}[a-zA-Z]{2,5}(\\\\\\/[^\\\\s]*)?$\\/\",\"msg\":\"Please enter a valid website address without the protocol in the $field field\"},{\"name\":\"field_postcode\",\"filter\":\"\\/^\\\\d+$\\/\",\"msg\":\"Please enter a numeric value in the $field field\"},{\"name\":\"field_p1_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"},{\"name\":\"field_p2_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"},{\"name\":\"field_p3_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"}]" );
;

// ========
// File: /components/com_sobipro/lib/js/simplemodal.js
// ========

/*
 * SimpleModal 1.3.5 - jQuery Plugin
 * http://www.ericmmartin.com/projects/simplemodal/
 * Copyright (c) 2010 Eric Martin (http://twitter.com/EricMMartin)
 * Dual licensed under the MIT and GPL licenses
 * Revision: $Id: simplemodal.js 2989 2013-01-15 16:32:42Z Sigrid Suski $
 */

/**
 * SimpleModal is a lightweight jQuery plugin that provides a simple
 * interface to create a modal dialog.
 *
 * The goal of SimpleModal is to provide developers with a cross-browser 
 * overlay and container that will be populated with data provided to
 * SimpleModal.
 *
 * There are two ways to call SimpleModal:
 * 1) As a chained function on a jQuery object, like $('#myDiv').modal();.
 * This call would place the DOM object, #myDiv, inside a modal dialog.
 * Chaining requires a jQuery object. An optional options object can be
 * passed as a parameter.
 *
 * @example $('<div>my data</div>').modal({options});
 * @example $('#myDiv').modal({options});
 * @example jQueryObject.modal({options});
 *
 * 2) As a stand-alone function, like $.modal(data). The data parameter
 * is required and an optional options object can be passed as a second
 * parameter. This method provides more flexibility in the types of data 
 * that are allowed. The data could be a DOM object, a jQuery object, HTML
 * or a string.
 * 
 * @example $.modal('<div>my data</div>', {options});
 * @example $.modal('my data', {options});
 * @example $.modal($('#myDiv'), {options});
 * @example $.modal(jQueryObject, {options});
 * @example $.modal(document.getElementById('myDiv'), {options}); 
 * 
 * A SimpleModal call can contain multiple elements, but only one modal 
 * dialog can be created at a time. Which means that all of the matched
 * elements will be displayed within the modal container.
 * 
 * SimpleModal internally sets the CSS needed to display the modal dialog
 * properly in all browsers, yet provides the developer with the flexibility
 * to easily control the look and feel. The styling for SimpleModal can be 
 * done through external stylesheets, or through SimpleModal, using the
 * overlayCss and/or containerCss options.
 *
 * SimpleModal has been tested in the following browsers:
 * - IE 6, 7, 8
 * - Firefox 2, 3
 * - Opera 9, 10
 * - Safari 3, 4
 * - Chrome 1, 2, 3, 4
 *
 * @name SimpleModal
 * @type jQuery
 * @requires jQuery v1.2.2
 * @cat Plugins/Windows and Overlays
 * @author Eric Martin (http://ericmmartin.com)
 * @version 1.3.5
 */
;(function ($) {
	$.noConflict();
	var ie6 = $.browser.msie && parseInt($.browser.version) == 6 && typeof window['XMLHttpRequest'] != "object",
		ieQuirks = null,
		w = [];

	/*
	 * Stand-alone function to create a modal dialog.
	 * 
	 * @param {string, object} data A string, jQuery object or DOM object
	 * @param {object} [options] An optional object containing options overrides
	 */
	$.modal = function (data, options) {
		return $.modal.impl.init(data, options);
	};

	/*
	 * Stand-alone close function to close the modal dialog
	 */
	$.modal.close = function () {
		$.modal.impl.close();
	};

	/*
	 * Chained function to create a modal dialog.
	 * 
	 * @param {object} [options] An optional object containing options overrides
	 */
	$.fn.modal = function (options) {
		return $.modal.impl.init(this, options);
	};

	/*
	 * SimpleModal default options
	 * 
	 * appendTo:		(String:'body') The jQuery selector to append the elements to. For ASP.NET, use 'form'.
	 * focus:			(Boolean:true) Forces focus to remain on the modal dialog
	 * opacity:			(Number:50) The opacity value for the overlay div, from 0 - 100
	 * overlayId:		(String:'simplemodal-overlay') The DOM element id for the overlay div
	 * overlayCss:		(Object:{}) The CSS styling for the overlay div
	 * containerId:		(String:'simplemodal-container') The DOM element id for the container div
	 * containerCss:	(Object:{}) The CSS styling for the container div
	 * dataId:			(String:'simplemodal-data') The DOM element id for the data div
	 * dataCss:			(Object:{}) The CSS styling for the data div
	 * minHeight:		(Number:null) The minimum height for the container
	 * minWidth:		(Number:null) The minimum width for the container
	 * maxHeight:		(Number:null) The maximum height for the container. If not specified, the window height is used.
	 * maxWidth:		(Number:null) The maximum width for the container. If not specified, the window width is used.
	 * autoResize:		(Boolean:false) Resize container on window resize? Use with caution - this may have undesirable side-effects.
	 * autoPosition:	(Boolean:true) Automatically position container on creation and window resize?
	 * zIndex:			(Number: 1000) Starting z-index value
	 * close:			(Boolean:true) If true, closeHTML, escClose and overClose will be used if set.
	 							If false, none of them will be used.
	 * closeHTML:		(String:'<a class="modalCloseImg" title="Close"></a>') The HTML for the 
							default close link. SimpleModal will automatically add the closeClass to this element.
	 * closeClass:		(String:'simplemodal-close') The CSS class used to bind to the close event
	 * escClose:		(Boolean:true) Allow Esc keypress to close the dialog? 
	 * overlayClose:	(Boolean:false) Allow click on overlay to close the dialog?
	 * position:		(Array:null) Position of container [top, left]. Can be number of pixels or percentage
	 * persist:			(Boolean:false) Persist the data across modal calls? Only used for existing
								DOM elements. If true, the data will be maintained across modal calls, if false,
								the data will be reverted to its original state.
	 * modal:			(Boolean:true) If false, the overlay, iframe, and certain events will be disabled
								allowing the user to interace with the page below the dialog
	 * onOpen:			(Function:null) The callback function used in place of SimpleModal's open
	 * onShow:			(Function:null) The callback function used after the modal dialog has opened
	 * onClose:			(Function:null) The callback function used in place of SimpleModal's close
	 */
	$.modal.defaults = {
		appendTo: 'body',
		focus: true,
		opacity: 50,
		overlayId: 'simplemodal-overlay',
		overlayCss: {},
		containerId: 'simplemodal-container',
		containerCss: {},
		dataId: 'simplemodal-data',
		dataCss: {},
		minHeight: null,
		minWidth: null,
		maxHeight: null,
		maxWidth: null,
		autoResize: false,
		autoPosition: true,
		zIndex: 1000,
		close: true,
		closeHTML: '<a class="modalCloseImg" title="Close"></a>',
		closeClass: 'simplemodal-close',
		escClose: true,
		overlayClose: false,
		position: null,
		persist: false,
		modal: true,
		onOpen: null,
		onShow: null,
		onClose: null
	};

	/*
	 * Main modal object
	 */
	$.modal.impl = {
		/*
		 * Modal dialog options
		 */
		o: null,
		/*
		 * Contains the modal dialog elements and is the object passed 
		 * back to the callback (onOpen, onShow, onClose) functions
		 */
		d: {},
		/*
		 * Initialize the modal dialog
		 */
		init: function (data, options) {
			var s = this;

			// don't allow multiple calls
			if (s.d.data) {
				return false;
			}

			// $.boxModel is undefined if checked earlier
			ieQuirks = $.browser.msie && !$.boxModel;

			// merge defaults and user options
			s.o = $.extend({}, $.modal.defaults, options);

			// keep track of z-index
			s.zIndex = s.o.zIndex;

			// set the onClose callback flag
			s.occb = false;

			// determine how to handle the data based on its type
			if (typeof data == 'object') {
				// convert DOM object to a jQuery object
				data = data instanceof jQuery ? data : $(data);
				s.d.placeholder = false;

				// if the object came from the DOM, keep track of its parent
				if (data.parent().parent().size() > 0) {
					data.before($('<span></span>')
						.attr('id', 'simplemodal-placeholder')
						.css({display: 'none'}));

					s.d.placeholder = true;
					s.display = data.css('display');

					// persist changes? if not, make a clone of the element
					if (!s.o.persist) {
						s.d.orig = data.clone(true);
					}
				}
			}
			else if (typeof data == 'string' || typeof data == 'number') {
				// just insert the data as innerHTML
				data = $('<div></div>').html(data);
			}
			else {
				// unsupported data type!
				alert('SimpleModal Error: Unsupported data type: ' + typeof data);
				return s;
			}

			// create the modal overlay, container and, if necessary, iframe
			s.create(data);
			data = null;

			// display the modal dialog
			s.open();

			// useful for adding events/manipulating data in the modal dialog
			if ($.isFunction(s.o.onShow)) {
				s.o.onShow.apply(s, [s.d]);
			}

			// don't break the chain =)
			return s;
		},
		/*
		 * Create and add the modal overlay and container to the page
		 */
		create: function (data) {
			var s = this;

			// get the window properties
			w = s.getDimensions();

			// add an iframe to prevent select options from bleeding through
			if (s.o.modal && ie6) {
				s.d.iframe = $('<iframe src="javascript:false;"></iframe>')
					.css($.extend(s.o.iframeCss, {
						display: 'none',
						opacity: 0, 
						position: 'fixed',
						height: w[0],
						width: w[1],
						zIndex: s.o.zIndex,
						top: 0,
						left: 0
					}))
					.appendTo(s.o.appendTo);
			}

			// create the overlay
			s.d.overlay = $('<div></div>')
				.attr('id', s.o.overlayId)
				.addClass('simplemodal-overlay')
				.css($.extend(s.o.overlayCss, {
					display: 'none',
					opacity: s.o.opacity / 100,
					height: s.o.modal ? w[0] : 0,
					width: s.o.modal ? w[1] : 0,
					position: 'fixed',
					left: 0,
					top: 0,
					zIndex: s.o.zIndex + 1
				}))
				.appendTo(s.o.appendTo);
		
			// create the container
			s.d.container = $('<div></div>')
				.attr('id', s.o.containerId)
				.addClass('simplemodal-container')
				.css($.extend(s.o.containerCss, {
					display: 'none',
					position: 'fixed', 
					zIndex: s.o.zIndex + 2
				}))
				.append(s.o.close && s.o.closeHTML
					? $(s.o.closeHTML).addClass(s.o.closeClass)
					: '')
				.appendTo(s.o.appendTo);
				
			s.d.wrap = $('<div></div>')
				.attr('tabIndex', -1)
				.addClass('simplemodal-wrap')
				.css({height: '100%', outline: 0, width: '100%'})
				.appendTo(s.d.container);
				
			// add styling and attributes to the data
			// append to body to get correct dimensions, then move to wrap
			s.d.data = data
				.attr('id', data.attr('id') || s.o.dataId)
				.addClass('simplemodal-data')
				.css($.extend(s.o.dataCss, {
						display: 'none'
				}))
				.appendTo('body');
			data = null;

			s.setContainerDimensions();
			s.d.data.appendTo(s.d.wrap);

			// fix issues with IE
			if (ie6 || ieQuirks) {
				s.fixIE();
			}
		},
		/*
		 * Bind events
		 */
		bindEvents: function () {
			var s = this;

			// bind the close event to any element with the closeClass class
			$('.' + s.o.closeClass).bind('click.simplemodal', function (e) {
				e.preventDefault();
				s.close();
			});
			
			// bind the overlay click to the close function, if enabled
			if (s.o.modal && s.o.close && s.o.overlayClose) {
				s.d.overlay.bind('click.simplemodal', function (e) {
					e.preventDefault();
					s.close();
				});
			}
	
			// bind keydown events
			$(document).bind('keydown.simplemodal', function (e) {
				if (s.o.modal && s.o.focus && e.keyCode == 9) { // TAB
					s.watchTab(e);
				}
				else if ((s.o.close && s.o.escClose) && e.keyCode == 27) { // ESC
					e.preventDefault();
					s.close();
				}
			});

			// update window size
			$(window).bind('resize.simplemodal', function () {
				// redetermine the window width/height
				w = s.getDimensions();

				// reposition the dialog
				s.setContainerDimensions(true);
	
				if (ie6 || ieQuirks) {
					s.fixIE();
				}
				else if (s.o.modal) {
					// update the iframe & overlay
					s.d.iframe && s.d.iframe.css({height: w[0], width: w[1]});
					s.d.overlay.css({height: w[0], width: w[1]});
				}
			});
		},
		/*
		 * Unbind events
		 */
		unbindEvents: function () {
			$('.' + this.o.closeClass).unbind('click.simplemodal');
			$(document).unbind('keydown.simplemodal');
			$(window).unbind('resize.simplemodal');
			this.d.overlay.unbind('click.simplemodal');
		},
		/*
		 * Fix issues in IE6 and IE7 in quirks mode
		 */
		fixIE: function () {
			var s = this, p = s.o.position;

			// simulate fixed position - adapted from BlockUI
			$.each([s.d.iframe || null, !s.o.modal ? null : s.d.overlay, s.d.container], function (i, el) {
				if (el) {
					var bch = 'document.body.clientHeight', bcw = 'document.body.clientWidth',
						bsh = 'document.body.scrollHeight', bsl = 'document.body.scrollLeft',
						bst = 'document.body.scrollTop', bsw = 'document.body.scrollWidth',
						ch = 'document.documentElement.clientHeight', cw = 'document.documentElement.clientWidth',
						sl = 'document.documentElement.scrollLeft', st = 'document.documentElement.scrollTop',
						s = el[0].style;

					s.position = 'absolute';
					if (i < 2) {
						s.removeExpression('height');
						s.removeExpression('width');
						s.setExpression('height','' + bsh + ' > ' + bch + ' ? ' + bsh + ' : ' + bch + ' + "px"');
						s.setExpression('width','' + bsw + ' > ' + bcw + ' ? ' + bsw + ' : ' + bcw + ' + "px"');
					}
					else {
						var te, le;
						if (p && p.constructor == Array) {
							var top = p[0] 
								? typeof p[0] == 'number' ? p[0].toString() : p[0].replace(/px/, '')
								: el.css('top').replace(/px/, '');
							te = top.indexOf('%') == -1 
								? top + ' + (t = ' + st + ' ? ' + st + ' : ' + bst + ') + "px"'
								: parseInt(top.replace(/%/, '')) + ' * ((' + ch + ' || ' + bch + ') / 100) + (t = ' + st + ' ? ' + st + ' : ' + bst + ') + "px"';

							if (p[1]) {
								var left = typeof p[1] == 'number' ? p[1].toString() : p[1].replace(/px/, '');
								le = left.indexOf('%') == -1 
									? left + ' + (t = ' + sl + ' ? ' + sl + ' : ' + bsl + ') + "px"'
									: parseInt(left.replace(/%/, '')) + ' * ((' + cw + ' || ' + bcw + ') / 100) + (t = ' + sl + ' ? ' + sl + ' : ' + bsl + ') + "px"';
							}
						}
						else {
							te = '(' + ch + ' || ' + bch + ') / 2 - (this.offsetHeight / 2) + (t = ' + st + ' ? ' + st + ' : ' + bst + ') + "px"';
							le = '(' + cw + ' || ' + bcw + ') / 2 - (this.offsetWidth / 2) + (t = ' + sl + ' ? ' + sl + ' : ' + bsl + ') + "px"';
						}
						s.removeExpression('top');
						s.removeExpression('left');
						s.setExpression('top', te);
						s.setExpression('left', le);
					}
				}
			});
		},
		focus: function (pos) {
			var s = this, p = pos || 'first';

			// focus on dialog or the first visible/enabled input element
			var input = $(':input:enabled:visible:' + p, s.d.wrap);
			input.length > 0 ? input.focus() : s.d.wrap.focus();
		},
		getDimensions: function () {
			var el = $(window);

			// fix a jQuery/Opera bug with determining the window height
			var h = $.browser.opera && $.browser.version > '9.5' && $.fn.jquery <= '1.2.6' ? document.documentElement['clientHeight'] :
				$.browser.opera && $.browser.version < '9.5' && $.fn.jquery > '1.2.6' ? window.innerHeight :
				el.height();

			return [h, el.width()];
		},
		getVal: function (v) {
			return v == 'auto' ? 0 
				: v.indexOf('%') > 0 ? v 
					: parseInt(v.replace(/px/, ''));
		},
		setContainerDimensions: function (resize) {
			var s = this;

			if (!resize || (resize && s.o.autoResize)) {
				// get the dimensions for the container and data
				var ch = $.browser.opera ? s.d.container.height() : s.getVal(s.d.container.css('height')), 
					cw = $.browser.opera ? s.d.container.width() : s.getVal(s.d.container.css('width')),
					dh = s.d.data.outerHeight(true), dw = s.d.data.outerWidth(true);

				var mh = s.o.maxHeight && s.o.maxHeight < w[0] ? s.o.maxHeight : w[0],
					mw = s.o.maxWidth && s.o.maxWidth < w[1] ? s.o.maxWidth : w[1];

				// height
				if (!ch) {
					if (!dh) {ch = s.o.minHeight;}
					else {
						if (dh > mh) {ch = mh;}
						else if (dh < s.o.minHeight) {ch = s.o.minHeight;}
						else {ch = dh;}
					}
				}
				else {
					ch = ch > mh ? mh : ch;
				}

				// width
				if (!cw) {
					if (!dw) {cw = s.o.minWidth;}
					else {
						if (dw > mw) {cw = mw;}
						else if (dw < s.o.minWidth) {cw = s.o.minWidth;}
						else {cw = dw;}
					}
				}
				else {
					cw = cw > mw ? mw : cw;
				}

				s.d.container.css({height: ch, width: cw});
				if (dh > ch || dw > cw) {
					s.d.wrap.css({overflow:'hidden'});
				}
			}
			
			if (s.o.autoPosition) {
				s.setPosition();
			}
		},
		setPosition: function () {
			var s = this, top, left,
				hc = (w[0]/2) - (s.d.container.outerHeight(true)/2),
				vc = (w[1]/2) - (s.d.container.outerWidth(true)/2);

			if (s.o.position && Object.prototype.toString.call(s.o.position) === "[object Array]") {
				top = s.o.position[0] || hc;
				left = s.o.position[1] || vc;
			} else {
				top = hc;
				left = vc;
			}
			s.d.container.css({left: left, top: top});
		},
		watchTab: function (e) {
			var s = this;

			if ($(e.target).parents('.simplemodal-container').length > 0) {
				// save the list of inputs
				s.inputs = $(':input:enabled:visible:first, :input:enabled:visible:last', s.d.data[0]);

				// if it's the first or last tabbable element, refocus
				if ((!e.shiftKey && e.target == s.inputs[s.inputs.length -1]) ||
						(e.shiftKey && e.target == s.inputs[0]) ||
						s.inputs.length == 0) {
					e.preventDefault();
					var pos = e.shiftKey ? 'last' : 'first';
					setTimeout(function () {s.focus(pos);}, 10);
				}
			}
			else {
				// might be necessary when custom onShow callback is used
				e.preventDefault();
				setTimeout(function () {s.focus();}, 10);
			}
		},
		/*
		 * Open the modal dialog elements
		 * - Note: If you use the onOpen callback, you must "show" the 
		 *	        overlay and container elements manually 
		 *         (the iframe will be handled by SimpleModal)
		 */
		open: function () {
			var s = this;
			// display the iframe
			s.d.iframe && s.d.iframe.show();

			if ($.isFunction(s.o.onOpen)) {
				// execute the onOpen callback 
				s.o.onOpen.apply(s, [s.d]);
			}
			else {
				// display the remaining elements
				s.d.overlay.show();
				s.d.container.show();
				s.d.data.show();
			}
			
			s.focus();

			// bind default events
			s.bindEvents();
		},
		/*
		 * Close the modal dialog
		 * - Note: If you use an onClose callback, you must remove the 
		 *         overlay, container and iframe elements manually
		 *
		 * @param {boolean} external Indicates whether the call to this
		 *     function was internal or external. If it was external, the
		 *     onClose callback will be ignored
		 */
		close: function () {
			var s = this;

			// prevent close when dialog does not exist
			if (!s.d.data) {
				return false;
			}

			// remove the default events
			s.unbindEvents();

			if ($.isFunction(s.o.onClose) && !s.occb) {
				// set the onClose callback flag
				s.occb = true;

				// execute the onClose callback
				s.o.onClose.apply(s, [s.d]);
			}
			else {
				// if the data came from the DOM, put it back
				if (s.d.placeholder) {
					var ph = $('#simplemodal-placeholder');
					// save changes to the data?
					if (s.o.persist) {
						// insert the (possibly) modified data back into the DOM
						ph.replaceWith(s.d.data.removeClass('simplemodal-data').css('display', s.display));
					}
					else {
						// remove the current and insert the original, 
						// unmodified data back into the DOM
						s.d.data.hide().remove();
						ph.replaceWith(s.d.orig);
					}
				}
				else {
					// otherwise, remove it
					s.d.data.hide().remove();
				}

				// remove the remaining elements
				s.d.container.hide().remove();
				s.d.overlay.hide().remove();
				s.d.iframe && s.d.iframe.hide().remove();

				// reset the dialog object
				s.d = {};
			}
		}
	};
})(jQuery);
;

// ========
// File: /components/com_sobipro/lib/js/opt/field_category.js
// ========

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
;

// ========
// File: /components/com_sobipro/lib/js/jquery-form.js
// ========

;(function($){"use strict";var O={};O.fileapi=$("<input type='file'/>").get(0).files!==undefined;O.formdata=window.FormData!==undefined;$.fn.ajaxSubmit=function(z){if(!this.length){log('ajaxSubmit: skipping submit process - no element selected');return this}var A,action,url,$form=this;if(typeof z=='function'){z={success:z}}A=this.attr('method');action=this.attr('action');url=(typeof action==='string')?$.trim(action):'';url=url||window.location.href||'';if(url){url=(url.match(/^([^#]+)/)||[])[1]}z=$.extend(true,{url:url,success:$.ajaxSettings.success,type:A||'GET',iframeSrc:/^https/i.test(window.location.href||'')?'javascript:false':'about:blank'},z);var B={};this.trigger('form-pre-serialize',[this,z,B]);if(B.veto){log('ajaxSubmit: submit vetoed via form-pre-serialize trigger');return this}if(z.beforeSerialize&&z.beforeSerialize(this,z)===false){log('ajaxSubmit: submit aborted via beforeSerialize callback');return this}var C=z.traditional;if(C===undefined){C=$.ajaxSettings.traditional}var D=[];var E,a=this.formToArray(z.semantic,D);if(z.data){z.extraData=z.data;E=$.param(z.data,C)}if(z.beforeSubmit&&z.beforeSubmit(a,this,z)===false){log('ajaxSubmit: submit aborted via beforeSubmit callback');return this}this.trigger('form-submit-validate',[a,this,z,B]);if(B.veto){log('ajaxSubmit: submit vetoed via form-submit-validate trigger');return this}var q=$.param(a,C);if(E){q=(q?(q+'&'+E):E)}if(z.type.toUpperCase()=='GET'){z.url+=(z.url.indexOf('?')>=0?'&':'?')+q;z.data=null}else{z.data=q}var F=[];if(z.resetForm){F.push(function(){$form.resetForm()})}if(z.clearForm){F.push(function(){$form.clearForm(z.includeHidden)})}if(!z.dataType&&z.target){var G=z.success||function(){};F.push(function(a){var b=z.replaceTarget?'replaceWith':'html';$(z.target)[b](a).each(G,arguments)})}else if(z.success){F.push(z.success)}z.success=function(a,b,c){var d=z.context||this;for(var i=0,max=F.length;i<max;i++){F[i].apply(d,[a,b,c||$form,$form])}};var H=$('input[type=file]:enabled[value!=""]',this);var I=H.length>0;var J='multipart/form-data';var K=($form.attr('enctype')==J||$form.attr('encoding')==J);var L=O.fileapi&&O.formdata;log("fileAPI :"+L);var M=(I||K)&&!L;var N;if(z.iframe!==false&&(z.iframe||M)){if(z.closeKeepAlive){$.get(z.closeKeepAlive,function(){N=fileUploadIframe(a)})}else{N=fileUploadIframe(a)}}else if((I||K)&&L){N=fileUploadXhr(a)}else{N=$.ajax(z)}$form.removeData('jqxhr').data('jqxhr',N);for(var k=0;k<D.length;k++)D[k]=null;this.trigger('form-submit-notify',[this,z]);return this;function deepSerialize(a){var b=$.param(a).split('&');var c=b.length;var d=[];var i,part;for(i=0;i<c;i++){b[i]=b[i].replace(/\+/g,' ');part=b[i].split('=');d.push([decodeURIComponent(part[0]),decodeURIComponent(part[1])])}return d}function fileUploadXhr(a){var f=new FormData();for(var i=0;i<a.length;i++){f.append(a[i].name,a[i].value)}if(z.extraData){var g=deepSerialize(z.extraData);for(i=0;i<g.length;i++)if(g[i])f.append(g[i][0],g[i][1])}z.data=null;var s=$.extend(true,{},$.ajaxSettings,z,{contentType:false,processData:false,cache:false,type:A||'POST'});if(z.uploadProgress){s.xhr=function(){var e=jQuery.ajaxSettings.xhr();if(e.upload){e.upload.addEventListener('progress',function(a){var b=0;var c=a.loaded||a.position;var d=a.total;if(a.lengthComputable){b=Math.ceil(c/d*100)}z.uploadProgress(a,c,d,b)},false)}return e}}s.data=null;var h=s.beforeSend;s.beforeSend=function(a,o){o.data=f;if(h)h.call(this,a,o)};return $.ajax(s)}function fileUploadIframe(a){var l=$form[0],el,i,s,g,id,$io,io,xhr,sub,n,timedOut,timeoutHandle;var m=!!$.fn.prop;var o=$.Deferred();if(a){for(i=0;i<D.length;i++){el=$(D[i]);if(m)el.prop('disabled',false);else el.removeAttr('disabled')}}s=$.extend(true,{},$.ajaxSettings,z);s.context=s.context||s;id='jqFormIO'+(new Date().getTime());if(s.iframeTarget){$io=$(s.iframeTarget);n=$io.attr('name');if(!n)$io.attr('name',id);else id=n}else{$io=$('<iframe name="'+id+'" src="'+s.iframeSrc+'" />');$io.css({position:'absolute',top:'-1000px',left:'-1000px'})}io=$io[0];xhr={aborted:0,responseText:null,responseXML:null,status:0,statusText:'n/a',getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(a){var e=(a==='timeout'?'timeout':'aborted');log('aborting upload... '+e);this.aborted=1;try{if(io.contentWindow.document.execCommand){io.contentWindow.document.execCommand('Stop')}}catch(ignore){}$io.attr('src',s.iframeSrc);xhr.error=e;if(s.error)s.error.call(s.context,xhr,e,a);if(g)$.event.trigger("ajaxError",[xhr,s,e]);if(s.complete)s.complete.call(s.context,xhr,e)}};g=s.global;if(g&&0===$.active++){$.event.trigger("ajaxStart")}if(g){$.event.trigger("ajaxSend",[xhr,s])}if(s.beforeSend&&s.beforeSend.call(s.context,xhr,s)===false){if(s.global){$.active--}o.reject();return o}if(xhr.aborted){o.reject();return o}sub=l.clk;if(sub){n=sub.name;if(n&&!sub.disabled){s.extraData=s.extraData||{};s.extraData[n]=sub.value;if(sub.type=="image"){s.extraData[n+'.x']=l.clk_x;s.extraData[n+'.y']=l.clk_y}}}var p=1;var q=2;function getDoc(a){var b=a.contentWindow?a.contentWindow.document:a.contentDocument?a.contentDocument:a.document;return b}var r=$('meta[name=csrf-token]').attr('content');var u=$('meta[name=csrf-param]').attr('content');if(u&&r){s.extraData=s.extraData||{};s.extraData[u]=r}function doSubmit(){var t=$form.attr('target'),a=$form.attr('action');l.setAttribute('target',id);if(!A){l.setAttribute('method','POST')}if(a!=s.url){l.setAttribute('action',s.url)}if(!s.skipEncodingOverride&&(!A||/post/i.test(A))){$form.attr({encoding:'multipart/form-data',enctype:'multipart/form-data'})}if(s.timeout){timeoutHandle=setTimeout(function(){timedOut=true;cb(p)},s.timeout)}function checkState(){try{var a=getDoc(io).readyState;log('state = '+a);if(a&&a.toLowerCase()=='uninitialized')setTimeout(checkState,50)}catch(e){log('Server abort: ',e,' (',e.name,')');cb(q);if(timeoutHandle)clearTimeout(timeoutHandle);timeoutHandle=undefined}}var b=[];try{if(s.extraData){for(var n in s.extraData){if(s.extraData.hasOwnProperty(n)){if($.isPlainObject(s.extraData[n])&&s.extraData[n].hasOwnProperty('name')&&s.extraData[n].hasOwnProperty('value')){b.push($('<input type="hidden" name="'+s.extraData[n].name+'">').val(s.extraData[n].value).appendTo(l)[0])}else{b.push($('<input type="hidden" name="'+n+'">').val(s.extraData[n]).appendTo(l)[0])}}}}if(!s.iframeTarget){$io.appendTo('body');if(io.attachEvent)io.attachEvent('onload',cb);else io.addEventListener('load',cb,false)}setTimeout(checkState,15);var c=document.createElement('form').submit;c.apply(l)}finally{l.setAttribute('action',a);if(t){l.setAttribute('target',t)}else{$form.removeAttr('target')}$(b).remove()}}if(s.forceSync){doSubmit()}else{setTimeout(doSubmit,10)}var v,doc,domCheckCount=50,callbackProcessed;function cb(e){if(xhr.aborted||callbackProcessed){return}try{doc=getDoc(io)}catch(ex){log('cannot access response document: ',ex);e=q}if(e===p&&xhr){xhr.abort('timeout');o.reject(xhr,'timeout');return}else if(e==q&&xhr){xhr.abort('server abort');o.reject(xhr,'error','server abort');return}if(!doc||doc.location.href==s.iframeSrc){if(!timedOut)return}if(io.detachEvent)io.detachEvent('onload',cb);else io.removeEventListener('load',cb,false);var c='success',errMsg;try{if(timedOut){throw'timeout';}var d=s.dataType=='xml'||doc.XMLDocument||$.isXMLDoc(doc);log('isXml='+d);if(!d&&window.opera&&(doc.body===null||!doc.body.innerHTML)){if(--domCheckCount){log('requeing onLoad callback, DOM not available');setTimeout(cb,250);return}}var f=doc.body?doc.body:doc.documentElement;xhr.responseText=f?f.innerHTML:null;xhr.responseXML=doc.XMLDocument?doc.XMLDocument:doc;if(d)s.dataType='xml';xhr.getResponseHeader=function(a){var b={'content-type':s.dataType};return b[a]};if(f){xhr.status=Number(f.getAttribute('status'))||xhr.status;xhr.statusText=f.getAttribute('statusText')||xhr.statusText}var h=(s.dataType||'').toLowerCase();var i=/(json|script|text)/.test(h);if(i||s.textarea){var j=doc.getElementsByTagName('textarea')[0];if(j){xhr.responseText=j.value;xhr.status=Number(j.getAttribute('status'))||xhr.status;xhr.statusText=j.getAttribute('statusText')||xhr.statusText}else if(i){var k=doc.getElementsByTagName('pre')[0];var b=doc.getElementsByTagName('body')[0];if(k){xhr.responseText=k.textContent?k.textContent:k.innerText}else if(b){xhr.responseText=b.textContent?b.textContent:b.innerText}}}else if(h=='xml'&&!xhr.responseXML&&xhr.responseText){xhr.responseXML=w(xhr.responseText)}try{v=y(xhr,h,s)}catch(e){c='parsererror';xhr.error=errMsg=(e||c)}}catch(e){log('error caught: ',e);c='error';xhr.error=errMsg=(e||c)}if(xhr.aborted){log('upload aborted');c=null}if(xhr.status){c=(xhr.status>=200&&xhr.status<300||xhr.status===304)?'success':'error'}if(c==='success'){if(s.success)s.success.call(s.context,v,'success',xhr);o.resolve(xhr.responseText,'success',xhr);if(g)$.event.trigger("ajaxSuccess",[xhr,s])}else if(c){if(errMsg===undefined)errMsg=xhr.statusText;if(s.error)s.error.call(s.context,xhr,c,errMsg);o.reject(xhr,'error',errMsg);if(g)$.event.trigger("ajaxError",[xhr,s,errMsg])}if(g)$.event.trigger("ajaxComplete",[xhr,s]);if(g&&!--$.active){$.event.trigger("ajaxStop")}if(s.complete)s.complete.call(s.context,xhr,c);callbackProcessed=true;if(s.timeout)clearTimeout(timeoutHandle);setTimeout(function(){if(!s.iframeTarget)$io.remove();xhr.responseXML=null},100)}var w=$.parseXML||function(s,a){if(window.ActiveXObject){a=new ActiveXObject('Microsoft.XMLDOM');a.async='false';a.loadXML(s)}else{a=(new DOMParser()).parseFromString(s,'text/xml')}return(a&&a.documentElement&&a.documentElement.nodeName!='parsererror')?a:null};var x=$.parseJSON||function(s){return window['eval']('('+s+')')};var y=function(a,b,s){var c=a.getResponseHeader('content-type')||'',xml=b==='xml'||!b&&c.indexOf('xml')>=0,v=xml?a.responseXML:a.responseText;if(xml&&v.documentElement.nodeName==='parsererror'){if($.error)$.error('parsererror')}if(s&&s.dataFilter){v=s.dataFilter(v,b)}if(typeof v==='string'){if(b==='json'||!b&&c.indexOf('json')>=0){v=x(v)}else if(b==="script"||!b&&c.indexOf("javascript")>=0){$.globalEval(v)}}return v};return o}};$.fn.ajaxForm=function(a){a=a||{};a.delegation=a.delegation&&$.isFunction($.fn.on);if(!a.delegation&&this.length===0){var o={s:this.selector,c:this.context};if(!$.isReady&&o.s){log('DOM not ready, queuing ajaxForm');$(function(){$(o.s,o.c).ajaxForm(a)});return this}log('terminating; zero elements found by selector'+($.isReady?'':' (DOM not ready)'));return this}if(a.delegation){$(document).off('submit.form-plugin',this.selector,doAjaxSubmit).off('click.form-plugin',this.selector,captureSubmittingElement).on('submit.form-plugin',this.selector,a,doAjaxSubmit).on('click.form-plugin',this.selector,a,captureSubmittingElement);return this}return this.ajaxFormUnbind().bind('submit.form-plugin',a,doAjaxSubmit).bind('click.form-plugin',a,captureSubmittingElement)};function doAjaxSubmit(e){var a=e.data;if(!e.isDefaultPrevented()){e.preventDefault();$(this).ajaxSubmit(a)}}function captureSubmittingElement(e){var a=e.target;var b=$(a);if(!(b.is("[type=submit],[type=image]"))){var t=b.closest('[type=submit]');if(t.length===0){return}a=t[0]}var c=this;c.clk=a;if(a.type=='image'){if(e.offsetX!==undefined){c.clk_x=e.offsetX;c.clk_y=e.offsetY}else if(typeof $.fn.offset=='function'){var d=b.offset();c.clk_x=e.pageX-d.left;c.clk_y=e.pageY-d.top}else{c.clk_x=e.pageX-a.offsetLeft;c.clk_y=e.pageY-a.offsetTop}}setTimeout(function(){c.clk=c.clk_x=c.clk_y=null},100)}$.fn.ajaxFormUnbind=function(){return this.unbind('submit.form-plugin click.form-plugin')};$.fn.formToArray=function(b,c){var a=[];if(this.length===0){return a}var d=this[0];var e=b?d.getElementsByTagName('*'):d.elements;if(!e){return a}var i,j,n,v,el,max,jmax;for(i=0,max=e.length;i<max;i++){el=e[i];n=el.name;if(!n){continue}if(b&&d.clk&&el.type=="image"){if(!el.disabled&&d.clk==el){a.push({name:n,value:$(el).val(),type:el.type});a.push({name:n+'.x',value:d.clk_x},{name:n+'.y',value:d.clk_y})}continue}v=$.fieldValue(el,true);if(v&&v.constructor==Array){if(c)c.push(el);for(j=0,jmax=v.length;j<jmax;j++){a.push({name:n,value:v[j]})}}else if(O.fileapi&&el.type=='file'&&!el.disabled){if(c)c.push(el);var f=el.files;if(f.length){for(j=0;j<f.length;j++){a.push({name:n,value:f[j],type:el.type})}}else{a.push({name:n,value:'',type:el.type})}}else if(v!==null&&typeof v!='undefined'){if(c)c.push(el);a.push({name:n,value:v,type:el.type,required:el.required})}}if(!b&&d.clk){var g=$(d.clk),input=g[0];n=input.name;if(n&&!input.disabled&&input.type=='image'){a.push({name:n,value:g.val()});a.push({name:n+'.x',value:d.clk_x},{name:n+'.y',value:d.clk_y})}}return a};$.fn.formSerialize=function(a){return $.param(this.formToArray(a))};$.fn.fieldSerialize=function(b){var a=[];this.each(function(){var n=this.name;if(!n){return}var v=$.fieldValue(this,b);if(v&&v.constructor==Array){for(var i=0,max=v.length;i<max;i++){a.push({name:n,value:v[i]})}}else if(v!==null&&typeof v!='undefined'){a.push({name:this.name,value:v})}});return $.param(a)};$.fn.fieldValue=function(a){for(var b=[],i=0,max=this.length;i<max;i++){var c=this[i];var v=$.fieldValue(c,a);if(v===null||typeof v=='undefined'||(v.constructor==Array&&!v.length)){continue}if(v.constructor==Array)$.merge(b,v);else b.push(v)}return b};$.fieldValue=function(b,c){var n=b.name,t=b.type,tag=b.tagName.toLowerCase();if(c===undefined){c=true}if(c&&(!n||b.disabled||t=='reset'||t=='button'||(t=='checkbox'||t=='radio')&&!b.checked||(t=='submit'||t=='image')&&b.form&&b.form.clk!=b||tag=='select'&&b.selectedIndex==-1)){return null}if(tag=='select'){var d=b.selectedIndex;if(d<0){return null}var a=[],ops=b.options;var e=(t=='select-one');var f=(e?d+1:ops.length);for(var i=(e?d:0);i<f;i++){var g=ops[i];if(g.selected){var v=g.value;if(!v){v=(g.attributes&&g.attributes['value']&&!(g.attributes['value'].specified))?g.text:g.value}if(e){return v}a.push(v)}}return a}return $(b).val()};$.fn.clearForm=function(a){return this.each(function(){$('input,select,textarea',this).clearFields(a)})};$.fn.clearFields=$.fn.clearInputs=function(a){var b=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var t=this.type,tag=this.tagName.toLowerCase();if(b.test(t)||tag=='textarea'){this.value=''}else if(t=='checkbox'||t=='radio'){this.checked=false}else if(tag=='select'){this.selectedIndex=-1}else if(t=="file"){if(/MSIE/.test(navigator.userAgent)){$(this).replaceWith($(this).clone())}else{$(this).val('')}}else if(a){if((a===true&&/hidden/.test(t))||(typeof a=='string'&&$(this).is(a)))this.value=''}})};$.fn.resetForm=function(){return this.each(function(){if(typeof this.reset=='function'||(typeof this.reset=='object'&&!this.reset.nodeType)){this.reset()}})};$.fn.enable=function(b){if(b===undefined){b=true}return this.each(function(){this.disabled=!b})};$.fn.selected=function(b){if(b===undefined){b=true}return this.each(function(){var t=this.type;if(t=='checkbox'||t=='radio'){this.checked=b}else if(this.tagName.toLowerCase()=='option'){var a=$(this).parent('select');if(b&&a[0]&&a[0].type=='select-one'){a.find('option').selected(false)}this.selected=b}})};$.fn.ajaxSubmit.debug=false;function log(){if(!$.fn.ajaxSubmit.debug)return;var a='[jquery.form] '+Array.prototype.join.call(arguments,'');if(window.console&&window.console.log){window.console.log(a)}else if(window.opera&&window.opera.postError){window.opera.postError(a)}}})(jQuery);
;

// ========
// File: /components/com_sobipro/lib/js/fileupload.js
// ========

SobiPro.jQuery.fn.SobiProFileUploader=function(k){"use strict";var l=this;this.settings={'hideProgressBar':true,'styles':{'.progress':{'clear':'left','float':'left','margin':'10px 10px 10px 0'},'.alert':{'clear':'both'},'.file input':{'margin-bottom':'10px'},'.progress-message':{'margin-top':'10px'}}};this.settings=SobiPro.jQuery.extend(true,k,this.settings);SobiPro.jQuery.each(this.settings.styles,function(a,b){l.find(a).css(b)});var m=l.find('.bar');var n=l.find('.progress-container');var o=l.find('.progress-message');var p=l.find('.alert');var q=l.find('.idStore');var r=l.find('.upload');this.complete=function(a){l.trigger('uploadComplete',[a]);var b='100%';m.width(b);o.html(b);var c=SobiPro.jQuery.parseJSON(a.responseText);if(l.settings.hideProgressBar){n.addClass('hide')}if(c.callback){var d=window[c.callback];d(c,l)}else{p.removeClass('hide');p.addClass('alert-'+c.type);p.find('div').html(c.text);q.val(c.id);r.attr('disabled','disabled')}};this.uploadProgress=function(a,b,c,d){l.trigger('uploadProgress',[a,b,c,d]);var e=d+'%';m.width(e);o.html(e)};this.beforeSend=function(){l.trigger('beforeSend',[this]);n.removeClass('hide');var a='0%';m.width(a);o.html(a)};this.upload=function(){var e=SobiPro.jQuery.parseJSON(l.find('.upload').attr('rel'));l.trigger('createRequest',[e]);var f=l.find('.file');var g=l.find('input:file');var h=g.attr('name')+'-form';var i='<form action="'+'index.php" method="post" enctype="multipart/form-data" id="'+h+'">';for(var j in e){i+='<input type="hidden" value="'+e[j]+'" name="'+j+'"/>'}i+='</form>';i=SobiPro.jQuery(i);g.appendTo(i);var c=g.clone(g);c.appendTo(f);i.appendTo(SobiPro.jQuery('#SobiPro'));SobiPro.jQuery('#'+h).ajaxForm({'dataType':'json',beforeSend:function(){l.beforeSend()},uploadProgress:function(a,b,c,d){l.uploadProgress(a,b,c,d)},complete:function(a){l.complete(a)}}).submit()};this.find('input:file').change(function(){if(SobiPro.jQuery(this).val()){l.find('.upload, .remove').removeAttr('disabled');var a=SobiPro.jQuery(this).val();var b=(a.indexOf('\\')>=0?a.lastIndexOf('\\'):a.lastIndexOf('/'));var c=a.substring(b);if(c.indexOf('\\')===0||c.indexOf('/')===0){c=c.substring(1)}l.find('.selected').val(c);setTimeout(function(){l.upload()},500)}});this.find('.select').click(function(){l.find('input:file').trigger('click')});this.find('.remove').click(function(){var a=l.find('input:file');l.find('.upload, .remove').attr('disabled','disabled');l.find('.selected').val('');l.find('idStore').val('');a.clone(a).appendTo(a.parent());a.detach()});this.find('.upload').click(function(){l.upload()});return this};SobiPro.jQuery.fn.SPFileUploader=function(a){return this.each(function(){SobiPro.jQuery(this).SobiProFileUploader(a)})};;

// ========
// File: /components/com_sobipro/lib/js/geomap.js
// ========

/**
 * @version: $Id: geomap.js 1832 2011-08-16 08:53:59Z Radek Suski $
 * @package: SobiPro Library
 * ===================================================
 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET
 * ===================================================
 * @copyright Copyright (C) 2006 - 2011 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license see http://www.gnu.org/licenses/lgpl.html GNU/LGPL Version 3.
 * You can use, redistribute this file and/or modify it under the terms of the GNU Lesser General Public License version 3
 * ===================================================
 * $Date: 2011-08-16 10:53:59 +0200 (Di, 16 Aug 2011) $
 * $Revision: 1832 $
 * $Author: Radek Suski $
 */
jQuery.noConflict();
if ( typeof SPGeoMapsReg == 'undefined' ) {
	var SPGeoMapsReg = {};
}
function SPGeoEditMapInit( Opt, pid )
{
	jQuery( document ).ready( function() { 
		var watcher = new SPGeoWatch( Opt ); 
		if( pid ) {
			var id = Opt.Id;
			try {
				jQuery( '#' + pid ).bind( 'click', function() {
					if( this.checked ) {
						jQuery( '#' + id ).fadeTo( 'slow', 1 );
						GeoFields( id, true );
					}
					else {
						jQuery( '#' + id ).fadeTo( 'slow', 0.1 );
						GeoFields( id, false );
					}
				} );
				// initial dimm
				if( jQuery( '#' + pid ).val() != undefined && !( jQuery( '#' + pid ).checked ) ) {
					jQuery( '#' + id ).fadeTo( 'slow', 0.1 );
				}
				GeoFields( id, false );
				function GeoFields( id, state ) {
					// for some reason the compressor changes strings like '_lat' to '_1' 
					SP_id( id +'_'+'latitude' ).enabled = state;
					SP_id( id +'_'+'longitude' ).enabled = state;	
					watcher.GetCoordinates();
				};
			} catch( e ) {}
		}
	} );
}

function SPShowGeoMap( Opt )
{
	SobiPro.onReady( function () {
		this.Map;
		this.Position = new google.maps.LatLng( parseFloat( Opt.Marker.Lat ), parseFloat( Opt.Marker.Long ) );
		this.Marker;
		this.Bubble;
		var views = [];
		var canvas = SP_id( Opt.Id );
		for( i = 0; i < Opt.Views.length; i++ ) {
			views[ i ] = google.maps.MapTypeId[ Opt.Views[ i ] ];
		}
		var options = {
			zoom: parseFloat( Opt.Zoom ),
			mapTypeId: google.maps.MapTypeId[ Opt.MapTypeId ]
		};
		for( var i in Opt.MapOpt ) {
			options[ i ] = Opt.MapOpt[ i ];
		}
		if( views.length > 0 ) {
			options[ 'mapTypeControlOptions' ] = { mapTypeIds: views };
		}
		this.Map = new google.maps.Map( canvas, options );	
		this.Map.setCenter( this.Position );
		this.Marker = new google.maps.Marker( { position: this.Position, map: this.Map, animation: google.maps.Animation.DROP } );
		SPGeoMapsReg[ Opt.Id ] = this;
		// @todo
//		if( Opt.Marker.Bubble ) {
//			this.Bubble = new google.maps.InfoWindow( {
//			  
//			} );
//			if( Opt.Marker.Bubble == 1 ) {
//				this.Bubble.open(this.Map, this.Marker );
//			}
//			w = this;
//			google.maps.event.addListener( this.Marker, 'click', function() {
//				w.Bubble.open( w.Map, w.Marker );
//			} );		
//		}
	} );
}

function SPGeoWatch( Opt )
{
	this.Fields = [];
	this.Map; 
	this.Address = {};
	this.Opt = Opt;
	this.Trigger;
	this.Address;
	this.Marker;
	this.MarkerLock = false;
	this.Turnout;
	// register field's events
	this.FieldEvent = function( field )
	{
		var watcher = this;
		field.bind( 'blur', function() {
			watcher.GetCoordinates();
		} );		
	};
	
	this.GetCoordinates = function()
	{
		change = false;
		// if these data has been changed - replace it in the array and eventually get new coordinates
		for( var i = 0; i < this.Fields.length; i++ ) {
			id = this.Fields[ i ].attr( 'id' );
			field = jQuery( '#' +  id );
			// if value has been changed
			if( this.Address[ id ] != field.attr( 'value' ) ) {				
				this.Address[ id ] = field.attr( 'value' );
				change = true;
			}
		}
		// if changed
		if( change )  {
			// if the marker was adjusted manually before - ask the user first
			if( this.MarkerLock ) {
				change = confirm( this.Opt.ChngMsg );
			}
			if( change ) {
				var string = new Array();
				c = 0;
				for( var i in this.Address ) {
					string[ ++c ] = this.Address[ i ];
				}
				var geocoder = new google.maps.Geocoder();
				var watcher = this;
			    geocoder.geocode( { 'address': string.join( '+' )  }, function( results, status ) {
			        if ( status == google.maps.GeocoderStatus.OK ) {	
			        	// reset lock
			        	watcher.MarkerLock = false;
			        	// set coordinates
			        	watcher.SetCoordinates( results[ 0 ].geometry.location );
			        } 
			    } );				
			}
		}
	};
	
	this.SetCoordinates = function( data, init )
	{		
		var newLocation = new google.maps.LatLng( data.lat(), data.lng() );
		this.Map.setCenter( newLocation );
		if( !( init ) ) {
			this.Map.setZoom( 16 );
			this.AdjustCoordinates( data.lat(), data.lng() );
		}
		// if marker has been already created
		try {
			this.Marker.setPosition( newLocation );
		} catch( e ) {
			// otherwise create new marker
			this.Marker = new google.maps.Marker( {
				position: newLocation, 
				map: this.Map,
				animation: google.maps.Animation.DROP,
				draggable:true
			} );
		}
		// insert into current scope
		var watcher = this;
		google.maps.event.addListener( this.Marker, 'dragend', function ( ev ) { 
			watcher.AdjustCoordinates( this.getPosition().lat(), this.getPosition().lng() );
			watcher.MarkerLock = true;
		} );
	};
	this.AdjustCoordinates = function( latitude, longitude )
	{
		SP_id( this.Opt.Id+'_'+'latitude' ).value = latitude;
		SP_id( this.Opt.Id+'_'+'longitude' ).value = longitude;		
	};	
	this.GeoInit = function() 
	{
		var initialLocation;
		// turnout coordinates - in case we cannot (or want) to get the browser geo data
		this.Turnout = new google.maps.LatLng( ( this.Opt.StartPoint.Lat ), ( this.Opt.StartPoint.Long ) );
		// the map container
		var canvas = SP_id( Opt.Id+'_'+'canvas' );	
		var views = [];
		var w = this;
		// register selcted views
		for( i = 0; i < this.Opt.Views.length; i++ ) {
			views[ i ] = google.maps.MapTypeId[ this.Opt.Views[ i ] ];
		}
		var options = {
			zoom: parseFloat( this.Opt.Zoom ),
			mapTypeId: google.maps.MapTypeId[ this.Opt.MapTypeId ]
		};
		for( var i in this.Opt.MapOpt ) {
			options[ i ] = this.Opt.MapOpt[ i ];
		}
		if( views.length > 0 ) {
			options[ 'mapTypeControlOptions' ] = { mapTypeIds: views };
		}
		this.Map = new google.maps.Map( canvas, options );
		// if marker has been set, we don't need to search for coordinates
		if( this.Opt.Sensor == 0 || this.Opt.StartPoint.Marker ) {
			this.NoInit( true ); 
		}
		else {
			// Try W3C Geolocation (Preferred)
			if ( navigator.geolocation ) {
				navigator.geolocation.getCurrentPosition( function( position ) {
					initialLocation = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
					try {
						w.Map.setCenter( initialLocation );
						w.SetCoordinates( initialLocation, true );
					} catch( e ) {}
				}, function() { w.NoInit(); } );
			}
			// Try Google Gears Geolocation
			else if ( this.Opt.Sensor && google.gears ) {
				var geo = google.gears.factory.create( 'beta.geolocation' );
				geo.getCurrentPosition( function( position ) {
					initialLocation = new google.maps.LatLng( position.latitude,position.longitude );
					try {
						w.Map.setCenter( initialLocation );
						w.SetCoordinates( initialLocation, true );
					} catch( e ) {}
				}, function() { w.NoInit();	} );
				// Browser doesn't support Geolocation
			} 
			else {
				if( !( google.gears ) ) {
					alert( 'Your browser doesn\'t support GeoLocation. Please visit: http://gears.google.com/ ');
				}
				this.NoInit();
			}  
		}
	};
	this.NoInit = function() 
	{
		this.Map.setCenter( this.Turnout );
	};
	this.GeoInit();	
	// travel address fields and store these as DOM objects
	for( var i = 0; i < Opt.Fields.length; i++ ) {
		try {
			this.Fields[ i ] = jQuery( '#' +  Opt.Fields[ i ] ) ;
		} catch( e ) {}
	}	
	// last field is the trigger
	this.Trigger = Opt.Fields[ Opt.Fields.length - 1 ];
	// travel again and add events
	for( var i = 0; i < this.Fields.length; i++ ) {
		this.FieldEvent( this.Fields[ i ] );		
	}	
	if( this.Opt.StartPoint.Marker ) {
		this.SetCoordinates( new google.maps.LatLng( this.Opt.StartPoint.Lat, this.Opt.StartPoint.Long ) );
	}
};

// ========
// File: /components/com_sobipro/usr/templates/usbydesign/js/edit.js
// ========

/**
 * @version: $Id: edit.js 1403 2011-05-24 07:47:50Z Sigrid Suski $
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
// it has to be MT :( because of the tiny
window.addEvent( 'load', function() {
	var els = SP_class( 'SPPaymentBox' );
	for( var i = 0; i < els.length; i++ ) {
		SP_ActivatePayment( SP_id( els[ i ].id ) );
	}	
	$( 'spEntryForm' ).addEvent( 'submit', function( ev ) {
		var els = SP_class( 'mce_editable' );
		for( var i = 0; i < els.length; i++ ) {
			if( tinyMCE.get( els[ i ].id ).getContent().length ) {
				els[ i ].value = tinyMCE.get( els[ i ].id ).getContent();
				els[ i ].disabled = false;
			}
		}	
	} );
} );

function SP_ActivatePayment( e )
{
	var cid = e.id.replace( 'Payment', 'Container' );
	if( e.checked ) {
		jQuery( "#" + cid + " input" ).each( function( i, el ){ this.disabled = false; } ); 
		jQuery( "#" + cid + " select" ).each( function( i, el ){ this.disabled = false; } );
		jQuery( "#" + cid + " textarea" ).each( function( i, el ){
			if( el.className == 'mce_editable' ) {
				tinyMCE.execCommand( 'mceToggleEditor', true, el.id );
			}
			else {
				this.disabled = false;
			}
		} );
	}
	else {
		jQuery( "#" + cid + " input" ).each( function( i, el ){ this.disabled = true; } ); 
		jQuery( "#" + cid + " select" ).each( function( i, el ){ this.disabled = true; } );
		jQuery( "#" + cid + " textarea" ).each( function( i, el ){ 
			if( el.className == 'mce_editable' ) {
				tinyMCE.execCommand( 'mceToggleEditor', false, el.id );
			}
			this.disabled = true;
		} );
	}
	e.disabled = false;
};

// ========
// File: /components/com_sobipro/usr/templates/usbydesign/js/osx.js
// ========

/*
 * SimpleModal OSX Style Modal Dialog
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2010 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: osx.js 1396 2011-05-23 18:11:18Z Radek Suski $
 */

jQuery( function() {
	jQuery.noConflict();
	var OSX = {
		container: null,
		init: function () {
			jQuery( "input.osx, a.osx, button.osx" ).click( function ( e ) {
				e.preventDefault();	
				jQuery("#osx-modal-content").modal({
					overlayId: 'osx-overlay',
					containerId: 'osx-container',
					closeHTML: null,
					minHeight: 80,
					opacity: 65, 
					position: ['0',],
					overlayClose: true,
					onOpen: OSX.open,
					onClose: OSX.close,
					persist: true
				});
			});
		},
		open: function (d) {
			var self = this;
			self.container = d.container[0];
			d.overlay.fadeIn('slow', function () {
				jQuery("#osx-modal-content", self.container).show();
				var title = jQuery("#osx-modal-title", self.container);
				title.show();
				d.container.slideDown('slow', function () {
					setTimeout(function () {
						var h = jQuery("#osx-modal-data", self.container).height()
							+ title.height()
							+ 20; // padding
						d.container.animate(
							{height: h}, 
							100,
							function () {
								jQuery("div.close", this.container).show();
								jQuery("#osx-modal-data", this.container).show();
							}
						);
					}, 300);
				});
			});
		},
		close: function (d) {
			var self = this;
			d.container.animate(
				{
					top:"-" + (d.container.height() + 20)
				}, 500,
				function () {
					try { SP_Save(); } catch ( e ) {}
					self.close();					
				}
			);
		}
	};

	OSX.init();

});;
