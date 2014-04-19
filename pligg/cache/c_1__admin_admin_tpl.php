<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkForCss.php'); $this->register_function("checkForCss", "tpl_function_checkForCss");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:57:25 UTC */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="<?php echo $this->_confs['PLIGG_Visual_Language_Direction']; ?>
" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_head_start"), $this);?>

	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/bootstrap.no-icons.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/jquery.pnotify.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/bootstrap-fileupload.min.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/style.css" media="screen">
	<?php echo tpl_function_checkForCss(array(), $this);?>

	<meta name="Language" content="en-us">
	<meta name="Robots" content="none">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 Admin Panel</title>
	
	<link rel="icon" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/favicon.ico" type="image/x-icon"/>	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.coda-slider-2.0.js"></script> 
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.pnotify.js"></script>
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.masonry.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/bootstrap-fileupload.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery_cookie.js"></script>
    <script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/leftmenu.js"></script>
	 
	<?php if ($this->_vars['pagename'] == "admin_index"): ?>
		<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.ui.widget.js"></script> 
		<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.ui.mouse.js"></script> 
		<script type="text/javascript" src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/jquery/jquery.ui.sortable.js"></script>
		<link type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/jquery.ui.theme.css" rel="stylesheet" /> 
		<link type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/admin_home.css" rel="stylesheet" />		
		<link type="text/css" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/coda-slider-2.0.css" rel="stylesheet" media="screen" />
	<?php endif; ?>
	
    <?php echo $this->_vars['Jscript']; ?>

	
	<script src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/simpleedit.js" type="text/javascript"></script>
	<?php if ($this->_vars['pagename'] == "admin_index"): ?>
		<?php echo '
		<script type="text/javascript">
		$(function() {
			$(".column").sortable({
				connectWith: \'.column\'
			});
			$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
				.find(".portlet-header")
					.addClass("ui-widget-header")
					.end()
				.find(".portlet-content");
			$(".ui-icon-minusthick").click(function() {
				$(this).toggleClass("ui-icon-minusthick").toggleClass("ui-icon-plusthick");
				$(this).parents(".portlet:first").find(".portlet-content:first").toggle();
				$(this).parents(".portlet:first").find(".portlet-content:first").each(function(index) {
					$.get("admin_index.php", { action: "minimize", display: this.style.display, id: this.parentNode.id }, function(data){
					});
				});
			});
			$(".ui-icon-plusthick").click(function() {
				$(this).toggleClass("ui-icon-plusthick").toggleClass("ui-icon-minusthick");
				$(this).parents(".portlet:first").find(".portlet-content:first").toggle();
				$(this).parents(".portlet:first").find(".portlet-content:first").each(function(index) {
					$.get("admin_index.php", { action: "minimize", display: this.style.display, id: this.parentNode.id }, function(data){
					});
				});
				var panelHeight = $(this).parents(".portlet:first").find(".panel:first").height();
				var codaslider = $(this).parents(".portlet:first").find(".coda-slider:first");
				codaslider.codaSlider();
	//			codaslider.css({ height: panelHeight });
			});
			jQuery(document).ajaxError(function(event, request, settings){ alert("Error"); });
			$( ".column" ).sortable({
				stop: function(event, ui) { 
					var data = \'\';
					$(".portlet").each(function(index) {
						data += this.id + \',\';
					});
					$.get("admin_index.php", { action: "move", left: ui.offset.left, top: ui.offset.top, id: ui.item[0].id, list: data }, function(data){
	//  					alert("data load " + data);
					});
				}
			});
	//		$(".column").disableSelection();
		});
		$().ready(function() {
			$(".coda-slider").each(function(index) {
			$(\'#\'+this.id).codaSlider();
			});
		});
		</script>
		'; ?>

	<?php endif; ?>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_head_end"), $this);?>
</head>
<body dir="<?php echo $this->_confs['PLIGG_Visual_Language_Direction']; ?>
">
<?php if ($this->_vars['pagename'] != "admin_login"): ?>
	
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_body_start"), $this);?>
	
	<header role="banner" class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://pligg.com/"><img src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/admin/img/pligg.png" /></a>
			</div>
			<nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
				<ul class="nav navbar-nav">
					<li<?php if ($this->_vars['pagename'] == "admin_index"): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_index.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel']; ?>
 Panel</a></li>
					<li><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/"><?php echo $this->_confs['PLIGG_Visual_Home']; ?>
</a></li>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_links"), $this);?>
					<li><a href="<?php echo $this->_vars['URL_logout']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Logout']; ?>
</a></li>
				</ul><!--/.nav -->
			</nav>
		</div>
	</header>
	
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<div id="AdminAccordion" class="accordion">
							<div class="accordion-group">
								<div class="btn btn-default col-md-12 accordion-heading">
									<span class="accordion-heading-title">
										<li class="nav-header"><i class="fa fa-user" /></i>&nbsp; <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Manage_Nav']; ?>
</li>
									</span>
									<?php if ($this->_vars['moderated_total_count'] != ''): ?>
										<span class="badge accordion-heading-alert">
											<?php echo $this->_vars['moderated_total_count']; ?>

										</span>
									<?php endif; ?>
								</div>
								<div class="accordion-body " id="CollapseManage">
									<ul class="accordion-inner">
										<li<?php if ($this->_vars['pagename'] == "admin_links"): ?> class="active"<?php endif; ?> id="manage_submissions"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php">Submissions <?php if ($this->_vars['moderated_submissions_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['moderated_submissions_count']; ?>
</span><?php endif; ?></a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_comments"): ?> class="active"<?php endif; ?> id="manage_comments"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_comments.php">Comments <?php if ($this->_vars['moderated_comments_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['moderated_comments_count']; ?>
</span><?php endif; ?></a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_users" || $this->_vars['pagename'] == "admin_user_validate"): ?> class="active"<?php endif; ?> id="manage_users"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php">Users <?php if ($this->_vars['moderated_users_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['moderated_users_count']; ?>
</span><?php endif; ?></a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_group"): ?> class="active"<?php endif; ?> id="manage_groups"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_group.php">Groups <?php if ($this->_vars['moderated_groups_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['moderated_groups_count']; ?>
</span><?php endif; ?></a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_page" || $this->_vars['pagename'] == "edit_page" || $this->_vars['pagename'] == "submit_page"): ?> class="active"<?php endif; ?> id="manage_pages"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_page.php">Pages</a></li> 
										<li<?php if ($this->_vars['pagename'] == "admin_categories" || $this->_vars['pagename'] == "admin_categories_tasks"): ?> class="active"<?php endif; ?> id="manage_categories"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_categories.php">Categories</a></li> 
										<?php if ($this->_vars['CHECK_SPAM']): ?><li<?php if ($this->_vars['pagename'] == "domain_management"): ?> class="active"<?php endif; ?> id="domain_management"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/domain_management.php">Manage Domains</a></li><?php endif; ?>
										<li<?php if ($this->_vars['pagename'] == "admin_log"): ?> class="active"<?php endif; ?> id="manage_errors"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_log.php">Error Log <?php if ($this->_vars['error_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['error_count']; ?>
</span><?php endif; ?></a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_backup"): ?> class="active"<?php endif; ?> id="settings_backup"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_backup.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Backup'];  if ($this->_vars['backup_count'] != '0'): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['backup_count']; ?>
</span><?php endif; ?></a></li>
										<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_manage_sidebarnav_end"), $this);?>
                                    </ul>
								</div>
							</div>
							<div class="accordion-group">
								<div class="btn btn-default col-md-12 accordion-heading">
									<span class="accordion-heading-title">
										<li class="nav-header"><i class="fa fa-wrench"></i>&nbsp; Settings</li>
									</span>
								</div>
								<div class="accordion-body " id="CollapseSettings">
									<ul class="accordion-inner">
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Anonymous"): ?> class="active"<?php endif; ?> id="settings_anonymous"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Anonymous">Anonymous</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "AntiSpam"): ?> class="active"<?php endif; ?> id="settings_antispam"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=AntiSpam">AntiSpam</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Avatars"): ?> class="active"<?php endif; ?> id="settings_avatars"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Avatars">Avatars</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Comments"): ?> class="active"<?php endif; ?> id="settings_comments"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Comments">Comments</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Groups"): ?> class="active"<?php endif; ?> id="settings_groups"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Groups">Groups</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Live"): ?> class="active"<?php endif; ?> id="settings_live"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Live">Live</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Location Installed"): ?> class="active"<?php endif; ?> id="settings_location"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Location Installed">Location Installed</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Misc"): ?> class="active"<?php endif; ?> id="settings_misc"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Misc">Miscellaneous</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "OutGoing"): ?> class="active"<?php endif; ?> id="settings_outgoing"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=OutGoing">OutGoing</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "SEO"): ?> class="active"<?php endif; ?> id="settings_seo"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=SEO">SEO</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Story"): ?> class="active"<?php endif; ?> id="settings_story"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Story">Story</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Submit"): ?> class="active"<?php endif; ?> id="settings_submit"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Submit">Submit</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Tags"): ?> class="active"<?php endif; ?> id="settings_tags"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Tags">Tags</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Voting"): ?> class="active"<?php endif; ?> id="settings_voting"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Voting">Voting</a></li>
										<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_navtabs_end"), $this);?>
									</ul>
								</div>
							</div>
							<div class="accordion-group">
								<div class="btn btn-default col-md-12 accordion-heading">
									<span class="accordion-heading-title">
										<li class="nav-header"><i class="fa fa-file-o"></i>&nbsp; Template</li>
									</span>
								</div>
								<div class="accordion-body " id="CollapseTemplate">
									<ul class="accordion-inner">
										<li<?php if ($this->_vars['pagename'] == "admin_config" && $_GET['page'] == "Template"): ?> class="active"<?php endif; ?> id="template_settings"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php?page=Template">Template Settings</a></li>
										<li<?php if ($this->_vars['pagename'] == "admin_editor"): ?> class="active"<?php endif; ?> id="template_editor"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_editor.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Template_Nav']; ?>
 Editor</a></li>
									    <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_template_sidebarnav_end"), $this);?>
                                    </ul>
								</div>
							</div>
							<div class="accordion-group">
								<div class="btn btn-default col-md-12 accordion-heading">
									<span class="accordion-heading-title">
										<li class="nav-header"><i class="fa fa-cogs"></i>&nbsp; Modules</li>
									</span>
									<?php if ($this->_vars['total_update_required_mod'] != "0"): ?>
										<span class="badge accordion-heading-alert">
											<a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_modules.php"><?php echo $this->_vars['total_update_required_mod']; ?>
