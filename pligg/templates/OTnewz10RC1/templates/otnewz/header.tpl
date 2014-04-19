<header id="header" role="banner">
	<div class="pageWrap">
		<h1 id="logo"><a href="{$my_base_url}{$my_pligg_base}" rel="home"><img src="{$my_pligg_base}/templates/{$the_template}/assets/images/logo.png" alt="{#PLIGG_Visual_Name#}" /></a></h1>
		{if $user_authenticated neq true}
			<ul id="navAcct">
				<li class="navAcctLogin"><a href="{$URL_login}" rel="nofollow">{#PLIGG_Visual_Login_LoginButton#}</a></li>
				<li class="navAcctRegister"><a href="{$URL_register}" rel="nofollow">{#PLIGG_Visual_Register#}</a></li>
			</ul>
		{/if}
		{if $user_authenticated eq true}
			<ul class="dropdown" id="navAcctMenu">
				<li>
					<a href="{$URL_userNoVar}" id="acctMenu" data-toggle="dropdown" data-target="#" class="dropdown-toggle"><span class="navAcctHello">Howdy,</span> {$user_logged_in}</a>
					<ul class="dropdownMenu altLinkColor" role="menu" aria-labelledby="acctMenu">
						{checkActionsTpl location="tpl_pligg_profile_sort_start"}
						<li><a href="{$URL_userNoVar}">{#PLIGG_Visual_Profile#}</a></li>
						<li><a href="{$user_url_news_sent}">{#PLIGG_Visual_User_NewsSent#}</a></li>
						{if check_for_enabled_module('simple_messaging',2.2)}
							<li><a href="{$URL_simple_messaging_inbox}" rel="nofollow">Messaging</a></li>
						{else}
							<li><a href="javascript://" onclick="alert('Simple Messaging is currently disabled!'); return false;">Messaging</a></li>
						{/if}
						<li><a href="{$user_url_commented}">{#PLIGG_Visual_User_NewsCommented#}</a></li>
						<li><a href="{$URL_Profile}" rel="nofollow">{#PLIGG_Visual_User_Setting#}</a></li>
						<li><a href="{$user_url_news_upvoted}">{#PLIGG_Visual_UpVoted#}</a></li>
						{if $Allow_Friends}
							<li><a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a></li>
						{/if}
						<li><a href="{$user_url_news_downvoted}">{#PLIGG_Visual_DownVoted#}</a></li>
						{if $Allow_Friends}
							<li><a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_Your_Friends#}</a></li>
						{/if}
						<li><a href="{$user_url_saved}">{#PLIGG_Visual_User_NewsSaved#}</a></li>
						<li><a href="{$URL_logout}" rel="nofollow">{#PLIGG_Visual_Logout#}</a></li>
						{checkActionsTpl location="tpl_pligg_profile_sort_end"}
					</ul>
				</li>
			</ul>
		{/if}
	</div>
</header>
<nav id="navPrimary" role="navigation" class="pageWrap" aria-labelledby="navMainHeading">
	<h2 id="navMainHeading" class="navMainHeader">Menu</h2>
	<ul class="navMain{if $enable_group neq "true" || $Enable_Live neq true || $Enable_Tags neq true} navMainOneOff{/if}{if ($enable_group neq "true" && $Enable_Live neq true) || ($enable_group neq "true" && $Enable_Tags neq true) || ($Enable_Live neq true && $Enable_Tags neq true)} navMainTwoOff{/if}{if $enable_group neq "true" && $Enable_Live neq true && $Enable_Tags neq true} navMainThreeOff{/if}">
		{checkActionsTpl location="tpl_pligg_navbar_start"}
		<li id="navHome"{if $pagename eq "published" || $pagename eq "index"} class="current"{/if}><a href="{$my_base_url}{$my_pligg_base}"><span>{#PLIGG_Visual_Home#}</span></a></li>
		<li id="navNew"{if $pagename eq "new"} class="current"{/if}><a href="{$URL_new}" rel="nofollow"><span>{#PLIGG_Visual_Pligg_Queued#}</span></a></li>
		{checkActionsTpl location="tpl_pligg_submit_link_start"}
		<li id="navSubmit"{if $pagename eq "submit"} class="current"{/if}><a href="{$URL_submit}" rel="nofollow"{if $user_authenticated neq true} class="loginRequired"{/if}><span>{#PLIGG_Visual_Submit_A_New_Story#}</span></a></li>
		{checkActionsTpl location="tpl_pligg_submit_link_end"}
		<li id="navUsers"{if $pagename eq "topusers"} class="current"{/if}><a href="{$URL_topusers}"><span>{#PLIGG_Visual_Top_Users#}</span></a></li>
		{if $enable_group eq "true"}
			<li id="navGroups"{if $pagename eq "groups" || $pagename eq "submit_groups" || $pagename eq "group_story"} class="current"{/if}><a href="{$URL_groups}"><span>{#PLIGG_Visual_Groups#}</span></a></li>
		{/if}
		{if $Enable_Live}
			<li id="navLive"{if $pagename eq "live" || $pagename eq "live_published" || $pagename eq "live_unpublished" || $pagename eq "live_comments"} class="current"{/if}><a href="{$URL_live}"><span>{#PLIGG_Visual_Live#}</span></a></li>
		{/if}
		{if $Enable_Tags}
			<li id="navCloud"{if $pagename eq "cloud"} class="current"{/if}><a href="{$URL_tagcloud}"><span>{#PLIGG_Visual_Tags#}</span></a></li>
		{/if}
		<li id="navRSS"{if $pagename eq "rssfeeds"} class="current"{/if}><a href="{$my_base_url}{$my_pligg_base}/rssfeeds.php"><span>RSS Feeds</span></a></li>
		{checkActionsTpl location="tpl_pligg_navbar_end"}
	</ul>
</nav>
{checkActionsTpl location="tpl_pligg_header_more_end"}