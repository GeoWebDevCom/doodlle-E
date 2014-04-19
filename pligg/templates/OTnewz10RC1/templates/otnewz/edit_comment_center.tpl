<div id="contentWrap" class="pageWrap">
	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">Edit Comment</h2>
	</div>
	<div class="contentBlock contentBlockSpace">
		<form action="" method="post" class="otForm">
			<fieldset>
				<p class="otField">
					<textarea id="comment_content" name="comment_content" rows="5">{if isset($TheComment)}{$TheComment}{/if}</textarea>
				</p>
				<p class="otField last aRight">
					<input type="hidden" name="process" value="newcomment" />
					<input type="hidden" name="randkey" value="{$randkey}" />
					<input type="hidden" name="link_id" value="{$link_id}" />
					<input type="hidden" name="user_id" value="{$user_id}" />
					<input type="submit" value="Submit Comment" class="button buttonAction" />
				</p>
			</fieldset>
		</form>	
	</div>
</div>