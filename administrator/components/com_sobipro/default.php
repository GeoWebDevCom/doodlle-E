<?php
/**
 * @version: $Id: default.php 3356 2013-04-13 11:32:22Z Radek Suski $
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

 * $Date: 2013-04-13 13:32:22 +0200 (Sat, 13 Apr 2013) $
 * $Revision: 3356 $
 * $Author: Radek Suski $
 * $HeadURL: file:///opt/svn/SobiPro/Component/branches/SobiPro-1.1/Admin/default.php $
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
$data = $this->getData();
?>
<?php echo $this->toolbar(); ?>
<?php $this->trigger( 'OnStart' ); ?>
<!--starts here-->
<?php foreach ( $data[ 'data' ] as $element ) : ?>
	<?php $this->getParser()->parse( $element ); ?>
<?php endforeach; ?>
<!--ends here-->
<?php $this->trigger( 'OnEnd' ); ?>
