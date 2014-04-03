<?xml version="1.0" encoding="UTF-8"?>
<!--
 SobiPro Template SobiRestara
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2012 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
    <xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>

    <xsl:include href="../common/topmenu.xsl"/>
    <xsl:include href="../common/manage.xsl"/>
    <xsl:include href="../common/alphamenu.xsl"/>
    <!-- Remove the comment lines if you have installed the Reviews and Rating application
    and the template file review.xsl is available in the common folder of your template
    <xsl:include href="../common/review.xsl" />
    -->
    <xsl:template match="/entry_details">
        <div class="SPDetails">
            <div>
                <xsl:apply-templates select="menu"/>
                <xsl:apply-templates select="alphaMenu"/>
            </div>
            <div class="spclear"/>
            <xsl:variable name="printUrl">
                {"sptpl":"print","out":"html","sid":"<xsl:value-of select="entry/@id"/>"}
            </xsl:variable>
            <div id="stabs" style="padding: 10px; margin-top: 10px;">
                <a style="float:right;text-decoration: none;"
                   onclick="javascript:window.open( this.href, 'print', 'status = 1, height = 500, width = 500' ); return false;">
                    <xsl:attribute name="href">
                        <xsl:value-of select="php:function( 'SobiPro::Url', $printUrl )"/>
                    </xsl:attribute>
                    <xsl:text>| Print |</xsl:text>
                </a>
                <h3>
                    <xsl:value-of select="entry/name"/>
                </h3>
                <div class="spclear"/>
                <ul>
                    <li>
                        <a href="#desc">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Description' )"/>
                        </a>
                    </li>
                    <li>
                        <a href="#addr">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Address and Contact' )"/>
                        </a>
                    </li>
                    <li>
                        <a href="#gallery">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Images' )"/>
                        </a>
                    </li>

                    <!-- Tab for Feedback: only if Review and Rating App is installed -->
                    <xsl:if test="( count(/entry_details/review_form/*) or count(/entry_details/reviews/*) ) and document('')/*/xsl:include[@href='../common/review.xsl'] ">
                        <li>
                            <a href="#feedback">
                                <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Feedback' )"/>
                            </a>
                        </li>
                    </xsl:if>
                </ul>


                <div id="desc">
                    <xsl:if test="entry/fields/field_gallery/data/@original">
                        <div style="text-decoration: none; float:right; margin: 3px;">
                            <xsl:copy-of select="entry/fields/field_gallery/data/*"/>
                        </div>
                    </xsl:if>
                    <xsl:value-of select="entry/fields/field_description/data" disable-output-escaping="yes"/>
                    <br/>
                    <xsl:if test="count(entry/fields/field_facilities/data/*)">
                        <br/>
                        <strong>
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Services and Facilities' )"/>
                        </strong>
                        <xsl:text>: </xsl:text>
                        <div style="width:100%; text-align:center; margin-top: 10px;">
                            <xsl:for-each select="entry/fields/field_facilities/data/ul/li">
                                <div style="width:50px; text-align:center;float:left;">
                                    <img class="editlinktip hasTip">
                                        <xsl:attribute name="src"><xsl:value-of select="/entry_details/template_path"/>images/icons/<xsl:value-of
                                                select="@class"/>.png
                                        </xsl:attribute>
                                        <xsl:attribute name="title">
                                            <xsl:value-of select="."/>
                                        </xsl:attribute>
                                        <xsl:attribute name="alt">
                                            <xsl:value-of select="."/>
                                        </xsl:attribute>
                                    </img>
                                </div>
                            </xsl:for-each>
                            <div class="spclear"/>
                        </div>
                        <div class="spclear"/>
                    </xsl:if>

                    <xsl:if test="count(entry/fields/field_payment_methods/data/*)">
                        <br/>
                        <strong>
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Accepted Payments' )"/>
                        </strong>
                        <xsl:text>: </xsl:text>
                        <div style="width:100%; text-align:center; margin-top: 10px;">
                            <xsl:for-each select="entry/fields/field_payment_methods/data/ul/li">
                                <div style="width:60px; text-align:center;float:left; margin: 3px;">
                                    <img class="editlinktip hasTip">
                                        <xsl:attribute name="src"><xsl:value-of select="/entry_details/template_path"/>images/payments/<xsl:value-of
                                                select="@class"/>.png
                                        </xsl:attribute>
                                        <xsl:attribute name="title">
                                            <xsl:value-of select="."/>
                                        </xsl:attribute>
                                        <xsl:attribute name="alt">
                                            <xsl:value-of select="."/>
                                        </xsl:attribute>
                                    </img>
                                </div>
                            </xsl:for-each>
                            <div class="spclear"/>
                        </div>
                    </xsl:if>
                    <xsl:if test="count(entry/fields/field_keywords/data/*)">
                        <br/>
                        <div style="font-size:10px;">
                            <strong>
                                <xsl:value-of select="entry/fields/field_keywords/label"/>
                            </strong>
                            <xsl:text>: </xsl:text>
                            <xsl:copy-of select="entry/fields/field_keywords/data/*"/>
                        </div>
                    </xsl:if>
                </div>
                <div id="addr">
                    <div style="float:left; width: 50%">
                        <strong>
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Address:' )"/>
                        </strong>
                        <br/>
                        <p>
                            <xsl:copy-of select="entry/fields/field_street/data"/>
                            <br/>
                            <xsl:copy-of select="entry/fields/field_postcode/data"/>
                            <xsl:text> </xsl:text>
                            <xsl:copy-of select="entry/fields/field_city/data"/>
                            <br/>
                            <xsl:text> </xsl:text>
                            <xsl:copy-of select="entry/fields/field_country/data"/>
                        </p>
                    </div>
                    <div style="float:left; width: 50%">
                        <strong>
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Contact Data:' )"/>
                        </strong>
                        <br/>
                        <p>
                            <xsl:if test="string-length(entry/fields/field_phone_number/data) &gt; 0">
                                <xsl:value-of select="entry/fields/field_phone_number/label"/>
                                <xsl:text>: </xsl:text>
                                <xsl:value-of select="entry/fields/field_phone_number/data"/>
                                <br/>
                            </xsl:if>
                            <xsl:if test="string-length(entry/fields/field_fax_number/data) &gt; 0">
                                <xsl:value-of select="entry/fields/field_fax_number/label"/>
                                <xsl:text>: </xsl:text>
                                <xsl:value-of select="entry/fields/field_fax_number/data"/>
                                <br/>
                            </xsl:if>
                            <xsl:if test="count(entry/fields/field_website/data/*)">
                                <xsl:value-of select="entry/fields/field_website/label"/>
                                <xsl:text>: </xsl:text>
                                <xsl:copy-of select="entry/fields/field_website/data/*"/>
                                <br/>
                            </xsl:if>
                        </p>
                    </div>
                    <xsl:copy-of select="entry/fields/field_map/data/*"/>
                    <div class="spclear"></div>
                </div>
                <div id="gallery">
					<xsl:if test="entry/fields/field_gallery/data/@original">
	                    <div id="SPGallery">
							<div class="SPGallery_cell">
								<div id="SPGallery_image">
			                        <xsl:if test="entry/fields/field_gallery/data/@original">
			                            <a class="modal" style="text-decoration: none;">
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_gallery/data/@original"/>
			                                </xsl:attribute>
			                                <xsl:copy-of select="entry/fields/field_gallery/data/*"/>
			                            </a>
			                        </xsl:if>
								</div>
							</div>
							<div class="SPGallery_cell">
								<div id="SPGallery_image">
		                        	<xsl:if test="entry/fields/field_gallery_2/data/@original">
			                            <a class="modal" style="text-decoration: none;">
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_gallery_2/data/@original"/>
			                                </xsl:attribute>
			                                <xsl:copy-of select="entry/fields/field_gallery_2/data/*"/>
			                            </a>
			                        </xsl:if>
								</div>
							</div>
							<div class="SPGallery_cell">
								<div id="SPGallery_image">
			                        <xsl:if test="entry/fields/field_gallery_3/data/@original">
			                            <a class="modal" style="text-decoration: none;">
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_gallery_3/data/@original"/>
			                                </xsl:attribute>
			                                <xsl:copy-of select="entry/fields/field_gallery_3/data/*"/>
			                            </a>
			                        </xsl:if>
								</div>	
							</div>
							<div class="SPGallery_cell">
								<div id="SPGallery_image">
		                        	<xsl:if test="entry/fields/field_gallery_4/data/@original">
			                            <a class="modal" style="text-decoration: none;">
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_gallery_4/data/@original"/>
			                                </xsl:attribute>
			                                <xsl:copy-of select="entry/fields/field_gallery_4/data/*"/>
			                            </a>
			                        </xsl:if>
								</div>
							</div>
							<div class="SPGallery_cell">
								<div id="SPGallery_image">
			                        <xsl:if test="entry/fields/field_gallery_5/data/@original">
			                            <a class="modal" style="text-decoration: none;">
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_gallery_5/data/@original"/>
			                                </xsl:attribute>
			                                <xsl:copy-of select="entry/fields/field_gallery_5/data/*"/>
			                            </a>
			                        </xsl:if>
								</div>
		                    </div>
						</div>
	                </xsl:if>
				</div>
                <!-- Tab for Feedback: only if Review and Rating App is installed -->
                <xsl:if test="( count(/entry_details/review_form/*) or count(/entry_details/reviews/*) ) and document('')/*/xsl:include[@href='../common/review.xsl'] ">
                    <div id="feedback">
                        <xsl:call-template name="ratingSummary"/>
                        <xsl:call-template name="reviewForm"/>
                        <div class="spclear"/>
                        <br/>
                        <xsl:call-template name="reviews"/>
                        <div class="spclear">
                            <xsl:text> </xsl:text>
                        </div>
                    </div>
                </xsl:if>
            </div>
            <xsl:if test="count(entry/categories)">
                <div class="spEntryCats">
                    <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Located in:' )"/><xsl:text> </xsl:text>
                    <xsl:for-each select="entry/categories/category">
                        <a>
                            <xsl:attribute name="href">
                                <xsl:value-of select="@url"/>
                            </xsl:attribute>
                            <xsl:value-of select="."/>
                        </a>
                        <xsl:if test="position() != last()">
                            <xsl:text> | </xsl:text>
                        </xsl:if>
                    </xsl:for-each>
                </div>
            </xsl:if>
            <div class="spclear"></div>
            <xsl:call-template name="manage"/>
        </div>
    </xsl:template>
</xsl:stylesheet>
