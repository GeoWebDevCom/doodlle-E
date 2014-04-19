<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/block.strip.php'); $this->register_block("strip", "tpl_block_strip");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic|Oswald" />
<?php $this->_tag_stack[] = array('tpl_block_strip', array()); tpl_block_strip(array(), null, $this); ob_start(); ?>
<link rel="stylesheet" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/min/g=common,
<?php if ($this->_vars['pagename'] == "index" || $this->_vars['pagename'] == "published" || $this->_vars['pagename'] == "new" || $this->_vars['pagename'] == "story" || $this->_vars['pagename'] == "search"): ?>
	links,
<?php elseif ($this->_vars['pagename'] == "register" || $this->_vars['pagename'] == "login" || $this->_vars['pagename'] == "recover" || $this->_vars['pagename'] == "submit" || $this->_vars['pagename'] == "editlink" || $this->_vars['pagename'] == "submit_groups" || $this->_vars['pagename'] == "editgroup" || $this->_vars['pagename'] == "advancedsearch"): ?>
	forms,
<?php elseif ($this->_vars['pagename'] == "topusers"): ?>
	members,
<?php elseif ($this->_vars['pagename'] == "groups"): ?>
	groups,
<?php elseif ($this->_vars['pagename'] == "group_story"): ?>
	links,groups,
<?php elseif ($this->_vars['pagename'] == "live" || $this->_vars['pagename'] == "live_published" || $this->_vars['pagename'] == "live_unpublished" || $this->_vars['pagename'] == " live_comments"): ?>
	live,
<?php elseif ($this->_vars['pagename'] == "user"): ?>
	links,profile,
<?php elseif ($this->_vars['pagename'] == "user_edit"): ?>
	forms,profile,
<?php elseif ($this->_vars['pagename'] == "rssfeeds"): ?>
	rss,
<?php elseif ($this->_vars['pagename'] == "page"): ?>
	pages,
<?php else: ?>
	misc,
<?php endif; ?>
<?php if ($this->_vars['pagename'] == "index" && count ( $_GET ) == 0): ?>
	OTslider,
<?php endif; ?>
modules,sidebar,footer,custom,themeDefault,helper,print" />
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); $this->_block_content = tpl_block_strip($this->_tag_stack[count($this->_tag_stack) - 1][1], $this->_block_content, $this); echo $this->_block_content; array_pop($this->_tag_stack); ?>	
<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/styles/OTnewzIE8.css" />
<link rel="stylesheet" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/assets/styles/OTnewzThemeDefaultIE8.css" />
<![endif]-->