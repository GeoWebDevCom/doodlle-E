<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

		<div class="siteSearch sidebarBlock">			
			<form id="siteSearch" action="<?php echo $this->_vars['my_pligg_base']; ?>
/search.php" method="get" role="search">
				<fieldset class="clearFix">
					<input type="search" name="search" id="searchsite" placeholder="Search..." />
					<span class="siteSearchButton"><input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
" /></span>
					<a href="<?php echo $this->_vars['URL_advancedsearch']; ?>
" id="aSearchLink" title="Advanced Search" rel="nofollow">Advanced Search</a>
				</fieldset>
			</form>
		</div>