<nav id="navCategories" role="navigation" class="pageWrap" aria-labelledby="navCatsHeading">
	<h2 id="navCatsHeading" class="navCatsHeader">Categories</h2>
	<ul class="dropFish navCats">
		{checkActionsTpl location="tpl_widget_categories_start"}
		{section name=thecat loop=$cat_array}
			{if $cat_array[thecat].auto_id neq 0}
				{if $cat_array[thecat].spacercount < $submit_lastspacer}
					{$cat_array[thecat].spacerdiff|repeat_count:'</ul></li>'}
				{/if}
				{if $cat_array[thecat].spacercount > $submit_lastspacer}
					<ul>
				{/if}
				<li{if $cat_array[thecat].principlecat neq 0} class="navCatsParent"{/if}>
					<a href="{if $pagename eq "new" || $groupview eq "new"}{$URL_newcategory, $cat_array[thecat].safename}{else}{$URL_maincategory, $cat_array[thecat].safename}{/if}{if $urlmethod==2}/{/if}"{if $pagename eq "new"} rel="nofollow"{/if}>
						{$cat_array[thecat].name}
					</a>
				{if $cat_array[thecat].principlecat eq 0}
					</li>
				{/if}
				{assign var=submit_lastspacer value=$cat_array[thecat].spacercount}
			{/if}
		{/section}
		{if $cat_array[thecat].spacercount < $submit_lastspacer}{$lastspacer|repeat_count:'</ul></li>'}{/if}
		{checkActionsTpl location="tpl_widget_categories_end"}
	</ul>
</nav>