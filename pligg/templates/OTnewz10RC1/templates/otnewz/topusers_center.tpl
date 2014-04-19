	<div id="content" role="main">
		<section>
			<header class="xFolkHeader">
				<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Top_Users#}</h2>
				<ul class="dropdown entrySorter altLinkColor">
					<li>
						<a href="#" id="userSort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
						<ul class="dropdownMenu bounce" role="menu" aria-labelledby="userSort">
							<li class="entrySorterHeader">Sort Top Users By</li>
							<li><a href="#" rel="nofollow">Rank / Karma</a></li>
							<li><a href="#" rel="nofollow">Published</a></li>
							<li><a href="#" rel="nofollow">Username</a></li>
							<li><a href="#" rel="nofollow">Comments</a></li>
							<li><a href="#" rel="nofollow">Submissions</a></li>
							<li><a href="#" rel="nofollow">Total Votes</a></li>
						</ul>
					</li>
				</ul>
			</header>
			<ul class="memberListHeader clearFix">
				<li class="memberListHeaderUser">Rank / User</li>
				<li class="memberListHeaderKarma">Karma</li>
				<li class="memberListHeaderSubmitted">Submissions</li>
				<li class="memberListHeaderPublished">Published</li>
				<li class="memberListHeaderCommented">Comments</li>
			</ul>
			{checkActionsTpl location="tpl_pligg_topusers_start"}
			<ol id="memberList" class="contentBlock">
				{$users_table}
			</ol>
			{checkActionsTpl location="tpl_pligg_topusers_end"}
		</section>
		{checkActionsTpl location="tpl_pligg_pagination_start"}
		{$topusers_pagination}
		{checkActionsTpl location="tpl_pligg_pagination_end"}
	</div>
	<aside id="sidebar" role="complementary">
		{include file=$the_template."/blocks/socialShare.tpl"}
		{include file=$the_template."/blocks/topPublishers.tpl"}
		{include file=$the_template."/blocks/topSubmitters.tpl"}
	</aside>