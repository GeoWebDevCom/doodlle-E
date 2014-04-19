<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

		<h2 id="sidebarHeading" class="hidden">Sidebar Content</h2>
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/blocks/socialShare.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		<?php if ($this->_vars['pagename'] != "user" && $this->_vars['pagename'] != "user_edit"): ?>
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/blocks/searchBox.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		<?php endif; ?>
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/blocks/sidebarTopUsers.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar_start"), $this);?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar_end"), $this);?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar2_start"), $this);?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "widget_sidebar"), $this);?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar2_end"), $this);?>