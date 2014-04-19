<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:11:02 UTC */ ?>

			<section id="commentsAdd">
				<h3 class="commentsListHeader"><?php echo $this->_confs['PLIGG_Visual_Comment_Send']; ?>
</h3>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_form_start"), $this);?>
				<form action="" method="post" class="otForm">
					<fieldset>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_submit_start"), $this);?>
						<p class="otField">
							<textarea id="comment_content" name="comment_content" rows="5"><?php if (isset ( $this->_vars['TheComment'] )):  echo $this->_vars['TheComment'];  endif; ?></textarea>
						</p>
						<?php if (isset ( $this->_vars['register_step_1_extra'] )): ?>
							<p class="otField"><?php echo $this->_vars['register_step_1_extra']; ?>
</p>
						<?php endif; ?>
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_submit_end"), $this);?>
						<p class="otField last aRight">
							<input type="hidden" name="process" value="newcomment" />
							<input type="hidden" name="randkey" value="<?php echo $this->_vars['randkey']; ?>
" />
							<input type="hidden" name="link_id" value="<?php echo $this->_vars['link_id']; ?>
" />
							<input type="hidden" name="user_id" value="<?php echo $this->_vars['user_id']; ?>
" />
							<input type="hidden" name="parrent_comment_id" value="<?php echo $this->_vars['parrent_comment_id']; ?>
" />						
							<input type="submit" value="Submit Comment" class="button buttonAction" />
						</p>
					</fieldset>
				</form>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_form_end"), $this);?>
			</section>