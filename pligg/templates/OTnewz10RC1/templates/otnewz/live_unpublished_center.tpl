	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Live#} {#PLIGG_Visual_Breadcrumb_Unpublished#}</h2>
		<ul class="dropdown entrySorter altLinkColor">
			<li>
				<a href="{$URL_live}" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
				<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
					<li>Sort By</li>
					<li{if $pagename eq "live"} class="current"{/if}><a href="{$URL_live}" rel="nofollow">{#PLIGG_Visual_Breadcrumb_All#}</a></li>
					<li{if $pagename eq "live_published"} class="current"{/if}><a href="{$URL_published}" rel="nofollow">{#PLIGG_Visual_Breadcrumb_Published_Tab#}</a></li>
					<li{if $pagename eq "live_unpublished"} class="current"{/if}><a href="{$URL_unpublished}" rel="nofollow">{#PLIGG_Visual_Breadcrumb_Unpublished_Tab#}</a></li>
					<li{if $pagename eq "live_comments"} class="current"{/if}><a href="{$URL_comments}" rel="nofollow">{#PLIGG_Visual_Breadcrumb_Comments#}</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="contentBlock">
		<div class="responsiveTable">
			<table id="live">
				<thead>
					<tr>
						<th class="liveTime">{#PLIGG_Visual_Comments_Date#}</th>
						<th class="liveUser">{#PLIGG_Visual_Comments_Author#}</th>
						<th class="liveVotes">{#PLIGG_Visual_Breadcrumb_Vote#}</th>
						<th class="liveStory">{#PLIGG_Visual_Comments_Link#}</th>
					</tr>
				</thead>
				<tbody>				
				{section name=live_item loop=$live_items}
					<tr>
						<td class="liveTime">{$live_items[live_item].link_date}</td>
						<td class="liveUser"><a href="{$URL_user, $live_items[live_item].link_username}">{$live_items[live_item].link_username}</a></td>
						<td class="liveVotes">{$live_items[live_item].link_votes}</td>
						<td class="liveStory"><a href="{$live_items[live_item].link_url}">{$live_items[live_item].link_title}</a></td>
					</tr>
				{/section}
				</tbody>
			</table>			
		</div>
	</div>
	{checkActionsTpl location="tpl_pligg_pagination_start"}
	{$live_pagination}
	{checkActionsTpl location="tpl_pligg_pagination_end"}