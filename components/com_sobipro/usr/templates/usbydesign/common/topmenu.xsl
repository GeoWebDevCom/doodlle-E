<?xml version="1.0" encoding="UTF-8"?>
<!-- 
 SobiPro Template SobiRestara
 Authors: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Copyright (C) 2011 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 Released under Sigsiu.NET Template License V1
 -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
	<xsl:template match="menu">
		<div class="spTopMenu">
			<div class="SPt">
				<div class="SPt">
					<div class="SPt"></div>
				</div>
			</div>
			<div class="SPm">
				<ul class="spTopMenu">
					<xsl:if test="front">
						<li class="spTopMenu">
							<a>
								<xsl:attribute name="href">
									<xsl:value-of select="front/@url" />
								</xsl:attribute>
								<xsl:value-of select="front" />
							</a>
						</li>
					</xsl:if>
					<xsl:if test="search">
						<li class="spTopMenu">
							<a>
								<xsl:attribute name="href">
									<xsl:value-of select="search/@url" />
								</xsl:attribute>
								<xsl:value-of select="search" />
							</a>
						</li>
					</xsl:if>
					<xsl:if test="add">
						<li class="spTopMenu">
							<a>
								<xsl:attribute name="href">
									<xsl:value-of select="add/@url" />
								</xsl:attribute>
								<xsl:value-of select="add" />
							</a>
						</li>
					</xsl:if>
				</ul>
                <div class="spclear" />
			</div>
			<div class="SPb">
				<div class="SPb">
					<div class="SPb"></div>
				</div>
			</div>		
		</div>
        <div class="spclear" />
	</xsl:template>
</xsl:stylesheet>