<?php
/**
 * @version: $Id: notifications.php 3591 2013-07-24 11:26:13Z Radek Suski $
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
 * $Date: 2013-07-24 13:26:13 +0200 (Mi, 24 Jul 2013) $
 * $Revision: 3591 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );

class SPRRNotifications
{
	public function __construct()
	{
	}

	public function defaultMessage( $nid, &$setting )
	{
		static $triggers = array();
		if ( !( count( $triggers ) ) ) {
			$triggers = SPLoader::loadIniFile( 'etc.rra_msg' );
		}
		if ( isset( $triggers[ $nid ] ) ) {
			$setting = $triggers[ $nid ];
		}
		else {
			$setting = array(
				'from' => '{cfg:mail.fromname}',
				'fromMail' => '{cfg:mail.from}',
				'to' => '{user.name}',
				'toMail' => '{user.email}',
				'subject' => 'Message Subject',
				'body' => 'Message Body',
				'cc' => null,
				'bcc' => null,
				'html' => true,
				'enabled' => true
			);
		}
	}

	public function prepareMessageArgs( $action, &$settings, &$args )
	{
		if ( isset( $args[ 'review_data' ] ) ) {
			$rev = array(
				'title' => $args[ 'review_data' ]->get( 'title' ),
				'content' => $args[ 'review_data' ]->get( 'review' ),
				'date' => $args[ 'review_data' ]->get( 'date' ),
				'negatives' => $args[ 'review_data' ]->get( 'negativeReview' ),
				'positives' => $args[ 'review_data' ]->get( 'positiveReview' ),
				'author' => $args[ 'review_data' ]->get( 'author' ),
			);
			$rating = $args[ 'review_data' ]->get( 'rating' );
			$sid = $args[ 'review_data' ]->get( 'sid' );
			$ratings = array();
			if ( count( $rating ) ) {
				foreach ( $rating as $vote ) {
					$ratings[ $vote[ 'fid' ] ] = array(
						'vote' => $vote[ 'vote' ],
						'explanation' => $vote[ 'definition' ][ 'label' ],
						'label' => $vote[ 'definition' ][ 'label' ]
					);
					$ratings[ SPLang::nid( $vote[ 'definition' ][ 'label' ] ) ] =& $ratings[ $vote[ 'fid' ] ];
				}
				$ratings[ 'average' ] = round( $args[ 'review_data' ]->get( 'oar' ), 2 );
			}
			switch ( $action ) {
				case 'AfterApprove.author':
					$args[ 'user' ] = $args[ 'review_data' ]->get( 'author' );
					break;
			}
			$settings[ 'sid' ] = $sid;
			$args[ 'review' ] = $rev;
			$args[ 'rating' ] = $ratings;
			$args[ 'entry' ] = SPFactory::Entry( $sid );
			$args[ 'author' ] = SPFactory::Instance( 'cms.base.user', $args[ 'entry' ]->get( 'owner' ) );
			$args[ 'user' ] = SPFactory::user();
		}
	}
}
