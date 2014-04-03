<?xml version="1.0" encoding="UTF-8"?>
<!-- 
 SobiPro Template SobiRestara
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2011 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml"/>
	<xsl:template match="letters|/menu/alphaMenu/letters">
		<xsl:variable name="letter">
			<xsl:value-of select="php:function( 'SobiPro::Request', 'letter' )" />	
		</xsl:variable>
		<xsl:for-each select="letter">			
			<xsl:choose>
				<xsl:when test="@url">
					<span>
						<xsl:attribute name="class">
							<xsl:choose>
								<xsl:when test=". = $letter">spAlphaLetterSelected</xsl:when>
								<xsl:otherwise>spAlphaLetter</xsl:otherwise>
							</xsl:choose>
						</xsl:attribute>
						<a>
							<xsl:attribute name="href">
								<xsl:value-of select="@url" />
							</xsl:attribute>
							<xsl:value-of select="." />
						</a>
					</span>					
				</xsl:when>
				<xsl:otherwise>
					<span>
						<xsl:value-of select="." />
					</span>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>