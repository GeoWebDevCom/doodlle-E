	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Submit2_Details#}</h2>
	</div>
	<div id="submitTwo" class="contentBlock contentBlockSpace">
		{checkActionsTpl location="tpl_pligg_submit_step2_start"}
		<form id="submitForm" action="{$URL_submit}" method="post" enctype="multipart/form-data" class="otForm">
			<ol class="submitStep">
				<li class="submitStepOne">1</li>
				<li class="submitStepLast current">2</li>
			</ol>
			<fieldset>
				<p class="otField otFieldSubmitURL">
					<label for="url" class="otFieldLabel otFieldLabelUsername">{#PLIGG_Visual_Submit1_NewsURL#}:</label>
					<input type="url" id="url" name="url" value="{$submit_url}" class="otFieldInput otFieldInputURL" disabled="disabled" />
				</p>
				<p class="otField">
					<label for="title" class="otFieldLabel">{#PLIGG_Visual_Submit2_Title#}:</label>
					<input type="text" id="title" name="title" required="required" autofocus="autofocus" value="{if $submit_title}{$submit_title}{else}{$submit_url_title}{/if}" maxlength="{$maxTitleLength}" class="otFieldInput" />
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
						<option value="">{#PLIGG_Visual_Submit2_CatInstructSelect#}</option>
						{section name=thecat loop=$submit_cat_array}
						<option value="{$submit_cat_array[thecat].auto_id}"{if $submit_cat_array[thecat].auto_id == $submit_category  || in_array($cat_array[thecat].auto_id,$submit_additional_cats)} selected="selected"{/if}>
							{if $submit_cat_array[thecat].spacercount lt $submit_lastspacer}
								{$submit_cat_array[thecat].spacerdiff|repeat_count:''}
							{/if}
							{if $submit_cat_array[thecat].spacercount gt $submit_lastspacer}{/if}
							{$submit_cat_array[thecat].spacercount|repeat_count:'&nbsp;&nbsp;&nbsp;'}
							{$submit_cat_array[thecat].name} &nbsp;&nbsp;&nbsp;
							{assign var=submit_lastspacer value=$submit_cat_array[thecat].spacercount}
						</option>
						{/section}
					</select>
				</p>
				{if $enable_group && $output neq ''}
					<p class="otField">
						<label for="link_group_id" class="otFieldLabel capitalize">{#PLIGG_Visual_Group_Submit_story#}</label>
						{$output}
					</p>
				{/if}
				{checkActionsTpl location="tpl_pligg_submit_step2_middle"}
				<p class="otField">
					<label for="bodytext" class="otFieldLabel">Description:</label>
					<textarea id="bodytext" name="bodytext" rows="6">{if $submit_url_description}{$submit_url_description}{/if}{$submit_content}</textarea>
				</p>
				{checkActionsTpl location="submit_step_2_pre_extrafields"}
				{include file=$tpl_extra_fields.".tpl"}
				{if isset($register_step_1_extra)}
					{$register_step_1_extra}
				{/if}
				{checkActionsTpl location="tpl_header_admin_main_comment_subscription"}
				{checkActionsTpl location="tpl_pligg_submit_step2_end"}
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