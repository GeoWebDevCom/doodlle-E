<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<footer id="footer" role="contentinfo">
	<div class="pageWrap">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_footer_start"), $this);?>
		<p class="copyright">Copyright &copy; <?php  echo date('Y');  ?> <a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
" rel="home"><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</a>. All Rights Reserved.</p>
		<ul class="footerLinks">
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy Policy</a></li>
			<li><a href="#">Terms Of Use</a></li>
		</ul>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_footer_end"), $this);?>
	</div>
	<div class="credits">
		<div class="pageWrap">
			<span class="creditsPowered">Powered By <a href="http://www.pligg.com" rel="nofollow" target="_blank">Pligg</a></span>
			<span  class="creditsDesign">Template By <a href="http://www.oxythemes.com" rel="external" target="_blank" title="Premium Responsive Pligg Templates">OxyThemes</a></span>
		</div>
	</div>
</footer>