			<div id="userSectionStats" class="userSection">
				<ul>
					{if $user_names != ""}
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_Profile_RealName#}</span>
							<span>{$user_names}</span>
						</li>
					{/if}
					{if $user_karma > "0.00"}
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_Rank#}:</span>
							<span>{$user_rank}</span>
						</li>
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_KarmaPoints#}:</span>
							<span>{$user_karma|number_format:"0"}</span>
						</li>
					{/if}
					{if $user_url != "" && $user_karma > "20" || $user_login eq $user_logged_in}
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Homepage#}:</span>
							<span><a href="{$user_url}" target="_blank" rel="nofollow">{$user_url}</a></span>
						</li>
					{/if}
					<li>
						<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Total_Links#}:</span>
						<span>{$user_total_links}</span>
					</li>
					<li>
						<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Published_Links#}:</span>
						<span>{$user_published_links}</span>
					</li>
					<li>
						<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Total_Comments#}:</span>
						<span>{$user_total_comments}</span>
					</li>
					<li>
						<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Total_Votes#}:</span>
						<span>{$user_total_votes}</span>
					</li>
					{checkActionsTpl location="tpl_show_extra_profile"}
					{checkActionsTpl location="tpl_user_profile_details_start"}
					{if $user_occupation != ""}
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_Profile_Occupation#}:</span>
							<span>{$user_occupation}</span>
						</li>
					{/if}
					{if $user_location != ""}
						<li>
							<span class="userSectionStatsField">{#PLIGG_Visual_Profile_Location#}:</span>
							<span>{$user_location}</span>
						</li>
					{/if}
					{checkActionsTpl location="tpl_user_profile_details_end"}
				</ul>
			</div>
			{if $user_skype || $user_facebook || $user_twitter || $user_linkedin || $user_googleplus || $user_pinterest || $user_publicemail ne ""}
				<div id="userSectionSocial" class="userSection">
					<h3 class=userSectionHeading>{#PLIGG_User_Profile_Social#}</h3>
					<ul>
						{checkActionsTpl location="tpl_user_profile_social_start"}
						{if $user_skype}
							<li>
								<span class="userSectionStatsField">{#PLIGG_Visual_User_Profile_Skype#}</span>
								<span><a href="callto://{$user_skype}" title="Skype {$user_username|capitalize}" rel="nofollow" target="_blank">{$user_skype}</a></span>
							</li>							
						{/if}
						{if $user_facebook}
							<li>
								<span class="userSectionStatsField">{#PLIGG_User_Profile_Facebook#}</span>
								<span><a href="http://www.facebook.com/{$user_facebook}" title="{$user_username|capitalize} on Facebook" rel="nofollow" target="_blank">{$user_facebook}</a></span>
							</li>
						{/if}
						{if $user_twitter}
							<li>
								<span class="userSectionStatsField">{#PLIGG_User_Profile_Twitter#}</span>
								<span><a href="http://twitter.com/{$user_twitter}" title="{$user_username|capitalize} on Twitter" rel="nofollow" target="_blank">{$user_twitter}</a></span>
							</li>
						{/if}
						{if $user_linkedin}
							<li>
								<span class="userSectionStatsField">{#PLIGG_User_Profile_Linkedin#}</span>
								<span><a href="http://www.linkedin.com/in/{$user_linkedin}" title="{$user_username|capitalize} on LinkedIn" rel="nofollow" target="_blank">{$user_linkedin}</a></span>
							</li>
						{/if}
						{if $user_googleplus}
							<li>
								<span class="userSectionStatsField">{#PLIGG_User_Profile_Googleplus#}</span>
								<span><a href="https://plus.google.com/{$user_googleplus}" title="{$user_username|capitalize} on Google+" rel="nofollow" target="_blank">{$user_googleplus}</a></span>
							</li>
						{/if}
						{if $user_pinterest}
							<li>
								<span class="userSectionStatsField">{#PLIGG_User_Profile_Pinterest#}</span>
								<span><a href="http://pinterest.com/{$user_pinterest}/" title="{$user_username|capitalize} on Pinterest" rel="nofollow" target="_blank">{$user_pinterest}</a></span>
							</li>
						{/if}
						{checkActionsTpl location="tpl_user_profile_social_end"}
					</ul>
				</div>
			{/if}
			{if $Allow_Friends neq "0"}
				{if $following}
					<div id="userSectionFriends" class="userSection">
						<h3 class=userSectionHeading>{#PLIGG_Visual_User_Profile_View_Friends#}</h3>
						<ul class="userProfileFriends clearFix">
							{foreach from=$following item=myfriend}
								{php}
									$this->_vars['friend_avatar'] = get_avatar('large', $this->_vars['myfriend']['user_avatar_source'], $this->_vars['myfriend']['user_login'], $this->_vars['myfriend']['user_email']);
									$this->_vars['profileURL'] = getmyurl('user2', $this->_vars['myfriend']['user_login'], 'profile');
								{/php}
								<li>
									<a href="{$profileURL}" title="View {$myfriend.user_login}'s Profile"><img src="{$friend_avatar}" alt="{$myfriend.user_login} Avatar" class="roundedImage responsiveImg" /></a>
								</li>
							{/foreach}
						</ul>
						{checkActionsTpl location="tpl_pligg_profile_info_end"}
						{checkActionsTpl location="tpl_pligg_profile_tab_insert"}
					</div>
				{/if}
			{/if}
			{if $enable_group eq "true"}
				{if $group_display neq ''}
					<div id="userSectionGroups" class="userSection">
						<h3 class=userSectionHeading>Groups Membership</h3>
						<table>
							{$group_display}
						</table>
					</div>
				{/if}
			{/if}