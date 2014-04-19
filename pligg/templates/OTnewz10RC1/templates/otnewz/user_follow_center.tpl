			{include file=$the_template"/user_header.tpl"}
				{if $user_view eq 'followers'}
					{if $follower}
						<table class="userFollowers userFriends">
							<tbody>
								{foreach from=$follower item=myfriend}
									{php}
										$this->_vars['friend_avatar'] = get_avatar('small', $this->_vars['myfriend']['user_avatar_source'], $this->_vars['myfriend']['user_login'], $this->_vars['myfriend']['user_email']);
										$this->_vars['profileURL'] = getmyurl('user2', $this->_vars['myfriend']['user_login'], 'profile');
										$this->_vars['addURL'] = getmyurl('user_friends', $this->_vars['myfriend']['user_login'], 'addfriend');
										$this->_vars['user_url_remove'] = getmyurl('user_friends', $this->_vars['myfriend']['user_login'], 'removefriend');
									{/php}				
									<tr>
										<td valign="middle">
											<img src="{$friend_avatar}" alt="{$myfriend.user_login} Avatar" />
											<a href="{$profileURL}">{$myfriend.user_login}</a>
										</td>
										{if check_for_enabled_module('simple_messaging',2.0) && $is_friend}
											<td valign="middle">
												<a href="{$my_pligg_base}/module.php?module=simple_messaging&view=compose&to={$myfriend.user_login}&return={$templatelite.server.REQUEST_URI|urlencode}" rel="nofollow">Send Message</a>
											</td>
										{/if}
										{if $user_authenticated eq true}
											{if $myfriend.is_friend>0}
												<td valign="middle"><a href="{$user_url_remove}" rel="nofollow">Unfollow</a></td>
											{else}
												<td valign="middle"><a href="{$addURL}" rel="nofollow">{#PLIGG_Visual_User_Profile_Add_Friend#}</a></td>
											{/if}
										{/if}
									</tr>
								{/foreach}
							</tbody>
						</table>
					{else}
						<h4>{#PLIGG_Visual_User_Profile_No_Friends_2#} {$user_username|capitalize}</h4>
					{/if}
				{/if}
				{if $user_view eq 'following'}
					{if $following}
						<table class="userFollowers userFriends">
							<tbody>
								{foreach from=$following item=myfriend}
									{php}
										$this->_vars['friend_avatar'] = get_avatar('small', $this->_vars['myfriend']['user_avatar_source'], $this->_vars['myfriend']['user_login'], $this->_vars['myfriend']['user_email']);
										$this->_vars['profileURL'] = getmyurl('user2', $this->_vars['myfriend']['user_login'], 'profile');
										$this->_vars['user_url_remove'] = getmyurl('user_friends', $this->_vars['myfriend']['user_login'], 'removefriend');
									{/php}
									<tr>
										<td>
											<img src="{$friend_avatar}" alt="{$myfriend.user_login} Avatar" />
											<a href="{$profileURL}">{$myfriend.user_login}</a>
										</td>
										{if check_for_enabled_module('simple_messaging',2.0) && $is_friend}
											<td>
												<a href="{$my_pligg_base}/module.php?module=simple_messaging&view=compose&return={$templatelite.server.REQUEST_URI|urlencode}&to={$myfriend.user_login}" rel="nofollow">Send Message</a>
											</td>
										{/if}
										{if $user_authenticated eq true}
											<td><a href="{$user_url_remove}" class="btn btn-danger">Unfollow</a></td>
										{/if}
									</tr>
								{/foreach}
							<tbody>
						</table>
					{else}
						<h3 style="text-align:center;">{$user_username|capitalize} {#PLIGG_Visual_User_Profile_No_Friends#}</h3>
					{/if}
				{/if}
				{if $user_view eq 'removefriend'}
					<div class="userMsg">
						{#PLIGG_Visual_User_Profile_Friend_Removed#}
					</div>
				{/if}
				{if $user_view eq 'addfriend'}
					<div class="userMsg">
						{#PLIGG_Visual_User_Profile_Friend_Added#}
					</div>
				{/if}
				{if $user_view eq 'removefriend' || $user_view eq 'addfriend'}
					{include file=$the_template"/user_profile.tpl"}
				{/if}
			</div>
			{if isset($user_page)}
				{$user_page}
			{/if}
			{if isset($user_pagination)}
				{checkActionsTpl location="tpl_pligg_pagination_start"}
				{$user_pagination}
				{checkActionsTpl location="tpl_pligg_pagination_end"}
			{/if}			
			{checkActionsTpl location="tpl_pligg_profile_end"}