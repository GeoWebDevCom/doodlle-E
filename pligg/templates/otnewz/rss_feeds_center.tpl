		<div class="xFolkHeader"><h2 class="xFolkHeaderTitle">RSS Feeds</h2></div>
		<ul id="rssFeeds">
			{section name=thecat loop=$cat_array}
				{if $lastspacer eq ""}
					{assign var=lastspacer value=$cat_array[thecat].spacercount}
				{/if}
				<li>
					<h3 class="rssFeedsCat"><a href="{$URL_rsscategory, $cat_array[thecat].auto_id}" target="_blank">{$cat_array[thecat].name}</a></h3>
					<span class="rssFeedsLinks"><input type="text" value="{$my_base_url}{$URL_rsscategory, $cat_array[thecat].auto_id}" readonly="readonly" /></span>
				</li>
				{assign var=lastspacer value=$cat_array[thecat].spacercount}
			{/section}
		</ul>