			<section id="commentsAdd">
				<h3 class="commentsListHeader">{#PLIGG_Visual_Comment_Send#}</h3>
				{checkActionsTpl location="tpl_pligg_story_comments_form_start"}
				<form action="" method="post" class="otForm">
					<fieldset>
						{checkActionsTpl location="tpl_pligg_story_comments_submit_start"}
						<p class="otField">
							<textarea id="comment_content" name="comment_content" rows="5">{if isset($TheComment)}{$TheComment}{/if}</textarea>
						</p>
						{if isset($register_step_1_extra)}
							<p class="otField">{$register_step_1_extra}</p>
						{/if}
						{checkActionsTpl location="tpl_pligg_story_comments_submit_end"}
						<p class="otField last aRight">
							<input type="hidden" name="process" value="newcomment" />
							<input type="hidden" name="randkey" value="{$randkey}" />
							<input type="hidden" name="link_id" value="{$link_id}" />
							<input type="hidden" name="user_id" value="{$user_id}" />
							<input type="hidden" name="parrent_comment_id" value="{$parrent_comment_id}" />						
							<input type="submit" value="Submit Comment" class="button buttonAction" />
						</p>
					</fieldset>
				</form>
				{checkActionsTpl location="tpl_pligg_story_comments_form_end"}
			</section>