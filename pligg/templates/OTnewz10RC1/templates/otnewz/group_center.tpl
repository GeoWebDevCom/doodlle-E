	{if $enable_group eq "true"}
		<section id="groups">
			<header class="xFolkHeader">
				<h2 class="xFolkHeaderTitle">Groups</h2>
				<ul class="dropdown entrySorter altLinkColor">
					<li>
						<a href="{$URL_groups}" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
						<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
							<li>Sort Groups By</li>							
							<li{if $sortby eq "members"} class="current"{/if}><a href="{$group_url_members}" rel="nofollow">{#PLIGG_Visual_Group_Sort_Members#}</a></li>						
							<li {if $sortby eq "name"} class="current"{/if}><a href="{$group_url_name}" rel="nofollow">{#PLIGG_Visual_Group_Sort_Name#}</a></li>
							<li {if $sortby eq "newest"} class="current"{/if}><a href="{$group_url_newest}" rel="nofollow">{#PLIGG_Visual_Group_Sort_Newest#}</a></li>
							<li {if $sortby eq "oldest"} class="current"{/if}><a href="{$group_url_oldest}" rel="nofollow">{#PLIGG_Visual_Group_Sort_Oldest#}</a></li>
						</ul>
					</li>
				</ul>
			</header>
			<p class="groupsIntro">
				{#PLIGG_Visual_Group_Explain#}
				{if $group_allow eq "1"}
					<span class="dBlock groupsButton"><a href="{$URL_submit_groups}" rel="nofollow" class="button buttonInput buttonAction">{#PLIGG_Visual_Submit_A_New_Group#}</a></span>
				{/if}
			</p>
			{$group_display}
		</section>
		{$group_pagination}
	{else}
		<script>{literal}window.location="{/literal}{$my_base_url}{$my_pligg_base}/{literal}";{/literal}</script>
	{/if}