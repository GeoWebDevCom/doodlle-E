		{php}
		global $db, $main_smarty;
		
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
		<div id="topPublishers" class="sidebarBlock sidebarUsers">
			<h3 class="sidebarBlockHeader">Top Publishers</h3>
			<div class="sidebarTabPanel">
				<ul class="sidebarUsersList">
					{foreach from=$topPublishers item=stp}
						{php}
						$this->_vars['topPublisherProfileURL'] = getmyurl('user', $this->_vars['stp']['user_login']);
						$this->_vars['topPublisherPublishedURL'] = getmyurl('user2', $this->_vars['stp']['user_login'], 'published');
						$this->_vars['topPublisherAvatar'] = get_avatar('large', "", $this->_vars['stp']['user_login'],"","");
						{/php}
						<li><a href="{$topPublisherProfileURL}" title="View {$stp.user_login} Profile"><img src="{$topPublisherAvatar}" alt="{$stp.user_login} Avatar" /></a></li>
					{/foreach}
				</ul>
			</div>
		</div>