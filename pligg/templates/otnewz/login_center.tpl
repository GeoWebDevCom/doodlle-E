<div class="contentWrap pageWrap">
	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Login_Login#}</h2>
	</div>
	<div id="login" class="contentBlock contentBlockSpace">
		{checkActionsTpl location="tpl_login_top"}
		<form id="loginForm" action="" method="post" class="otForm">
			{if $errorMsg ne ""}
				<div class="formError">
					<p>{$errorMsg}</p>
				</div>
			{/if}
			<fieldset>
				<p class="otField">
					<label for="username" class="otFieldLabel otFieldLabelUsername">{#PLIGG_Visual_Login_Username#}/{#PLIGG_Visual_Register_Email#}:</label>
					<input type="text" id="username" name="username" required="required" autofocus="autofocus" value="{if isset($login_username)}{$login_username}{/if}" class="otFieldInput" />
				</p>
				<p class="otField">
					<label for="password" class="otFieldLabel">{#PLIGG_Visual_Login_Password#}:</label>
					<input type="password" id="password" name="password" required="required" class="otFieldInput" />
				</p>
				<p class="otField last">
					<span class="remember">
						<input type="checkbox" id="persistent" name="persistent" />
						<label for="persistent" class="otFieldLabel checkRadio">{#PLIGG_Visual_Login_Remember#}</label>
					</span>
					<span class="loginAction">
						<input type="hidden" name="processlogin" value="1" />
						<input type="hidden" name="return" value="{$get.return}" />
						<input type="submit" value="{#PLIGG_Visual_Login_LoginButton#}" class="button buttonAction" />
					</span>
				</p>
			</fieldset>
		</form>
		{checkActionsTpl location="tpl_login_bottom"}
	</div>
</div>
<div class="contentWrap pageWrap">
	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Login_ForgottenPassword#}</h2>
	</div>
	<div id="forgotPass" class="contentBlock contentBlockSpace">
		<p class="forgetPassDesc">
			{#PLIGG_Visual_Login_EmailChangePass#}
		</p>
		<form id="forgotPassForm" action="{$URL_login}" method="post" class="otForm">
			<fieldset>
				<p class="otField">
					<label for="forgot-email" class="otFieldLabel">{#PLIGG_Visual_Register_Email#}:</label>
					<input type="email" id="forgot-email" name="email" required="required" value="" class="otFieldInput" />
				</p>
				<p class="otField aRight last">
					<input type="hidden" name="processlogin" value="3" />
					<input type="hidden" name="return" value="{$get.return}" />
					<input type="submit" value="Submit" id="forgotPassButton" class="button buttonAction" />
				</p>
			</fieldset>
		</form>
	</div>
</div>