<?xml version="1.0" encoding="UTF-8"?>
<!--
 SobiPro Template SobImmo
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2012 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 @version: $Id: vcard.xsl 2116 2012-01-01 14:39:14Z Radek Suski $
 $Date: 2012-01-01 15:39:14 +0100 (So, 01 Jan 2012) $
 $Revision: 2116 $
 $Author: Radek Suski $
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>

	<xsl:template name="vcard">
		
	
		<div class="SPdescrip">
		<!-- name -->		
			<!-- image logo -->
			<div id="SPlogo">
				<xsl:copy-of select="fields/field_cover_image/data" />
				<div id="vcardSPname"><xsl:value-of select="name" /></div>
			</div>
		
			<div id="SPcontent">
				<a id="SPname" class="font4">
					<xsl:attribute name="href">
						<xsl:value-of select="url" />
					</xsl:attribute>
					<xsl:value-of select="name" />
				</a>
	<!-- description -->
				<a id="spEntriesDescription" class="font2">
					<xsl:attribute name="href">
						<xsl:value-of select="url" />
					</xsl:attribute>
					<xsl:value-of select="substring( fields/field_company_description /data,1,120 )" disable-output-escaping="yes" />...
				</a>
			
				<a id="spDateCreated" class="font3">
					<xsl:attribute name="href">
						<xsl:value-of select="url" />
					</xsl:attribute>
					<xsl:value-of select="php:function( 'SobiPro::FormatDate', 'F d,Y', string(created_time) )"/> 
				</a>
			</div>
			
		</div>
		
<!-- edit button -->
		<div id="SPedit_name">
			<xsl:if test="edit_url">
				<span class="spEntriesListEditLink">
					<a>
						<xsl:attribute name="href">
							<xsl:value-of select="edit_url" />
						</xsl:attribute>
						<xsl:value-of select="php:function( 'SobiPro::Txt', 'Edit' )" />
					</a>
				</span>
			</xsl:if>
		</div>
		
		<div style="clear:both;"/>
	</xsl:template>
</xsl:stylesheet>
