		<section id="xFolfEntries">
			<header class="xFolkHeader">
				<h2 class="xFolkHeaderTitle">
					{if $pagename eq "noresults"}
						{$posttitle}
					{elseif isset($get.search)}
						{#PLIGG_Visual_Search_SearchResults#} &quot;<span class="lowerize">{if $get.search}{$get.search}{else}{$get.date}{/if}</span>&quot;
					{/if}
					{if isset($get.q)}{#PLIGG_Visual_Search_SearchResults#} &quot;<span class="lowerize">{$get.q}</span> sds dfsadfsdf&quot;{/if}
				</h2>
				<ul class="dropdown entrySorter altLinkColor">
					<li>
						<a href="{$my_base_url}{$my_pligg_base}" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
						<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
							<li>Sort Published News By</li>
							<li{if $setmeka eq "" || $setmeka eq "recent"} class="current"{/if}><a href="{$index_url_recent}" rel="nofollow">{#PLIGG_Visual_Recently_Pop#}</a></li>
							<li{if $setmeka eq "upvoted"} class="current"{/if}><a href="{$index_url_upvoted}" rel="nofollow">Most {#PLIGG_Visual_UpVoted#}</a></li>
							<li{if $setmeka eq "downvoted"} class="current"{/if}><a href="{$index_url_downvoted}" rel="nofollow">Most {#PLIGG_Visual_DownVoted#}</a></li>
							<li{if $setmeka eq "commented"} class="current"{/if}><a href="{$index_url_commented}" rel="nofollow">Most {#PLIGG_Visual_User_NewsCommented#}</a></li>
						</ul>
					</li>
				</ul>
			</header>
			{$link_summary_output}
		</section>
		{checkActionsTpl location="tpl_pligg_pagination_start"}
		{$link_pagination}
		{checkActionsTpl location="tpl_pligg_pagination_end"}