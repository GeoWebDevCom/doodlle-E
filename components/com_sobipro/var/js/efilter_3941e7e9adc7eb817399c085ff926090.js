/**
 * @version: $Id: efilter.js 2989 2013-01-15 16:32:42Z Sigrid Suski $
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

 * $Date: 2013-01-15 17:32:42 +0100 (Tue, 15 Jan 2013) $
 * $Revision: 2989 $
 * $Author: Sigrid Suski $
 * File location: components/com_sobipro/lib/js/efilter.js $
 */

var SPFilter = eval( "[{\"name\":\"field_telephone_direct\",\"filter\":\"\\/^(\\\\+\\\\d{1,3}\\\\s?)?(\\\\s?\\\\([\\\\d]\\\\)\\\\s?)?[\\\\d\\\\-\\\\s\\\\.]+$\\/\",\"msg\":\"Please enter a valid telephone number into $field field.\"},{\"name\":\"field_mobile\",\"filter\":\"\\/^(\\\\+\\\\d{1,3}\\\\s?)?(\\\\s?\\\\([\\\\d]\\\\)\\\\s?)?[\\\\d\\\\-\\\\s\\\\.]+$\\/\",\"msg\":\"Please enter a valid telephone number into $field field.\"},{\"name\":\"field_email_address\",\"filter\":\"\\/^[\\\\w\\\\.-]+@[\\\\w\\\\.-]+\\\\.[a-zA-Z]{2,5}$\\/\",\"msg\":\"Please enter an email address into the $field field\"},{\"name\":\"field_website\",\"filter\":\"\\/^[\\\\w\\\\.-]+\\\\.{1}[a-zA-Z]{2,5}(\\\\\\/[^\\\\s]*)?$\\/\",\"msg\":\"Please enter a valid website address without the protocol in the $field field\"},{\"name\":\"field_postcode\",\"filter\":\"\\/^\\\\d+$\\/\",\"msg\":\"Please enter a numeric value in the $field field\"},{\"name\":\"field_p1_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"},{\"name\":\"field_p2_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"},{\"name\":\"field_p3_title\",\"filter\":\"\\/^[\\\\w\\\\d]+[\\\\w\\\\d\\\\s!@\\\\$\\\\%\\\\&\\\\*\\\\\\\"\\\\\'\\\\-\\\\+_]*$\\/\",\"msg\":\"The data entered in the $field field contains not allowed characters\"}]" );