</a>
										</span>
									<?php endif; ?>
								</div>
								<div class="accordion-body " id="CollapseModules">
									<ul class="accordion-inner">
										<li<?php if ($this->_vars['pagename'] == "admin_modules"):   if ($_GET["status"] == ""){ echo ' class="active"'; }   endif; ?> id="modules_installed"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_modules.php" <?php if ($this->_vars['pagename'] == "admin_modules"): ?>class="active"<?php endif; ?> >Installed <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Modules_Nav']; ?>
 <?php if ($this->_vars['in_no_module_update_require'] != "0"): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['in_no_module_update_require']; ?>
</span><?php endif; ?></a></li> 
										<li<?php if ($this->_vars['pagename'] == "admin_modules"):   if ($_GET["status"] == "uninstalled"){ echo ' class="active"'; }   endif; ?> id="modules_uninstalled"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_modules.php?status=uninstalled" <?php if ($this->_vars['pagename'] == "admin_modules"):   if ($_GET["status"] == "uninstalled"){ echo ' class="active"'; }   endif; ?> >Uninstalled <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Modules_Nav']; ?>
 <?php if ($this->_vars['un_no_module_update_require'] != "0"): ?><span class="pull-right badge badge-gray"><?php echo $this->_vars['un_no_module_update_require']; ?>
