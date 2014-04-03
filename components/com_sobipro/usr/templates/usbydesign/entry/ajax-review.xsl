<?xml version="1.0" encoding="UTF-8"?>

<!--
 @version: $Id: ajax-review.xsl 3496 2013-06-29 13:58:04Z Radek Suski $
 @package: SobiPro Review & Rating Application

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

 $Date: 2013-06-29 15:58:04 +0200 (Sa, 29 Jun 2013) $
 $Revision: 3496 $
 $Author: Radek Suski $
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
	<xsl:import href="../common/review.xsl" />
	<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />
	<xsl:template match="/">
		<xsl:call-template name="reviews"/>
		<input type="hidden" name="site" value="{//reviews/navigation/site}"/>
		<input type="hidden" name="sites" value="{//reviews/navigation/sites}"/>
	</xsl:template>
</xsl:stylesheet>
