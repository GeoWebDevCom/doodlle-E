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
            <div id="stabs" class="ui-tabs">
                 <div class="spclear"/>
                <ul class="font1">
	                <li>
                        <a href="#gallery">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Profile' )"/>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#desc">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Description' )"/>
                        </a>
                    </li> -->
                    <li>
                        <a href="#addr">
                            <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Map and Contact' )"/>
                        </a>
                    </li>
	               <a style="float:right;text-decoration: none;"
	                   onclick="javascript:window.open( this.href, 'print', 'status = 1, height = 500, width = 500' ); return false;">
	                    <xsl:attribute name="href">
	                        <xsl:value-of select="php:function( 'SobiPro::Url', $printUrl )"/>
	                    </xsl:attribute>
	                    <xsl:text>| Print |</xsl:text>
	                </a>


                    <!-- Tab for Feedback: only if Review and Rating App is installed -->
                    <xsl:if test="( count(/entry_details/review_form/*) or count(/entry_details/reviews/*) ) and document('')/*/xsl:include[@href='../common/review.xsl'] ">
                        <li>
                            <a href="#feedback">
                                <xsl:value-of select="php:function( 'SobiPro::Txt' , 'Feedback' )"/>
                            </a>
                        </li>
                    </xsl:if>

                </ul>


                <!-- <div id="desc">
                    <xsl:if test="entry/fields/field_gallery/data/@original">
                        <div style="text-decoration: none; float:right; margin: 3px;">
                            <xsl:copy-of select="entry/fields/field_gallery/data/*"/>
                        </div>
                    </xsl:if>
                    <xsl:value-of select="entry/fields/field_description/data" disable-output-escaping="yes"/>
                    <br/>

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
                </div> -->
                
					<div class="SPDescription_container">
						<div class="font4"><h3 id="SPtitle">
		                    <xsl:value-of select="entry/name"/>
							<a id="SPDisc_Target"><img src="/media/sobipro/images/icons/plus.png"/></a></h3>
						</div>
						
						<div id="SPDescription_logo">
							<xsl:copy-of select="entry/fields/field_logo/data/*"/>
						</div>
						<div class="SPDescription_text" id="SPDescription_contact">
							
	                        <p>
	                            <xsl:if test="string-length(entry/fields/field_telephone_direct/data) &gt; 0">
	                    
	                                <xsl:text>T: </xsl:text>
	                                <xsl:value-of select="entry/fields/field_telephone_direct/data"/>
	                                <br/>
	                            </xsl:if>
	                            <xsl:if test="string-length(entry/fields/field_mobile/data) &gt; 0">
	                                <xsl:text>M: </xsl:text>
	                                <xsl:value-of select="entry/fields/field_mobile/data"/>
	                                <br/>
	                            </xsl:if>
	                            <xsl:if test="count(entry/fields/field_website/data/*)">
	                                
									<xsl:value-of select="substring-after(entry/fields/field_website/data,'//')"/>
	                                <br/>
	                            </xsl:if>
								<xsl:if test="count(entry/fields/field_email_address/data/*)">
	                                
	                                <xsl:copy-of select="entry/fields/field_email_address/data/*"/>
	                                <br/>
	                            </xsl:if>
	                        </p>
	                    	<div class="SPDescription_text" id="SPDescription_paragraph">
								<p><xsl:value-of select="entry/fields/field_company_description/data" disable-output-escaping="yes"/></p>
							</div>
						</div>
					</div>



				<div id="addr">
                  
					<div id="SPGeomap">
                    	<xsl:copy-of select="entry/fields/field_map/data/*"/>
					
	                    <div class="spclear"></div>
	                    <div id="SPAddress_text">
							<div class="SPDescription_text">
	 	                        <p>
									<xsl:if test="entry/name">
										<p style="text-transform:uppercase;font-weight:bold;font-style:normal;"><xsl:value-of select="entry/name"/></p>
									</xsl:if>	
									
	 								<xsl:if test="entry/fields/field_street/data">
	 	                            	<xsl:copy-of select="entry/fields/field_street/data"/>
	 	                            	<br/>
	 								</xsl:if>
	 	                            <xsl:if test="entry/fields/field_town/data"> 
	 									<xsl:copy-of select="entry/fields/field_town/data"/> - 
	 								</xsl:if>
 	
	 								<xsl:if test="entry/fields/field_postcode/data">
	 									<xsl:copy-of select="entry/fields/field_postcode/data"/>
	 								</xsl:if>
	 	                        </p>
	 						</div>
	                     </div>
					</div>
                </div>
                
				<div id="gallery">
					<div id="SPgallery_container">
						<xsl:if test="entry/fields/field_p1_image_1/data/@original">
							<div class="span6">
								<xsl:if test="entry/fields/field_p1_title/data">
									<h3 class="font4"><xsl:value-of select="entry/fields/field_p1_title/data"/></h3>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_description /data">
									<p class="font2 titleUp" style="text-transform:uppercase; top:515px;"><xsl:value-of select="substring-before(entry/fields/field_p1_description/data, '.')"/>.</p>
									<!-- substring-after(entry/fields/field_website/data,'//') -->
									<p class="font2"><xsl:value-of select="substring-after(entry/fields/field_p1_description/data, '.')"/></p>
								</xsl:if>
							</div>
							<xsl:if test="entry/fields/field_p1_image_1/data/@original">
								<div class="SPGallery_cell">
									<div class="SPGallery_preview big-image">
			                            <a class="">
				                            <xsl:attribute name="title">
			                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
			                                </xsl:attribute>
			                                <xsl:attribute name="href">
			                                    <xsl:value-of select="entry/fields/field_p1_image_1/data/@original"/>
			                                </xsl:attribute>
											<img class="spField">
												<xsl:attribute name="src">
				                                    <xsl:value-of select="entry/fields/field_p1_image_1/data/img/@src"/>
				                                </xsl:attribute>
												<xsl:attribute name="alt">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
											</img>
			                            </a>
									</div>
								</div>
							</xsl:if>
							
		                    <div id="SPGallery">
								<xsl:if test="entry/fields/field_p1_image_1/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_1/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_1/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_image_2/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_2/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_2/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_image_3/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_3/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_3/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_image_4/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_4/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_4/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_image_5/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_5/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_5/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								<xsl:if test="entry/fields/field_p1_image_6/data/@original">
									<div class="SPGallery_cell">
										<div class="SPGallery_image">
				                            <a class="">
					                            <xsl:attribute name="title">
				                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
				                                </xsl:attribute>
				                                <xsl:attribute name="href">
				                                    <xsl:value-of select="entry/fields/field_p1_image_6/data/@original"/>
				                                </xsl:attribute>
												<img class="spField">
													<xsl:attribute name="src">
					                                    <xsl:value-of select="entry/fields/field_p1_image_6/data/img/@src"/>
					                                </xsl:attribute>
													<xsl:attribute name="alt">
					                                    <xsl:value-of select="entry/fields/field_p1_title/data"/>
					                                </xsl:attribute>
												</img>
				                            </a>
										</div>
									</div>
								</xsl:if>
								
							</div>
		                </xsl:if>
					</div> <!-- endof SPgallery_container -->
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
           	</div> <!-- end of id="stabs" -->
 			<div class="spclear"></div>
            <xsl:call-template name="manage"/>
        </div>
    </xsl:template>
</xsl:stylesheet>
