<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:10:57 UTC */ ?>

			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_start"), $this);?>
			<<?php if ($this->_vars['pagename'] == "story"): ?>div<?php else: ?>article<?php endif; ?> id="xfolkentry-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentry<?php if ($this->_vars['pagename'] == "group_story"): ?> xfolkentryGroups<?php endif;  if ($this->_vars['pagename'] == "user"): ?> xfolkentryProfile<?php endif; ?>">
				<div class="xfolkentryThumb">
					<a href="<?php echo $this->_vars['url']; ?>
" rel="nofollow" data-xfolkentry-url="<?php echo $this->_vars['story_url']; ?>
" class="embedModalTrigger"></a>
				</div>
				<header class="xfolkentryHeader">
					<h2 class="xfolkentryTitle">
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_title_start"), $this);?>
						<?php if ($this->_vars['use_title_as_link'] == true): ?>
							<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
								<a href="<?php echo $this->_vars['url']; ?>
"<?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif;  if ($this->_vars['story_status'] != "published"): ?> rel="nofollow"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
							<?php else: ?>
								<a href="<?php echo $this->_vars['story_url']; ?>
"<?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
							<?php endif; ?>
						 <?php else: ?>
							<?php if ($this->_vars['pagename'] == "story" && $this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
								<a href="<?php echo $this->_vars['url']; ?>
"<?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif;  if ($this->_vars['story_status'] != "published"): ?> rel="nofollow"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
							<?php else: ?>
								<a href="<?php echo $this->_vars['story_url']; ?>
"><?php echo $this->_vars['title_short']; ?>
</a>
							<?php endif; ?>
						<?php endif; ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_title_end"), $this);?>
					</h2>
					<p class="xfolkentryHeaderMeta">
						<span class="xfolkentrySubmitter"><a href="<?php echo $this->_vars['submitter_profile_url']; ?>
"><?php echo $this->_vars['link_submitter']; ?>
</a></span>
						<?php if ($this->_vars['story_status'] == "published"): ?>
							<time datetime="<?php echo $this->_run_modifier($this->_vars['link_published_time'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
" class="xfolkentryTime capitalize"><?php echo $this->_vars['link_submit_timeago']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Comment_Ago']; ?>
</time>
						<?php else: ?>
							<span class="xfolkentryTime capitalize"><?php echo $this->_vars['link_submit_timeago']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Comment_Ago']; ?>
</span>
						<?php endif; ?>
						<span class="xfolkentryCats">
							on <a href="<?php echo $this->_vars['category_url']; ?>
"<?php if ($this->_vars['story_status'] != "published"): ?> rel="nofollow"<?php endif; ?>><?php echo $this->_vars['link_category']; ?>
</a>
							<?php if ($this->_vars['link_additional_cats']): ?>
								<?php if (count((array)$this->_vars['link_additional_cats'])):  foreach ((array)$this->_vars['link_additional_cats'] as $this->_vars['caturl'] => $this->_vars['catname']): ?>
									<a href="<?php echo $this->_vars['caturl']; ?>
"<?php if ($this->_vars['story_status'] != "published"): ?> rel="nofollow"<?php endif; ?>><?php echo $this->_vars['catname']; ?>
</a>
								<?php endforeach; endif; ?>
							<?php endif; ?>
						</span>
					</p>
				</header>
				<div class="description xfolkentryDesc">
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_start"), $this);?>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_pre_story_content"), $this);?>
					<?php if ($this->_vars['pagename'] == "story"): ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_start_full"), $this);?>
					<?php else: ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_start"), $this);?>
					<?php endif; ?>
					<?php if ($this->_vars['viewtype'] != "short"): ?>
						<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
							<a href="<?php echo $this->_vars['url']; ?>
