<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.sanitize.php'); $this->register_modifier("sanitize", "tpl_modifier_sanitize");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<?php if ($this->_vars['meta_description'] != ""): ?>
	<meta name="description" content="<?php echo $this->_run_modifier($this->_vars['meta_description'], 'truncate', 'plugin', 1, "300"); ?>
" />
<?php elseif ($this->_vars['pagename'] == "search"): ?>
	<meta name="description" content="<?php echo $this->_confs['PLIGG_Visual_Search_SearchResults']; ?>
 <?php echo $this->_run_modifier($this->_run_modifier($_GET['search'], 'sanitize', 'plugin', 1, 2), 'stripslashes', 'PHP', 1); ?>
" />
<?php else: ?>
	<meta name="description" content="<?php echo $this->_run_modifier($this->_confs['PLIGG_Visual_What_Is_Pligg_Text'], 'htmlentities', 'PHP', 1); ?>
" />
<?php endif; ?>
<?php if ($this->_vars['meta_keywords'] != ""): ?>
	<meta name="keywords" content="<?php echo $this->_vars['meta_keywords']; ?>
" />
<?php elseif ($this->_vars['pagename'] == "search"): ?>
	<meta name="keywords" content="<?php echo $this->_run_modifier($this->_run_modifier($_GET['search'], 'sanitize', 'plugin', 1, 2), 'stripslashes', 'PHP', 1); ?>
" />
<?php else: ?>
	<meta name="keywords" content="<?php echo $this->_confs['PLIGG_Visual_Meta_Keywords']; ?>
" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == "submit" || $this->_vars['pagename'] == "editlink" || $this->_vars['pagename'] == "register" || $this->_vars['pagename'] == "register_complete" || $this->_vars['pagename'] == "validation" || $this->_vars['pagename'] == "login" || $this->_vars['pagename'] == "404" || $this->_vars['pagename'] == "noresults" || $this->_vars['pagename'] == "advancedsearch" || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "addfriend" ) || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "removefriend" ) || $this->_vars['pagename'] == "module"): ?>
	<meta name="robots" content="noindex" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == "new" || $this->_vars['pagename'] == "search" || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "history" ) || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "shaken" ) || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "voted" ) || ( $this->_vars['pagename'] == "user" && $this->_vars['user_view'] == "saved" )): ?>
	<meta name="robots" content="noindex, nofollow" />
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php if ($this->_vars['pagename'] == "index" && count ( $_GET ) == 0): ?>
	<meta property="og:title" content="<?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 - <?php echo $this->_confs['PLIGG_Visual_RSS_Description']; ?>
" />
	<meta property="og:description" content="<?php echo $this->_run_modifier($this->_confs['PLIGG_Visual_What_Is_Pligg_Text'], 'htmlentities', 'PHP', 1); ?>
" />
	<meta property="og:image" content="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/images/logo.png" />
	<meta property="og:url" content="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
" />
<?php endif; ?>
<link rel="home" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/" />
<?php if ($this->_vars['pagename'] == 'index'): ?>
	<link rel="canonical" href="<?php if ($this->_vars['get']['page'] > 1):  echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/?page=<?php echo $this->_vars['get']['page'];  else:  echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php endif; ?>" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == 'published'): ?>
	<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/<?php if ($this->_vars['urlmethod'] == 2):  if ($this->_vars['get']['page'] > 1):  echo $this->_vars['request_category']; ?>
/page/2/<?php else:  echo $this->_vars['request_category']; ?>
/<?php endif;  else:  if ($this->_vars['get']['page'] > 1): ?>?page=<?php echo $this->_vars['get']['page']; ?>
&amp;category=<?php echo $this->_vars['request_category'];  else: ?>?category=<?php echo $this->_vars['request_category'];  endif;  endif; ?>" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == 'story'): ?>
	<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['navbar_where']['link2']; ?>
" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == 'user' && $this->_vars['user_view'] == 'profile'): ?>
	<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['user_url_personal_data']; ?>
" />
<?php endif; ?>
<?php if ($this->_vars['pagename'] == 'user' && $this->_vars['user_view'] == 'published'): ?>
	<?php if (! $this->_vars['get']['page'] || $this->_vars['get']['page'] == 1): ?>
		<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['user_url_news_published']; ?>
" />
	<?php else: ?>
		<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['URL_userNoVar']; ?>
?page=<?php echo $this->_vars['get']['page']; ?>
&amp;login=<?php echo $this->_vars['user_username']; ?>
&amp;view=published" />
	<?php endif; ?>
<?php endif; ?>
<?php if ($this->_vars['pagename'] == 'topusers'): ?>
	<?php if (! $this->_vars['get']['page'] || $this->_vars['get']['page'] == 1): ?>
		<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['URL_topusers']; ?>
" />
	<?php else: ?>
		<link rel="canonical" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['URL_topusers']; ?>
?page=<?php echo $this->_vars['get']['page']; ?>
" />
	<?php endif; ?>
<?php endif; ?>
<link rel="alternate" type="application/rss+xml" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/rss.php" title="<?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 RSS" />