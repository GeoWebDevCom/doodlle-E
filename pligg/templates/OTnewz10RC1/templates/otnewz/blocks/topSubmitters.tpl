		{php}
		global $db, $main_smarty;
		
		$qTopSubmitters = $db->get_results('
			SELECT user_id, user_login, user_level, user_lastip, count(link_author) AS topSubmitter, link_status
			FROM '. table_links .', '. table_users . '
			WHERE (link_status="published" OR link_status="new")
			AND link_author=user_id
			AND user_level NOT IN ("god","Spammer")
			AND (user_login!="anonymous" OR user_lastip)
			GROUP BY link_author
			ORDER BY topSubmitter DESC LIMIT 0,20
		');
		$main_smarty->assign('topSubmitters', object_2_array($qTopSubmitters));
		{/php}
		<div id="topSubmitters" class="sidebarBlock sidebarUsers">
			<h3 class="sidebarBlockHeader">Top Submitters</h3>
			<div class="sidebarTabPanel">
				<ul class="sidebarUsersList">
					{foreach from=$topSubmitters item=sts}
						{php}
						$this->_vars['topSubmitterProfileURL'] = getmyurl('user', $this->_vars['sts']['user_login']);
						$this->_vars['topSubmitterSubmittedURL'] = getmyurl('user2', $this->_vars['sts']['user_login'], 'history');
						$this->_vars['topSubmitterAvatar'] = get_avatar('large', "", $this->_vars['sts']['user_login'],"","");
						{/php}
						<li><a href="{$topSubmitterProfileURL}" title="View {$sts.user_login} Profile"><img src="{$topSubmitterAvatar}" alt="{$sts.user_login} Avatar" /></a></li>
					{/foreach}
				</ul>
			</div>
		</div>