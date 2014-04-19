{if $meta_description neq ""}
	<meta name="description" content="{$meta_description|truncate:"300"}" />
{elseif $pagename eq "search"}
	<meta name="description" content="{#PLIGG_Visual_Search_SearchResults#} {$templatelite.get.search|sanitize:2|stripslashes}" />
{else}
	<meta name="description" content="{#PLIGG_Visual_What_Is_Pligg_Text#|htmlentities}" />
{/if}
{if $meta_keywords neq ""}
	<meta name="keywords" content="{$meta_keywords}" />
{elseif $pagename eq "search"}
	<meta name="keywords" content="{$templatelite.get.search|sanitize:2|stripslashes}" />
{else}
	<meta name="keywords" content="{#PLIGG_Visual_Meta_Keywords#}" />
{/if}
{if $pagename eq "submit" || $pagename eq "editlink" || $pagename eq "register" || $pagename eq "register_complete" || $pagename eq "validation" || $pagename eq "login" || $pagename eq "404" || $pagename eq "noresults" || $pagename eq "advancedsearch" || ($pagename eq "user" && $user_view eq "addfriend") || ($pagename eq "user" && $user_view eq "removefriend") || $pagename eq "module"}
	<meta name="robots" content="noindex" />
{/if}
{if $pagename eq "new" || $pagename eq "search" || ($pagename eq "user" && $user_view eq "history") || ($pagename eq "user" && $user_view eq "shaken") || ($pagename eq "user" && $user_view eq "voted") || ($pagename eq "user" && $user_view eq "saved")}
	<meta name="robots" content="noindex, nofollow" />
{/if}
<meta name="viewport" content="width=device-width, initial-scale=1" />
{if $pagename eq "index" && count($templatelite.get) == 0}
	<meta property="og:title" content="{#PLIGG_Visual_Name#} - {#PLIGG_Visual_RSS_Description#}" />
	<meta property="og:description" content="{#PLIGG_Visual_What_Is_Pligg_Text#|htmlentities}" />
	<meta property="og:image" content="{$my_base_url}{$my_pligg_base}/templates/{$the_template}/assets/images/logo.png" />
	<meta property="og:url" content="{$my_base_url}{$my_pligg_base}" />
{/if}
<link rel="home" href="{$my_base_url}{$my_pligg_base}/" />
{if $pagename eq 'index'}
	<link rel="canonical" href="{if $get.page>1}{$my_base_url}{$my_pligg_base}/?page={$get.page}{else}{$my_base_url}{$my_pligg_base}/{/if}" />
{/if}
{if $pagename eq 'published'}
	<link rel="canonical" href="{$my_base_url}{$my_pligg_base}/{if $urlmethod==2}{if $get.page>1}{$request_category}/page/2/{else}{$request_category}/{/if}{else}{if $get.page>1}?page={$get.page}&amp;category={$request_category}{else}?category={$request_category}{/if}{/if}" />
{/if}
{if $pagename eq 'story'}
	<link rel="canonical" href="{$my_base_url}{$navbar_where.link2}" />
{/if}
{if $pagename eq 'user' && $user_view eq 'profile'}
	<link rel="canonical" href="{$my_base_url}{$user_url_personal_data}" />
{/if}
{if $pagename eq 'user' && $user_view eq 'published'}
	{if !$get.page || $get.page eq 1}
		<link rel="canonical" href="{$my_base_url}{$user_url_news_published}" />
	{else}
		<link rel="canonical" href="{$my_base_url}{$URL_userNoVar}?page={$get.page}&amp;login={$user_username}&amp;view=published" />
	{/if}
{/if}
{if $pagename eq 'topusers'}
	{if !$get.page || $get.page eq 1}
		<link rel="canonical" href="{$my_base_url}{$URL_topusers}" />
	{else}
		<link rel="canonical" href="{$my_base_url}{$URL_topusers}?page={$get.page}" />
	{/if}
{/if}
<link rel="alternate" type="application/rss+xml" href="{$my_base_url}{$my_pligg_base}/rss.php" title="{#PLIGG_Visual_Name#} RSS" />