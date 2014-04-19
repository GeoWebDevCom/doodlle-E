				<div id="xfolkentryShare-{$link_id}" class="xfolkentryShare modal">
					<p class="modalHeader">Share Story<span data-share-modal="xfolkentryShare-{$link_id}" class="modalClose"></span></p>
					<div class="modalContent">
						<p class="xfolkentryShareTitle"><a href="{$story_url}">{$title_short}</a></p>
						<ul class="xfolkentryShareSites altLinkColor clearFix">
							<li class="shareTwitter"><a href="https://twitter.com/intent/tweet?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;text={$title_short|escape:'url'}" rel="nofollow" target="_blank">Twitter</a></li>
							<li class="shareFacebook"><a href="https://www.facebook.com/sharer/sharer.php?u={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}" rel="nofollow" target="_blank">Facebook</a></li>
							<li class="shareGoogle"><a href="https://plus.google.com/share?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}" rel="nofollow" target="_blank">Google +</a></li>
							<li class="shareLinkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;title={$title_short|escape:'url'}&amp;summary={$story_content|escape:'url'}" rel="nofollow" target="_blank">Linkedin</a></li>
							<li class="shareReddit"><a href="http://www.reddit.com/submit?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}" rel="nofollow" target="_blank">Reddit</a></li>
							<li class="shareDel"><a href="https://delicious.com/save?v=5&amp;url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;title={$title_short|escape:'url'}" rel="nofollow" target="_blank">Delicious</a></li>
							<li class="shareDigg"><a href="http://digg.com/submit?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}" rel="nofollow" target="_blank">Digg</a></li>
							<li class="shareTumblr"><a href="http://www.tumblr.com/share/link?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;name={$title_short|escape:'url'}&amp;description={$story_content|escape:'url'}" rel="nofollow" target="_blank">Tumblr</a></li>
							<li class="sharePinterest"><a href="http://pinterest.com/pin/create/button/?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;description={$story_content|escape:'url'}" rel="nofollow" target="_blank">Pinterest</a></li>
							<li class="shareFF"><a href="http://www.friendfeed.com/share?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;title={$title_short|escape:'url'}" rel="nofollow" target="_blank">FriendFeed</a></li>
							<li class="shareSlashdot"><a href="http://slashdot.org/submission?url={if $url_short neq "http://" && $url_short neq "://"}{$url|escape:'url'}{else}{$story_url|escape:'url'}{/if}&amp;new=1" rel="nofollow" target="_blank">Slashdot</a></li>
							<li class="shareFURL"><a href="#" rel="nofollow" target="_blank">FURL</a></li>
						</ul>
					</div>
				</div>