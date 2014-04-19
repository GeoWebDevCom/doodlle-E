<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:09:08 UTC */ ?>

	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle"><?php echo $this->_confs['PLIGG_Visual_Submit1_Header']; ?>
</h2>
	</div>
	<div id="submitOne" class="contentBlock contentBlockSpace">
		<form id="submitForm" action="<?php if ($this->_vars['UrlMethod'] == "2"):  echo $this->_vars['URL_submit'];  else: ?>submit.php<?php endif; ?>" method="post" class="otForm">
			<ol class="submitStep">
				<li class="submitStepOne current">1</li>
				<li class="submitStepLast">2</li>
			</ol>
			<fieldset>
				<p class="otField">
					<input type="url" id="url" name="url" required="required" autofocus="autofocus" value="" placeholder="http://" class="otFieldInput" />
					<input type="submit" value="Continue" class="button buttonAction submitOneButton" />
				</p>
				<p class="otField submitURLField">
					<label for="url" class="submitURLLabel"><?php echo $this->_confs['PLIGG_Visual_Submit1_NewsURL']; ?>
</label>
					<span class="submitURLDesc">
						Fill in the unique URL of the story or news you are going to submit in our <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 social bookmarking website. It should begin with <strong>http://</strong> or <strong>https://</strong>
					</span>
				</p>
				<p class="otField otFieldAction aRight last">
					<input type="hidden" name="phase" value="1" />
					<input type="hidden" name="randkey" value="<?php echo $this->_vars['submit_rand']; ?>
" />
					<input type="hidden" name="id" value="c_1" />
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Submit1_Continue']; ?>
" class="button buttonAction submitOneButtonExtra" />
				</p>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step1_end"), $this);?>
			</fieldset>
			<div id="submitBookmarklet" class="formBox">
				<h2 class="formBoxHeader"><?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title']; ?>
</h2>
				<div class="formBoxContent">
					<p>
						<?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title_1']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
.<?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title_2']; ?>

					</p>
					<ul>
						<li><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_IE']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_User_Profile_IE_1']; ?>
</li>
						<li><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Firefox']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_User_Profile_Firefox_1']; ?>
</li>
						<li><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Opera']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_User_Profile_Opera_1']; ?>
</li>
					</ul>
					<span class="submitBookmarkletLink"><?php echo $this->_confs['PLIGG_Visual_User_Profile_The_Bookmarklet']; ?>
: <a href="javascript:q=(document.location.href);void(open('<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/submit.php?url='+escape(q),'','resizable,location,menubar,toolbar,scrollbars,status'));"><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</a></span>
				</div>
			</div>
		</form>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step1_middle"), $this);?>
		<div id="submitRules" class="formBox">
			<h2 class="formBoxHeader">Submission Guidelines</h2>
			<div class="formBoxContent">
				<p>
					<?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct']; ?>
:
				</p>
				<ul>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_1A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_1A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_1B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_2A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_2A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_2B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_3A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_3A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_3B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_4A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_4A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_4B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_5A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_5A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_5B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_6A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_6A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_6B']; ?>
</li><?php endif; ?>
					<?php if ($this->_confs['PLIGG_Visual_Submit1_Instruct_7A'] != ''): ?><li><strong><?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_7A']; ?>
:</strong> <?php echo $this->_confs['PLIGG_Visual_Submit1_Instruct_7B']; ?>
</li><?php endif; ?>
				</ul>
			</div>
		</div>
	</div>