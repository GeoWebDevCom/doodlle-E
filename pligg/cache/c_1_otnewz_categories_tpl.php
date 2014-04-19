<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.repeat_count.php'); $this->register_modifier("repeat_count", "tpl_modifier_repeat_count");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<nav id="navCategories" role="navigation" class="pageWrap" aria-labelledby="navCatsHeading">
	<h2 id="navCatsHeading" class="navCatsHeader">Categories</h2>
	<ul class="dropFish navCats">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_categories_start"), $this);?>
		<?php if (isset($this->_sections['thecat'])) unset($this->_sections['thecat']);
$this->_sections['thecat']['name'] = 'thecat';
$this->_sections['thecat']['loop'] = is_array($this->_vars['cat_array']) ? count($this->_vars['cat_array']) : max(0, (int)$this->_vars['cat_array']);
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
			<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['auto_id'] != 0): ?>
				<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount'] < $this->_vars['submit_lastspacer']): ?>
					<?php echo $this->_run_modifier($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacerdiff'], 'repeat_count', 'plugin', 1, '</ul></li>'); ?>

				<?php endif; ?>
				<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount'] > $this->_vars['submit_lastspacer']): ?>
					<ul>
				<?php endif; ?>
				<li<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['principlecat'] != 0): ?> class="navCatsParent"<?php endif; ?>>
					<a href="<?php if ($this->_vars['pagename'] == "new" || $this->_vars['groupview'] == "new"):  echo $this->_vars['URL_newcategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['safename'];  else:  echo $this->_vars['URL_maincategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['safename'];  endif;  if ($this->_vars['urlmethod'] == 2): ?>/<?php endif; ?>"<?php if ($this->_vars['pagename'] == "new"): ?> rel="nofollow"<?php endif; ?>>
						<?php echo $this->_vars['cat_array'][$this->_sections['thecat']['index']]['name']; ?>

					</a>
				<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['principlecat'] == 0): ?>
					</li>
				<?php endif; ?>
				<?php $this->assign('submit_lastspacer', $this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount'] < $this->_vars['submit_lastspacer']):  echo $this->_run_modifier($this->_vars['lastspacer'], 'repeat_count', 'plugin', 1, '</ul></li>');  endif; ?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_categories_end"), $this);?>
	</ul>
</nav>