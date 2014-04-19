			<article class="groupsEntry">
				<div class="groupsEntryThumb">
					<a href="{$group_story_url}"><img src="{$imgsrc}" alt="{$group_name} Avatar" /></a>
				</div>
				<div class="groupsEntryContent">
					{if $pagename eq 'group_story'}
						{checkActionsTpl location="tpl_pligg_group_list_start"}
					{/if}
					<header class="groupsEntryHeader">
						<h2 class="groupsEntryTitle">
							{if $pagename eq 'group_story'}
								{$group_name}
							{else}
								<a href="{$group_story_url}">{$group_name}</a>
							{/if}
						</h2>
						<p class="groupsEntryHeaderMeta">
							{#PLIGG_Visual_Group_Created_By#} <a href="{$submitter_profile_url}">{$group_submitter}</a>
							<span class="groupsEntryDate">{#PLIGG_Visual_Group_Created_On#} <time>{$group_date}</time></span> 
							with {$group_members} {#PLIGG_Visual_Group_Member#}
						</p>
					</header>
					<p class="groupsEntryDesc">
						{$group_description}
					</p>
					{checkActionsTpl location="tpl_pligg_group_list_end"}
					{if $pagename eq 'group_story'}
						<div class="groupsAction">
							{if $user_logged_in neq $group_submitter}
								{if $user_logged_in neq ""}
									{if $is_group_member eq 0}
										{if $join_group_url neq '' || $join_group_privacy_url neq ''}
											{if $group_privacy eq 'public'}
												<a href="{$join_group_url}" class="button buttonAction buttonSmall capitalize" rel="nofollow">{#PLIGG_Visual_Group_Join#}</a>
											{else}
												<a href="{$join_group_privacy_url}" class="button buttonAction buttonSmall" rel="nofollow">{#PLIGG_Visual_Group_Join#}</a>
											{/if}
										{/if}
									{else}
										{if $is_member_active eq 'active'}
											<a href="{$unjoin_group_url}" class="button buttonAction buttonSmall capitalize" rel="nofollow">{#PLIGG_Visual_Group_Unjoin#}</a>
										{/if}
										{if $is_member_active eq 'inactive'}
											<a href="{$join_group_withdraw}" class="button buttonAction buttonSmall capitalize" rel="nofollow">{#PLIGG_Visual_Group_Withdraw_Request#}</a>
										{/if}
									{/if}
								{/if}
							{/if}
							{if $is_group_admin eq '1'}
								<a href="{$group_edit_url}" class="button buttonAction buttonSmall">{#PLIGG_Visual_Group_Text_edit#}</a>
								<a href="{$group_delete_url}" onclick="return confirm('{#PLIGG_Visual_Group_Delete_Confirm#}')" rel="nofollow" class="button buttonAction buttonSmall">{#PLIGG_Visual_Group_Text_Delete#}</a>
							{/if}							
						</div>
					{/if}
					{if $group_status eq 'disable'}
						<div class="groupsAction">
							<a href="{$URL_groups}?approve={$group_id}" class="button buttonAction">Approve</a>
						</div>
					{/if}
				</div>
			{if $pagename eq "groups"}</article>{/if}