"  class="taggedlink"<?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif;  if ($this->_vars['story_status'] != "published"): ?> rel="nofollow"<?php endif; ?>><?php echo $this->_vars['url_short']; ?>
</a> -
						<?php endif; ?>
						<?php if ($this->_vars['show_content'] != 'FALSE'): ?>
							<?php if ($this->_vars['pagename'] == "story"): ?>
								<?php echo $this->_run_modifier($this->_vars['story_content'], 'nl2br', 'PHP', 1); ?>

							<?php else: ?>
								<?php echo $this->_run_modifier($this->_vars['story_content'], 'nl2br', 'PHP', 1); ?>

							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_vars['pagename'] == "story"): ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_end_full"), $this);?>
					<?php else: ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_end"), $this);?>
					<?php endif; ?>
				</div>
				<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/blocks/entryShare.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
				<ul id="xfolkentryVote-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVote altLinkColor clearFix">
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_votebox_start"), $this);?>
					<?php if ($this->_vars['anonymous_vote'] == "false" && $this->_vars['user_logged_in'] == ""): ?>
						<li class="xfolkentryVoteLike"><a href="#modalLogin" title="Vote Up" class="loginRequired"><?php echo $this->_confs['PLIGG_Visual_Vote_For_It']; ?>
</a></li>
						<li class="xfolkentryVoteNum"><a href="<?php echo $this->_vars['story_url']; ?>
#votersLink"><?php echo $this->_vars['link_shakebox_votes']; ?>
</a></li>
						<li class="xfolkentryVoteDislike"><a href="#modalLogin" title="Vote Down" class="loginRequired"><?php echo $this->_confs['PLIGG_Visual_Vote_Bury']; ?>
</a></li>
					<?php else: ?>
						<?php if ($this->_vars['link_shakebox_currentuser_votes'] == 0): ?>
							<li id="xfolkentryVoteLike-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVoteLike">
								<a href="<?php if ($this->_vars['vote_from_this_ip'] != 0 && $this->_vars['user_logged_in'] == ""): ?>#modalLogin<?php else: ?>javascript:<?php echo $this->_vars['link_shakebox_javascript_vote'];  endif; ?>"<?php if ($this->_vars['vote_from_this_ip'] != 0 && $this->_vars['user_logged_in'] == ""): ?> class="loginRequired"<?php endif; ?> title="<?php echo $this->_confs['PLIGG_Visual_Vote_For_It']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Vote_For_It']; ?>
</a>
							</li>
						<?php elseif ($this->_vars['link_shakebox_currentuser_votes'] == 1): ?>
							<li id="xfolkentryVoteLike-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVoteLike">
								<a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_unvote']; ?>
" class="xfolkentryVoted" title="<?php echo $this->_confs['PLIGG_Visual_Unvote_For_It']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Unvote_For_It']; ?>
</a>
							</li>
						<?php endif; ?>
						<li id="xfolkentryVoteNum-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVoteNum"><a href="<?php echo $this->_vars['story_url']; ?>
#voters"><?php echo $this->_vars['link_shakebox_votes']; ?>
</a></li>
						<?php if ($this->_vars['link_shakebox_currentuser_reports'] == 0): ?>
							<li id="xfolkentryVoteDislike-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVoteDislike">
								<a href="<?php if ($this->_vars['report_from_this_ip'] != 0 && $this->_vars['user_logged_in'] == ""): ?>#modalLogin<?php else: ?>javascript:<?php echo $this->_vars['link_shakebox_javascript_report'];  endif; ?>"<?php if ($this->_vars['report_from_this_ip'] != 0 && $this->_vars['user_logged_in'] == ""): ?> class="loginRequired"<?php endif; ?> title="<?php echo $this->_confs['PLIGG_Visual_Vote_Bury']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Vote_Bury']; ?>
</a>
							</li>
						<?php elseif ($this->_vars['link_shakebox_currentuser_reports'] == 1): ?>
							<li id="xfolkentryVoteDislike-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryVoteDislike">
								<a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_unbury']; ?>
