		<section id="xFolfEntries">
			<header class="xFolkHeader">
				<h2 class="xFolkHeaderTitle">New{if $request_category} / {$request_category}{/if}</h2>
				<ul class="dropdown entrySorter altLinkColor">
					<li>
						<a href="{$URL_new}" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
						<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
							<li>Sort {#PLIGG_Visual_Pligg_Queued#} News By</li>
							<li{if $setmeka eq "" || $setmeka eq "recent"} class="current"{/if}><a href="{$index_url_recent}">{#PLIGG_Visual_Recently_Pop#}</a></li>
							<li{if $setmeka eq "yesterday"} class="current"{/if}><a href="{$index_url_yesterday}" rel="nofollow">{#PLIGG_Visual_Yesterday#}</a></li>
							<li{if $setmeka eq "upvoted"} class="current"{/if}><a href="{$index_url_upvoted}" rel="nofollow">Most {#PLIGG_Visual_UpVoted#}</a></li>
							<li{if $setmeka eq "week"} class="current"{/if}><a href="{$index_url_week}" rel="nofollow">{#PLIGG_Visual_This_Week#}</a></li>
							<li{if $setmeka eq "downvoted"} class="current"{/if}><a href="{$index_url_downvoted}" rel="nofollow">Most {#PLIGG_Visual_DownVoted#}</a></li>
							<li{if $setmeka eq "month"} class="current"{/if}><a href="{$index_url_month}" rel="nofollow">{#PLIGG_Visual_This_Month#}</a></li>
							<li{if $setmeka eq "commented"} class="current"{/if}><a href="{$index_url_commented}" rel="nofollow">Most {#PLIGG_Visual_User_NewsCommented#}</a></li>
							<li{if $setmeka eq "year"} class="current"{/if}><a href="{$index_url_year}" rel="nofollow">{#PLIGG_Visual_This_Year#}</a></li>
							<li{if $setmeka eq "today"} class="current"{/if}><a href="{$index_url_today}" rel="nofollow">{#PLIGG_Visual_Top_Today#}</a></li>
							<li{if $setmeka eq "alltime"} class="current"{/if}><a href="{$index_url_alltime}" rel="nofollow">{#PLIGG_Visual_This_All#}</a></li>
						</ul>
					</li>
				</ul>
			</header>
			{$link_summary_output}
		</section>
		{checkActionsTpl location="tpl_pligg_pagination_start"}
		{$link_pagination}
		{checkActionsTpl location="tpl_pligg_pagination_end"}