</span><?php endif; ?></a></li> 
										<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_main_links"), $this);?>
									</ul>
								</div>
							</div>
							<div class="accordion-group">
								<div class="btn btn-default col-md-12 accordion-heading">
									<span class="accordion-heading-title">
										<li class="nav-header"><i class="fa fa-puzzle-piece"></i>&nbsp; Widgets</li>
									</span>
									<span class="badge accordion-heading-alert">
										<a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_widgets.php">1</a>
									</span>
								</div>
								<div class="accordion-body " id="CollapseWidgets">
									<ul class="accordion-inner">
										<li <?php if ($this->_vars['pagename'] == "admin_widgets"):   if ($_GET["status"] == ""){ echo 'class="active"'; }   endif; ?> id="widgets_installed"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_widgets.php">Installed <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Widgets_Nav']; ?>
 <span class="pull-right badge badge-gray">1</span></a></li> 
										<li <?php if ($this->_vars['pagename'] == "admin_widgets"):   if ($_GET["status"] == "uninstalled"){ echo 'class="active"'; }   endif; ?> id="widgets_uninstalled"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_widgets.php?status=uninstalled">Uninstalled <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Widgets_Nav']; ?>
</a></li>
								        <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_widgets_sidebarnav_end"), $this);?>
                                    </ul>
								</div>
							</div>
						</div>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div id="main_content">
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_legend_before"), $this);?>
						<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
						
						<?php if (( $this->_vars['pagename'] == "admin_users" && $_GET['mode'] == '' ) || $this->_vars['pagename'] == "admin_comments" || $this->_vars['pagename'] == "admin_links" || $this->_vars['pagename'] == "admin_user_validate"): ?>	
							<?php  
							Global $db, $main_smarty, $rows, $offset, $URLMethod;
							$oldURLMethod=$URLMethod;
							$URLMethod=1;
							$pagesize=get_misc_data('pagesize');
							do_pages($rows, $pagesize ? $pagesize : 30, $the_page); 
							$URLMethod=$oldURLMethod;
							 ?>
						<?php endif; ?> 
						
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_legend_after"), $this);?>
					</div>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_body_end"), $this);?>
				</div><!-- /row -->
			</div><!-- /col-md-9 -->
		</div><!-- /row -->
		<hr />
		<footer>
			<p>Powered by <a href="http://pligg.com/">Pligg CMS</a></p>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_footer_end"), $this);?>
		</footer>
	</div><!-- /container -->
	
	<?php echo '
		<script type=\'text/javascript\'>//<![CDATA[ 
			$(window).load(function(){
				$(function() {
					$(\'.carousel\').each(function(){
						$(this).carousel({
							interval: false
						});
					});
				});
			});//]]>  
		</script>
		<!-- JavaScript to allow multiple sidebar accordions to be open -->
		<script type=\'text/javascript\'>//<![CDATA[ 
			$(window).load(function(){
				$(\'.collapse\').collapse({
					toggle: false
				});
				//$(".collapse").collapse()
			});//]]>  
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
			// https://gist.github.com/1688900
			// Support for AJAX loaded modal window.
			// Focuses on first input textbox after it loads the window.
				$(\'[data-toggle="modal"]\').click(function(e) {
					e.preventDefault();
					var href = $(this).attr(\'href\');
					if (href.indexOf(\'#\') == 0) {
						$(href).modal(\'open\');
					} else {
						$.get(href, function(data) {
							$(\'<div class="modal" >\' + data + \'</div>\').modal();
						}).success(function() { $(\'input:text:visible:first\').focus(); });
					}
				});
			});
		</script>
	'; ?>

<?php else:  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  endif; ?>
</body>
</html>