	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_EditStory_Header#}</h2>
	</div>
	<div id="submitTwo" class="contentBlock contentBlockSpace">
		{checkActionsTpl location="tpl_pligg_submit_step2_start"}
		<form id="submitForm" action="" method="post" enctype="multipart/form-data" class="otForm">
			<input type="hidden" name="id" value="{$submit_id}" />
			{$hidden_token_edit_link}
			<fieldset>
				{if $isAdmin eq 1 or $isModerator eq 1}
				<p class="otField">
					<label for="author" class="otFieldLabel">{#PLIGG_Visual_Change_Link_Submitted_By#}:</label>
					<select id="author" name="author">
						{section name=nr loop=$userdata}
							<option value="{$userdata[nr].user_id}"{if $userdata[nr].user_id eq $author} selected="selected"{/if}>{$userdata[nr].user_login}</option>
						{/section}
					</select>
				</p>
				{/if}
				<p class="otField otFieldSubmitURL">
					<label for="url" class="otFieldLabel otFieldLabelUsername">{#PLIGG_Visual_Submit1_NewsURL#}:</label>
					<input type="url" id="url" name="url" {if $submit_url neq "http://" && $submit_url neq ""}value ="{$submit_url}"{else}placeholder="http://"{/if} class="otFieldInput otFieldInputURL"{if $isAdmin neq 1} disabled="disabled"{/if} />
				</p>
				<p class="otField">
					<label for="title" class="otFieldLabel">{#PLIGG_Visual_Submit2_Title#}:</label>
					<input type="text" id="title" name="title" required="required" autofocus="autofocus" value="{$submit_title}" maxlength="{$maxTitleLength}" class="otFieldInput" />
				</p>
				{if $enable_tags}
					<p class="otField">
						<label for="tags" class="otFieldLabel">{#PLIGG_Visual_Submit2_Tags#}:</label>
						<input type="text" id="tags" name="tags" value="{$tags_words}" maxlength="{$maxTagsLength}" class="otFieldInput">
					</p>
				{/if}
				<p class="otField">
					<label for="category" class="otFieldLabel">{#PLIGG_Visual_Submit2_Category#}:</label>
					<select id="category" name="category">
						{section name=thecat loop=$submit_cat_array}
							<option value="{$submit_cat_array[thecat].auto_id}"{if $submit_cat_array[thecat].auto_id eq $submit_category || in_array($submit_cat_array[thecat].auto_id,$submit_additional_cats)} selected="selected"{/if}>
								{if $submit_cat_array[thecat].spacercount lt $lastspacer}{$submit_cat_array[thecat].spacerdiff|repeat_count:''}{/if}
								{if $submit_cat_array[thecat].spacercount gt $lastspacer}{/if}
								{$submit_cat_array[thecat].spacercount|repeat_count:'&nbsp;&nbsp;&nbsp;'}
								{$submit_cat_array[thecat].name} &nbsp;&nbsp;&nbsp;
								{assign var=lastspacer value=$submit_cat_array[thecat].spacercount}
							</option>
						{/section}
					</select>
				</p>
				<p class="otField">
					<label for="bodytext" class="otFieldLabel">{#PLIGG_Visual_Submit2_Description#}:</label>
					<textarea id="bodytext" name="bodytext" rows="6">{$submit_content}</textarea>
				</p>
				{if $canIhaveAccess eq 1}
				<div class="otField">
					<label for="notify" class="otFieldLabel">{#PLIGG_Visual_EditStory_Notify#}:</label>
					<div class="otFieldInputWrap">
						<input type="checkbox" id="notify" name="notify" value="yes" /> {#PLIGG_Visual_EditStory_NotifyText#}
						<ul>
							<li><input type="radio" name="reason" value="typo" onclick="notify.checked = 'true';">{#PLIGG_Visual_EditStory_Reason_typo#}</li>
							<li><input type="radio" name="reason" value="category" onclick="notify.checked = 'true';">{#PLIGG_Visual_EditStory_Reason_category#}</li>
							<li><input type="radio" name="reason" value="tags" onclick="notify.checked = 'true';">{#PLIGG_Visual_EditStory_Reason_tags#}</li>
							<li><input type="radio" name="reason" value="foul" onclick="notify.checked = 'true';">{#PLIGG_Visual_EditStory_Reason_foul#}</li>
							<li>
								<input type="radio" name="reason" value="other" onclick="notify.checked = 'true';">{#PLIGG_Visual_EditStory_Reason_other#} 
								{*<input type="text" name="otherreason" />*}
							</li>
						</ul>
					</div>
				</div>
				{/if}
				{checkActionsTpl location="submit_step_2_pre_extrafields"}
				{include file=$tpl_extra_fields.".tpl"}
				<p class="otField otFieldAction aRight last">
					<input type="hidden" name="url" id="url" value="{$submit_url}" />
					<input type="hidden" name="phase" value="2" />
					<input type="hidden" name="randkey" value="{$randkey}" />
					<input type="hidden" name="id" value="{$submit_id}" />
					<input type="submit" value="{#PLIGG_Visual_Submit2_Continue#}" class="button buttonAction" />
				</p>
			</fieldset>
		</form>
		{checkActionsTpl location="tpl_pligg_submit_step2_after_form"}
		<div id="submitRules" class="formBox">
			<h3 class="formBoxHeader">Submission Guidelines</h3>
			<div class="formBoxContent">
				<p>
					{#PLIGG_Visual_Submit1_Instruct#}:
				</p>
				<ul>
					{if #PLIGG_Visual_Submit1_Instruct_1A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_1A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_1B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_2A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_2A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_2B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_3A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_3A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_3B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_4A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_4A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_4B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_5A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_5A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_5B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_6A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_6A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_6B#}</li>{/if}
					{if #PLIGG_Visual_Submit1_Instruct_7A# ne ''}<li><strong>{#PLIGG_Visual_Submit1_Instruct_7A#}:</strong> {#PLIGG_Visual_Submit1_Instruct_7B#}</li>{/if}
				</ul>
			</div>
		</div>
	</div>