<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.repeat_count.php'); $this->register_modifier("repeat_count", "tpl_modifier_repeat_count");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:09:46 UTC */ ?>

	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle"><?php echo $this->_confs['PLIGG_Visual_Submit2_Details']; ?>
</h2>
	</div>
	<div id="submitTwo" class="contentBlock contentBlockSpace">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_start"), $this);?>
		<form id="submitForm" action="<?php echo $this->_vars['URL_submit']; ?>
" method="post" enctype="multipart/form-data" class="otForm">
			<ol class="submitStep">
				<li class="submitStepOne">1</li>
				<li class="submitStepLast current">2</li>
			</ol>
			<fieldset>
				<p class="otField otFieldSubmitURL">
					<label for="url" class="otFieldLabel otFieldLabelUsername"><?php echo $this->_confs['PLIGG_Visual_Submit1_NewsURL']; ?>
:</label>
					<input type="url" id="url" name="url" value="<?php echo $this->_vars['submit_url']; ?>
" class="otFieldInput otFieldInputURL" disabled="disabled" />
				</p>
				<p class="otField">
					<label for="title" class="otFieldLabel"><?php echo $this->_confs['PLIGG_Visual_Submit2_Title']; ?>
:</label>
					<input type="text" id="title" name="title" required="required" autofocus="autofocus" value="<?php if ($this->_vars['submit_title']):  echo $this->_vars['submit_title'];  else:  echo $this->_vars['submit_url_title'];  endif; ?>" maxlength="<?php echo $this->_vars['maxTitleLength']; ?>
" class="otFieldInput" />
				</p>
				<?php if ($this->_vars['enable_tags']): ?>
					<p class="otField">
						<label for="tags" class="otFieldLabel"><?php echo $this->_confs['PLIGG_Visual_Submit2_Tags']; ?>
:</label>
						<input type="text" id="tags" name="tags" value="<?php echo $this->_vars['tags_words']; ?>
" maxlength="<?php echo $this->_vars['maxTagsLength']; ?>
" class="otFieldInput">
					</p>
				<?php endif; ?>
				<p class="otField">
					<label for="category" class="otFieldLabel"><?php echo $this->_confs['PLIGG_Visual_Submit2_Category']; ?>
:</label>
					<select id="category" name="category">
						<option value=""><?php echo $this->_confs['PLIGG_Visual_Submit2_CatInstructSelect']; ?>
</option>
						<?php if (isset($this->_sections['thecat'])) unset($this->_sections['thecat']);
$this->_sections['thecat']['name'] = 'thecat';
$this->_sections['thecat']['loop'] = is_array($this->_vars['submit_cat_array']) ? count($this->_vars['submit_cat_array']) : max(0, (int)$this->_vars['submit_cat_array']);
$this->_sections['thecat']['show'] = true;
$this->_sections['thecat']['max'] = $this->_sections['thecat']['loop'];
$this->_sections['thecat']['step'] = 1;
$this->_sections['thecat']['start'] = $this->_sections['thecat']['step'] > 0 ? 0 : $this->_sections['thecat']['loop']-1;
if ($this->_sections['thecat']['show']) {
	$this->_sections['thecat']['total'] = $this->_sections['thecat']['loop'];
	if ($this->_sections['thecat']['total'] == 0)
		$this->_sections['thecat']['show'] = false;
} else
	$this->_sections['thecat']['total'] = 0;
if ($this->_sections['thecat']['show']):

		for ($this->_sections['thecat']['index'] = $this->_sections['thecat']['start'], $this->_sections['thecat']['iteration'] = 1;
			 $this->_sections['thecat']['iteration'] <= $this->_sections['thecat']['total'];
			 $this->_sections['thecat']['index'] += $this->_sections['thecat']['step'], $this->_sections['thecat']['iteration']++):
$this->_sections['thecat']['rownum'] = $this->_sections['thecat']['iteration'];
$this->_sections['thecat']['index_prev'] = $this->_sections['thecat']['index'] - $this->_sections['thecat']['step'];
$this->_sections['thecat']['index_next'] = $this->_sections['thecat']['index'] + $this->_sections['thecat']['step'];
$this->_sections['thecat']['first']	  = ($this->_sections['thecat']['iteration'] == 1);
$this->_sections['thecat']['last']	   = ($this->_sections['thecat']['iteration'] == $this->_sections['thecat']['total']);
?>
						<option value="<?php echo $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['auto_id']; ?>
"<?php if ($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['auto_id'] == $this->_vars['submit_category'] || in_array ( $this->_vars['cat_array'][$this->_sections['thecat']['index']]['auto_id'] , $this->_vars['submit_additional_cats'] )): ?> selected="selected"<?php endif; ?>>
							<?php if ($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'] < $this->_vars['submit_lastspacer']): ?>
								<?php echo $this->_run_modifier($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacerdiff'], 'repeat_count', 'plugin', 1, ''); ?>

							<?php endif; ?>
							<?php if ($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'] > $this->_vars['submit_lastspacer']):  endif; ?>
							<?php echo $this->_run_modifier($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'], 'repeat_count', 'plugin', 1, '&nbsp;&nbsp;&nbsp;'); ?>

							<?php echo $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['name']; ?>
 &nbsp;&nbsp;&nbsp;
							<?php $this->assign('submit_lastspacer', $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
						</option>
						<?php endfor; endif; ?>
					</select>
				</p>
				<?php if ($this->_vars['enable_group'] && $this->_vars['output'] != ''): ?>
					<p class="otField">
						<label for="link_group_id" class="otFieldLabel capitalize"><?php echo $this->_confs['PLIGG_Visual_Group_Submit_story']; ?>
</label>
						<?php echo $this->_vars['output']; ?>

					</p>
				<?php endif; ?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_middle"), $this);?>
				<p class="otField">
					<label for="bodytext" class="otFieldLabel">Description:</label>
					<textarea id="bodytext" name="bodytext" rows="6"><?php if ($this->_vars['submit_url_description']):  echo $this->_vars['submit_url_description'];  endif;  echo $this->_vars['submit_content']; ?>
</textarea>
				</p>
				<?php echo tpl_function_checkActionsTpl(array('location' => "submit_step_2_pre_extrafields"), $this);?>
				<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_extra_fields'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
				<?php if (isset ( $this->_vars['register_step_1_extra'] )): ?>
					<?php echo $this->_vars['register_step_1_extra']; ?>

				<?php endif; ?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_main_comment_subscription"), $this);?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_end"), $this);?>
				<p class="otField otFieldAction aRight last">
					<input type="hidden" name="url" id="url" value="<?php echo $this->_vars['submit_url']; ?>
" />
					<input type="hidden" name="phase" value="2" />
					<input type="hidden" name="randkey" value="<?php echo $this->_vars['randkey']; ?>
" />
					<input type="hidden" name="id" value="<?php echo $this->_vars['submit_id']; ?>
" />
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Submit2_Continue']; ?>
" class="button buttonAction" />
				</p>
			</fieldset>
		</form>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_after_form"), $this);?>
		<div id="submitRules" class="formBox">
			<h3 class="formBoxHeader">Submission Guidelines</h3>
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