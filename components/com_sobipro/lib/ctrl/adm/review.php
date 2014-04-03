<?php
/**
 * @version: $Id: review.php 3576 2013-07-22 12:52:51Z Radek Suski $
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
 * $Date: 2013-07-22 14:52:51 +0200 (Mo, 22 Jul 2013) $
 * $Revision: 3576 $
 * $Author: Radek Suski $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadController( 'config', true );

class SPRrCtrl extends SPConfigAdmCtrl
{
	/**
	 * @var string
	 */
	protected $_type = 'review';
	/**
	 * @var string
	 */
	protected $_defTask = 'config';

	public function execute()
	{
		$task = $this->_task = strlen( $this->_task ) ? $this->_task : $this->_defTask;

		SPLang::load( 'SpApp.review_rating' );
		switch ( $this->_task ) {
			case 'config':
				$this->checkInstall();
				$this->screen();
				Sobi::ReturnPoint();
				$r = true;
				break;
			case 'list':
				$this->listReviews();
				Sobi::ReturnPoint();
				$r = true;
				break;
			case 'addMenuEntry':
				self::XMLInstall();
				Sobi::Redirect( Sobi::Back(), 'Done!' );
				break;
			case 'saveReview':
			case 'applyReview':
				$this->saveReview( $this->_task == 'applyReview' );
				$r = true;
				break;
			case 'toggle.state':
			case 'toggle.approval':
				$this->toggle();
				$r = true;
				break;
			case 'cancel':
				$this->response( Sobi::Back() );
				break;
			default:
				if ( method_exists( $this, $this->_task ) ) {
					$this->$task();
					$r = true;
				}
				else {
					Sobi::Error( 'SPRrCtrl', 'Task not found', SPC::WARNING, 404, __LINE__, __FILE__ );
				}
				break;
		}
		return $r;
	}

	public static function XMLInstall( $force = false )
	{
		$file = SPLoader::translatePath( 'metadata', 'front', true, 'xml' );
		$run = false;
		$tasks = array(
			'list.rating.top' => 'SPRRA.LIST_TOP_RATED',
			'list.rating.most' => 'SPRRA.LIST_MOST_RATED'
		);
		$strings = array();
		foreach ( $tasks as $label ) {
			$strings[ ] = $label;
			$strings[ ] = $label . '_EXPL';
		}
		$strings[ ] = 'TASK_LIST.RATING.TOP';
		/** check if it hasn't been already added */
		if ( !( strstr( SPFs::read( $file ), 'list.rating.top' ) ) ) {
			$run = true;
			$doc = new DOMDocument();
			$doc->load( $file );
			$options = $doc->getElementsByTagName( 'options' )->item( 0 );
			foreach ( $tasks as $task => $label ) {
				$node = $doc->createElement( 'option' );
				$attribute = $doc->createAttribute( 'value' );
				$attribute->value = $task;
				$node->appendChild( $attribute );
				$attribute = $doc->createAttribute( 'name' );
				$attribute->value = 'SP.' . $label;
				$node->appendChild( $attribute );
				$attribute = $doc->createAttribute( 'msg' );
				$attribute->value = 'SP.' . $label . '_EXPL';
				$node->appendChild( $attribute );
				$options->appendChild( $node );
			}
			$doc->save( $file );
		}
		if ( $run || $force ) {
			$dirPath = SPLoader::dirPath( 'administrator.language', 'root' );
			/** @var SPDirectory $dir */
			$dir = SPFactory::Instance( 'base.fs.directory', $dirPath );
			$files = $dir->searchFile( 'com_sobipro.sys.ini', false, 2 );
			$default = array();
			$defaultLangDir = SPLoader::dirPath( "language.en-GB", 'root', true );
			$defaultLang = parse_ini_file( $defaultLangDir . 'en-GB.SpApp.review_rating.ini' );
			foreach ( $strings as $string ) {
				$default[ 'SP.' . $string ] = $defaultLang[ 'SP.' . $string ];
			}
			/** @var SPFile $file */
			$file = null;
			foreach ( $files as $file ) {
				$fileName = $file->getFileName();
				list( $language ) = explode( '.', $fileName );
				$nativeLangDir = SPLoader::dirPath( "language.{$language}", 'root', true );
				$nativeStrings = array();
				if ( $nativeLangDir ) {
					$nativeLangFile = $nativeLangDir . $language . '.SpApp.review_rating.ini';
					if ( file_exists( $nativeLangFile ) ) {
						$nativeLang = @parse_ini_file( $nativeLangFile );
						foreach ( $strings as $string ) {
							if ( isset( $nativeLang[ 'SP.' . $string ] ) ) {
								$nativeStrings[ 'SP.' . $string ] = $nativeLang[ 'SP.' . $string ];
							}
						}
					}
				}
				$add = null;
				foreach ( $strings as $string ) {
					if ( isset( $nativeStrings[ 'SP.' . $string ] ) ) {
						$add .= "\nSP.{$string}=\"{$nativeStrings['SP.' . $string]}\"";
					}
					else {
						$add .= "\nSP.{$string}=\"{$default['SP.' . $string]}\"";
					}
				}
				$add .= "\n";
				$content = SPFs::read( $file->getPathname() );
				$add = $content . $add;
				SPFs::write( $file->getPathname(), $add );
			}
		}
	}

	public static function ParseRating( $value = null, $r = null, $o = 0 )
	{
		static $ratings = array();
		static $index = 0;
		static $oar = 0;
		$data = null;
		$params = array( 'class' => 'sprrstar' );
		if ( $value == 'init' ) {
			$ratings = $r;
			$oar = $o;
		}
		elseif ( is_numeric( $value ) ) {
			for ( $s = 1; $s < 11; ++$s ) {
				$sel = ( $s <= $value ) ? ' star-rating-on' : '';
				$mar = $s % 2 ? 0 : -8;
				$data .= "<div style=\"width: 8px;\" class=\"star-rating star-rating-applied star-rating-readonly{$sel}\">";
				$data .= "<a style=\"margin-left: {$mar}px;\"></a>";
				$data .= "</div>";
			}
		}
		else {
			if ( $value == 'OAR' ) {
				$rating = $oar;
				$params[ 'disabled' ] = 'disabled';
				$params[ 'class' ] = 'sprrstar oar';
				$name = 'star';
			}
			else {
				$name = 'rating[' . $ratings[ $index ][ 'rating' ][ 'fid' ] . ']';
				$rating = $ratings[ $index++ ][ 'rating' ][ 'vote' ];
			}
			$rating = round( $rating );
			for ( $s = 1; $s < 11; ++$s ) {
				$data .= SPHtml_Input::radio( $name, $s, null, 'oar_' . $s, ( $rating == $s ), $params );
			}
		}
		return $data;
	}

	protected function toggle( $trigger = null )
	{
		/** @var SPReview $model */
		$model = SPFactory::Instance( 'models.review', SPRequest::int( 'rid' ) );
		$action = $trigger ? $trigger : $this->_task;
		switch ( $action ) {
			case 'toggle.state':
				$state = $model->get( 'state' );
				$state == 1 ? $model->unpublish() : $model->publish();
				$msg = Sobi::Txt( $state == 1 ? 'SPRRA.MSG_REV_UNPUBLISHED' : 'SPRRA.MSG_REV_PUBLISHED' );
				break;
			case 'toggle.approval':
				$state = $model->get( 'approved' ) > 0;
				$state ? $model->unapprove() : $model->approve();
				$msg = Sobi::Txt( $state ? 'SPRRA.MSG_REV_UNAPPR' : 'SPRRA.MSG_REV_APPR' );
				break;
		}
		SPFactory::cache()->cleanSection();
		if ( !( $trigger ) ) {
			$this->response( Sobi::Back(), $msg );
		}
	}

	protected function checkInstall()
	{
		$init = false;
		self::XMLInstall();
		$files = array( '.common.review', '.listing.top-rated', '.listing.most-rated', '.entry.ajax-review' );
		foreach ( $files as $file ) {
			if ( !( SPLoader::path( 'usr.templates.' . Sobi::Cfg( 'section.template' ) . $file, 'front', true, 'xsl' ) ) ) {
				if ( !( SPFs::copy( SPLoader::path( 'usr.templates.' . SPC::DEFAULT_TEMPLATE . $file, 'front', true, 'xsl' ), SPLoader::path( 'usr.templates.' . Sobi::Cfg( 'section.template' ) . $file, 'front', false, 'xsl' ) ) ) ) {
					Sobi::Error( 'SPRrCtrl', 'Cannot copy template to the current template directory', SPC::WARNING, 0, __LINE__, __FILE__ );
				}
				else {
					$init = true;
				}
			}
		}
		if ( $init || Sobi::Cfg( 'section.template' ) == SPC::DEFAULT_TEMPLATE ) {
			$fields = SPFactory::Model( 'review' )->reviewFields( false );
			if ( !( count( $fields ) ) ) {
				$def = array( 'Service', 'Communication', 'Support', 'Pricing' );
				foreach ( $def as $i => $value ) {
					$a = array(
						'enabled' => true,
						'importance' => 5,
						'sid' => Sobi::Section(),
						'fid' => 0,
						'section' => Sobi::Section(),
						'position' => $i + 1,
						'name' => $value,
						'label' => $value,
						'explanation' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nulla urna, molestie ut adipiscing vulputate, elementum eu nunc. Suspendisse eget sapien nec diam suscipit rutrum at id tellus.'
					);
					SPFactory::Model( 'review' )->storeField( $a );
				}
				$settings = array(
					'ratingEnabled' => true,
					'ratingRevReq' => true,
					'revEnabled' => true,
					'revMulti' => false,
					'revMailRequ' => true,
					'revOrdering' => 'date.asc',
					'revOnSite' => 5,
					'revPositive' => true,
					'website' => false,
				);
				$this->save( $settings );
			}
		}
	}

	protected function rdelete()
	{
		$rids = SPRequest::arr( 'rid', array() );
		if ( !count( $rids ) ) {
			Sobi::Redirect( Sobi::Back(), Sobi::Txt( 'SPRRA.ERR_NO_REV_TO_DEL' ), SPC::ERROR_MSG );
		}
		foreach ( $rids as $rid ) {
			SPFactory::Instance( 'models.review', $rid )->delete();
		}
		Sobi::Redirect( Sobi::Back(), Sobi::Txt( 'SPRRA.MSG_REVS_DELETED' ) );
	}

	protected function saveReview( $apply = false )
	{
		if ( !( SPFactory::mainframe()->checkToken() ) ) {
			Sobi::Error( 'SPRrCtrl', 'UNAUTHORIZED_ACCESS', SPC::WARNING, 403, __LINE__, __FILE__ );
			exit;
		}
		$rid = SPRequest::int( 'rid' );
		$rev = SPFactory::Instance( 'models.review', $rid );
		$review = array(
			'review' => array(
				'title' => SPRequest::string( 'review_title' ),
				'review' => SPRequest::string( 'review_review' ),
				'neg_review' => SPRequest::string( 'review_negativeReview' ),
				'pos_review' => SPRequest::string( 'review_positiveReview' ),
				'rid' => $rid,
				'sid' => SPRequest::int( 'eid' ) ? SPRequest::int( 'eid' ) : $rev->get( 'sid' ),
				'section' => Sobi::Section(),
				'date' => SPFactory::config()->date( SPRequest::int( 'review_date' ), 'date.publishing_format' ),
				'uid' => SPRequest::int( 'review_author_uid' )
			),
			'rating' => SPRequest::arr( 'rating', array(), 'post' )
		);
		if ( !( SPRequest::int( 'review_uid' ) ) ) {
			$review[ 'review' ][ 'visitor' ] = SPRequest::string( 'review_author_name' );
			$review[ 'review' ][ 'vmail' ] = SPRequest::string( 'review_author_email' );
		}
		if ( SPRequest::bool( 'review_state' ) != $rev->get( 'state' ) ) {
			$this->toggle( 'toggle.state' );
		}
		if ( SPRequest::bool( 'review_approved' ) != $rev->get( 'approved' ) ) {
			$this->toggle( 'toggle.approval' );
		}
		try {
			$model = SPFactory::Instance( 'models.review', $rid );
			$model->saveReview( $review );
		} catch ( SPException $x ) {
			$this->response( Sobi::Back(), $x->getMessage(), false, SPC::ERROR_MSG );
		}
		SPFactory::cache()->deleteObj( 'entry', $rev->get( 'sid' ) );
		$this->response( Sobi::Back(), Sobi::Txt( 'MSG.OBJ_SAVED', array( 'type' => Sobi::Txt( 'SPRRA.REVIEW_OBJ' ) ) ), !( $apply ), SPC::SUCCESS_MSG, array( 'sets' => array( 'oar_txt' => number_format( (float)$model->get( 'oar' ), 2, '.', '' ), 'oar' => round( $model->get( 'oar' ) ) ) ) );
	}

	protected function redit()
	{
		$rid = SPRequest::int( 'rid' );
		/** @var SPReview $model */
		$model = SPFactory::Instance( 'models.review', $rid )
				->redefine();
		$fields = $model->reviewFields( false );
		$rating = $model->get( 'rating' );
		$approved = $model->get( 'approved' );
		if ( $approved ) {
			$u = SPUser::getBaseData( $approved );
			$model->approval = array(
				'user' => $u[ $approved ],
				'ip' => $model->get( 'approvedIp' ),
				'date' => $model->get( 'approvedAt' ),
			);
		}
		$ratings = array();
		foreach ( $fields as $field ) {
			$ratings[ ] = array( 'field' => $field, 'rating' => $rating[ $field[ 'fid' ] ] );
		}
		self::ParseRating( 'init', $ratings, $model->get( 'oar' ) );
		$view =& SPFactory::View( 'view', true );
		$view->assign( $model, 'review' )
				->assign( $ratings, 'ratings' )
				->assign( SPFactory::Model( 'review' )->get( 'ratingEnabled' ), 'rating-enabled' )
				->determineTemplate( 'extensions', 'review-rating.review' );
		$view->display();
	}

	protected function listReviews()
	{
		$order = Sobi::GetUserState( 'reviews.order', 'reviews-order', 'rDate.desc' );
		$rLimit = Sobi::GetUserState( 'adm.reviews.limit', 'reviews-limit', Sobi::Cfg( 'adm_list.reviews', 25 ) );
		$eLimStart = SPRequest::int( 'rSite', 1 );
		$LimStart = $eLimStart ? ( ( $eLimStart - 1 ) * $rLimit ) : $eLimStart;
		$revsCount = SPFactory::db()
				->select( 'COUNT(*)', 'spdb_sprr_review', array( 'section' => Sobi::Section(), '!rReview' => null ) )
				->loadResult();
		if ( $eLimStart > ceil( $revsCount / $rLimit ) ) {
			$LimStart = 0;
			SPRequest::set( 'rSite', 1 );
		}
		$revs = SPFactory::db()
				->select( '*', 'spdb_sprr_review', array( 'section' => Sobi::Section(), '!rReview' => null ), $order, $rLimit, $LimStart )
				->loadAssocList();
		$reviews = array();
		if ( count( $revs ) ) {
			foreach ( $revs as $rev ) {
				if ( $rev[ 'uid' ] ) {
					$user = SPUser::getBaseData( array( $rev[ 'uid' ] ) );
					$user = $user[ $rev[ 'uid' ] ];
					$author = array( 'url' => SPUser::userUrl( $rev[ 'uid' ] ), 'name' => $user->name, 'uid' => $rev[ 'uid' ] );
				}
				else {
					$author = array( 'url' => "mailto:{$rev['uEmail']}", 'name' => Sobi::Txt( 'SPRRA.AUTHOR_UNREGISTERED', $rev[ 'uName' ] ), 'uid' => $rev[ 'uid' ] );
				}
				$reviews[ ] = array(
					'id' => $rev[ 'rid' ],
					'state' => $rev[ 'state' ],
					'title' => $rev[ 'rTitle' ],
					'author' => $author,
					'entry' => SPFactory::EntryRow( $rev[ 'sid' ] ),
					'date' => $rev[ 'rDate' ],
					'approved' => $rev[ 'approved' ] > 0,
					'oar' => number_format( (float)$rev[ 'oar' ], 2, '.', '' )
				);
			}
		}
		$view = $this->getView( 'sprr' );
		$menu = $view->get( 'menu' );
		$menu->setOpen( 'AMN.ENT_CAT' );
		$view->assign( $reviews, 'reviews' )
				->assign( Sobi::Section( true ), 'section_name' )
				->assign( Sobi::Section(), 'sid' )
				->assign( SPFactory::Model( 'review' )->get( 'ratingEnabled' ), 'rating-enabled' )
				->assign( $order, 'reviews-order' )
				->assign( $rLimit, 'reviews-limit' )
				->assign( SPRequest::int( 'rSite', 1 ), 'reviews-site' )
				->assign( $revsCount, 'reviews-count' )
				->assign( $menu, 'menu' )
				->determineTemplate( 'extensions', 'review-rating.reviews' )
				->display();
	}

	protected function deleteField()
	{
		$fid = SPRequest::int( 'fid' );
		SPFactory::db()->delete( 'spdb_sprr_rating', array( 'fid' => $fid ) );
		SPFactory::db()->delete( 'spdb_sprr_fields', array( 'fid' => $fid ) );
		SPFactory::db()->delete( 'spdb_language', array( 'fid' => $fid, 'sKey' => 'sprr_field', 'oType' => 'sprr_field', 'id' => $fid ) );
		SPFactory::message()->setMessage( Sobi::Txt( 'SPRRA.DELETED_FIELD' ), false, SPC::WARN_MSG );
		$this->response( Sobi::Back(), Sobi::Txt( 'SPRRA.DELETED_FIELD' ), false, SPC::WARN_MSG );
	}

	protected function saveField()
	{
		if ( !( SPFactory::mainframe()->checkToken() ) ) {
			Sobi::Error( 'Token', SPLang::e( 'UNAUTHORIZED_ACCESS_TASK', SPRequest::task() ), SPC::ERROR, 403, __LINE__, __FILE__ );
		}
		$request = array();
		$request[ 'fid' ] = SPRequest::int( 'fid' );
		$request[ 'enabled' ] = SPRequest::int( 'field_enabled' );
		$request[ 'importance' ] = SPRequest::int( 'field_importance' );
		$request[ 'sid' ] = Sobi::Section();
		$request[ 'position' ] = SPRequest::int( 'field_position' );
		$request[ 'key' ] = $request[ 'type' ] = 'sprr_field';
		$request[ 'value' ] = SPRequest::string( 'field_label' );
		$request[ 'section' ] = Sobi::Section();
		$request[ 'id' ] = $request[ 'fid' ];
		$request[ 'explanation' ] = str_replace( array( "\n", "\t", "\r" ), null, SPLang::clean( SPRequest::string( 'field_explanation' ) ) );
		$request[ 'name' ] = SPRequest::string( 'field_label' );
		$request[ 'section' ] = Sobi::Section();
		$fid = SPFactory::Model( 'review' )->storeField( $request );
		SPFactory::cache()->cleanSection();
		$this->response( Sobi::Back(), Sobi::Txt( 'SPRRA.SETTINGS_FIELD_SAVED' ), false, SPC::SUCCESS_MSG, array( 'sets' => array( 'fid' => $fid ) ) );
	}

	protected function editField()
	{
		$id = SPRequest::int( 'fid' );
		$fields = $this->reviewFields( false );
		if ( isset( $fields[ $id ] ) ) {
			$field = $fields[ $id ];
		}
		else {
			$field = array( 'fid' => 0, 'sid' => 0, 'enabled' => true, 'label' => '', 'explanation' => '', 'id' => 0, 'importance' => 5, 'position' => count( $fields ) + 1 );
		}
		$raw = Sobi::Url( array( 'out' => 'raw' ), true );
		$raw = explode( '&', $raw );
		$view =& SPFactory::View( 'view', true );
		$view->assign( $this->_task, 'task' );
		$view->assign( $field, 'field' );
		if ( count( $raw ) ) {
			foreach ( $raw as $line ) {
				if ( !( strstr( $line, '?' ) ) ) {
					$line = explode( '=', $line );
					$view->addHidden( $line[ 1 ], $line[ 0 ] );
				}
			}
		}
		$view->addHidden( $id, 'fid' );
		$view->addHidden( Sobi::Section(), 'sid' );
		$view->determineTemplate( 'extensions', 'review-rating.field' );
		$view->display();
	}

	protected function screen()
	{
		$registry = SPFactory::registry();
		$registry->loadDBSection( 'sprr_' . Sobi::Section() );
		$set = $registry->get( 'sprr_' . Sobi::Section() );
		$settings = array();
		if ( !( count( $set ) ) ) {
			$settings = array(
				'ratingEnabled' => true,
				'ratingRevReq' => true,
				'revEnabled' => true,
				'revMulti' => false,
				'revMailRequ' => true,
				'revOrdering' => 'date.asc',
				'revOnSite' => 5,
				'revPositive' => true,
				'website' => false,
				'badWords' => '',
				'parseContent' => true
			);
		}
		else {
			foreach ( $set as $k => $v ) {
				$settings[ $k ] = $v[ 'value' ];
			}
		}
		if ( isset( $settings[ 'badWords' ] ) ) {
			if ( is_array( $settings[ 'badWords' ] ) ) {
				$settings[ 'badWords' ] = implode( ',', $settings[ 'badWords' ] );
			}
		}
		$fields = array();
		$f = $this->reviewFields( false );
		if ( count( $f ) ) {
			foreach ( $f as $field ) {
//				$field['enabled'] *= -1;
				$fields[ ] = $field;
			}
		}
		$subjects = SPLang::getValue( 'sprr_report_msg', 'application', Sobi::Section() );
		if ( strlen( $subjects ) < 10 ) {
			SPLang::load( 'SpApp.review_rating' );
			$subjects = SPLang::clean( preg_replace( "/([^\\\])(')/", '\1"', Sobi::Txt( 'SPRRA.SETTINGS_REPORTS_DEF_SUBJECTS' ) ) );
		}
		$settings[ 'revReportTypes' ] = implode( "\n", json_decode( $subjects ) );
		$view = $this->getView( 'sprr' );
		$view->assign( $fields, 'fields' );
		$view->assign( $settings, 'settings' );
		$view->assign( Sobi::Url( array( 'task' => 'review.editField', 'out' => 'html', 'sid' => Sobi::Section() ), true ), 'edit_url' );
		$menu = $view->get( 'menu' );
		$menu->setOpen( 'AMN.SEC_CFG' );
		$view->assign( $menu, 'menu' );
		$view->determineTemplate( 'extensions', 'review-rating.config' );
		$view->display();
	}

	protected function reviewFields( $enabled = true )
	{
		return SPFactory::Model( 'review' )->reviewFields( $enabled );
	}

	protected function save( $settings = null )
	{
		$r = false;
		if ( !( $settings ) ) {
			if ( !( SPFactory::mainframe()->checkToken() ) ) {
				Sobi::Error( 'Token', SPLang::e( 'UNAUTHORIZED_ACCESS_TASK', SPRequest::task() ), SPC::ERROR, 0, __LINE__, __FILE__ );
				$this->response( Sobi::Back(), SPLang::e( 'UNAUTHORIZED_ACCESS_TASK', SPRequest::task() ), false, SPC::ERROR_MSG );
			}
			$settings = SPRequest::search( 'settings' );
			unset( $settings[ 'settings_revReportTypes' ] );
			$r = true;
		}
		$reportTypes = SPRequest::string( 'settings_revReportTypes' );
		$reportTypes = explode( "\n", $reportTypes );
		if ( count( $reportTypes ) ) {
			$data = array();
			$data[ 'id' ] = 1;
			$data[ 'value' ] = json_encode( $reportTypes );
			$data[ 'key' ] = 'sprr_report_msg';
			$data[ 'type' ] = 'application';
			$data[ 'section' ] = Sobi::Section();
			SPLang::saveValues( $data );
		}
		$store = array();
		foreach ( $settings as $k => $value ) {
			$key = str_replace( 'settings_', null, $k );
			$store[ $key ] = array( 'key' => $key, 'value' => $value );
		}
		SPFactory::registry()->saveDBSection( $store, 'sprr_' . Sobi::Section() );
		SPFactory::cache()->cleanSection();
		if ( $r ) {
			$this->response( Sobi::Back(), Sobi::Txt( 'MSG.ALL_CHANGES_SAVED' ), false, SPC::SUCCESS_MSG );
		}
	}
}
