<article id="contentWrap" class="pageWrap">
	<div id="content" role="main">
		<div class="xFolkHeader"><p class="xFolkHeaderTitle">Story Details</p></div>
		{$the_story}
			{checkActionsTpl location="tpl_pligg_story_comments_start"}
			{if $story_comment_count gte 1}
				<section id="commentsList">
					<h3 class="commentsListHeader">{$story_comment_count} {#PLIGG_Visual_Story_Comments#}</h3>
					{checkActionsTpl location="tpl_pligg_story_comments_individual_start"}
					{$the_comments}
					{checkActionsTpl location="tpl_pligg_story_comments_individual_end"}
				</section>
			{/if}
			{if $user_authenticated neq ""}
				{include file=$the_template."/comment_form.tpl"}
			{else}
				{checkActionsTpl location="anonymous_comment_form_start"}
				<section id="commentsAdd">
					<h3 class="commentsListHeader">{#PLIGG_Visual_Comment_Send#}</h3>
					<div class="padTop20">
						<a href="{$login_url}" rel="nofollow" class="loginRequired">{#PLIGG_Visual_Story_LoginToComment#}</a>
						{#PLIGG_Visual_Story_Register#}
						<a href="{$register_url}" rel="nofollow">{#PLIGG_Visual_Story_RegisterHere#}</a></div>
				</section>
				{checkActionsTpl location="anonymous_comment_form_end"}
			{/if}
			{checkActionsTpl location="tpl_pligg_story_comments_end"}
		</div>
	</div>
	<div id="sidebar" role="complementary">
		<div id="voters" class="sidebarUsers sidebarTab">
			<h3 class="sidebarBlockHeader">{#PLIGG_Visual_Story_WhoVoted#}</h3>
			<div class="sidebarTabPanel">
			{if count($voter) neq 0}
				<ul id="votersUp" class="sidebarUsersList">
					{checkActionsTpl location="tpl_pligg_story_who_voted_start"}
					{section name=upvote loop=$voter}
						<li>
							<a href="{$URL_user, $voter[upvote].user_login}" title="View {$voter[upvote].user_login}'s Profile"><img src="{$voter[upvote].Avatar_ImgSrc}" alt="{$voter[upvote].user_login} Avatar" /></a>
						</li>
					{/section}
					{checkActionsTpl location="tpl_pligg_story_who_voted_end"}
				</ul>
			{/if}
			</div>
		</div>
		{if count($downvoter) neq 0}
		<div id="downvoters" class="sidebarUsers sidebarTab">
			<h3 class="sidebarBlockHeader">{#PLIGG_Visual_Story_Who_Downvoted_Story#}</h3>
			<div class="sidebarTabPanel">
				<ul id="votersUp" class="sidebarUsersList">
					{checkActionsTpl location="tpl_pligg_story_who_downvoted_start"}
					{section name=downvote loop=$downvoter}
						<li>
							<a href="{$URL_user, $downvoter[downvote].user_login}" title="View {$downvoter[downvote].user_login}'s Profile"><img src="{$downvoter[downvote].Avatar_ImgSrc}" alt="{$downvoter[downvote].user_login} Avatar" /></a>
						</li>
					{/section}
					{checkActionsTpl location="tpl_pligg_story_who_downvoted_end"}
				</ul>
			</div>
		</div>
		{/if}			
		{if count($related_story) neq 0}
		<div id="relatedLinks" class="newEntries sidebarBlock">
			<h3 class="sidebarBlockHeader">{#PLIGG_Visual_Story_RelatedStory#}</h3>
			<ul class="sidebarBlockContent sidebarList altLinkColor">
				{checkActionsTpl location="tpl_pligg_story_related_start"}
				{if count($related_story) > 10}{assign var="related_count" value="10"}{else}{assign var="related_count" value=$related_story}{/if}
				{section name=related loop=$related_count}
					<li><a href="{$related_story[related].url}">{$related_story[related].link_title}</a></li> 
				{/section}
				{checkActionsTpl location="tpl_pligg_story_related_end"}
			</ul>
		</div>
		{/if}
	</div>
	{checkActionsTpl location="tpl_pligg_story_tab_end_content"}
</article>

