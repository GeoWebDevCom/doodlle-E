<?php
/**
 * @version: $Id: review.php 3610 2013-07-31 16:45:11Z Radek Suski $
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
 * $Date: 2013-07-31 18:45:11 +0200 (Mi, 31 Jul 2013) $
 * $Revision: 3610 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );

/**
 * @author Radek Suski
 * @version 1.0
 */
class SPReview extends SPObject
{
	/** @var int */
	protected $rid = 0;
	/** @var null */
	protected $data = null;
	/** @var null */
	protected $title = null;
	/** @var null */
	protected $review = null;
	/** @var null */
	protected $negativeReview = null;
	/** @var null */
	protected $positiveReview = null;
	/** @var null */
	protected $date = null;
	/** @var array */
	protected $author = array();
	/** @var bool */
	protected $approved = false;
	/** @var bool */
	protected $state = false;
	/** @var array */
	protected $rating = array();
	/** @var null */
	protected $approvedAt = null;
	/** @var null */
	protected $approvedIp = null;
	/** @var null */
	protected $editedAt = null;
	/** @var null */
	protected $editedBy = null;
	/** @var null */
	protected $editedIp = null;
	/** @var int */
	protected $oar = 0;
	/** @var array */
	private $rel = array( 'section' => 'section', 'rid' => 'rid', 'sid' => 'sid', 'uid' => 'uid', 'title' => 'rTitle', 'review' => 'rReview', 'neg_review' => 'rNeg', 'pos_review' => 'rPos', 'date' => 'rDate', 'visitor' => 'uName', 'vmail' => 'uEmail', 'oar' => 'oar', 'rating' => 'rRating' );
	/** @var int */
	protected $sid = 0;
	/** @var int */
	protected $ratingEnabled = 0;
	/** @var int */
	protected $ratingRevReq = 1;
	/** @var null */
	protected $authorIP = null;
	/** @var array */
	public $approval = array();
	/** @var bool */
	protected $parseContent = true;
	/** @var array */
	protected $badWords = array();
	/** @var bool */
	protected $revRattingReq = true;
	/** @var bool */
	protected $revReportsEnabled = true;
	/** @var bool */
	protected $revEnabled = false;

	/**
	 * @param int $id
	 */
	public function __construct( $id = 0 )
	{
		$this->rid = $id;
		if ( $id ) {
			$this->load( $this->rid );
		}
		static $settings = null;
		if ( !( $settings ) ) {
			$settings = SPFactory::registry()
					->loadDBSection( 'sprr_' . Sobi::Section() )
					->get( 'sprr_' . Sobi::Section() );
		}
		if ( count( $settings ) ) {
			foreach ( $settings as $setting => $value ) {
				$this->$setting = $value[ 'value' ];
			}
			$this->revOrdering = 'r' . $this->revOrdering;
		}
		if ( is_string( $this->badWords ) ) {
			$this->badWords = explode( ',', $this->badWords );
		}
		if ( count( $this->badWords ) ) {
			foreach ( $this->badWords as $i => $word ) {
				$this->badWords[ $i ] = trim( $word );
			}
		}
		$this->revRattingReq = true;
		// if review isn't enabled then we are allowing only one rating
		if ( !( $this->revEnabled ) ) {
			$this->revMulti = false;
		}
	}

	protected function & load( $id )
	{
		$rev = SPFactory::db()->select( '*', 'spdb_sprr_review', array( 'rid' => $id ) )->loadObject();
		if ( $rev ) {
			if ( $rev->uid ) {
				$user = SPUser::getBaseData( array( $rev->uid ) );
				$user = $user[ $rev->uid ];
				$this->author = array( 'uid' => $rev->uid, 'name' => $user->name, 'email' => $user->email, 'editable' => false );
			}
			else {
				$this->author = array( 'uid' => $rev->uid, 'name' => $rev->uName, 'email' => $rev->uEmail, 'editable' => true );
			}
			$this->title = $rev->rTitle;
			$this->review = $rev->rReview;
			$this->negativeReview = $rev->rNeg;
			$this->positiveReview = $rev->rPos;
			$this->date = $rev->rDate;
			$this->approved = $rev->approved;
			$this->state = $rev->state;
			$this->rating = unserialize( $rev->rRating );
			$this->approvedAt = $rev->appAt;
			$this->approvedIp = $rev->appIP;
			$this->editedAt = $rev->editedAt;
			$this->editedBy = $rev->editedBy;
			$this->editedIp = $rev->editedIP;
			$this->authorIP = $rev->uIP;
			$this->oar = $rev->oar;
			$fields = $this->reviewFields();
			if ( !( $this->oar ) ) {
				$this->recount( false );
			}
			elseif ( $this->oar < 0 ) {
				$this->recount();
			}
			// when the number of define fields and those for which we have ratings is different
			// it can be that some fields have been published/unpublished
			// so recount again
			if ( count( $fields ) != count( $this->rating ) ) {
				$this->recount( false );
			}
			$this->oar = number_format( (float)$this->oar, 2, '.', '' );
			$this->sid = $rev->sid;
			if ( count( $this->rating ) ) {
				foreach ( $this->rating as $fid => $rating ) {
					if ( isset( $fields[ $fid ] ) ) {
						$this->rating[ $fid ][ 'definition' ] = $fields[ $fid ];
					}
					else {
						unset( $this->rating[ $fid ] );
						$this->recount( false );
					}
				}
			}
		}
		return $this;
	}

