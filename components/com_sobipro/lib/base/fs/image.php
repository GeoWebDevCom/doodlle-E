<?php
/**
 * @version: $Id: image.php 3318 2013-03-28 15:10:57Z Radek Suski $
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

 * $Date: 2013-03-28 16:10:57 +0100 (Thu, 28 Mar 2013) $
 * $Revision: 3318 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/lib/base/fs/image.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadClass( 'base.fs.file' );

/**
 * @author Radek Suski
 * @version 1.0
 * @created 10-Jan-2009 5:03:15 PM
 */
class SPImage extends SPFile
{

	/**
	 * @var int
	 */
	private $width = 0;
	/**
	 * @var int
	 */
	private $height = 0;
	/**
	 * @var int
	 */
	private $type = 0;
	/**
	 * @var string
	 */
	private $contentType = null;
	/**
	 * @var string
	 */
	private $temp = null;
	/**
	 * @var resource
	 */
	private $image = null;
	/**
	 * @var array
	 */
	static $imgFunctions = array(
		IMAGETYPE_GIF => 'imagecreatefromgif',
		IMAGETYPE_JPEG => 'imagecreatefromjpeg',
		IMAGETYPE_PNG => 'imagecreatefrompng',
		IMAGETYPE_JPEG2000 => 'imagecreatefromjpeg'
	);

	/**
	 * Resample image
	 * @param $width
	 * @param $height
	 * @param bool $always - even if smaller as given values
	 * @throws SPException
	 * @return bool
	 */
	public function resample( $width, $height, $always = true )
	{
		if( !( $width && $height ) ) {
			throw new SPException( SPLang::e( 'INVALID_VALUES_FOR_RESAMPLE', $width, $height ) );
		}
		if( !$this->_content ) {
			$this->read();
		}
		list( $wOrg, $hOrg, $imgType ) = getimagesize( $this->_filename );

		/* if not an image */
		if( !$wOrg || !$hOrg || !$imgType ) {
			throw new SPException( SPLang::e( 'CANNOT_GET_IMG_INFO', $this->_filename ) );
		}

		/* if not always and image is smaller */
		if( !$always && ( ( $wOrg <= $width ) && ( $hOrg <= $height ) ) ) {
			return true;
		}

		$orgRatio = $wOrg / $hOrg;

		if( ( $width / $height ) > $orgRatio ) {
		   $width = $height * $orgRatio;
		}
		else {
		   $height = $width / $orgRatio;
		}

		/* create new image */
		$this->image = imagecreatetruecolor( $width, $height );

		/* create image object from the current file */
		if( isset( self::$imgFunctions[ $imgType ] ) ) {
			$function = self::$imgFunctions[ $imgType ];
			$currentImg = $function( $this->_filename );
		}
		if( !isset( self::$imgFunctions[ $imgType ] ) || !isset( $currentImg ) ) {
			throw new SPException( SPLang::e( 'CREATE_IMAGE_MISSING_HANDLER', $this->_filename, $imgType ) );
		}

		$this->type = $imgType;

		/* save the transparency */
		if( $imgType == IMAGETYPE_GIF || $imgType == IMAGETYPE_PNG ) {
			$this->transparency( $currentImg );
		}

		/* resample image */
		imagecopyresampled( $this->image, $currentImg, 0, 0, 0, 0, $width, $height, $wOrg, $hOrg );
		$this->storeImage();
	}

	/**
	 * Small work-around
	 * The imageTYPE function is not very suitable for OO code
	 * @return void
	 */
	private function storeImage()
	{
		$st = preg_replace( '/[^0-9]/', null, microtime( true ) * 10000 );
		$this->temp = SPLoader::path( 'tmp.img.' . $st , 'front', false, 'var', false );
		if( !( SPLoader::dirPath( 'tmp.img', 'front', true ) ) ) {
			SPFs::mkdir( SPLoader::dirPath( 'tmp.img', 'front', false ) );
		}
		switch( $this->type ) {
            case IMAGETYPE_GIF:
                imagegif( $this->image, $this->temp );
            	break;
            case IMAGETYPE_JPEG:
            case IMAGETYPE_JPEG2000:
                imagejpeg( $this->image, $this->temp, Sobi::Cfg( 'image.jpeg_quality', 75 ) );
            	break;
            case IMAGETYPE_PNG:
                imagepng( $this->image, $this->temp, Sobi::Cfg( 'image.png_compression', 0 ) );
            	break;
        }
        $this->_content = file_get_contents( $this->temp );
		if( $this->image ) {
        	imagedestroy( $this->image );
		}
	}

	/**
	 * @author Radek Suski
	 * @author Claudio F. images with transparent color are processed in the right way
	 * resampling image to adjusted size
	 * @param $img
	 * @return void
	 */
	private function transparency( &$img )
	{
		$index = imagecolortransparent( $img );
		/* If we have a specific transparent color */
		if ( $index >= 0 ) {
			/* Get the original image's transparent color's RGB values */
			$transparency = imagecolorsforindex( $img, $index );
			/* Allocate the same color in the new image resource */
			$index = imagecolorallocate( $this->image, $transparency[ 'red' ], $transparency[ 'green' ], $transparency[ 'blue' ] );
			/* Completely fill the background of the new image with allocated color. */
			imagefill( $this->image, 0, 0, $index );
			/* Set the background color for new image to transparent */
			imagecolortransparent( $this->image, $index );
		}
		/* Always make a transparent background color for PNGs that don't have one allocated already */
		else {
			/* Turn off transparency blending (temporarily) */
			imagealphablending( $this->image, false );
			/* Create a new transparent color for image */
			$color = imagecolorallocatealpha( $this->image, 0, 0, 0, 127 );
			/* Completely fill the background of the new image with allocated color. */
			imagefill( $this->image, 0, 0, $color );
			/* Restore transparency blending */
			imagesavealpha( $this->image, true );
		}
	}
}
