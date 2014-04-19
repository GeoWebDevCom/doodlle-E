			<div id="userProfile" class="contentBlock">
				{checkActionsTpl location="tpl_pligg_profile_start"}
				<div class="userHeader">
					<div class="userAvatar">
						<img src="{$Avatar.large}" alt="{$user_username}'s Avatar" class="roundedImage responsiveImg" />
					</div>
					<div class="userHeaderInfo">
						<div class="userHeaderUser">
							<span class="userHeaderName dBlock">{$user_username}</span>
							<span class="userHeaderJoined dBlock">Member Since {php} $pligg_date = $this->_vars['user_joined']; echo date("F d, Y", strtotime($pligg_date)); {/php}</span>
						</div>
						{if $Allow_Friends}
							<ul class="userActions{if check_for_enabled_module('simple_messaging',2.2) && $is_friend}{else} userActionsOneOff{/if}{if $user_login eq $user_logged_in} userActionsTwoOff{/if} altLinkColor clearFix">
								{if check_for_enabled_module('simple_messaging',2.2) && $is_friend}
									<li><a href="{$my_base_url}{$my_pligg_base}/module.php?module=simple_messaging&amp;view=compose&amp;to={$username}&amp;return={$my_pligg_base}%2Fuser.php%3Flogin%3D{$user_logged_in}%26view%3Dfollowers">Send PM</a></li>
								{/if}
								{if $is_friend gt 0}
									<li>
											<a href="{$user_url_remove}">{#PLIGG_Unfollow#}</a>
											{if $user_authenticated eq true}{checkActionsTpl location="tpl_user_center"}{/if}
									</li>
								{elseif $user_login neq $user_logged_in}
									{if $user_authenticated eq true}
										<li><a href="{$user_url_add}">{#PLIGG_Visual_User_Profile_Add_Friend#}</a></li>
									{else}
										<li><a href="{$user_url_add}" class=loginRequired>{#PLIGG_Visual_User_Profile_Add_Friend#}</a></li>
									{/if}
								{/if}
								<li><a href="{$user_url_friends}">{$user_following} {#PLIGG_Visual_User_Profile_View_Friends#}</a></li>
								<li><a href="{$user_url_friends2}">{$user_followers} {#PLIGG_Visual_User_Profile_Your_Friends#}</a></li>
							</ul>
						{/if}
					</div>
				</div>
				{checkActionsTpl location="tpl_user_center_just_below_header"}
				<ul class="userTabs{if $user_login eq $user_logged_in || $isadmin} userTabsOneOn {/if} dropdown altLinkColor">
					<li>
						<a href="{$URL_userNoVar}" id="userSection" class="ir" data-toggle="dropdown" data-target="#">
							{if $user_view eq "profile" || $user_view eq "removefriend" || $user_view eq "addfriend"}
								{#PLIGG_Visual_User_PersonalData#}
							{elseif $pagename eq "user_edit"}
								{#PLIGG_Visual_User_Setting#}
							{elseif $user_view eq "history"}
								{#PLIGG_Visual_User_NewsSent#}
							{elseif $user_view eq "published"}
								{#PLIGG_Visual_User_NewsPublished#}
							{elseif $user_view eq "new"}
								{#PLIGG_Visual_User_NewsUnPublished#}
							{elseif $user_view eq "commented"}
								{#PLIGG_Visual_User_NewsCommented#}
							{elseif $user_view eq "upvoted"}
								{#PLIGG_Visual_UpVoted#}
							{elseif $user_view eq "downvoted"}
								{#PLIGG_Visual_DownVoted#}
							{elseif $user_view eq "saved"}
								{#PLIGG_Visual_User_NewsSaved#}
							{elseif $user_view eq "followers"}
								{#PLIGG_Visual_User_Profile_Your_Friends#}
							{elseif $user_view eq "following"}
								{#PLIGG_Visual_User_Profile_View_Friends#}
							{/if}
						</a>
						<ul class="dropdownMenu bounce clearFix" role="menu" aria-labelledby="userSection">
							{checkActionsTpl location="tpl_pligg_profile_sort_start"}
							<li{if $user_view eq "profile" || $user_view eq "removefriend" || $user_view eq "addfriend"} class="current"{/if}><a href="{$user_url_personal_data2}">{#PLIGG_Visual_User_PersonalData#}</a></li>
							{if $user_login eq $user_logged_in || $isadmin}
								<li{if $pagename eq "user_edit"} class="current"{/if}><a href="{$URL_Profile2}">{#PLIGG_Visual_User_Setting#}</a></li>
							{/if}
							<li{if $user_view eq "history"} class="current"{/if}><a href="{$user_url_news_sent2}">{#PLIGG_Visual_User_NewsSent#}</a></li>
							<li{if $user_view eq "published"} class="current"{/if}><a href="{$user_url_news_published2}">{#PLIGG_Visual_User_NewsPublished#}</a></li>
							<li{if $user_view eq "new"} class="current"{/if}><a href="{$user_url_news_unpublished2}">{#PLIGG_Visual_User_NewsUnPublished#}</a></li>
							<li{if $user_view eq "commented"} class="current"{/if}><a href="{$user_url_commented2}">{#PLIGG_Visual_User_NewsCommented#}</a></li>
							<li{if $user_view eq "upvoted"} class="current"{/if}><a href="{$user_url_news_upvoted2}">{#PLIGG_Visual_UpVoted#}</a></li>
							<li{if $user_view eq "downvoted"} class="current"{/if}><a href="{$user_url_news_downvoted2}">{#PLIGG_Visual_DownVoted#}</a></li>
							<li class="userTabsSaved{if $user_view eq "saved"} current{/if}"><a href="{$user_url_saved2}">{#PLIGG_Visual_User_NewsSaved#}</a></li>
							{checkActionsTpl location="tpl_pligg_profile_sort_end"}
						</ul>
					</li>
				</ul>