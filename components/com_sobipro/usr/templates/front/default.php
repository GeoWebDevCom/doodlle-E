<?php
/**
 * @version: $Id: default.php 2998 2013-01-16 17:09:18Z Sigrid Suski $
 * @package: SobiPro Component for Joomla!

 * @author
 * Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 * Email: sobi[at]sigsiu.net
 * Url: http://www.Sigsiu.NET

 * @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 * @license GNU/GPL Version 3
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 3
 * as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 * See http://www.gnu.org/licenses/gpl.html and http://sobipro.sigsiu.net/licenses.

 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

 * $Date: 2013-01-16 18:09:18 +0100 (Wed, 16 Jan 2013) $
 * $Revision: 2998 $
 * $Author: Sigrid Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Site/usr/templates/front/default.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
?>
<div style="padding: 10px;">
<?php $c = $this->count( 'sections' );
for ( $i = 0; $i < $c ; $i++ ) { ?>
	<div>
		<a href="<?php echo Sobi::Url( array( 'sid' => $this->get( 'sections.id', $i ) ) )?>"><?php $this->show( 'sections.name', $i ); ?> </a>
	</div>
	<?php } ?>
</div>
