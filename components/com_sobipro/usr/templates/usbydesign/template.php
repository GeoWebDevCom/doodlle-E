<?php
/**
 * @version: $Id: template.php 2456 2012-05-09 19:15:58Z Radek Suski $
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
 * $Date: 2012-05-09 21:15:58 +0200 (Mi, 09 Mai 2012) $
 * $Revision: 2456 $
 * $Author: Radek Suski $
 */
defined( 'SOBIPRO' ) || exit( 'Restricted access' );
abstract class designTpl {
	
	public static function CCSelectList( $selected )
	{
	  $multi = true; $size = 1; $sel = array();
	  if( isset( $selected[ 0 ] ) && $selected[ 0 ] instanceof DOMElement ) {
	    foreach ( $selected[ 0 ]->childNodes as $node ) {
	      $sel[] = $node->getAttribute( 'id' );
	    }
	  }
	  $result = SPFactory::cache()
	    ->getVar( 'cat_chooser_select_list', Sobi::Section() );
	  if( !( $result ) ) {
	    $result = array();
	    self::travelCats( Sobi::Section(), $result, false );
	    SPFactory::cache()
	      ->addVar( $result, 'cat_chooser_select_list', Sobi::Section() );
	  }
	  $box = array( '' => Sobi::Txt( 'EN.SELECT_CAT_PATH' ) );

	  foreach ( $result as $id => $name ) {
	    $box[ $id ] = $name;
	  }

	  $params = array(
	    'size' => $size,
	    'style' => 'width: 200px;',
	    'id' => 'SPCatChooserSl',
	    'class' => 'required'
	  );

	  return SPHtml_Input::select( 'entry.parent', $box, $sel, $multi, $params );

	}

	private static function travelCats( $sid, &$result, $margin )
	{
	  $msign = '-';
	  $category = SPFactory::Model( $margin == false ? 'section' : 'category' );
	  $category->init( $sid );
	  if( $category->get( 'state' ) ) {
	    if( $category->get( 'oType' ) == 'category' ) {
	      $result[ $sid ] = $margin.' '.$category->get( 'name' );
	    }
	    $childs = $category->getChilds( 'category' );
	    if( count( $childs ) ) {
	      foreach ( $childs as $id => $name ) {
	        self::travelCats( $id, $result, $msign.$margin );
	      }
	    }
	  }
	}	
	
}
	


?>
