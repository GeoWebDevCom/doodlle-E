<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:09:02 UTC */ ?>

		<section id="xFolfEntries">
			<header class="xFolkHeader">
				<h2 class="xFolkHeaderTitle">New<?php if ($this->_vars['request_category']): ?> / <?php echo $this->_vars['request_category'];  endif; ?></h2>
				<ul class="dropdown entrySorter altLinkColor">
					<li>
						<a href="<?php echo $this->_vars['URL_new']; ?>
" id="entrySort" class="ir" data-toggle="dropdown" data-target="#">Sort</a>
						<ul class="dropdownMenu bounce" role="menu" aria-labelledby="entrySort">
							<li>Sort <?php echo $this->_confs['PLIGG_Visual_Pligg_Queued']; ?>
 News By</li>
							<li<?php if ($this->_vars['setmeka'] == "" || $this->_vars['setmeka'] == "recent"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_recent']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Recently_Pop']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "yesterday"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_yesterday']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Yesterday']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "upvoted"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_upvoted']; ?>
" rel="nofollow">Most <?php echo $this->_confs['PLIGG_Visual_UpVoted']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "week"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_week']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_This_Week']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "downvoted"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_downvoted']; ?>
" rel="nofollow">Most <?php echo $this->_confs['PLIGG_Visual_DownVoted']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "month"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_month']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_This_Month']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "commented"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_commented']; ?>
" rel="nofollow">Most <?php echo $this->_confs['PLIGG_Visual_User_NewsCommented']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "year"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_year']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_This_Year']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "today"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_today']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_Top_Today']; ?>
</a></li>
							<li<?php if ($this->_vars['setmeka'] == "alltime"): ?> class="current"<?php endif; ?>><a href="<?php echo $this->_vars['index_url_alltime']; ?>
" rel="nofollow"><?php echo $this->_confs['PLIGG_Visual_This_All']; ?>
</a></li>
						</ul>
					</li>
				</ul>
			</header>
			<?php echo $this->_vars['link_summary_output']; ?>

		</section>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_start"), $this);?>
		<?php echo $this->_vars['link_pagination']; ?>

		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_end"), $this);?>