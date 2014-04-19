				{checkActionsTpl location="tpl_pligg_story_comments_single_start"}
				<article id="comment-{$comment_id}" class="comment">
					<div class="commentAvatarVote">
						<div class="commentAvatar">{if $UseAvatars neq "0"}<a href="{$user_view_url}"><img src="{$Avatar.large}" alt="{$user_username}'s Avatar" title="View {$user_username} Profile" /></a>{/if}</div>
						{if $Enable_Comment_Voting eq 1}
						<ul id="commentVote-{$comment_id}" class="commentVote">
							{if $comment_shakebox_currentuser_votes eq 0}
								<li class="commentVoteUp"><a href="{if $current_userid neq 0}javascript:{$link_shakebox_javascript_votey}{else}#modalLogin{/if}" rel="nofollow" title="{#PLIGG_Visual_Comment_Rate_Comment#}"{if $current_userid eq 0} class="loginRequired"{/if}>{#PLIGG_Visual_Comment_Rate_Comment#}</a></li>
							{else}
								<li class="commentVoteUp"><a href="javascript:{$link_shakebox_javascript_unvotey}" rel="nofollow" class="commentVoted" title="Remove Comment Rating">Remove Comment Rating</a></li>
							{/if}
							<li id="commentVoteNum-{$comment_id}" class="commentVoteNum">{$comment_votes}</li>
							{if $comment_shakebox_currentuser_reports eq 0}
								<li class="commentVoteDown"><a href="{if $current_userid neq 0}javascript:{$link_shakebox_javascript_voten}{else}#modalLogin{/if}" rel="nofollow"{if $current_userid eq 0} class="loginRequired"{/if}>Vote Down</a></li>
							{else}
								<li class="commentVoteDown"><a href="javascript:{$link_shakebox_javascript_unvoten}" rel="nofollow" class="commentBuried" title="{#PLIGG_Visual_Comment_Rate_Comment#}">{#PLIGG_Visual_Comment_Rate_Comment#}</a></li>
							{/if}
						
						
									{*
									
									
									
									
									{if $comment_shakebox_currentuser_votes eq 0}
										<!-- Vote For It -->
										<a class="btn btn-xs btn-default" href="javascript:{$link_shakebox_javascript_votey}"><i class="icon-thumbs-up"></i></a>
									{else}
										<!-- Already Voted -->
										<a class="btn btn-xs btn-success" href="javascript:{$link_shakebox_javascript_unvotey}"><i class="icon-white icon-thumbs-up"></i></a>
									{/if}
									<a id="cvote-{$comment_id}" class="btn btn-default btn-xs comment_vote_count" disabled>{$comment_votes}</a>
									{if $comment_shakebox_currentuser_reports eq 0}
										<!-- Bury It -->
										<a class="btn btn-xs btn-default" href="javascript:{$link_shakebox_javascript_voten}"><i class="icon-thumbs-down"></i></a>
									{else}
										<!-- Already Buried -->
										<a class="btn btn-xs btn-danger" href="javascript:{$link_shakebox_javascript_unvoten}"><i class="icon-white icon-thumbs-down"></i></a>
									{/if}
									
										<li class="commentVoteUp"><a href="#">Vote Up</a></li>
										<li class="commentVoteNum">0</li>
										<li class="commentVoteDown"><a href="#">Vote Down</a></li> *}
						</ul>
						{/if}
					</div>
					<div class="commentContentWrap">
						<div class="commentHeader">
							<header>
								<h4 class="commentAuthor">
									{if $is_anonymous}{#PLIGG_Visual_Comment_Manage_Unregistered#}{/if}
									<a href="{$user_view_url}">{$user_username}</a>
								</h4>
								-
								<time datetime="{$comment_date_timestamp|date_format:"%Y-%m-%d %H:%M:%S"}" class="commentDate">
									{$comment_age} {#PLIGG_Visual_Comment_Ago#}
								</time>
							</header>
							<ul class="commentCtrl clearFix">
								{if $user_logged_in == $user_userlogin || $isadmin eq 1}
									{if $isadmin eq 1}
										<li class="commentCtrlOps">
											<a href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}#comment-{$comment_id}" title="Options" data-toggle="dropdown" data-target="#">Options</a>
											<ul class="dropdownMenu bounce altLinkColor">
												<li><a href="{$my_base_url}{$my_pligg_base}/admin/admin_users.php?mode=view&user={$user_userlogin}" rel="nofollow">{#PLIGG_Visual_Comment_Manage_User#} {$user_userlogin}</a></li>
												<li><a href="{$edit_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Edit#}</a></li>
												<li><a href="{$delete_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Delete#}</a></li>
											</ul>
										</li>
									{elseif $user_logged_in == $user_userlogin}
										<li class="commentCtrlEdit"><a href="{$edit_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Edit#}</a></li>
									{/if}
								{/if}
								<li class="commentCtrlPerm"><a href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}#comment-{$comment_id}" title="Permalink">Permalink</a></li>
								<li class="commentCtrlReply"><a {if $current_userid neq 0}href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}&amp;reply=1#comment-reply-{$comment_id}"{else}href="#" class="loginRequired"{/if} title="Reply To Comment">{#PLIGG_Visual_Comment_Reply#}</a></li>
							</ul>
						</div>
						<div id="commentContent-{$comment_id}" class="commentContent">
							{$comment_content}
						</div>
						<footer>
							<ul class="commentCtrlAlt dropdown clearFix">								
								{if $user_logged_in == $user_userlogin || $isadmin eq 1}
									{if $isadmin eq 1}
										<li class="commentCtrlOps">
											<a href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}#comment-{$comment_id}" title="Options" data-toggle="dropdown" data-target="#">Options</a>
											<ul class="dropdownMenu bounce altLinkColor">
												<li><a href="{$my_base_url}{$my_pligg_base}/admin/admin_users.php?mode=view&user={$user_userlogin}" rel="nofollow">{#PLIGG_Visual_Comment_Manage_User#} {$user_userlogin}</a></li>
												<li><a href="{$edit_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Edit#}</a></li>
												<li><a href="{$delete_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Delete#}</a></li>
											</ul>
										</li>
									{elseif $user_logged_in == $user_userlogin}
										<li class="commentCtrlEdit"><a href="{$edit_comment_url}" rel="nofollow">{#PLIGG_Visual_Comment_Edit#}</a></li>
									{/if}
								{/if}
								<li class="commentCtrlPerm"><a href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}#comment-{$comment_id}" title="Permalink">Permalink</a></li>
								<li class="commentCtrlReply"><a {if $current_userid neq 0}href="{$my_base_url}{$templatelite.server.REQUEST_URI}&amp;comment_id={$comment_id}&amp;reply=1#comment-reply-{$comment_id}"{else}href="#" class="loginRequired"{/if} title="Reply To Comment">{#PLIGG_Visual_Comment_Reply#}</a></li>
							</ul>
						</footer>
					</div>
				</article>
				<div class="child-comment"></div>
				{checkActionsTpl location="tpl_pligg_story_comments_single_end"}