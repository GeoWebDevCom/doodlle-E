	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Live#}</h2>
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
						<th class="liveTime">{#PLIGG_Visual_All_Hour#}</th>
						<th class="liveAction">{#PLIGG_Visual_All_Action#}</th>
						<th class="liveVotes">{#PLIGG_Visual_All_Votes#}</th>
						<th class="liveStory">{#PLIGG_Visual_All_Story#}</th>
						<th class="liveUser">{#PLIGG_Visual_All_User#}</th>
						<th class="liveState">{#PLIGG_Visual_All_State#}</th>
					</tr>
				</thead>
				<tbody>
					{section name=foo start=0 loop=$items_to_show step=1}
						<tr id="live2-{$templatelite.section.foo.index}"></tr>
					{/section}
				</tbody>
			</table>		
		</div>
	</div>