{config_load file=sidebar_stats_lang_conf}
		<div id="siteStats" class="sidebarBlock">
			<h3 class="sidebarBlockHeader">{#Sidebar_Stats_Statistics#}</h3>
			<div class="sidebarBlockContent">
				<dl>
					<dt>{#Sidebar_Stats_Newest_Member#}:</dt>
					<dd>{$sidebar_stats_last_user}</dd>
					
					<dt>{#Sidebar_Stats_Members#}:</dt>
					<dd>{$sidebar_stats_members}</dd>
					
					<dt>{#Sidebar_Stats_Stories#}:</dt>
					<dd>{$sidebar_stats_stories}</dd>
					
					<dt>{#Sidebar_Stats_Published#}:</dt>
					<dd>{$sidebar_stats_published}</dd>
					
					<dt>{#Sidebar_Stats_New#}:</dt>
					<dd>{$sidebar_stats_new}</dd>

					<dt>{#Sidebar_Stats_Votes#}:</dt>
					<dd>{$sidebar_stats_votes}</dd>
					
					<dt>{#Sidebar_Stats_Comments#}:</dt>
					<dd>{$sidebar_stats_comments}</dd>
					
					<dt>{#Sidebar_Stats_Comment_Votes#}:</dt>
					<dd>{$sidebar_stats_comment_votes}</dd>
					
					<dt>{#Sidebar_Stats_Groups#}:</dt>
					<dd>{$sidebar_stats_groups}</dd>
				</dl>
			</div>
		</div>
{config_load file=sidebar_stats_pligg_lang_conf}