<?php
/**
 * @version: $Id: review.php 3530 2013-07-05 20:11:18Z Radek Suski $
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
 * $Date: 2013-07-05 22:11:18 +0200 (Fr, 05 Jul 2013) $
 * $Revision: 3530 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadController( 'controller' );

/**
 * @author Radek Suski
 * @version 1.0
 * @created 15-Jul-2010 18:17:28
 */

class SPRr extends SPController
{
	/**
	 * @var string
	 */
	protected $_defTask = 'js';

	public function __construct()
	{
	}

	/**
	 */
	public function execute()
	{
		$this->_task = $task = strlen( $this->_task ) ? $this->_task : $this->_defTask;
		if ( method_exists( $this, $this->_task ) ) {
			SPLang::load( 'SpApp.review_rating' );
			switch ( $this->_task ) {
				case 'report':
					$this->report();
					break;
				case 'submit':
					$this->submit();
					break;
				case 'entry':
					$this->entry();
					break;
			}
		}
		else {
			Sobi::Error( 'SPRrCtrl', 'Task not found', SPC::WARNING, 404, __LINE__, __FILE__ );
		}
	}

	public function visible()
	{
		SPLang::load( 'SpApp.review_rating' );
		return true;
	}

	protected function entry()
	{
		$site = SPRequest::int( 'site', 1 );
		$template = SPRequest::cmd( 'sptpl', null );
		if ( strstr( $template, '.' ) ) {
			$template = explode( '.', $template );
			$templateType = $template[ 0 ];
			$template = $template[ 1 ];
		}
		else {
			$templateType = 'entry';
			$template = $template ? $template : 'ajax-review';
		}
		$tplPackage = Sobi::Cfg( 'section.template', SPC::DEFAULT_TEMPLATE );
		$this->template();
		$this->tplCfg( $tplPackage );
		$data = array();
		SPFactory::Model( 'review' )
				->setSid( SPRequest::sid() )
				->setDetails( $data, $site );
		SPFactory::View( 'listing' )
				->assign( $data[ 'reviews' ], 'reviews' )
				->assign( $data[ 'visitor' ], 'visitor' )
				->setTemplate( "{$tplPackage}.{$templateType}.{$template}" )
				->display( 'reviews-list' );

	}

	protected function report()
	{
		if ( !( SPFactory::mainframe()->checkToken() ) ) {
			Sobi::Error( 'Token', SPLang::e( 'UNAUTHORIZED_ACCESS_TASK', SPRequest::task() ), SPC::ERROR, 403, __LINE__, __FILE__ );
		}
		$data = SPRequest::arr( 'reviewReport', array(), 'POST' );
		$messageData = array();
		$filter = SPFactory::registry()
				->loadDBSection( 'fields_filter' )
				->get( 'fields_filter.email.params' );
		if ( Sobi::My( 'id' ) ) {
			$messageData[ 'report' ][ 'author' ] = SPFactory::user();
		}
		elseif ( $data[ 'email' ] && preg_match( base64_decode( $filter ), trim( $data[ 'email' ] ) ) && $data[ 'author' ] ) {
			$messageData[ 'report' ][ 'author' ] = array(
				'name' => $data[ 'author' ],
				'email' => trim( $data[ 'email' ] )
			);
			unset( $data[ 'author' ] );
			unset( $data[ 'email' ] );
		}
		else {
			if ( !( $data[ 'author' ] ) && !( $messageData[ 'name' ] ) ) {
				$this->axRsponse( array( 'status' => 'error', 'message' => Sobi::Txt( 'SPRRA.ERR_REPORTER_REQ' ), 'fid' => 'reporter-name' ) );
			}
			else {
				$this->axRsponse( array( 'status' => 'error', 'message' => Sobi::Txt( 'SPRRA.ERR_MAIL_REQ' ), 'fid' => 'reporter-email' ) );
			}
		}
		if ( $data[ 'subject' ] ) {
			$messageData[ 'report' ][ 'subject' ] = $data[ 'subject' ];
			unset( $data[ 'subject' ] );
		}
		else {
			$this->axRsponse( array( 'status' => 'error', 'message' => Sobi::Txt( 'SPRRA.ERR_REPORT_SUBJECT_REQ' ), 'fid' => 'review-report-subject' ) );
		}
		if ( $data[ 'message' ] ) {
			$messageData[ 'report' ][ 'message' ] = $data[ 'message' ];
			unset( $data[ 'message' ] );
		}
		else {
			$this->axRsponse( array( 'status' => 'error', 'message' => Sobi::Txt( 'SPRRA.ERR_REPORT_MESSAGE_REQ' ), 'fid' => 'review-report-text' ) );
		}
		if ( count( $data ) ) {
			foreach ( $data as $i => $k ) {
				$messageData[ 'report' ][ $i ] = $k;
			}
		}
		$messageData[ 'review_data' ] = SPFactory::Instance( 'models.review', $data[ 'rid' ] );
		Sobi::Trigger( 'Review', 'Report', array( &$messageData ) );
		$send = SPFactory::db()
				->select( 'send', 'spdb_notifications', array( 'mailDate' => 'FUNCTION:NOW()', ) )
				->loadResult();
		if ( $send ) {
			$this->axRsponse( array( 'status' => 'ok', 'message' => Sobi::Txt( 'SPRRA.REPORT_MSG_THANK_YOU' ) ) );
		}
		else {
			$this->axRsponse( array( 'status' => 'failed', 'message' => Sobi::Txt( 'SPRRA.REPORT_MSG_FAILED' ) ) );
		}
	}

	protected function submit()
	{
		if ( !( Sobi::Can( 'review.add.own' ) ) || !( SPFactory::mainframe()->checkToken() ) ) {
			Sobi::Error( 'SPRrCtrl', 'UNAUTHORIZED_ACCESS', SPC::WARNING, 403, __LINE__, __FILE__ );
			exit;
		}
		$data = array();
		/** @var SPReview $model */
		$model = SPFactory::Instance( 'models.review' );
		$data[ 'rating' ] = SPRequest::arr( 'sprating', array(), 'post' );
		$data[ 'review' ] = SPRequest::arr( 'spreview', array(), 'post' );
		$data[ 'review' ][ 'section' ] = Sobi::Section();

		try {
			$hide = $model->saveReview( $data );
			if( $model->get('revEnabled') ){
				$message = Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' ) ? SPReview::Txt( 'REV_STORED_PUBLISHED' ) : SPReview::Txt( 'REV_STORED_UNPUBLISHED' );
			}
			else {
				$message = SPReview::Txt( 'REV_THANK_FOR_RATING' );
			}
			$this->axRsponse( array( 'response' => $message, 'status' => 'ok', 'hide' => $hide ) );
		} catch ( SPException $x ) {
			$data = $x->getData();
			if ( is_array( $data ) ) {
				$data = array_merge( array( 'response' => $x->getMessage(), 'status' => 'failed' ), $data );
			}
			else {
				$data = array( 'response' => $x->getMessage(), 'status' => 'failed' );
			}
			$this->axRsponse( $data );
		}
	}

	private function axRsponse( $data )
	{
		if ( !( SPRequest::int( 'deb' ) ) ) {
			SPFactory::mainframe()
					->cleanBuffer()
					->customHeader();
		}
		echo json_encode( $data );
		exit;
	}
}
