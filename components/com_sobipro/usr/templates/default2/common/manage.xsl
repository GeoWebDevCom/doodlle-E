<?xml version="1.0" encoding="UTF-8"?>
<!--
 @version: $Id: manage.xsl 3128 2013-02-09 17:09:04Z Radek Suski $
 @package: SobiPro Component for Joomla!

 @author
 Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Email: sobi[at]sigsiu.net
 Url: http://www.Sigsiu.NET

 @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 @license GNU/GPL Version 3
 This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 3
 as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 See http://www.gnu.org/licenses/gpl.html and http://sobipro.sigsiu.net/licenses.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

 $Date: 2013-02-09 18:09:04 +0100 (Sat, 09 Feb 2013) $
 $Revision: 3128 $
 $Author: Radek Suski $
 File location: components/com_sobipro/usr/templates/default2/common/manage.xsl $
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
	<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8" />
	<xsl:template name="manage">
		<xsl:if test="entry/approve_url or entry/edit_url or entry/publish_url or entry/delete_url">
			<div class="btn-group pull-left">
				<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
					<i class="icon-edit"></i>
				</a>
				<ul class="dropdown-menu">
					<xsl:if test="entry/publish_url">
						<li>
							<a href="{entry/publish_url}">
								<xsl:choose>
									<xsl:when test="entry/state = 'published'">
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'ENTRY_MANAGE_DISABLE' )" />
									</xsl:when>
									<xsl:otherwise>
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'ENTRY_MANAGE_ENABLE' )" />
									</xsl:otherwise>
								</xsl:choose>
							</a>
						</li>
					</xsl:if>
					<xsl:if test="entry/approve_url and entry/approved = 0">
						<li>
							<a href="{entry/approve_url}">
								<xsl:value-of select="php:function( 'SobiPro::Txt', 'ENTRY_MANAGE_APPROVE' )" />
							</a>
						</li>
					</xsl:if>
					<xsl:if test="entry/edit_url">
						<li>
							<a href="{entry/edit_url}">
								<xsl:value-of select="php:function( 'SobiPro::Txt', 'ENTRY_MANAGE_EDIT' )" />
							</a>
						</li>
					</xsl:if>
					<xsl:if test="entry/delete_url">
						<li>
							<a href="{entry/delete_url}" id="spDeleteEntry">
								<xsl:value-of select="php:function( 'SobiPro::Txt', 'ENTRY_MANAGE_DELETE' )" />
							</a>
						</li>
					</xsl:if>
				</ul>
			</div>
		</xsl:if>
	</xsl:template>
</xsl:stylesheet>
