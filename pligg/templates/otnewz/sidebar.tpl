		<h2 id="sidebarHeading" class="hidden">Sidebar Content</h2>
		{include file=$the_template."/blocks/socialShare.tpl"}
		{if $pagename neq "user" && $pagename neq "user_edit"}
			{include file=$the_template."/blocks/searchBox.tpl"}
		{/if}
		{include file=$the_template."/blocks/sidebarTopUsers.tpl"}
		{checkActionsTpl location="tpl_pligg_sidebar_start"}
		{checkActionsTpl location="tpl_pligg_sidebar_end"}
		{checkActionsTpl location="tpl_pligg_sidebar2_start"}
		{checkActionsTpl location="widget_sidebar"}
		{checkActionsTpl location="tpl_pligg_sidebar2_end"}