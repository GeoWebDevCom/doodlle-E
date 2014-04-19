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
		
		$qTopPublishers = $db->get_results('
			SELECT user_id, user_login, user_level, user_lastip, count(link_author) AS topPublisher, link_status
			FROM '. table_links .', '. table_users .'
			WHERE link_status="published"
			AND link_author=user_id
			AND user_level NOT IN ("god","Spammer")
			AND (user_login!="anonymous" OR user_lastip)
			GROUP BY link_author
			ORDER BY topPublisher DESC LIMIT 0,20
		');
		$main_smarty->assign('topPublishers', object_2_array($qTopPublishers));
		{/php}
		<div id="sidebarTopUsers" class="sidebarUsers sidebarTab">
			<div class="sidebarTabLinks">
				<h3 class="sidebarTabLink" id="topPublishersTab"><a href="#topPublishers">Top Publishers</a></h3>
				<h3 class="sidebarTabLink"><a href="#topSubmitters">Top Submitters</a></h3>
			</div>
			<div class="sidebarTabPanel">
				<ul id="topPublishers" class="sidebarUsersList">
					{foreach from=$topPublishers item=stp}
						{php}
						$this->_vars['topPublisherProfileURL'] = getmyurl('user', $this->_vars['stp']['user_login']);
						$this->_vars['topPublisherPublishedURL'] = getmyurl('user2', $this->_vars['stp']['user_login'], 'published');
						$this->_vars['topPublisherAvatar'] = get_avatar('large', "", $this->_vars['stp']['user_login'],"","");
						{/php}
						<li><a href="{$topPublisherProfileURL}" title="View {$stp.user_login} Profile"><img src="{$topPublisherAvatar}" alt="{$stp.user_login} Avatar" /></a></li>
					{/foreach}
				</ul>
				<ul id="topSubmitters" class="sidebarUsersList">
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