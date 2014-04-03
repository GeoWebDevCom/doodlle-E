<?xml version="1.0" encoding="UTF-8"?>
<!-- 
 SobiPro Template SobiRestara
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2012 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
<xsl:include href="vcard.xsl" />
	
	<xsl:template name="entriesLoop">
	<div class="spEntriesListContainer">
		<xsl:variable name="entriesInLine">
			<xsl:value-of select="entries_in_line" />
		</xsl:variable>
		<xsl:variable name="eCellWidth">
			<xsl:value-of select="(100 div $entriesInLine) -5" />
		</xsl:variable>
		<xsl:variable name="entriesCount">
			<xsl:value-of select="count(entries/entry)" />
		</xsl:variable>

		<xsl:for-each select="entries/entry">		
			<xsl:if test="$entriesInLine > 1 and ( position() = 1 or ( position() mod $entriesInLine ) = 1 )">
				<!-- opening the "table" row -->
				<xsl:text disable-output-escaping="yes">
					&lt;div class="spEntriesListRow" &gt;
				</xsl:text>
			</xsl:if>
			<div style="width: {$eCellWidth}%;">
				<xsl:attribute name="class">
					<xsl:choose>
						<xsl:when test="( ( position() - 1 ) mod $entriesInLine ) ">spEntriesListCell spEntriesListRightCell</xsl:when>
						<xsl:otherwise>spEntriesListCell</xsl:otherwise>
					</xsl:choose>
				</xsl:attribute>
				<xsl:attribute name="id"><xsl:value-of select="id"/>
				</xsl:attribute>
				<xsl:call-template name="vcard" />
			</div>
			<xsl:if test="$entriesInLine > 1 and ( ( position() mod $entriesInLine ) = 0 or position() = $entriesCount )">
                <div class="spclear" />
				<!-- closing the "table" row -->		
				<xsl:text disable-output-escaping="yes">
					&lt;/div&gt;					
				</xsl:text>						
			</xsl:if>			
		</xsl:for-each>
		<a id="SPForm_Target"  href="/index.php/directory/add-entry"><img src="/media/sobipro/images/icons/plus_big.png" style="cursor: pointer;"/></a>
	</div>
    <div class="spclear" />
	</xsl:template>
</xsl:stylesheet>