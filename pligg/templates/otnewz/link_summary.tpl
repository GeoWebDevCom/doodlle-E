			{checkActionsTpl location="tpl_link_summary_start"}
			<{if $pagename eq "story"}div{else}article{/if} id="xfolkentry-{$link_id}" class="xfolkentry{if $pagename eq "group_story"} xfolkentryGroups{/if}{if $pagename eq "user"} xfolkentryProfile{/if}">
				<div class="xfolkentryThumb">
					<a href="{$url}" rel="nofollow" data-xfolkentry-url="{$story_url}" class="embedModalTrigger"></a>
				</div>
				<header class="xfolkentryHeader">
					<h2 class="xfolkentryTitle">
						{checkActionsTpl location="tpl_pligg_story_title_start"}
						{if $use_title_as_link eq true}
							{if $url_short neq "http://" && $url_short neq "://"}
								<a href="{$url}"{if $open_in_new_window eq true} target="_blank"{/if}{if $story_status neq "published"} rel="nofollow"{/if}>{$title_short}</a>
							{else}
								<a href="{$story_url}"{if $open_in_new_window eq true} target="_blank"{/if}>{$title_short}</a>
							{/if}
						 {else}
							{if $pagename eq "story" && $url_short neq "http://" && $url_short neq "://"}
								<a href="{$url}"{if $open_in_new_window eq true} target="_blank"{/if}{if $story_status neq "published"} rel="nofollow"{/if}>{$title_short}</a>
							{else}
								<a href="{$story_url}">{$title_short}</a>
							{/if}
						{/if}
						{checkActionsTpl location="tpl_pligg_story_title_end"}
					</h2>
					<p class="xfolkentryHeaderMeta">
						<span class="xfolkentrySubmitter"><a href="{$submitter_profile_url}">{$link_submitter}</a></span>
						{if $story_status eq "published"}
							<time datetime="{$link_published_time|date_format:"%Y-%m-%d %H:%M:%S"}" class="xfolkentryTime capitalize">{$link_submit_timeago} {#PLIGG_Visual_Comment_Ago#}</time>
						{else}
							<span class="xfolkentryTime capitalize">{$link_submit_timeago} {#PLIGG_Visual_Comment_Ago#}</span>
						{/if}
						<span class="xfolkentryCats">
							on <a href="{$category_url}"{if $story_status neq "published"} rel="nofollow"{/if}>{$link_category}</a>
							{if $link_additional_cats}
								{foreach from=$link_additional_cats item=catname key=caturl}
									<a href="{$caturl}"{if $story_status neq "published"} rel="nofollow"{/if}>{$catname}</a>
								{/foreach}
							{/if}
						</span>
					</p>
				</header>
				<div class="description xfolkentryDesc">
					{checkActionsTpl location="tpl_pligg_story_start"}
					{checkActionsTpl location="tpl_link_summary_pre_story_content"}
					{if $pagename eq "story"}
						{checkActionsTpl location="tpl_pligg_story_body_start_full"}
					{else}
						{checkActionsTpl location="tpl_pligg_story_body_start"}
					{/if}
					{if $viewtype neq "short"}
						{if $url_short neq "http://" && $url_short neq "://"}
							<a href="{$url}"  class="taggedlink"{if $open_in_new_window eq true} target="_blank"{/if}{if $story_status neq "published"} rel="nofollow"{/if}>{$url_short}</a> -
						{/if}
						{if $show_content neq 'FALSE'}
							{if $pagename eq "story"}
								{$story_content|nl2br}
							{else}
								{$story_content|nl2br}
							{/if}
						{/if}
					{/if}
					{if $pagename eq "story"}
						{checkActionsTpl location="tpl_pligg_story_body_end_full"}
					{else}
						{checkActionsTpl location="tpl_pligg_story_body_end"}
					{/if}
				</div>
				{include file=$the_template"/blocks/entryShare.tpl"}
				<ul id="xfolkentryVote-{$link_id}" class="xfolkentryVote altLinkColor clearFix">
					{checkActionsTpl location="tpl_pligg_story_votebox_start"}
					{if $anonymous_vote eq "false" and $user_logged_in eq ""}
						<li class="xfolkentryVoteLike"><a href="#modalLogin" title="Vote Up" class="loginRequired">{#PLIGG_Visual_Vote_For_It#}</a></li>
						<li class="xfolkentryVoteNum"><a href="{$story_url}#votersLink">{$link_shakebox_votes}</a></li>
						<li class="xfolkentryVoteDislike"><a href="#modalLogin" title="Vote Down" class="loginRequired">{#PLIGG_Visual_Vote_Bury#}</a></li>
					{else}
						{if $link_shakebox_currentuser_votes eq 0}
							<li id="xfolkentryVoteLike-{$link_id}" class="xfolkentryVoteLike">
								<a href="{if $vote_from_this_ip neq 0 and $user_logged_in eq ""}#modalLogin{else}javascript:{$link_shakebox_javascript_vote}{/if}"{if $vote_from_this_ip neq 0 and $user_logged_in eq ""} class="loginRequired"{/if} title="{#PLIGG_Visual_Vote_For_It#}">{#PLIGG_Visual_Vote_For_It#}</a>
							</li>
						{elseif $link_shakebox_currentuser_votes eq 1}
							<li id="xfolkentryVoteLike-{$link_id}" class="xfolkentryVoteLike">
								<a href="javascript:{$link_shakebox_javascript_unvote}" class="xfolkentryVoted" title="{#PLIGG_Visual_Unvote_For_It#}">{#PLIGG_Visual_Unvote_For_It#}</a>
							</li>
						{/if}
						<li id="xfolkentryVoteNum-{$link_id}" class="xfolkentryVoteNum"><a href="{$story_url}#voters">{$link_shakebox_votes}</a></li>
						{if $link_shakebox_currentuser_reports eq 0}
							<li id="xfolkentryVoteDislike-{$link_id}" class="xfolkentryVoteDislike">
								<a href="{if $report_from_this_ip neq 0 and $user_logged_in eq ""}#modalLogin{else}javascript:{$link_shakebox_javascript_report}{/if}"{if $report_from_this_ip neq 0 and $user_logged_in eq ""} class="loginRequired"{/if} title="{#PLIGG_Visual_Vote_Bury#}">{#PLIGG_Visual_Vote_Bury#}</a>
							</li>
						{elseif $link_shakebox_currentuser_reports eq 1}
							<li id="xfolkentryVoteDislike-{$link_id}" class="xfolkentryVoteDislike">
								<a href="javascript:{$link_shakebox_javascript_unbury}" title="Unbury" class="xfolkentryBuried">Unbury</a>
							</li>
						{/if}
					{/if}
					{checkActionsTpl location="tpl_pligg_story_votebox_end"}
				</ul>
				<footer class="{if $user_logged_in eq $link_submitter || $isadmin}xfolkentryCtrlAlt{else}xfolkentryCtrl{/if}">
					<ul class="clearFix">
						{if $isadmin}
							{checkActionsTpl location="tpl_link_summary_admin_links"}
							<li class="xfolkentryCtrlOptions dropdown">
								<a href="{$story_url}" data-toggle="dropdown" data-target="#">Article Options</a>
								<ul class="dropdownMenu altLinkColor">
									<li><a href="{$story_edit_url}" rel="nofollow">{#PLIGG_Visual_LS_Admin_Edit#}</a></li>
									<li><a href="{$story_admin_url}" rel="nofollow">{#PLIGG_Visual_LS_Admin_Status#}</a>
									<li><a href="{$my_base_url}{$my_pligg_base}/admin/admin_users.php?mode=view&user={$link_submitter}" rel="nofollow">{#PLIGG_Visual_Comment_Manage_User#} {$link_submitter}</a>
									<li><a href="{$my_pligg_base}/admin/admin_users.php?mode=killspam&user={$link_submitter}" rel="nofollow">{#PLIGG_Visual_View_User_Killspam#}</a>
									<li><a href="{$my_pligg_base}/delete.php?link_id={$link_id}" rel="nofollow">{#PLIGG_Visual_AdminPanel_Discard#}</a>
								</ul>
							</li>
						{elseif $user_logged_in eq $link_submitter}
							<li class="xfolkentryCtrlEdit"><a href="{$story_edit_url}" rel="nofollow">{#PLIGG_Visual_LS_Admin_Edit#}</a></li>
						{/if}
						{checkActionsTpl location="tpl_pligg_story_tools_start"}
						<li class="xfolkentryCtrlDiscuss">
							{if $pagename eq "story"}
								<a href="{$story_url}#commentsAdd">Add Comment</a>
							{else}
								{if $story_comment_count eq 0}
									<a href="{$story_url}#commentsAdd">{#PLIGG_MiscWords_Discuss#}</a>
								{/if}
								{if $story_comment_count eq 1}
									<a href="{$story_url}#commentsList">{$story_comment_count} {#PLIGG_MiscWords_Comment#}</a>
								{/if}
								{if $story_comment_count gt 1}
									<a href="{$story_url}#commentsList">{$story_comment_count} {#PLIGG_MiscWords_Comments#}</a>
								{/if}
							{/if}
						</li>
						<li class="xfolkentryCtrlShare"><a href="#xfolkentryShare-{$link_id}" data-share-popup="xfolkentryShare-{$link_id}">Share</a></li>
						<li class="xfolkentryCtrlSave">
							{if $user_logged_in}  
								{if $link_mine eq 0}
									<a href="#" data-bookmark-action="add" data-bookmark-id="{$link_id}" class="xfolkentryCtrlBmrk">{#PLIGG_MiscWords_Save_Links_Save#}</a>
								{else}
									<a href="#" data-bookmark-action="remove" data-bookmark-id="{$link_id}" class="xfolkentryCtrlBmrk">{#PLIGG_MiscWords_Save_Links_Remove#}</a>
								{/if}
							{else}
								<a href="#" data-entry-bookmark-id="{$link_id}" class="loginRequired">{#PLIGG_MiscWords_Save_Links_Save#}</a>
							{/if}
						</li>
					</ul>
				</footer>
				{checkActionsTpl location="tpl_pligg_story_end"}
			{if $pagename neq "story"}</article>{/if}
			{checkActionsTpl location="tpl_link_summary_end"}