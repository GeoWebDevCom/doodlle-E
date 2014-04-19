<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic|Oswald" />
{strip}
<link rel="stylesheet" href="{$my_pligg_base}/templates/{$the_template}/assets/min/g=common,
{if $pagename eq "index" || $pagename eq "published" || $pagename eq "new" || $pagename eq "story" || $pagename eq "search"}
	links,
{elseif $pagename eq "register" || $pagename eq "login" || $pagename eq "recover" || $pagename eq "submit" || $pagename eq "editlink" || $pagename eq "submit_groups" || $pagename eq "editgroup" || $pagename eq "advancedsearch"}
	forms,
{elseif $pagename eq "topusers"}
	members,
{elseif $pagename eq "groups"}
	groups,
{elseif $pagename eq "group_story"}
	links,groups,
{elseif $pagename eq "live" || $pagename eq "live_published" || $pagename eq "live_unpublished" || $pagename eq " live_comments"}
	live,
{elseif $pagename eq "user"}
	links,profile,
{elseif $pagename eq "user_edit"}
	forms,profile,
{elseif $pagename eq "rssfeeds"}
	rss,
{elseif $pagename eq "page"}
	pages,
{else}
	misc,
{/if}
{if $pagename eq "index" && count($templatelite.get) == 0}
	OTslider,
{/if}
modules,sidebar,footer,custom,themeDefault,helper,print" />
{/strip}	
<!--[if IE 8]>
<link rel="stylesheet" href="{$my_pligg_base}/templates/{$the_template}/assets/styles/OTnewzIE8.css" />
<link rel="stylesheet" href="{$my_pligg_base}/templates/{$the_template}/assets/styles/OTnewzThemeDefaultIE8.css" />
<![endif]-->