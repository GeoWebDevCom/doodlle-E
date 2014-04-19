	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Tags#}</h2>
		<ul class="dropdown entrySorter altLinkColor">
			<li>
				<a href="{$URL_tagcloud}" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
				<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
					<li>Sort By</li>
					{section name=i start=0 loop=$count_range_values step=1}
						{if $templatelite.section.i.index eq $current_range}
							<li class="current"><a href="#">{$range_names[i]}</a></li>
						{else}	
							<li><a href="{$URL_tagcloud_range, $templatelite.section.i.index}">{$range_names[i]}</a></li>
						{/if}
					{/section}
				</ul>
			</li>
		</ul>
	</div>
	<div id="tagCloud" class="contentBlock contentBlockSpace" style="line-height:{$tags_max_pts}px;">
		{section name=customer loop=$tag_number}
			<span style="font-size: {$tag_size[customer]|number_format:"0":"":""}px"><a href="{$tag_url[customer]}">{$tag_name[customer]}</a></span>
			&nbsp;
		{/section}	
	</div>