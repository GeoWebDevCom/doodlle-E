	{if $enable_group eq "true"}
		<div class="xFolkHeader"><p class="xFolkHeaderTitle">Group Details</p></div>
		{checkActionsTpl location="tpl_pligg_group_start"}
		{include file=$the_template."/group_summary.tpl"}
		{checkActionsTpl location="tpl_pligg_group_end"}
			<ul class="groupsEntryTabs tabLinks altLinkColor clearFix">
				{checkActionsTpl location="tpl_pligg_group_sort_start"}
				<li{if $groupview eq "published"} class="current"{/if}><a href="{$groupview_published}">{#PLIGG_Visual_Group_Published#}</a></li>
				<li{if $groupview eq "new"} class="current"{/if}><a href="{$groupview_new}">{#PLIGG_Visual_Group_New#}</a></li>
				<li{if $groupview eq "shared"} class="current"{/if}><a href="{$groupview_sharing}">{#PLIGG_Visual_Group_Shared#}</a></li>
				<li{if $groupview eq "members" } class="current"{/if}><a href="{$groupview_members}">{#PLIGG_Visual_Group_Member#}</a></li>
				{checkActionsTpl location="tpl_pligg_group_sort_end"}
			</ul>
		{if $groupview eq "published"}
			{$group_display}
		</article>
		{elseif $groupview eq "new"}
			{$group_display}
		</article>
		{elseif $groupview eq "shared"}
			{$group_shared_display}
		</article>
		{elseif $groupview eq "members"}
			<div id="groupsMembersList" class="responsiveTable">
				<table class="groupsMembers">
					<thead>
						<tr>
							<th class="groupsMembersAvatar">&nbsp;  </th>
							<th class="groupsMembersUsername">Username</th>
							{if $is_group_admin eq true}
							<th class="groupsMembersRole">Role</th>
							<th class="groupsMembersEdit">Edit</th>
							<th class="groupsMembersActivate">Activation</th>
							{/if}
						</tr>
					</thead>
					<tbody>
						{$member_display}
					</tbody>
				</table>
			</div>
		</article>
		{/if}
		{$group_story_pagination}
	{/if}