<?php
/**
 * @version: $Id: rating.php 3517 2013-07-04 11:05:19Z Radek Suski $
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
 * $Date: 2013-07-04 13:05:19 +0200 (Do, 04 Jul 2013) $
 * $Revision: 3517 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadController( 'listing_interface' );
SPLoader::loadController( 'section' );

/**
 * @author Radek Suski
 * @version 1.0
 * @created Sun, Jun 23, 2013 14:37:07
 */
class SPRatingListing extends SPSectionCtrl implements SPListing
{
	/** @var string */
	protected $_type = 'listing';
	/** @var string */
	public static $compatibility = '1.1';

	public function execute()
	{
		SPLang::load( 'SpApp.review_rating' );
		$this->view();
	}

	protected function view()
	{
		/* determine template package */
		$tplPckg = Sobi::Cfg( 'section.template', SPC::DEFAULT_TEMPLATE );
		Sobi::ReturnPoint();

		if ( !( $this->_model ) ) {
			$this->setModel( 'section' );
			$this->_model->init( Sobi::Section() );
		}
		SPFactory::header()->objMeta( $this->_model );

		switch ( $this->_task ) {
			case 'rating.top':
				$this->_task = 'top-rated';
				break;
			case 'rating.most':
				$this->_task = 'most-rated';
				break;
		}

		$originalTask = $this->_task;

		/* load template config */
		$this->template();
		$this->tplCfg( $tplPckg );

		/* get limits - if defined in template config - otherwise from the section config */
		$eLimit = $this->tKey( $this->template, 'entries_limit', Sobi::Cfg( 'list.entries_limit', 2 ) );
		$eInLine = $this->tKey( $this->template, 'entries_in_line', Sobi::Cfg( 'list.entries_in_line', 2 ) );

		/* get the site to display */
		$site = SPRequest::int( 'site', 1 );
		$eLimStart = ( ( $site - 1 ) * $eLimit );
		$eCount = count( $this->getEntries( $eLimit, $site, true ) );
		$entries = $this->getEntries( $eLimit, $site );

		$pn = SPFactory::Instance(
			'helpers.pagenav_' . $this->tKey( $this->template, 'template_type', 'xslt' ),
			$eLimit, $eCount, $site,
			array( 'sid' => SPRequest::sid(), 'task' => $originalTask )
		);
		$cUrl = array( 'sid' => SPRequest::sid(), 'task' => $originalTask );
		if ( SPRequest::int( 'site', 0 ) ) {
			$cUrl[ 'site' ] = SPRequest::int( 'site', 0 );
		}
		SPFactory::header()->addCanonical( Sobi::Url( $cUrl, true, true, true ) );

		/* get view class */
		$view = SPFactory::View( 'listing' );

		switch ( $this->_task ) {
			case 'top-rated':
				$view->assign( Sobi::Txt( 'RL.TOP_PATH_TITLE', Sobi::Section( true ) ), 'listing_name' );
				SPFactory::mainframe()
						->addToPathway( Sobi::Txt( 'RL.TOP_PATH_TITLE', Sobi::Section( true ) ), Sobi::Url( 'current' ) );
				SPFactory::header()
						->addTitle( Sobi::Txt( 'RL.TOP_TITLE', Sobi::Section( true ) ), array( ceil( $eCount / $eLimit ), $site ) );
				break;
			case 'most-rated':
				$view->assign( Sobi::Txt( 'RL.MOST_PATH_TITLE', Sobi::Section( true ) ), 'listing_name' );
				SPFactory::mainframe()
						->addToPathway( Sobi::Txt( 'RL.MOST_PATH_TITLE', Sobi::Section( true ) ), Sobi::Url( 'current' ) );
				SPFactory::header()
						->addTitle( Sobi::Txt( 'RL.MOST_TITLE', Sobi::Section( true ) ), array( ceil( $eCount / $eLimit ), $site ) );
				break;
		}

		$view->assign( $eLimit, '$eLimit' )
				->assign( $eLimStart, '$eLimStart' )
				->assign( $eCount, '$eCount' )
				->assign( $eInLine, '$eInLine' )
				->assign( $this->_task, 'task' )
				->assign( $this->_model, 'section' )
				->assign( $pn->get(), 'navigation' )
				->assign( SPFactory::user()->getCurrent(), 'visitor' )
				->assign( $entries, 'entries' )
				->setConfig( $this->_tCfg, $this->template )
				->setTemplate( $tplPckg . '.' . $this->templateType . '.' . $this->template );
		Sobi::Trigger( 'RatingListing', 'View', array( &$view ) );
		$view->display();
	}

	public function entries( $field = null )
	{
		return $this->getEntries( 0, 0, true );
	}

	public function setParams( $request )
	{
	}

	public function getEntries( $eLimit, $site, $ids = false )
	{
		$conditions = array();
		$entries = array();

		/* get the site to display */
		$eLimStart = ( ( $site - 1 ) * $eLimit );
		$db = SPFactory::db();
		switch ( $this->_task ) {
			case 'top-rated':
				$groupBy = null;
				$eOrder = 'reviews.oar.desc';
				$table = $db->join(
					array(
						array( 'table' => 'spdb_sprr_review', 'as' => 'reviews', 'key' => 'sid' ),
						array( 'table' => 'spdb_object', 'as' => 'spo', 'key' => 'id' ),
					)
				);
				$oPrefix = 'spo.';
				$conditions[ 'spo.oType' ] = 'entry';
				$conditions[ 'reviews.section' ] = Sobi::Section();
				break;
			case 'most-rated':
				$groupBy = 'reviews.sid';
				$eOrder = 'COUNT(reviews.sid)';
				$table = $db->join(
					array(
						array( 'table' => 'spdb_sprr_review', 'as' => 'reviews', 'key' => 'sid' ),
						array( 'table' => 'spdb_object', 'as' => 'spo', 'key' => 'id' ),
					)
				);
				$oPrefix = 'spo.';
				$conditions[ 'spo.oType' ] = 'entry';
				$conditions[ 'reviews.section' ] = Sobi::Section();
				break;
		}

		/* check user permissions for the visibility */
		if ( Sobi::My( 'id' ) ) {
			$this->userPermissionsQuery( $conditions, $oPrefix );
		}
		else {
			$conditions = array_merge( $conditions, array( $oPrefix . 'state' => '1', '@VALID' => $db->valid( $oPrefix . 'validUntil', $oPrefix . 'validSince' ) ) );
		}
		try {
			$db->select( $oPrefix . 'id', $table, $conditions, $eOrder, $eLimit, $eLimStart, true, $groupBy );
			$results = $db->loadResultArray();
		} catch ( SPException $x ) {
			Sobi::Error( 'RatingListing', SPLang::e( 'DB_REPORTS_ERR', $x->getMessage() ), SPC::WARNING, 0, __LINE__, __FILE__ );
		}
		if ( $ids ) {
			return $results;
		}
		if ( count( $results ) ) {
			foreach ( $results as $i => $sid ) {
				$entries[ $i ] = $sid;
			}
		}
		Sobi::Trigger( $this->name(), 'AfterGetEntries', array( &$results, false ) );
		return $entries;
	}

	/**
	 * @param string $task
	 */
	public function setTask( $task )
	{
		$this->_task = strlen( $task ) ? $task : $this->_defTask;
		$helpTask = $this->_type . '.' . $this->_task;
		Sobi::Trigger( $this->name(), __FUNCTION__, array( &$this->_task ) );
		SPFactory::registry()->set( 'task', $helpTask );
	}
}
