				{php}
					global $main_smarty, $user;
					$main_smarty->assign('topUserID', $user->id);
					$main_smarty->assign('topUserAvatarSource', $user->avatar_source);
				{/php}
				{if $user_total_links gt 0 || $user_total_comments gt 0}
				<li>
					<div class="memberListAvatar">
						<a href="{$user_userlink}" title="View {$user_username}'s Complete Profile">
							{if $topUserAvatarSource eq "useruploaded"}
								<img src="{$my_base_url}{$my_pligg_base}{$User_Upload_Avatar_Folder}/{$topUserID}_{$Avatar_Large}.jpg" alt="{$user_username}'s Avatar" class="" />
							{else}
								<img src="{$my_base_url}{$my_pligg_base}{$Default_Gravatar_Large}" alt="{$user_username}'s Avatar" class="" />
							{/if}
						</a>
						<span class="memberListRank" title="{$user_username}'s Rank">{$user_rank}</span>
					</div>
					<div class="memberListInfo">
						<h3 class="memberListName"><a href="{$user_userlink}">{$user_username}</a></h3>
						<dl class="memberListKarma">
							<dt>User Karma:</dt>
							<dd>{$user_karma}</dd>
						</dl>
						<dl class="memberListSubmitted">
							<dt>Submissions:</dt>
							<dd>{$user_total_links}</dd>
						</dl>
						<dl class="memberListPublished">
							<dt>Published:</dt>
							<dd>{if $user_total_links gt 0}{$user_published_links}&nbsp;({$user_published_links_percent}%){else}{$user_published_links}&nbsp;(-){/if}</dd>
						</dl>
						<dl class="memberListCommented">
							<dt>Comments:</dt>
							<dd>{$user_total_comments}</dd>
						</dl>
					</div>
				</li>
				{/if}