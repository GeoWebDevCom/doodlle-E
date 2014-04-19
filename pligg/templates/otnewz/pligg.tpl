<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
{include file=$the_template"/title.tpl"}
{include file=$the_template"/metaLinkRel.tpl"}
{include file=$the_template"/stylesheet.tpl"}
{checkForCss}
<!--[if lt IE 9]><script src="{$my_pligg_base}/templates/{$the_template}/assets/scripts/HTML5Shiv.js"></script><![endif]-->
<script src="{$my_pligg_base}/templates/{$the_template}/assets/scripts/cssUA.js"></script>
{checkActionsTpl location="tpl_pligg_head_start"}
{checkForJs}
{checkActionsTpl location="tpl_pligg_head_end"}
</head>
<body id="{$pagename}Page" {$body_args} {checkActionsTpl location="tpl_pligg_body_onload"}>
{checkActionsTpl location="tpl_pligg_body_start"}
{include file=$tpl_header.".tpl"}
{if $pagename neq "login" && $pagename neq "register" && $pagename neq "register_complete" && $pagename neq "validation" && $pagename neq "submit" && $pagename neq "editlink" && $pagename neq "user" && $pagename neq "user_edit" && $pagename neq "profile" && $pagename neq "topusers" && $pagename neq "rssfeeds"}
	{include file=$the_template."/categories.tpl"}
{/if}
{checkActionsTpl location="tpl_pligg_banner_top"}
{checkActionsTpl location="tpl_pligg_content_start"}
{checkActionsTpl location="tpl_pligg_above_center"}
{checkActionsTpl location="tpl_pligg_columns_start"}
{if $pagename eq "story" || $pagename eq "edit"}
	{include file=$tpl_center.".tpl"}
{elseif $pagename eq "register" || $pagename eq "submit" || $pagename eq "editlink" || $pagename eq "live" || $pagename eq "live_published" || $pagename eq "live_unpublished" || $pagename eq "live_comments" || $pagename eq "topusers" || $pagename eq "error_404"}
	<div id="contentWrap" class="pageWrap">
		{include file=$tpl_center.".tpl"}
	</div>
{elseif $pagename eq "login" || $pagename eq "recover"}
	{include file=$tpl_center.".tpl"}
{else}
	<div id="contentWrap" class="pageWrap">
		<div id="content" role="main">
			{if $pagename eq "index" && count($templatelite.get) == 0}
				{$otSlider}
			{/if}
			{include file=$tpl_center.".tpl"}
		</div>
		<aside id="sidebar" role="complementary">
			{include file=$tpl_first_sidebar.".tpl"}
		</aside>
	</div>
{/if}
{checkActionsTpl location="tpl_pligg_columns_end"}
{checkActionsTpl location="tpl_pligg_below_center"}
{checkActionsTpl location="tpl_pligg_content_end"}
{checkActionsTpl location="tpl_pligg_banner_bottom"}
{include file=$tpl_footer.".tpl"}
{if $user_authenticated neq true && $pagename neq 'login'}
	{include file=$the_template"/blocks/modalLogin.tpl"}
{/if}
<div id="embedModal"><span class="embedModalClose"></span></div>
{checkActionsTpl location="tpl_pligg_body_end"}
<script>
{literal}
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]= function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;e=o.createElement(i);r=o.getElementsByTagName(i)[0];e.src='//www.google-analytics.com/analytics.js';r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X');ga('send','pageview');
{/literal}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{$my_pligg_base}/templates/{$the_template}/assets/scripts/jQuery.1.10.2.js"><\/script>')</script>
<script src="{$my_pligg_base}/templates/{$the_template}/assets/min/g=commonJS,embedJS,OTsliderJS"></script>
{if ($anonymous_vote eq "false" && $user_authenticated eq true) || $user_authenticated eq true}{include file=$the_template"/assets/scripts/PliggJS.tpl"}{/if}
{include file=$the_template"/assets/scripts/OTnewzJS.tpl"}
{if $pagename eq "live"}{include file=$the_template"/assets/scripts/PliggLiveJS.tpl"}{/if}
</body>
</html>