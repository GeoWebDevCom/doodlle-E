<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkForJs.php'); $this->register_function("checkForJs", "tpl_function_checkForJs");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkForCss.php'); $this->register_function("checkForCss", "tpl_function_checkForCss");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/title.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/metaLinkRel.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/stylesheet.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php echo tpl_function_checkForCss(array(), $this);?>
<!--[if lt IE 9]><script src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/scripts/HTML5Shiv.js"></script><![endif]-->
<script src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/scripts/cssUA.js"></script>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_head_start"), $this);?>
<?php echo tpl_function_checkForJs(array(), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_head_end"), $this);?>
</head>
<body id="<?php echo $this->_vars['pagename']; ?>
Page" <?php echo $this->_vars['body_args']; ?>
 <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_body_onload"), $this);?>>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_body_start"), $this);?>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_header'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php if ($this->_vars['pagename'] != "login" && $this->_vars['pagename'] != "register" && $this->_vars['pagename'] != "register_complete" && $this->_vars['pagename'] != "validation" && $this->_vars['pagename'] != "submit" && $this->_vars['pagename'] != "editlink" && $this->_vars['pagename'] != "user" && $this->_vars['pagename'] != "user_edit" && $this->_vars['pagename'] != "profile" && $this->_vars['pagename'] != "topusers" && $this->_vars['pagename'] != "rssfeeds"): ?>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/categories.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php endif; ?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_banner_top"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_content_start"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_above_center"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_columns_start"), $this);?>
<?php if ($this->_vars['pagename'] == "story" || $this->_vars['pagename'] == "edit"): ?>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php elseif ($this->_vars['pagename'] == "register" || $this->_vars['pagename'] == "submit" || $this->_vars['pagename'] == "editlink" || $this->_vars['pagename'] == "live" || $this->_vars['pagename'] == "live_published" || $this->_vars['pagename'] == "live_unpublished" || $this->_vars['pagename'] == "live_comments" || $this->_vars['pagename'] == "topusers" || $this->_vars['pagename'] == "error_404"): ?>
	<div id="contentWrap" class="pageWrap">
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	</div>
<?php elseif ($this->_vars['pagename'] == "login" || $this->_vars['pagename'] == "recover"): ?>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php else: ?>
	<div id="contentWrap" class="pageWrap">
		<div id="content" role="main">
			<?php if ($this->_vars['pagename'] == "index" && count ( $_GET ) == 0): ?>
				<?php echo $this->_vars['otSlider']; ?>

			<?php endif; ?>
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		</div>
		<aside id="sidebar" role="complementary">
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_first_sidebar'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		</aside>
	</div>
<?php endif; ?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_columns_end"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_below_center"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_content_end"), $this);?>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_banner_bottom"), $this);?>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_footer'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php if ($this->_vars['user_authenticated'] != true && $this->_vars['pagename'] != 'login'): ?>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/blocks/modalLogin.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php endif; ?>
<div id="embedModal"><span class="embedModalClose"></span></div>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_body_end"), $this);?>
<script>
<?php echo '
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]= function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;e=o.createElement(i);r=o.getElementsByTagName(i)[0];e.src=\'//www.google-analytics.com/analytics.js\';r.parentNode.insertBefore(e,r)}(window,document,\'script\',\'ga\'));
ga(\'create\',\'UA-XXXXX-X\');ga(\'send\',\'pageview\');
'; ?>

</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/scripts/jQuery.1.10.2.js"><\/script>')</script>
<script src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/min/g=commonJS,embedJS,OTsliderJS"></script>
<?php if (( $this->_vars['anonymous_vote'] == "false" && $this->_vars['user_authenticated'] == true ) || $this->_vars['user_authenticated'] == true):  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/assets/scripts/PliggJS.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  endif; ?>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/assets/scripts/OTnewzJS.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<?php if ($this->_vars['pagename'] == "live"):  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/assets/scripts/PliggLiveJS.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  endif; ?>
</body>
</html>