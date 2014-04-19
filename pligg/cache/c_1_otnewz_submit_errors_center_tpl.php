<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:10:11 UTC */ ?>

	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">Submission Result</h2>
	</div>
	<div id="submitError" class="contentBlock contentBlockSpace">
		<?php if ($this->_vars['submit_error'] == 'invalidurl'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_InvalidURL'];  if ($this->_vars['submit_url'] == "http://"): ?>. <?php echo $this->_confs['PLIGG_Visual_Submit2Errors_InvalidURL_Specify'];  else: ?>: <?php echo $this->_vars['submit_url'];  endif; ?></p>
			</div>
			<form id="errorForm">
				<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit2Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'dupeurl'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<ul class="formErrorContent">
					<li><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL']; ?>
: <?php echo $this->_vars['submit_url']; ?>
</li>
					<li><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct']; ?>
</li>
					<li><a href="<?php echo $this->_vars['submit_search']; ?>
"><strong><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct2']; ?>
</strong></a></li>
				</ul>
			</div>
			<form id="errorForm">
				<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit2Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'badkey'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_BadKey']; ?>
</p>
			</div>
			<form id="errorForm">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'hashistory'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_HasHistory']; ?>
: <?php echo $this->_vars['submit_error_history']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
"  class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'urlintitle'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_URLInTitle']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'incomplete'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Incomplete']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'long_title'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Long_Title']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'long_content'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Long_Content']; ?>
</p>
			</div>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'long_tags'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Long_Tags']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		
		<?php if ($this->_vars['submit_error'] == 'short_tags'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Submit3Errors_Short_Tags']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		
		<?php if ($this->_vars['submit_error'] == 'long_summary'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Long_Summary']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
		<?php if ($this->_vars['submit_error'] == 'nocategory'): ?>
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
			<p><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_NoCategory']; ?>
</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php echo $this->_vars['pagename']; ?>
.php?id=<?php echo $this->_vars['link_id']; ?>
';" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="button buttonLink" />
			</form>
		<?php endif; ?>
	</div>