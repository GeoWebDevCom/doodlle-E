<?xml version="1.0" encoding="UTF-8"?>
<!-- 
 SobiPro Template SobiRestara
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2012 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>

<xsl:include href="../common/alphamenu.xsl" />
<xsl:include href="../common/topmenu.xsl" />
<xsl:include href="../common/navigation.xsl" />
<xsl:include href="../common/entries.xsl" />

<xsl:template match="/search">
	<div class="SPSearch">
	    <div class="SobiPro componentheading">
	      <xsl:value-of select="section" />
	    </div>
        <div class="spclear" />
	    <div>
	      <xsl:apply-templates select="menu" />
	      <xsl:apply-templates select="alphaMenu" />
	    </div>
        <div class="spclear" />
		<div id="SPSearchForm">		
			<!-- define variable to check if there are more than 3 fields -->
			<xsl:variable name="fieldsCount">
				<xsl:value-of select="count(fields/*)" />
			</xsl:variable>					
			<xsl:choose>				
				<!-- if there are more than 3 fields we show the extended search option -->
				<xsl:when test="$fieldsCount &gt; 3">
					<xsl:for-each select="fields/*">
						<!-- output the first 3 fields -->
						<xsl:if test="position() &lt; 4">
							<!-- directly after the "search" button -->
							<xsl:if test="position() = 3">
                                <div class="spclear" />
							</xsl:if>				
							<xsl:call-template name="FieldCell" />
						</xsl:if>
					</xsl:for-each>				
					<!-- output all other fields -->
					<div class="spclear" style="min-height: 2px;"/>
					<div id="SPExtSearch">
						<xsl:for-each select="fields/*">
							<xsl:if test="position() &gt; 3">						
								<xsl:call-template name="FieldCell" />
							</xsl:if>
						</xsl:for-each>						
					</div>
				</xsl:when>							
				<xsl:otherwise>
					<xsl:for-each select="fields/*">
						<xsl:call-template name="FieldCell" />
						<xsl:if test="name() = 'top_button'">
                            <div class="spclear" />
						</xsl:if>
					</xsl:for-each>
				</xsl:otherwise>				
			</xsl:choose>				
		</div>
        <div class="spclear" />
		<xsl:if test="message">
			<div class="message">
				<xsl:value-of select="message"/>
			</div>
		</xsl:if>
		
		<xsl:call-template name="entriesLoop" />
		<xsl:apply-templates select="navigation" />
        <div class="spclear" />
	</div>
</xsl:template>

<xsl:template name="FieldCell">
	<div class="SPSearchCell">			
		<xsl:if test="not( name() = 'top_button' )">
			<div class="SPSearchLabel">
				<strong><xsl:value-of select="label" /><xsl:text>: </xsl:text></strong>
			</div><br />
		</xsl:if>
		<div class="SPSearchField">
			<xsl:copy-of select="data/*"/><xsl:text> </xsl:text><xsl:value-of select="@suffix"/>
		</div>				  
	</div>
	<xsl:if test="not( name() = 'searchbox' or name() = 'top_button' )">
		<div class="spclear" style="margin-bottom: 10px;"/>
	</xsl:if>
</xsl:template>
</xsl:stylesheet>