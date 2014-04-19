<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<header id="header" role="banner">
	<div class="pageWrap">
		<h1 id="logo"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
" rel="home"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/images/logo.png" alt="<?php echo $this->_confs['PLIGG_Visual_Name']; ?>
" /></a></h1>
		<?php if ($this->_vars['user_authenticated'] != true): ?>
			<ul id="navAcct">
				<li class="navAcctLogin"><a href="<?php echo $this->_vars['URL_login']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Login_LoginButton']; ?>
</a></li>
				<li class="navAcctRegister"><a href="<?php echo $this->_vars['URL_register']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Register']; ?>
</a></li>
			</ul>
		<?php endif; ?>
		<?php if ($this->_vars['user_authenticated'] == true): ?>
			<ul class="dropdown" id="navAcctMenu">
				<li>
					<a href="<?php echo $this->_vars['URL_userNoVar']; ?>
" id="acctMenu" data-toggle="dropdown" data-target="#" class="dropdown-toggle"><span class="navAcctHello">Howdy,</span> <?php echo $this->_vars['user_logged_in']; ?>
</a>
					<ul class="dropdownMenu altLinkColor" role="menu" aria-labelledby="acctMenu">
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_sort_start"), $this);?>
						<li><a href="<?php echo $this->_vars['URL_userNoVar']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Profile']; ?>
</a></li>
						<li><a href="<?php echo $this->_vars['user_url_news_sent']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_NewsSent']; ?>
</a></li>
						<?php if (check_for_enabled_module ( 'simple_messaging' , 2.2 )): ?>
							<li><a href="<?php echo $this->_vars['URL_simple_messaging_inbox']; ?>
" rel="nofollow">Messaging</a></li>
						<?php else: ?>
							<li><a href="javascript://" onclick="alert('Simple Messaging is currently disabled!'); return false;">Messaging</a></li>
						<?php endif; ?>
						<li><a href="<?php echo $this->_vars['user_url_commented']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_NewsCommented']; ?>
</a></li>
						<li><a href="<?php echo $this->_vars['URL_Profile']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_User_Setting']; ?>
</a></li>
						<li><a href="<?php echo $this->_vars['user_url_news_upvoted']; ?>
"><?php echo $this->_confs['PLIGG_Visual_UpVoted']; ?>
</a></li>
						<?php if ($this->_vars['Allow_Friends']): ?>
							<li><a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a></li>
						<?php endif; ?>
						<li><a href="<?php echo $this->_vars['user_url_news_downvoted']; ?>
"><?php echo $this->_confs['PLIGG_Visual_DownVoted']; ?>
</a></li>
						<?php if ($this->_vars['Allow_Friends']): ?>
							<li><a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_Your_Friends']; ?>
</a></li>
						<?php endif; ?>
						<li><a href="<?php echo $this->_vars['user_url_saved']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_NewsSaved']; ?>
</a></li>
						<li><a href="<?php echo $this->_vars['URL_logout']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Logout']; ?>
</a></li>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_sort_end"), $this);?>
					</ul>
				</li>
			</ul>
		<?php endif; ?>
	</div>
</header>
<nav id="navPrimary" role="navigation" class="pageWrap" aria-labelledby="navMainHeading">
	<h2 id="navMainHeading" class="navMainHeader">Menu</h2>
	<ul class="navMain<?php if ($this->_vars['enable_group'] != "true" || $this->_vars['Enable_Live'] != true || $this->_vars['Enable_Tags'] != true): ?> navMainOneOff<?php endif;  if (( $this->_vars['enable_group'] != "true" && $this->_vars['Enable_Live'] != true ) || ( $this->_vars['enable_group'] != "true" && $this->_vars['Enable_Tags'] != true ) || ( $this->_vars['Enable_Live'] != true && $this->_vars['Enable_Tags'] != true )): ?> navMainTwoOff<?php endif;  if ($this->_vars['enable_group'] != "true" && $this->_vars['Enable_Live'] != true && $this->_vars['Enable_Tags'] != true): ?> navMainThreeOff<?php endif; ?>">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_navbar_start"), $this);?>
		<li id="navHome"<?php if ($this->_vars['pagename'] == "published" || $this->_vars['pagename'] == "index"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Home']; ?>
</span></a></li>
		<li id="navNew"<?php if ($this->_vars['pagename'] == "new"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_new']; ?>
" rel="nofollow"><span><?php echo $this->_confs['PLIGG_Visual_Pligg_Queued']; ?>
</span></a></li>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_link_start"), $this);?>
		<li id="navSubmit"<?php if ($this->_vars['pagename'] == "submit"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_submit']; ?>
" rel="nofollow"<?php if ($this->_vars['user_authenticated'] != true): ?> class="loginRequired"<?php endif; ?>><span><?php echo $this->_confs['PLIGG_Visual_Submit_A_New_Story']; ?>
</span></a></li>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_link_end"), $this);?>
		<li id="navUsers"<?php if ($this->_vars['pagename'] == "topusers"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_topusers']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Top_Users']; ?>
</span></a></li>
		<?php if ($this->_vars['enable_group'] == "true"): ?>
			<li id="navGroups"<?php if ($this->_vars['pagename'] == "groups" || $this->_vars['pagename'] == "submit_groups" || $this->_vars['pagename'] == "group_story"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_groups']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Groups']; ?>
</span></a></li>
		<?php endif; ?>
		<?php if ($this->_vars['Enable_Live']): ?>
			<li id="navLive"<?php if ($this->_vars['pagename'] == "live" || $this->_vars['pagename'] == "live_published" || $this->_vars['pagename'] == "live_unpublished" || $this->_vars['pagename'] == "live_comments"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_live']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Live']; ?>
</span></a></li>
		<?php endif; ?>
		<?php if ($this->_vars['Enable_Tags']): ?>
			<li id="navCloud"<?php if ($this->_vars['pagename'] == "cloud"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_tagcloud']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Tags']; ?>
</span></a></li>
		<?php endif; ?>
		<li id="navRSS"<?php if ($this->_vars['pagename'] == "rssfeeds"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/rssfeeds.php"><span>RSS Feeds</span></a></li>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_navbar_end"), $this);?>
	</ul>
</nav>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_header_more_end"), $this);?>