/**
 * @version: $Id: review.js 3608 2013-07-31 13:20:08Z Radek Suski $
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
 * $Date: 2013-07-31 15:20:08 +0200 (Mi, 31 Jul 2013) $
 * $Revision: 3608 $
 * $Author: Radek Suski $
 */

SobiPro.jQuery( function ()
{
	bootbox.classes( 'SobiProBootBox' );
	SobiPro.jQuery( '#SobiPro' )
		.find( '.review-navigation' )
		.addClass( 'hide' );
	SobiPro.jQuery( '#SobiPro' )
		.find( '.review-ajax-navigation' )
		.removeClass( 'hide' )
		.SobiProReviewsNavigation();

	SobiPro.jQuery( '#review-trigger-form' ).click( function ()
	{
		SobiPro.jQuery( '#review-form' ).modal();
		SobiPro.jQuery( '#review-form' ).addClass( 'in' );
	} );

	SobiPro.jQuery( '[data-toggle=review-tooltip]' ).tooltip();

	SobiPro.jQuery( '.review-report-send-btn' ).click( function ( e )
	{
		e.preventDefault();
		var request = SobiPro.jQuery( '#review-report-form' )
			.find( 'form' )
			.serializeArray();
		request.push( { 'name': 'option', 'value': 'com_sobipro' } );
		request.push( { 'name': 'task', 'value': 'review.report' } );
		request.push( { 'name': 'tmpl', 'value': 'component' } );
		request.push( { 'name': 'format', 'value': 'raw' } );
		request.push( { 'name': 'sid', 'value': SobiProSection } );
		SobiPro.jQuery.ajax( { url: 'index.php', data: request, type: 'POST', dataType: 'json' } ).done( function ( data )
		{
			if ( data.status == 'error' ) {
				SobiPro.jQuery( '#review-report-form' )
					.find( '.alert' )
					.removeClass( 'hide' )
					.html( '<i class="icon-warning-sign">&nbsp;</i>' + data.message );
				var canvas = SobiPro.jQuery( '#' + data.fid )
					.parent()
					.parent()
					.parent();
				canvas.addClass( 'error' );
				SobiPro.jQuery( '#' + data.fid )
					.focus()
					.blur( function ()
					{
						canvas.removeClass( 'error' );
						SobiPro.jQuery( '#review-report-form' )
							.find( '.alert' )
							.addClass( 'hide' );
					} );
			}
			else {
				SobiPro.jQuery( '#review-report-form' ).modal( 'hide' );
				if ( data.status == 'failed' ) {
					bootbox.alert( '<div class="alert alert-error SobiPro"><i class="icon-warning-sign">&nbsp;</i>' + data.message + '</div>' );
				}
				else {
					bootbox.alert( '<div class="alert alert-success SobiPro"><i class="icon-thumbs-up">&nbsp;</i>' + data.message + '</div>' );
				}
				SobiPro.jQuery( '.SobiProBootBox' )
					.addClass( 'in' )
					.appendTo( SobiPro.jQuery( '#SobiPro' ) );
			}
		} );
	} );

	SobiPro.jQuery( 'input.review-rating-star' ).rating( { half: true } );
	SobiPro.jQuery( 'input.review-rating-star' ).rating( 'select', 5 );
	SobiPro.jQuery( '#review-positives' ).tagsInput( { 'defaultText': SobiPro.jQuery( '#review-positives' ).prop( 'placeholder' ), 'width': null, 'height': null } );
	SobiPro.jQuery( '#review-negatives' ).tagsInput( { 'defaultText': SobiPro.jQuery( '#review-negatives' ).prop( 'placeholder' ), 'width': null, 'height': null } );

	SobiPro.jQuery( '.report-review' ).bind( 'click', function ()
	{
		SobiProReportReview( this.name );
	} );


	SobiPro.jQuery( '#review-submit-btn' ).bind( 'click', function ( e )
	{
		e.preventDefault();
		var request = SobiPro.jQuery( '#review-form' )
			.find( 'form' )
			.serializeArray();
		request.push( { 'name': 'option', 'value': 'com_sobipro' } );
		request.push( { 'name': 'task', 'value': 'review.submit' } );
		request.push( { 'name': 'tmpl', 'value': 'component' } );
		request.push( { 'name': 'format', 'value': 'raw' } );
		request.push( { 'name': 'sid', 'value': SobiProSection } );
		SobiPro.jQuery.ajax( { url: 'index.php', data: request, type: 'POST', dataType: 'json' } ).done( function ( data )
		{
			if ( data.status == 'failed' ) {
				SobiPro.jQuery( '#review-form' )
					.find( '.alert' )
					.removeClass( 'hide' )
					.html( '<i class="icon-warning-sign">&nbsp;</i>' + data.response );
				var canvas = SobiPro.jQuery( '#' + data.fid )
					.parent()
					.parent();
				canvas.addClass( 'error' );
				SobiPro.jQuery( '#' + data.fid )
					.focus()
					.blur( function ()
					{
						canvas.removeClass( 'error' );
						SobiPro.jQuery( '#review-form' )
							.find( '.alert' )
							.addClass( 'hide' );
					} );
			}
			else {
				SobiPro.jQuery( '#review-form form' )[ 0 ].reset();
				SobiPro.jQuery( 'input.review-rating-star' ).rating( 'select', 5 );
				try {
					SobiPro.jQuery( '#review-positives' ).importTags( '' );
					SobiPro.jQuery( '#review-negatives' ).importTags( '' );
				}
				catch ( x ) {
				}
				SobiPro.jQuery( '#review-form' ).modal( 'hide' );
				SobiPro.jQuery( ':input', '#review-form form' )
					.not( ':button, :submit, :reset, :hidden' )
					.val( '' )
					.removeAttr( 'checked' )
					.removeAttr( 'selected' );
				if ( data.hide ) {
					SobiPro.jQuery( '#review-trigger-form' ).addClass( 'hide' );
				}
				bootbox.alert( '<div class="alert alert-success SobiPro"><i class="icon-thumbs-up">&nbsp;</i>' + data.response + '</div>' );
				SobiPro.jQuery( '.SobiProBootBox' )
					.addClass( 'in' )
					.appendTo( SobiPro.jQuery( '#SobiPro' ) );
			}
		} );
	} );
} );