" title="Unbury" class="xfolkentryBuried">Unbury</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_votebox_end"), $this);?>
				</ul>
				<footer class="<?php if ($this->_vars['user_logged_in'] == $this->_vars['link_submitter'] || $this->_vars['isadmin']): ?>xfolkentryCtrlAlt<?php else: ?>xfolkentryCtrl<?php endif; ?>">
					<ul class="clearFix">
						<?php if ($this->_vars['isadmin']): ?>
							<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_admin_links"), $this);?>
							<li class="xfolkentryCtrlOptions dropdown">
								<a href="<?php echo $this->_vars['story_url']; ?>
" data-toggle="dropdown" data-target="#">Article Options</a>
								<ul class="dropdownMenu altLinkColor">
									<li><a href="<?php echo $this->_vars['story_edit_url']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Edit']; ?>
</a></li>
									<li><a href="<?php echo $this->_vars['story_admin_url']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Status']; ?>
</a>
									<li><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=view&user=<?php echo $this->_vars['link_submitter']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Comment_Manage_User']; ?>
 <?php echo $this->_vars['link_submitter']; ?>
</a>
									<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=killspam&user=<?php echo $this->_vars['link_submitter']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_View_User_Killspam']; ?>
</a>
									<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/delete.php?link_id=<?php echo $this->_vars['link_id']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Discard']; ?>
</a>
								</ul>
							</li>
						<?php elseif ($this->_vars['user_logged_in'] == $this->_vars['link_submitter']): ?>
							<li class="xfolkentryCtrlEdit"><a href="<?php echo $this->_vars['story_edit_url']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Edit']; ?>
</a></li>
						<?php endif; ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_tools_start"), $this);?>
						<li class="xfolkentryCtrlDiscuss">
							<?php if ($this->_vars['pagename'] == "story"): ?>
								<a href="<?php echo $this->_vars['story_url']; ?>
#commentsAdd">Add Comment</a>
							<?php else: ?>
								<?php if ($this->_vars['story_comment_count'] == 0): ?>
									<a href="<?php echo $this->_vars['story_url']; ?>
#commentsAdd"><?php echo $this->_confs['PLIGG_MiscWords_Discuss']; ?>
</a>
								<?php endif; ?>
								<?php if ($this->_vars['story_comment_count'] == 1): ?>
									<a href="<?php echo $this->_vars['story_url']; ?>
#commentsList"><?php echo $this->_vars['story_comment_count']; ?>
 <?php echo $this->_confs['PLIGG_MiscWords_Comment']; ?>
</a>
								<?php endif; ?>
								<?php if ($this->_vars['story_comment_count'] > 1): ?>
									<a href="<?php echo $this->_vars['story_url']; ?>
#commentsList"><?php echo $this->_vars['story_comment_count']; ?>
 <?php echo $this->_confs['PLIGG_MiscWords_Comments']; ?>
</a>
								<?php endif; ?>
							<?php endif; ?>
						</li>
						<li class="xfolkentryCtrlShare"><a href="#xfolkentryShare-<?php echo $this->_vars['link_id']; ?>
" data-share-popup="xfolkentryShare-<?php echo $this->_vars['link_id']; ?>
">Share</a></li>
						<li class="xfolkentryCtrlSave">
							<?php if ($this->_vars['user_logged_in']): ?>  
								<?php if ($this->_vars['link_mine'] == 0): ?>
									<a href="#" data-bookmark-action="add" data-bookmark-id="<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryCtrlBmrk"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Save']; ?>
</a>
								<?php else: ?>
									<a href="#" data-bookmark-action="remove" data-bookmark-id="<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryCtrlBmrk"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Remove']; ?>
</a>
								<?php endif; ?>
							<?php else: ?>
								<a href="#" data-entry-bookmark-id="<?php echo $this->_vars['link_id']; ?>
" class="loginRequired"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Save']; ?>
</a>
							<?php endif; ?>
						</li>
					</ul>
				</footer>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_end"), $this);?>
			<?php if ($this->_vars['pagename'] != "story"): ?></article><?php endif; ?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_end"), $this);?>