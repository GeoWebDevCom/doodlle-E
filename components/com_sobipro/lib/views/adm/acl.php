<?php
/**
 * @version: $Id: acl.php 3337 2013-04-03 09:03:57Z Radek Suski $
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

 * $Date: 2013-04-03 11:03:57 +0200 (Wed, 03 Apr 2013) $
 * $Revision: 3337 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/lib/views/adm/acl.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadView( 'view', true );

/**
 * @author Radek Suski
 * @version 1.0
 * @created 14-Jan-2009 2:44:34 PM
 */
class SPAclView extends SPAdmView
{
	/**
	 *
	 */
	public function display()
	{
		switch ( $this->get( 'task' ) ) {
			case 'add':
			case 'edit':
				$this->edit();
				$this->determineTemplate( 'acl', 'edit' );
				break;
		}
		parent::display();
	}

	/**
	 */
	private function edit()
	{
		$put = array();
		$get = $this->get( 'groups' );
		foreach ( $get as $group ) {
			$put[ $group[ 'value' ] ] = $group[ 'text' ];
		}
		$this->set( $put, 'groups' );
		$put = array();
		$get = $this->get( 'sections' );
		if ( is_array( $get ) && count( $get ) ) {
			foreach ( $get as $section ) {
				$put[ ] = $section->id;
			}
			$put = Sobi::Txt( $put, 'name', 'section' );
			foreach ( $put as $id => $vals ) {
				$put[ $id ] = $vals[ 'value' ];
			}
		}
		$this->set( $put, 'sections' );
//		$put = array();
//		$get = $this->get( 'adm_permissions' );
//		if ( is_array( $get ) && count( $get ) ) {
//			foreach ( $get as $permission ) {
//				if ( !isset( $put[ $permission->subject ] ) ) {
//					$put[ $permission->subject ] = array();
//				}
//				$k = $permission->action . '_' . $permission->value;
//				$put[ $permission->subject ][ $permission->pid ] = Sobi::Txt( 'permissions.' . $k );
//			}
//		}
//		$this->set( $put, 'adm_permissions' );
		$put = array();
		$rule = $this->get( 'set' );
		$get = $this->get( 'permissions' );
		// WTF was that?!!
//		if ( is_array( $rule[ 'permissions' ] ) && count( $rule[ 'permissions' ] ) ) {
//
//		}
		foreach ( $get as $permission ) {
			$subject = ucfirst( $permission->subject );
			if ( !isset( $put[ $subject ] ) ) {
				$put[ $subject ] = array();
			}
			$k = $permission->action . '_' . $permission->value;
			$put[ $subject ][ $permission->pid ] = Sobi::Txt( 'permissions.' . $k );
		}

		// default ordering
		$permissionsOrder = array(
			'Section' => array( 3, 4 ),
			'Category' => array( 8, 7 ),
			'Entry' => array( 9, 11, 10, 14, 12, 16, 18, 17, 20, 21, 19, 15, 24, 25 )
		);
		// to show current
//		 SPConfig::debOut( $put );
		$permissions = array();
		foreach ( $permissionsOrder as $subject => $ordering ) {
			foreach ( $ordering as $pid ) {
				$permissions[ $subject ][ $pid ] = $put[ $subject ][ $pid ];
				unset( $put[ $subject ][ $pid ] );
			}
			// if still something left - add this too
			if ( count( $put[ $subject ] ) ) {
				foreach ( $put[ $subject ] as $pid => $label ) {
					$permissions[ $subject ][ $pid ] = $label;
				}
			}
			unset( $put[ $subject ] );
		}
		// if still something left - add this too (subjects)
		if ( count( $put ) ) {
			foreach ( $put as $subject => $perms ) {
				$permissions[ $subject ] = $perms;
			}
		}
//			SPConfig::debOut( $permissions );
		$this->set( $permissions, 'permissions' );
		$sections = array();
		$perms = array();
		if ( count( $rule[ 'permissions' ] ) ) {
			foreach ( $rule[ 'permissions' ] as $keys ) {
				$sections[ ] = $keys[ 'sid' ];
				$perms[ ] = $keys[ 'pid' ];
			}
		}
		$rule[ 'sections' ] = $sections;
		$rule[ 'permissions' ] = $perms;
		$this->set( $rule, 'set' );
	}

	/**
	 * @param string $title
	 * @return string
	 */
	public function setTitle( $title )
	{
		$name = $this->get( 'rule' );
		Sobi::Trigger( 'setTitle', $this->name(), array( &$title ) );
		$title = Sobi::Txt( $title, array( 'rule_name' => $name ) );
		$title = parent::setTitle( $title );
		return $title;
	}
}