SobiPro.jQuery.fn.SobiProReviewsNavigation = function ()
{
	var proxy = this;
	this.site = 1;
	this.sites = 0;
	this.canvas = SobiPro.jQuery( this );
	this.defaultText = this.html();
	this.enabled = true;
	this.getReviews = function ()
	{
		SobiPro.jQuery.ajax( {
			url: 'index.php',
			data: {
				'option': 'com_sobipro',
				'task': 'review.entry',
				'sid': SobiPro.jQuery( proxy ).attr( 'data-source' ),
				'site': ++proxy.site,
				'tmpl': 'component',
				'format': 'raw'
			},
			type: 'POST',
			dataType: 'html'
		} ).done( function ( data )
			{
				proxy.setResponse( data );
			} );
	};

	this.setResponse = function ( data )
	{
		proxy.site = SobiPro.jQuery( data ).filter( '[name="site"]' ).val();
		proxy.sites = SobiPro.jQuery( data ).filter( '[name="sites"]' ).val();
		proxy.finish( data );
	};

	this.finish = function ( data )
	{
		if ( this.site >= this.sites ) {
			this.canvas.addClass( 'hide' );
			this.enabled = false;
		}
		else {
			this.canvas.removeClass( 'disabled' );
		}
		this.canvas.html( this.defaultText );
		SobiPro.jQuery( data ).insertBefore( SobiPro.jQuery( proxy ) );
		SobiPro.jQuery( '.report-review' ).bind( 'click', function ()
		{
			SobiProReportReview( this.name );
		} );

	};

	this.click( function ()
	{
		if ( proxy.enabled ) {
			proxy.canvas.html( '<i class="icon-spinner icon-spin icon-large"></i>&nbsp;' + proxy.defaultText );
			proxy.canvas.addClass( 'disabled' );
			proxy.getReviews();
		}
	} );
};
function SobiProReportReview( name )
{
	SobiPro.jQuery( '#review-report-form form' )[ 0 ].reset();
	SobiPro.jQuery( '#review-report-rid' ).val( name );
	SobiPro.jQuery( '#review-report-form' ).modal();
	SobiPro.jQuery( '#review-report-form' ).addClass( 'in' );
}
