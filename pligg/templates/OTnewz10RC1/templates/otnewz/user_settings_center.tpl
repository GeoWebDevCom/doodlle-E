			{include file=$the_template"/user_header.tpl"}
				{if $savemsg neq ""}
					<div class="userMsg">{$savemsg}</div>
				{/if}
				{if $UseAvatars neq "0"}				
					<form name="image_upload_form" method="post" enctype="multipart/form-data" class="otForm userSettingsForm">
						<fieldset>
							<div class="otField">
								<label for="image_file" class="otFieldLabel">
									{#PLIGG_Visual_Profile_UploadAvatar2#}:
								</label>
								<div class="otFieldInputWrap">
									<input type="file" id="image_file" name="image_file" class="otFieldInputFile" />
								</div>
							</div>
							<p class="otField aRight">
								<input type="hidden" name="avatar" value="uploaded" />
								{$hidden_token_profile_change}
								<input type="submit" value="{#PLIGG_Visual_Profile_AvatarUpload#}" class="button buttonAction" />
							</p>
						</fieldset>
					</form>
				{/if}
				{checkActionsTpl location="tpl_pligg_profile_info_start"}
				<form action="" method="post" id="thisform" class="otForm userSettingsForm">
					<h3 class=userSectionHeading>{#PLIGG_Visual_Profile_ModifyProfile#}</h3>
					{checkActionsTpl location="tpl_user_edit_fields"}
					{checkActionsTpl location="tpl_pligg_profile_info_middle"}
					<fieldset>
						{if $userlevel eq 'admin' or $userlevel eq 'moderator'}
							<p class="otField">
								<label for="names" class="otFieldLabel">{#PLIGG_Visual_Register_Username#}:</label>
								<input type="text" id="names" name="user_login" value="{$user_login}" class="otFieldInput" />
							</p>
						{/if}
						<p class="otField">
							<label for="email" class="otFieldLabel">{#PLIGG_Visual_Profile_Email#}:</label>
							<input type="email" id="email" name="email" value="{$user_email}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="public_email" class="otFieldLabel">{#PLIGG_Visual_User_Profile_PublicEmail#}:</label>
							<input type="email" id="public_email" name="public_email" value="{$user_publicemail}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="url" class="otFieldLabel">{#PLIGG_Visual_User_Profile_Homepage#}:</label>
							<input type="url" id="url" name="url" value="{$user_url}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="names" class="otFieldLabel">{#PLIGG_Visual_Profile_RealName#}:</label>
							<input type="text" id="names" name="names" value="{$user_names}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="occupation" class="otFieldLabel">{#PLIGG_Visual_Profile_Occupation#}:</label>
							<input type="text" id="occupation" name="occupation" value="{$user_occupation}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="location" class="otFieldLabel">{#PLIGG_Visual_Profile_Location#}:</label>
							<input type="text" id="location" name="location" value="{$user_location}" class="otFieldInput" />
						</p>
					</fieldset>
					<h3 class=userSectionHeading>{#PLIGG_User_Profile_Social#}</h3>
					<fieldset>						
						<p class="otField">
							<label for="skype" class="otFieldLabel">{#PLIGG_Visual_User_Profile_Skype#}:</label>
							<input type="text" id="skype" name="skype" value="{$user_skype}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="facebook" class="otFieldLabel">{#PLIGG_User_Profile_Facebook#}:</label>
							<input type="text" id="facebook" name="facebook" value="{$user_facebook}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="twitter" class="otFieldLabel">{#PLIGG_User_Profile_Twitter#}:</label>
							<input type="text" id="twitter" name="twitter" value="{$user_twitter}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="linkedin" class="otFieldLabel">{#PLIGG_User_Profile_Linkedin#}:</label>
							<input type="text" id="linkedin" name="linkedin" value="{$user_linkedin}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="googleplus" class="otFieldLabel">{#PLIGG_User_Profile_Googleplus#}:</label>
							<input type="text" id="googleplus" name="googleplus" value="{$user_googleplus}" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="pinterest" class="otFieldLabel">{#PLIGG_User_Profile_Pinterest#}:</label>
							<input type="text" id="pinterest" name="pinterest" value="{$user_pinterest}" class="otFieldInput" />
						</p>
					</fieldset>
					{checkActionsTpl location="tpl_pligg_profile_settings_start"}
					<h3 class=userSectionHeading>{#PLIGG_User_Display_Settings#}</h3>
					<fieldset>
						{php}
						if (user_language) {
						{/php}
							<p class="otField">
								<label for="language" class="otFieldLabel">{#PLIGG_Visual_User_Profile_Language#}:</label>
								<select id="language" name="language">
									{foreach from=$languages value=lang}
										<option{if $lang==$user_language} selected="selected"{/if}>{$lang}</option>
									{/foreach}
								</select>
							</p>
						{php}
						}
						{/php}						
						{if $Allow_User_Change_Templates}
							{if count($templates) gt 1}
								<p class="otField">
									<label for="template" class="otFieldLabel">{#PLIGG_Visual_User_Setting_Template#}:</label>
									<select id="template" name="template">
										{foreach from=$templates item=template}
											<option{if $template==$current_template} selected="selected"{/if}>{$template|capitalize}</option>
										{/foreach}
									</select>
								</p>
							{/if}
						{/if}
						<div class="otField">
							<label class="otFieldLabel">{#PLIGG_Visual_User_Setting_Categories#}:</label>
							<div class="otFieldInputWrap">
								<ul>
									{foreach from=$category item=cat name="cate"}
										<li>
											<input type="checkbox" name="chack[]" value="{$cat.category__auto_id}"{if !in_array($cat.category__auto_id,$user_category)} checked="checked"{/if} />
											{$cat.category_name}
										</li>
									{/foreach}
								</ul>
							</div>
						</div>
					</fieldset>
					{checkActionsTpl location="tpl_pligg_profile_settings_end"}
					<h3 class=userSectionHeading>{#PLIGG_Visual_Profile_ChangePass#}</h3>
					<fieldset class="userSettingsPass">
						<p class="otField">
							<label for="oldpassword" class="otFieldLabel">{#PLIGG_Visual_Profile_OldPass#}:</label>
							<input type="password" id="oldpassword" name="oldpassword" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="newpassword" class="otFieldLabel">{#PLIGG_Visual_Profile_NewPass#}:</label>
							<input type="password" id="newpassword" name="newpassword" class="otFieldInput" />
						</p>
						<p class="otField">
							<label for="verify" class="otFieldLabel">{#PLIGG_Visual_Profile_VerifyNewPass#}:</label>
							<input type="password" id="verify" name="newpassword2" class="otFieldInput" />
						</p>
						<p class="otField aRight">
							{$hidden_token_profile_change}
							<input type="hidden" name="process" value="1" />
							<input type="hidden" name="user_id" value="{$user_id}" />
							<input type="submit" name="save_profile" value="{#PLIGG_Visual_Profile_Save#}" class="button buttonAction" />
						</p>
					</fieldset>
				</form>
			</div>
			{checkActionsTpl location="tpl_pligg_profile_end"}