	public function & redefine()
	{
		$fields = $this->reviewFields();
		foreach ( $fields as $fid => $field ) {
			if ( !( isset( $this->rating[ $fid ] ) ) ) {
				$this->rating[ $fid ] = array(
					'sid' => $this->sid,
					'fid' => $fid,
					'vote' => 0,
					'oai' => 0,
					'definition' => $field
				);
			}
		}
		return $this;
	}

	public function & setSid( $sid )
	{
		$this->sid = $sid;
		return $this;
	}

	/**
	 *
	 */
	public function setDetails( &$entry, $site = 1 )
	{
		// common settings first
		$entry[ 'reviews' ][ 'settings' ] = array(
			'review_enabled' => $this->revEnabled ? '1' : '0',
			'rating_enabled' => $this->ratingEnabled ? '1' : '0',
			'multi_rating' => $this->revMulti ? '1' : '0',
			'positive_negative' => $this->revPositive ? '1' : '0',
		);

		if ( Sobi::Can( 'review.add.own' ) ) {
			$enabled = $this->revEnabled;
			$rated = false;
			// check if user has already rated this entry
			if ( !( $this->revMulti ) ) {
				$rated = $this->userReviews( true );
			}
			// @todo it has to be improved - quite a stupid non-DRY code due to quick fix of a serious logic bug
			if ( !( $rated ) && $enabled ) {
				$entry[ 'review_form' ][ 'settings' ] = array(
					'email_required' => Sobi::My( 'id' ) ? false : $this->revMailRequ,
					'review_enabled' => $this->revEnabled,
					'rating_enabled' => $this->ratingEnabled,
					'positive_negative' => $this->revPositive,
					'name_required' => Sobi::My( 'id' ) ? '0' : true,
					'token' => SPFactory::mainframe()->token()
				);
				if ( $this->ratingEnabled ) {
					$entry[ 'review_form' ][ 'fields' ] = $this->reviewFieldsView();
				}
			}
			elseif ( !( $rated ) && $this->ratingEnabled ) {
				$entry[ 'review_form' ][ 'settings' ] = array(
					'review_enabled' => '0',
					'rating_enabled' => true,
					'token' => SPFactory::mainframe()->token(),
					'positive_negative' => $this->revPositive,
				);
				$entry[ 'review_form' ][ 'fields' ] = $this->reviewFieldsView();
			}
			else {
				$entry[ 'review_form' ][ 'settings' ] = array(
					'review_enabled' => '0',
					'rating_enabled' => '0',
					'positive_negative' => $this->revPositive,
				);
			}
		}
		if ( Sobi::Can( 'review.see.valid' ) ) {
			$db = SPFactory::db();
			$perms = array( 'sid' => $this->sid, '!rReview' => null );
			if ( !( Sobi::Can( 'review.see.any' ) ) ) {
				if ( !( Sobi::Can( 'review.see.own_unpublished' ) ) ) {
					$perms[ 'state' ] = 1;
				}
				else {
					$perms = $db->argsOr( array( 'state' => '1', 'uid' => Sobi::My( 'id' ) ) );
				}
			}
			$count = $db
					->select( 'count(rid)', 'spdb_sprr_review', $perms, $this->revOrdering )
					->loadResult();
			$reviews = array();
			if ( $count ) {
				$eLimStart = ( ( $site - 1 ) * $this->revOnSite );
				$revs = $db->select( 'rid', 'spdb_sprr_review', $perms, $this->revOrdering, $this->revOnSite, $eLimStart )->loadResultArray();
				if ( $revs && count( $revs ) ) {
					foreach ( $revs as $rev ) {
						$review = new self( $rev );
						$review->prepareContent();
						$reviews[ ] = $review;
					}
				}
			}
			if ( count( $reviews ) ) {
				foreach ( $reviews as $review ) {
					$input[ 'positives' ] = null;
					$input[ 'negatives' ] = null;
					$author = $review->get( 'author' );
					$ratings = $review->get( 'rating' );
					$r = array();
					if ( count( $ratings ) ) {
						foreach ( $ratings as $rating ) {
							if ( !( isset( $rating[ 'definition' ] ) ) ) {
								continue;
							}
							$r[ ] = array(
								'_complex' => 1,
								'_data' => $rating[ 'vote' ],
								'_attributes' => array( 'id' => $rating[ 'fid' ], 'label' => $rating[ 'definition' ][ 'label' ], 'importance' => $rating[ 'definition' ][ 'importance' ] )
							);
						}
					}
					$input[ 'text' ] = array(
						'_complex' => 1,
						'_xml' => true,
						'_data' => ( $review->get( 'review' ) )
					);
					if ( strlen( $review->get( 'positiveReview' ) ) ) {
						$input[ 'positives' ] = explode( ',', $review->get( 'positiveReview' ) );
					}
					if ( strlen( $review->get( 'negativeReview' ) ) ) {
						$input[ 'negatives' ] = explode( ',', $review->get( 'negativeReview' ) );
					}
					$entry[ 'reviews' ][ ] = array(
						'_complex' => 1,
						'_data' => array(
							'title' => $review->get( 'title' ),
							'input' => $input,
							'author' => array(
								'_complex' => 1,
								'_data' => $author[ 'name' ],
								'_attributes' => array( 'id' => $author[ 'uid' ] )
							),
							'ratings' => $r
						),
						'_attributes' => array(
							'id' => $review->get( 'rid' ),
							'date' => $review->get( 'date' ),
							'oar' => $review->get( 'oar' ),
							'published' => $review->get( 'state' ),
						),
					);
				}
				/** If not isset( $entry[ 'entry' ] ) then it is ajax request and the form is already there */
				if ( $this->revReportsEnabled && ( Sobi::My( 'id' ) || $this->revReportsAnonymous ) && isset( $entry[ 'entry' ] ) ) {
					$subjects = SPLang::getValue( 'sprr_report_msg', 'application', Sobi::Section() );
					if ( !( strlen( $subjects ) ) ) {
						$subjects = Sobi::Txt( 'SPRRA.SETTINGS_REPORTS_DEF_SUBJECTS' );
					}
					$subjects = json_decode( $subjects );
					if ( count( $subjects ) ) {
						foreach ( $subjects as $i => $s ) {
							$subjects[ $i ] = trim( $s );
						}
					}
					$txt = array(
						'report' => Sobi::Txt( 'SPRRA.REPORT_LABEL' ),
						'select_subject' => Sobi::Txt( 'SPRRA.REPORT_SELECT_SUBJECT_LABEL' ),
						'enter_subject' => Sobi::Txt( 'SPRRA.REPORT_ENTER_SUBJECT_LABEL' ),
						'enter_text' => Sobi::Txt( 'SPRRA.REPORT_ENTER_TEXT_LABEL' ),
						'send_bt' => Sobi::Txt( 'SPRRA.REPORT_SEND_BUTTON' ),
						'window_title' => Sobi::Txt( 'SPRRA.REPORT_WINDOW_HEAD' ),
					);
					if ( !( Sobi::My( 'id' ) ) ) {
						$txt[ 'enter_name' ] = Sobi::Txt( 'SPRRA.REPORT_ENTER_NAME_LABEL' );
						$txt[ 'enter_email' ] = Sobi::Txt( 'SPRRA.REPORT_ENTER_EMAIL_LABEL' );
					}
					foreach ( $txt as $i => $s ) {
						$labels[ ] = array(
							'_complex' => 1,
							'_data' => trim( $s ),
							'_attributes' => array( 'label' => $i )
						);
					}
					$entry[ 'reviews' ][ 'report_form' ] = array(
						'texts' => $labels,
						'subjects' => $subjects
					);
				}
				elseif ( $this->revReportsEnabled && ( Sobi::My( 'id' ) || $this->revReportsAnonymous ) ) {
					$entry[ 'reviews' ][ 'report_form' ] = array(
						'enabled' => 1,
						'texts' => array(
							array(
								'_complex' => 1,
								'_data' => trim( Sobi::Txt( 'SPRRA.REPORT_LABEL' ) ),
								'_attributes' => array( 'label' => 'report' )
							)
						)
					);
				}
				$rs = $this->countAverage();
				$entry[ 'reviews' ][ 'summary_rating' ][ 'overall' ] = array( '_complex' => 1, '_data' => round( $rs[ 'oar' ], 2 ), '_attributes' => array( 'count' => $rs[ 'count' ], 'value' => $rs[ 'oar' ] ) );
				if ( isset( $rs[ 'detailed' ] ) && count( $rs[ 'detailed' ] ) ) {
					$r = array();
					$ratings = $this->reviewFields();
					if ( count( $ratings ) ) {
						foreach ( $ratings as $rating ) {
							if ( isset( $rs[ 'detailed' ][ $rating[ 'fid' ] ] ) ) {
								$r[ ] = array(
									'_complex' => 1,
									'_data' => round( $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'ar' ], 2 ),
									'_attributes' => array( 'id' => $rating[ 'fid' ], 'label' => $rating[ 'label' ], 'count' => $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'count' ], 'value' => $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'ar' ] )
								);
							}
						}
					}
					$entry[ 'reviews' ][ 'summary_rating' ][ 'fields' ] = $r;
				}
				$entry[ 'reviews' ][ 'settings' ][ 'positive_negative' ] = $this->revPositive;
				/* create page navigation - if no Ajax Fri, Jun 28, 2013 15:25:24 */
				if ( isset( $entry[ 'entry' ] ) ) {
					$pnc = SPLoader::loadClass( 'helpers.pagenav_xslt' );
					$nid = Sobi::Cfg( 'sef.alias', true ) ? $entry[ 'entry' ][ '_attributes' ][ 'nid' ] : $entry[ 'entry' ][ '_data' ][ 'name' ][ '_data' ];
					$pn = new $pnc( $this->revOnSite, $count, $site, array( 'sid' => $this->sid, 'title' => $nid ) );
					$entry[ 'reviews' ][ 'navigation' ] = array(
						'_complex' => 1,
						'_data' => $pn->get(),
						'_attributes' => array( 'lang' => Sobi::Lang( false ) )
					);
				}
				else {
					$pages = ceil( $count / $this->revOnSite );
					$entry[ 'reviews' ][ 'navigation' ][ 'sites' ] = $pages;
					$entry[ 'reviews' ][ 'navigation' ][ 'site' ] = $site;
					$visitor = SPFactory::user()->getCurrent();
					$usertype = $visitor->get( 'usertype' );
					if ( strlen( $usertype ) == 0 ) {
						$usertype = 'Visitor';
					}
					$entry[ 'visitor' ] = array(
						'_complex' => 1,
						'_data' => array(
							'name' => $visitor->get( 'name' ),
							'username' => $visitor->get( 'username' ),
							'usertype' => array(
								'_complex' => 1,
								'_data' => $usertype,
								'_attributes' => array( 'gid' => implode( ', ', $visitor->get( 'gid' ) ) )
							)
						),
						'_attributes' => array( 'id' => $visitor->get( 'id' ) )
					);
				}
			}
			// we have only rating enabled so there would not be reviews
			else {
				$this->setList( $entry );
			}
		}
	}

	protected function prepareContent()
	{
		$this->review = str_replace( array( '<', '>' ), array( '&lt;', '&gt;' ), $this->review );
		while ( preg_match( '/\n\s*\n/', $this->review ) ) {
			$this->review = preg_replace( '/\n\s*\n/', "\n", $this->review );
		}
		$this->review = str_replace( "\n", '<br/>', $this->review );
		$this->review = preg_replace( "/(?<!>)\n/", "<br />\n", $this->review );
		$this->review = preg_replace( '/(http[s]?:\/\/)([a-z0-9\.\-]*)([[:space:]\n\r\t])/i', '<a href="\1\2" target="_blank">\2</a>\3', $this->review );
		if ( count( $this->badWords ) ) {
			foreach ( $this->badWords as $word ) {
				$this->censor( $word, $this->review );
				$this->censor( $word, $this->negativeReview );
				$this->censor( $word, $this->positiveReview );
				$this->censor( $word, $this->title );
			}
		}
		$this->review = preg_replace( '/&(?![#]?[a-z0-9]+;)/i', '&amp;', $this->review );
	}

	/**
	 * @param $word
	 * @param $string
	 */
	protected function censor( $word, &$string )
	{
		preg_match_all( "/{$word}/i", $string, $result );
		if ( isset( $result[ 0 ] ) && count( $result[ 0 ] ) ) {
			foreach ( $result[ 0 ] as $replace ) {
				$replacement = Sobi::Txt( 'SPRRA.BAD_WORD_CENSORED', $replace );
				$replacement = "<span class=\"review-censored-word\">{$replacement}</span>";
				$string = str_replace( $replace, $replacement, $string );
			}
		}
	}

	public function countAverage( $sid = 0 )
	{
		$sid = $sid ? $sid : $this->sid;
		$r = SPFactory::db()->select( array( 'AVG(oar)', 'COUNT(*)' ), 'spdb_sprr_review', array( 'sid' => $sid, 'state' => 1 ) )
				->loadAssocList();
		$rating = array(
			'oar' => $r[ 0 ][ 'AVG(oar)' ],
			'count' => $r[ 0 ][ 'COUNT(*)' ]
		);
		$r = SPFactory::db()
				->select( array( 'AVG(vote)', 'COUNT(*)', 'fid' ), 'spdb_sprr_rating', array( 'sid' => $sid, 'state' => 1, 'vote>' => 0 ), null, 0, 0, true, 'fid' )
				->loadAssocList( 'fid' );
		$rd = array();
		if ( count( $r ) ) {
			foreach ( $r as $v ) {
				$rd[ 'ar' ] = $v[ 'AVG(vote)' ];
				$rd[ 'count' ] = $v[ 'COUNT(*)' ];
				$rating[ 'detailed' ][ $v[ 'fid' ] ] = $rd;
			}
		}
		return $rating;
	}

	/**
	 *
	 */
	private function userReviews( $count = false, $data = array() )
	{
		$result = null;
		if ( $count ) {
			if ( Sobi::My( 'id' ) ) {
				$result = SPFactory::db()
						->select( 'COUNT(*)', 'spdb_sprr_review', array( 'uid' => Sobi::My( 'id' ), 'sid' => $this->sid ) )
						->loadResult();
			}
			elseif ( count( $data ) && isset( $data[ 'review' ][ 'vmail' ] ) ) {
				$result = SPFactory::db()
						->select( 'COUNT(*)', 'spdb_sprr_review', array( 'uEmail' => $data[ 'review' ][ 'vmail' ], 'sid' => $this->sid ) )
						->loadResult();
			}
			else {
				/* @todo: limit the time to not prevent forever */
				$result = SPFactory::db()
						->select( 'COUNT(*)', 'spdb_sprr_review', array( 'uIP' => SPRequest::ip( 'REMOTE_ADDR', 0, 'SERVER' ), 'sid' => $this->sid ) )
						->loadResult();
			}
		}
		else {

		}
		return $result;
	}

	public function extend( $model, $something )
	{

	}

	public function countVisit()
	{

	}

	/**
	 *
	 */
	public function delete()
	{
		Sobi::Trigger( 'Review', 'BeforeDelete', array( array( 'review' => &$this ) ) );
		SPFactory::db()->delete( 'spdb_sprr_rating', array( 'rid' => $this->rid ) );
		SPFactory::db()->delete( 'spdb_sprr_review', array( 'rid' => $this->rid ) );
	}

	/**
	 *
	 */
	public function saveReview( &$data )
	{
		$this->validateInput( $data, isset( $data[ 'review' ][ 'rid' ] ) );
		$action = 'save';
		/* @todo: */
		if ( !( $this->revMulti ) && ( !( Sobi::My( 'id' ) ) ) ) {

		}
		$this->countRating( $data );
		if ( isset( $data[ 'review' ][ 'sid' ] ) ) {
			$this->sid = $data[ 'review' ][ 'sid' ];
		}
		else {
			$this->sid = $data[ 'review' ][ 'eid' ];
		}
		if ( !( isset( $data[ 'review' ][ 'rid' ] ) ) ) {
			try {
				SPFactory::db()->insert(
					'spdb_sprr_review',
					array(
						'rid' => 0,
						'sid' => $data[ 'review' ][ 'sid' ],
						'section' => isset( $data[ 'review' ][ 'section' ] ) ? $data[ 'review' ][ 'section' ] : Sobi::Section(),
						'rTitle' => $data[ 'review' ][ 'title' ],
						'rReview' => $data[ 'review' ][ 'review' ],
						'rNeg' => $data[ 'review' ][ 'neg_review' ],
						'rPos' => $data[ 'review' ][ 'pos_review' ],
						'rDate' => SPRequest::now(),
						'uid' => Sobi::My( 'id' ),
						'uName' => $data[ 'review' ][ 'visitor' ],
						'uEmail' => $data[ 'review' ][ 'vmail' ],
						'uIP' => SPRequest::ip( 'REMOTE_ADDR', 0, 'SERVER' ),
						'approved' => Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' ) || !( $this->revEnabled ) ? Sobi::My( 'id' ) : 0,
						'state' => Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' ) || !( $this->revEnabled ),
						'rRating' => serialize( $data[ 'rating' ][ 'fields' ] ),
						'rParams' => null,
						'appAt' => Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' ) ? SPRequest::now() : null,
						'appIP' => Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' ) ? SPRequest::ip( 'REMOTE_ADDR', 0, 'SERVER' ) : null,
						'editedAt' => null,
						'editedBy' => 0,
						'editedIP' => null,
						'oar' => $data[ 'rating' ][ 'oar' ],
						'hc' => 0
					)
				);
				$rid = SPFactory::db()->insertid();
			} catch ( SPException $x ) {
				Sobi::Error( __CLASS__, SPLang::e( 'Cannot save review. Msg %s', $x->getMessage() ), SPC::WARNING, 0, __LINE__, __FILE__ );
				throw new SPException( SPReview::Txt( 'ERR_CANNOT_STORE' ) );
			}
		}
		else {
			$action = 'update';
			$rid = $data[ 'review' ][ 'rid' ];
			$rev = array();
			foreach ( $data[ 'review' ] as $k => $v ) {
				$rev[ $this->rel[ $k ] ] = $v;
			}
			$rev[ 'editedAt' ] = SPRequest::now();
			$rev[ 'editedBy' ] = Sobi::My( 'id' );
			$rev[ 'editedIP' ] = SPRequest::ip( 'REMOTE_ADDR', 0, 'SERVER' );
			$rev[ 'rDate' ] = $data[ 'review' ][ 'date' ] ? $data[ 'review' ][ 'date' ] : SPRequest::now();
			if ( $data[ 'review' ][ 'uid' ] ) {
				$rev[ 'uid' ] = $data[ 'review' ][ 'uid' ];
			}

			$rev[ 'sid' ] = $this->sid;
			$rev[ 'oar' ] = $data[ 'rating' ][ 'oar' ];
			if ( isset( $data[ 'rating' ][ 'fields' ] ) && count( $data[ 'rating' ][ 'fields' ] ) ) {
				$rev[ 'rRating' ] = serialize( $data[ 'rating' ][ 'fields' ] );
			}
			SPFactory::db()->delete( 'spdb_sprr_rating', array( 'rid' => $rid ) );
			SPFactory::db()->update( 'spdb_sprr_review', $rev, array( 'rid' => $rid ) );
		}
		if ( $this->ratingEnabled ) {
			try {
				if ( count( $data[ 'rating' ][ 'fields' ] ) ) {
					foreach ( $data[ 'rating' ][ 'fields' ] as $fid => $rate ) {
						$data[ 'rating' ][ 'fields' ][ $fid ][ 'rid' ] = $rid;
						$data[ 'rating' ][ 'fields' ][ $fid ][ 'sid' ] = $this->sid;
						$data[ 'rating' ][ 'fields' ][ $fid ][ 'state' ] = Sobi::Can( 'review.manage.own' ) || Sobi::Can( 'review.autopublish.own' );
					}
					SPFactory::db()->insertArray( 'spdb_sprr_rating', $data[ 'rating' ][ 'fields' ] );
				}
			} catch ( SPException $x ) {
				Sobi::Error( __CLASS__, SPLang::e( 'Cannot save review. Msg %s', $x->getMessage() ), SPC::WARNING, 0, __LINE__, __FILE__ );
				throw new SPException( SPReview::Txt( 'ERR_CANNOT_STORE' ) );
			}
		}
		$this->load( $rid );
		$this->trigger( $action );
		SPFactory::cache()->cleanSection();
		return !( $this->revMulti );
	}

	private function recount( $full = true )
	{
		$data = array();
		$r = SPFactory::db()->select( array( 'fid', 'vote' ), 'spdb_sprr_rating', array( 'rid' => $this->rid, 'vote>' => 0 ) )->loadAssocList( 'fid' );
		if ( count( $r ) ) {
			foreach ( $r as $fid => $vote ) {
				$rating[ $fid ] = $vote[ 'vote' ];
			}
		}
		$data[ 'review' ][ 'sid' ] = $this->sid;
		$data[ 'rating' ] =& $rating;
		$this->countRating( $data );
		if ( !( isset( $data[ 'rating' ][ 'fields' ] ) ) || !( count( $data[ 'rating' ][ 'fields' ] ) ) ) {
			if ( $this->ratingEnabled ) {
				SPFactory::message()
						->warning( SPReview::Txt( 'ERR_NO_RATING_CRITERIA' ), false )
						->setSystemMessage();
			}
			return false;
		}

		foreach ( $data[ 'rating' ][ 'fields' ] as $fid => $vote ) {
			$this->rating[ $fid ] = $vote;
		}
		$this->oar = $data[ 'rating' ][ 'oar' ];
		// only if for example a field has been completely deleted
		if ( $full ) {
			SPFactory::db()->delete( 'spdb_sprr_rating', array( 'rid' => $this->rid ) );
			foreach ( $data[ 'rating' ] as $fid => $rate ) {
				$data[ 'rating' ][ 'fields' ][ $fid ][ 'rid' ] = $this->rid;
				$data[ 'rating' ][ 'fields' ][ $fid ][ 'sid' ] = $this->sid;
				$data[ 'rating' ][ 'fields' ][ $fid ][ 'state' ] = $this->state;
			}
			//SPFactory::db()->delete( 'spdb_sprr_rating', array( 'rid' => $this->rid ) );
			SPFactory::db()->insertArray( 'spdb_sprr_rating', $data[ 'rating' ][ 'fields' ] );
		}
		$rev[ 'oar' ] = $this->oar;
		$rev[ 'rRating' ] = serialize( $data[ 'rating' ][ 'fields' ] );
		SPFactory::db()->update( 'spdb_sprr_review', $rev, array( 'rid' => $this->rid ) );
	}

	public function countRating( &$data )
	{
		if ( !( $this->ratingEnabled ) ) {
			$data[ 'rating' ] = array();
			return true;
		}
		$fields = $this->reviewFields();
		$oai = 0;
		$fieldsCount = 0;
		foreach ( $fields as $field ) {
			$fieldsCount++;
			// we have to revert the importance as 1 is the most and 10 is the less important
			$oai += ( 11 - $field[ 'importance' ] );
		}
		if ( !( $oai ) ) {
			$oai = count( $fields );
		}
		$overAll = 0;
		foreach ( $fields as $fid => $field ) {
			if ( !( isset( $data[ 'rating' ][ $fid ] ) ) ) {
				continue;
			}
			$fr = array();
			$fr[ 'sid' ] = $data[ 'review' ][ 'sid' ];
			$fr[ 'fid' ] = $fid;
			$fr[ 'vote' ] = $data[ 'rating' ][ $fid ];
			$percent = ( 11 - $field[ 'importance' ] ) * 100 / $oai;
			$fr[ 'oai' ] = ( $percent * $fr[ 'vote' ] ) / 100;
			$overAll = $overAll + $fr[ 'oai' ];
			$data[ 'rating' ][ 'fields' ][ $fid ] = $fr;
		}
		$data[ 'rating' ][ 'oar' ] = $overAll;
	}

	protected function throwInputException( $message, $data = array() )
	{
		$ex = new SPException( $message );
		if ( count( $data ) ) {
			$ex->setData( $data );
		}
		throw $ex;
	}

	/**
	 *
	 */
	public function validateInput( &$data, $update = false )
	{
		if ( $this->revEnabled || $update ) {
			if ( !( strlen( $data[ 'review' ][ 'title' ] ) ) ) {
				$this->throwInputException( SPReview::Txt( 'ERR_REV_NO_TITLE' ), array( 'fid' => 'review-title' ) );
			}
			if ( !( strlen( $data[ 'review' ][ 'review' ] ) ) ) {
				$this->throwInputException( SPReview::Txt( 'ERR_REV_REQ' ), array( 'fid' => 'review-text' ) );
			}
			if ( !( $this->revPositive || $update ) ) {
				$data[ 'review' ][ 'pos_review' ] = null;
				$data[ 'review' ][ 'neg_review' ] = null;
			}
		}
		else {
			$data[ 'review' ][ 'title' ] = null;
			$data[ 'review' ][ 'review' ] = null;
		}
		$fields = $this->reviewFields();
		if ( count( $data[ 'rating' ] ) ) {
			foreach ( $fields as $field ) {
				if ( !( isset( $data[ 'rating' ][ $field[ 'fid' ] ] ) ) || $data[ 'rating' ][ $field[ 'fid' ] ] == 0 ) {
					$this->throwInputException( SPReview::Txt( 'ERR_RATING_ZERO' ), array( 'fid' => 'criteria-' . $field[ 'fid' ] ) );
				}
				if ( !( is_numeric( $data[ 'rating' ][ $field[ 'fid' ] ] ) ) ) {
					$this->throwInputException( SPReview::Txt( 'ERR_RATING_HACK' ) );
				}
			}
		}
		elseif ( $this->ratingEnabled ) {
			$field = array_shift( $fields );
			$this->throwInputException( SPReview::Txt( 'ERR_RATING_ZERO' ), array( 'fid' => 'criteria-' . $field[ 'fid' ] ) );
		}
		if ( !( $data[ 'review' ][ 'sid' ] ) ) {
			$this->throwInputException( SPReview::Txt( 'ERR_RATING_HACK' ) );
		}
		if ( !( Sobi::My( 'id' ) || $update ) || isset( $data[ 'review' ][ 'vmail' ] ) ) {
			if ( $this->revEnabled && !( Sobi::My( 'id' ) ) && !( isset( $data[ 'review' ][ 'visitor' ] ) && $data[ 'review' ][ 'visitor' ] ) ) {
				$this->throwInputException( SPReview::Txt( 'ERR_AUTHOR_REQ' ), array( 'fid' => 'review-author' ) );
			}
			if ( $this->revMailRequ && $this->revEnabled ) {
				$data[ 'review' ][ 'vmail' ] = trim( $data[ 'review' ][ 'vmail' ] );
				if ( !( $data[ 'review' ][ 'vmail' ] ) ) {
					$this->throwInputException( SPReview::Txt( 'ERR_MAIL_REQ' ), array( 'fid' => 'review-author-mail' ) );
				}
				else {
					$registry =& SPFactory::registry();
					$registry->loadDBSection( 'fields_filter' );
					$filter = $registry->get( 'fields_filter.email' );
					if ( !( preg_match( base64_decode( $filter[ 'params' ] ), $data[ 'review' ][ 'vmail' ] ) ) ) {
						$this->throwInputException( str_replace( '$field', '"' . SPReview::Txt( 'FORM_VISITOR_MAIL' ) . '"', SPLang::e( $filter[ 'description' ] ) ), array( 'fid' => 'review-author-mail' ) );
					}
				}
			}
		}
		elseif ( !( $update ) ) {
			$data[ 'review' ][ 'vmail' ] = Sobi::My( 'email' );
			$data[ 'review' ][ 'visitor' ] = Sobi::My( 'name' );
		}
	}

	/**
	 *
	 */
	public function reviewFieldsView()
	{
		$f = $this->reviewFields();
		$fields = array();
		foreach ( $f as $field ) {
			$fields[ ] = array(
				'_complex' => 1,
				'_data' => array(
					'label' => $field[ 'label' ],
					'explanation' => $field[ 'explanation' ],
				),
				'_attributes' => array(
					'id' => $field[ 'id' ],
					'enabled' => $field[ 'enabled' ],
					'importance' => $field[ 'importance' ],
					'position' => $field[ 'position' ],
				),
			);
		}
		return $fields;
	}

	/**
	 *
	 */
	public function setList( &$entry )
	{
		$rs = $this->countAverage();
		$ratings = $this->reviewFields();
		$entry[ 'reviews' ][ 'summary_rating' ][ 'overall' ] = array( '_complex' => 1, '_data' => round( $rs[ 'oar' ], 2 ), '_attributes' => array( 'count' => $rs[ 'count' ], 'value' => $rs[ 'oar' ] ) );
		if ( isset( $rs[ 'detailed' ] ) && count( $rs[ 'detailed' ] ) ) {
			$r = array();
			foreach ( $ratings as $rating ) {
				if ( isset( $rs[ 'detailed' ][ $rating[ 'fid' ] ] ) ) {
					$r[ ] = array(
						'_complex' => 1,
						'_data' => round( $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'ar' ], 2 ),
						'_attributes' => array( 'id' => $rating[ 'fid' ], 'label' => $rating[ 'label' ], 'count' => $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'count' ], 'value' => $rs[ 'detailed' ][ $rating[ 'fid' ] ][ 'ar' ] )
					);
				}
			}
			$entry[ 'reviews' ][ 'summary_rating' ][ 'fields' ] = $r;
		}
	}

	/**
	 *
	 */
	public function storeField( $data )
	{
		SPFactory::db()->insertUpdate(
			'spdb_sprr_fields',
			array(
				'fid' => $data[ 'fid' ],
				'enabled' => $data[ 'enabled' ],
				'importance' => $data[ 'importance' ],
				'sid' => $data[ 'sid' ],
				'position' => $data[ 'position' ],
			)
		);
		if ( !( $data[ 'fid' ] ) ) {
			$data[ 'fid' ] = SPFactory::db()->insertid();
		}
		$data[ 'id' ] = $data[ 'fid' ];
		$data[ 'value' ] = $data[ 'name' ];
		$data[ 'key' ] = $data[ 'type' ] = 'sprr_field';
		SPLang::saveValues( $data );
		return $data[ 'fid' ];
	}

	/**
	 *
	 */
	public function reviewFields( $enabled = true )
	{
		static $fields = null;
		if ( !( $fields ) ) {
			$query = array( 'sid' => Sobi::Section() );
			if ( $enabled ) {
				$query[ 'enabled' ] = 1;
			}
			$fields = SPFactory::db()
					->select( '*', 'spdb_sprr_fields', $query, 'position' )
					->loadAssocList( 'fid' );
			if ( count( $fields ) ) {
				$ids = array_keys( $fields );
				$labels = SPFactory::db()
						->select(
							array( 'sValue', 'explanation', 'language', 'id' ),
							'spdb_language',
							array( 'id' => $ids, 'oType' => 'sprr_field', 'section' => Sobi::Section() )
						)->loadAssocList();
				foreach ( $fields as $id => $field ) {
					foreach ( $labels as $label ) {
						if ( $label[ 'id' ] == $id ) {
							if ( !( isset( $field[ 'label' ] ) ) || $label[ 'language' ] == Sobi::Lang() ) {
								$field[ 'label' ] = $label[ 'sValue' ];
								$field[ 'explanation' ] = $label[ 'explanation' ];
							}
						}
						$field[ 'id' ] = $id;
						/* Needed in admin area only */
						if ( defined( 'SOBIPRO_ADM' ) ) {
							$row = new SPObject();
							$row->castArray( $field );
							$field[ 'object' ] = $row;
						}
						$fields[ $id ] = $field;
					}
					if ( !( isset( $field[ 'label' ] ) ) ) {
						$field[ 'label' ] = 'Missing';
						$field[ 'explanation' ] = 'Missing';
					}
				}
			}
			else {
				$fields = array();
			}
		}
		return $fields;
	}

	/**
	 *
	 */
	private function trigger( $action )
	{
		Sobi::Trigger( 'Review', 'After' . ucfirst( $action ) . 'Review', array( array( 'review_data' => &$this ) ) );
	}

	/**
	 *
	 */
	public function approve()
	{
		SPFactory::db()->update( 'spdb_sprr_review',
			array( 'approved' => Sobi::My( 'id' ), 'appAt' => SPRequest::now(), 'appIP' => SPRequest::ip( 'REMOTE_ADDR', 0, 'SERVER' ), 'state' => 1 ),
			array( 'rid' => $this->rid )
		);
		SPFactory::db()->update( 'spdb_sprr_rating', array( 'state' => 1 ), array( 'rid' => $this->rid ) );
		$this->trigger( __FUNCTION__ );
	}

	/**
	 *
	 */
	public function unapprove()
	{
		SPFactory::db()->update( 'spdb_sprr_review', array( 'approved' => 0 ), array( 'rid' => $this->rid ) );
		SPFactory::db()->update( 'spdb_sprr_rating', array( 'state' => 0 ), array( 'rid' => $this->rid ) );
		$this->trigger( __FUNCTION__ );
	}

	/**
	 *
	 */
	public function publish()
	{
		SPFactory::db()->update( 'spdb_sprr_review', array( 'state' => 1 ), array( 'rid' => $this->rid ) );
		SPFactory::db()->update( 'spdb_sprr_rating', array( 'state' => 1 ), array( 'rid' => $this->rid ) );
		$this->trigger( __FUNCTION__ );
	}

	/**
	 *
	 */
	public function unpublish()
	{
		SPFactory::db()->update( 'spdb_sprr_review', array( 'state' => 0 ), array( 'rid' => $this->rid ) );
		SPFactory::db()->update( 'spdb_sprr_rating', array( 'state' => 0 ), array( 'rid' => $this->rid ) );
		$this->trigger( __FUNCTION__ );
	}

	/**
	 *
	 */
	public static function Txt( $txt )
	{
		return Sobi::Txt( 'SPRRA.' . $txt );
	}
}
