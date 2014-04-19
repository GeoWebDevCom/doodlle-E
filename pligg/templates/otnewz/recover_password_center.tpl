<div class="contentWrap pageWrap">
	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">Password Recover</h2>
	</div>
	<div id="login" class="contentBlock contentBlockSpace">
		<form id="loginForm" action="recover.php" method="post" class="otForm">
			{if $errorMsg ne ""}
				<div class="formError">
					<p>{$errorMsg}</p>
				</div>
			{/if}
			{if isset($form_password_error)}
				{foreach value=error from=$form_password_error}
					<div class="formError">
						<p>{$error}</p>
					</div>
				{/foreach}
			{/if}
			<fieldset>
				<p class="otField">
					<label for="reg_password" class="otFieldLabel otFieldLabelUsername">{#PLIGG_Visual_New_Password#}:</label>
					<input type="text" id="reg_password" name="reg_password" class="otFieldInput" />
				</p>
				<p class="otField">
					<label for="reg_verify" class="otFieldLabel">{#PLIGG_Visual_New_Verify_Password#}:</label>
					<input type="password" id="reg_verify" name="reg_password2" class="otFieldInput" />
				</p>
				<p class="otField last">
					<span class="remember">
						&nbsp;
					</span>
					<span class="loginAction">
						<input type="hidden" name="processrecover" value="1" />
						<input type="hidden" name="id" value="{$id}" />
						<input type="hidden" name="n" value="{$n}"  />
						<input type="submit" value="Submit" class="button buttonAction" />
					</span>
				</p>
			</fieldset>
		</form>
	</div>
</div>