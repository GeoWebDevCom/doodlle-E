<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:11:02 UTC */ ?>

<article id="contentWrap" class="pageWrap">
	<div id="content" role="main">
		<div class="xFolkHeader"><p class="xFolkHeaderTitle">Story Details</p></div>
		<?php echo $this->_vars['the_story']; ?>

			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_start"), $this);?>
			<?php if ($this->_vars['story_comment_count'] >= 1): ?>
				<section id="commentsList">
					<h3 class="commentsListHeader"><?php echo $this->_vars['story_comment_count']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Story_Comments']; ?>
</h3>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_individual_start"), $this);?>
					<?php echo $this->_vars['the_comments']; ?>

					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_individual_end"), $this);?>
				</section>
			<?php endif; ?>
			<?php if ($this->_vars['user_authenticated'] != ""): ?>
				<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/comment_form.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
			<?php else: ?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "anonymous_comment_form_start"), $this);?>
				<section id="commentsAdd">
					<h3 class="commentsListHeader"><?php echo $this->_confs['PLIGG_Visual_Comment_Send']; ?>
</h3>
					<div class="padTop20">
						<a href="<?php echo $this->_vars['login_url']; ?>
" rel="nofollow" class="loginRequired"><?php echo $this->_confs['PLIGG_Visual_Story_LoginToComment']; ?>
</a>
						<?php echo $this->_confs['PLIGG_Visual_Story_Register']; ?>

						<a href="<?php echo $this->_vars['register_url']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Story_RegisterHere']; ?>
</a></div>
				</section>
				<?php echo tpl_function_checkActionsTpl(array('location' => "anonymous_comment_form_end"), $this);?>
			<?php endif; ?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_end"), $this);?>
		</div>
	</div>
	<div id="sidebar" role="complementary">
		<div id="voters" class="sidebarUsers sidebarTab">
			<h3 class="sidebarBlockHeader"><?php echo $this->_confs['PLIGG_Visual_Story_WhoVoted']; ?>
</h3>
			<div class="sidebarTabPanel">
			<?php if (count ( $this->_vars['voter'] ) != 0): ?>
				<ul id="votersUp" class="sidebarUsersList">
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_who_voted_start"), $this);?>
					<?php if (isset($this->_sections['upvote'])) unset($this->_sections['upvote']);
$this->_sections['upvote']['name'] = 'upvote';
$this->_sections['upvote']['loop'] = is_array($this->_vars['voter']) ? count($this->_vars['voter']) : max(0, (int)$this->_vars['voter']);
$this->_sections['upvote']['show'] = true;
$this->_sections['upvote']['max'] = $this->_sections['upvote']['loop'];
$this->_sections['upvote']['step'] = 1;
$this->_sections['upvote']['start'] = $this->_sections['upvote']['step'] > 0 ? 0 : $this->_sections['upvote']['loop']-1;
if ($this->_sections['upvote']['show']) {
	$this->_sections['upvote']['total'] = $this->_sections['upvote']['loop'];
	if ($this->_sections['upvote']['total'] == 0)
		$this->_sections['upvote']['show'] = false;
} else
	$this->_sections['upvote']['total'] = 0;
if ($this->_sections['upvote']['show']):

		for ($this->_sections['upvote']['index'] = $this->_sections['upvote']['start'], $this->_sections['upvote']['iteration'] = 1;
			 $this->_sections['upvote']['iteration'] <= $this->_sections['upvote']['total'];
			 $this->_sections['upvote']['index'] += $this->_sections['upvote']['step'], $this->_sections['upvote']['iteration']++):
$this->_sections['upvote']['rownum'] = $this->_sections['upvote']['iteration'];
$this->_sections['upvote']['index_prev'] = $this->_sections['upvote']['index'] - $this->_sections['upvote']['step'];
$this->_sections['upvote']['index_next'] = $this->_sections['upvote']['index'] + $this->_sections['upvote']['step'];
$this->_sections['upvote']['first']	  = ($this->_sections['upvote']['iteration'] == 1);
$this->_sections['upvote']['last']	   = ($this->_sections['upvote']['iteration'] == $this->_sections['upvote']['total']);
?>
						<li>
							<a href="<?php echo $this->_vars['URL_user'].$this->_vars['voter'][$this->_sections['upvote']['index']]['user_login']; ?>
" title="View <?php echo $this->_vars['voter'][$this->_sections['upvote']['index']]['user_login']; ?>
's Profile"><img src="<?php echo $this->_vars['voter'][$this->_sections['upvote']['index']]['Avatar_ImgSrc']; ?>
" alt="<?php echo $this->_vars['voter'][$this->_sections['upvote']['index']]['user_login']; ?>
 Avatar" /></a>
						</li>
					<?php endfor; endif; ?>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_who_voted_end"), $this);?>
				</ul>
			<?php endif; ?>
			</div>
		</div>
		<?php if (count ( $this->_vars['downvoter'] ) != 0): ?>
		<div id="downvoters" class="sidebarUsers sidebarTab">
			<h3 class="sidebarBlockHeader"><?php echo $this->_confs['PLIGG_Visual_Story_Who_Downvoted_Story']; ?>
</h3>
			<div class="sidebarTabPanel">
				<ul id="votersUp" class="sidebarUsersList">
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_who_downvoted_start"), $this);?>
					<?php if (isset($this->_sections['downvote'])) unset($this->_sections['downvote']);
