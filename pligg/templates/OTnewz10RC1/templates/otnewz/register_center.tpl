	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Login_NewUsersB#}</h2>
	</div>
	<div id="register" class="contentBlock contentBlockSpace">
		{checkActionsTpl location="tpl_pligg_register_start"}
		<form id="regForm" action="{$URL_register}" method="post" class="otForm">
			{if isset($form_username_error) || isset($form_email_error) || isset($form_password_error) || isset($register_captcha_error)}
				<div class="formError">
					<h3 class="formErrorHeader">Error(s) Found:</h3>
					<ul class="formErrorContent">
						{if isset($form_username_error)}
							{foreach value=error from=$form_username_error}
								<li>{$error}</li>
							{/foreach}
						{/if}
						{if isset($form_email_error)}
							{foreach value=error from=$form_email_error}
								<li>{$error}</li>
							{/foreach }
						{/if}
						{if isset($form_password_error)}
							{foreach value=error from=$form_password_error}
								<li>{$error}</li>
							{/foreach}
						{/if}
						{if isset($register_captcha_error)}
							<li>{$register_captcha_error}</li>
						{/if}
					</ul>
				</div>
			{/if}
			<fieldset>
				<p class="otField">
					<label for="reg_username" class="otFieldLabel otFieldLabelUsername">{#PLIGG_Visual_Register_Username#}:</label>
					<input type="text" id="reg_username" name="reg_username" required="required" autofocus="autofocus" value="{if isset($reg_username)}{$reg_username}{/if}" class="otFieldInput" />
				</p>
				<p class="otField">
					<label for="reg_email" class="otFieldLabel">{#PLIGG_Visual_Register_Email#}:</label>
					<input type="email" id="reg_email" name="reg_email" required="required" value="{if isset($reg_email)}{$reg_email}{/if}" class="otFieldInput" />
				</p>
				<p class="otField">
					<label for="reg_password" class="otFieldLabel">{#PLIGG_Visual_Register_Password#}:</label>
					<input type="password" id="reg_password" name="reg_password" required="required" class="otFieldInput" />
				</p>
				<p class="otField">
					<label for="reg_verify" class="otFieldLabel">{#PLIGG_Visual_Register_Verify_Password#}:</label>
					<input type="password" id="reg_verify" name="reg_password2" required="required" class="otFieldInput" />
				</p>
				{if isset($register_step_1_extra)}
				<div class="otField">
					<label for="adcopy_response" class="otFieldLabel">CAPTCHA:</label>
					<div class="otFieldInputWrap">
						{$register_step_1_extra}
					</div>
				</div>
				{/if}
				<p class="otField otFieldAction aRight last">
					<input type="hidden" name="regfrom" value="full" />
					<input type="submit" value="Create User" class="button buttonAction" />
				</p>
			</fieldset>
		</form>
		{checkActionsTpl location="tpl_pligg_register_end"}
		<div class="formBox">
			<h2 class="formBoxHeader">{#PLIGG_Visual_Register_Description_Title#}</h2>
			<div class="formBoxContent">
				<p>
					{#PLIGG_Visual_Register_Description_Paragraph#}
				</p>
				<ul>
					{#PLIGG_Visual_Register_Description_Points#}
				</ul>
			</div>
		</div>
	</div>