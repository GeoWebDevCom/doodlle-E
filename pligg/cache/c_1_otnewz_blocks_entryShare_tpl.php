<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/modifier.escape.php'); $this->register_modifier("escape", "tpl_modifier_escape");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:10:57 UTC */ ?>

				<div id="xfolkentryShare-<?php echo $this->_vars['link_id']; ?>
" class="xfolkentryShare modal">
					<p class="modalHeader">Share Story<span data-share-modal="xfolkentryShare-<?php echo $this->_vars['link_id']; ?>
" class="modalClose"></span></p>
					<div class="modalContent">
						<p class="xfolkentryShareTitle"><a href="<?php echo $this->_vars['story_url']; ?>
"><?php echo $this->_vars['title_short']; ?>
</a></p>
						<ul class="xfolkentryShareSites altLinkColor clearFix">
							<li class="shareTwitter"><a href="https://twitter.com/intent/tweet?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;text=<?php echo $this->_run_modifier($this->_vars['title_short'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">Twitter</a></li>
							<li class="shareFacebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>" rel="nofollow" target="_blank">Facebook</a></li>
							<li class="shareGoogle"><a href="https://plus.google.com/share?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>" rel="nofollow" target="_blank">Google +</a></li>
							<li class="shareLinkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;title=<?php echo $this->_run_modifier($this->_vars['title_short'], 'escape', 'plugin', 1, 'url'); ?>
&amp;summary=<?php echo $this->_run_modifier($this->_vars['story_content'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">Linkedin</a></li>
							<li class="shareReddit"><a href="http://www.reddit.com/submit?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>" rel="nofollow" target="_blank">Reddit</a></li>
							<li class="shareDel"><a href="https://delicious.com/save?v=5&amp;url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;title=<?php echo $this->_run_modifier($this->_vars['title_short'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">Delicious</a></li>
							<li class="shareDigg"><a href="http://digg.com/submit?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>" rel="nofollow" target="_blank">Digg</a></li>
							<li class="shareTumblr"><a href="http://www.tumblr.com/share/link?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;name=<?php echo $this->_run_modifier($this->_vars['title_short'], 'escape', 'plugin', 1, 'url'); ?>
&amp;description=<?php echo $this->_run_modifier($this->_vars['story_content'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">Tumblr</a></li>
							<li class="sharePinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;description=<?php echo $this->_run_modifier($this->_vars['story_content'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">Pinterest</a></li>
							<li class="shareFF"><a href="http://www.friendfeed.com/share?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;title=<?php echo $this->_run_modifier($this->_vars['title_short'], 'escape', 'plugin', 1, 'url'); ?>
" rel="nofollow" target="_blank">FriendFeed</a></li>
							<li class="shareSlashdot"><a href="http://slashdot.org/submission?url=<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"):  echo $this->_run_modifier($this->_vars['url'], 'escape', 'plugin', 1, 'url');  else:  echo $this->_run_modifier($this->_vars['story_url'], 'escape', 'plugin', 1, 'url');  endif; ?>&amp;new=1" rel="nofollow" target="_blank">Slashdot</a></li>
							<li class="shareFURL"><a href="#" rel="nofollow" target="_blank">FURL</a></li>
						</ul>
					</div>
				</div>