$this->_sections['downvote']['name'] = 'downvote';
$this->_sections['downvote']['loop'] = is_array($this->_vars['downvoter']) ? count($this->_vars['downvoter']) : max(0, (int)$this->_vars['downvoter']);
$this->_sections['downvote']['show'] = true;
$this->_sections['downvote']['max'] = $this->_sections['downvote']['loop'];
$this->_sections['downvote']['step'] = 1;
$this->_sections['downvote']['start'] = $this->_sections['downvote']['step'] > 0 ? 0 : $this->_sections['downvote']['loop']-1;
if ($this->_sections['downvote']['show']) {
	$this->_sections['downvote']['total'] = $this->_sections['downvote']['loop'];
	if ($this->_sections['downvote']['total'] == 0)
		$this->_sections['downvote']['show'] = false;
} else
	$this->_sections['downvote']['total'] = 0;
if ($this->_sections['downvote']['show']):

		for ($this->_sections['downvote']['index'] = $this->_sections['downvote']['start'], $this->_sections['downvote']['iteration'] = 1;
			 $this->_sections['downvote']['iteration'] <= $this->_sections['downvote']['total'];
			 $this->_sections['downvote']['index'] += $this->_sections['downvote']['step'], $this->_sections['downvote']['iteration']++):
$this->_sections['downvote']['rownum'] = $this->_sections['downvote']['iteration'];
$this->_sections['downvote']['index_prev'] = $this->_sections['downvote']['index'] - $this->_sections['downvote']['step'];
$this->_sections['downvote']['index_next'] = $this->_sections['downvote']['index'] + $this->_sections['downvote']['step'];
$this->_sections['downvote']['first']	  = ($this->_sections['downvote']['iteration'] == 1);
$this->_sections['downvote']['last']	   = ($this->_sections['downvote']['iteration'] == $this->_sections['downvote']['total']);
?>
						<li>
							<a href="<?php echo $this->_vars['URL_user'].$this->_vars['downvoter'][$this->_sections['downvote']['index']]['user_login']; ?>
" title="View <?php echo $this->_vars['downvoter'][$this->_sections['downvote']['index']]['user_login']; ?>
's Profile"><img src="<?php echo $this->_vars['downvoter'][$this->_sections['downvote']['index']]['Avatar_ImgSrc']; ?>
" alt="<?php echo $this->_vars['downvoter'][$this->_sections['downvote']['index']]['user_login']; ?>
 Avatar" /></a>
						</li>
					<?php endfor; endif; ?>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_who_downvoted_end"), $this);?>
				</ul>
			</div>
		</div>
		<?php endif; ?>			
		<?php if (count ( $this->_vars['related_story'] ) != 0): ?>
		<div id="relatedLinks" class="newEntries sidebarBlock">
			<h3 class="sidebarBlockHeader"><?php echo $this->_confs['PLIGG_Visual_Story_RelatedStory']; ?>
</h3>
			<ul class="sidebarBlockContent sidebarList altLinkColor">
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_related_start"), $this);?>
				<?php if (count ( $this->_vars['related_story'] ) > 10):  $this->assign('related_count', "10");  else:  $this->assign('related_count', $this->_vars['related_story']);  endif; ?>
				<?php if (isset($this->_sections['related'])) unset($this->_sections['related']);
$this->_sections['related']['name'] = 'related';
$this->_sections['related']['loop'] = is_array($this->_vars['related_count']) ? count($this->_vars['related_count']) : max(0, (int)$this->_vars['related_count']);
$this->_sections['related']['show'] = true;
$this->_sections['related']['max'] = $this->_sections['related']['loop'];
$this->_sections['related']['step'] = 1;
$this->_sections['related']['start'] = $this->_sections['related']['step'] > 0 ? 0 : $this->_sections['related']['loop']-1;
if ($this->_sections['related']['show']) {
	$this->_sections['related']['total'] = $this->_sections['related']['loop'];
	if ($this->_sections['related']['total'] == 0)
		$this->_sections['related']['show'] = false;
} else
	$this->_sections['related']['total'] = 0;
if ($this->_sections['related']['show']):

		for ($this->_sections['related']['index'] = $this->_sections['related']['start'], $this->_sections['related']['iteration'] = 1;
			 $this->_sections['related']['iteration'] <= $this->_sections['related']['total'];
			 $this->_sections['related']['index'] += $this->_sections['related']['step'], $this->_sections['related']['iteration']++):
$this->_sections['related']['rownum'] = $this->_sections['related']['iteration'];
$this->_sections['related']['index_prev'] = $this->_sections['related']['index'] - $this->_sections['related']['step'];
$this->_sections['related']['index_next'] = $this->_sections['related']['index'] + $this->_sections['related']['step'];
$this->_sections['related']['first']	  = ($this->_sections['related']['iteration'] == 1);
$this->_sections['related']['last']	   = ($this->_sections['related']['iteration'] == $this->_sections['related']['total']);
?>
					<li><a href="<?php echo $this->_vars['related_story'][$this->_sections['related']['index']]['url']; ?>
"><?php echo $this->_vars['related_story'][$this->_sections['related']['index']]['link_title']; ?>
</a></li> 
				<?php endfor; endif; ?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_related_end"), $this);?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_tab_end_content"), $this);?>
</article>

