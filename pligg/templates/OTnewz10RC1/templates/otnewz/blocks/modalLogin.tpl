<div id="modalLogin" class="modal">
	<h3 class="modalHeader">
		{#PLIGG_Visual_Login_LoginButton#}
		<span class="modalClose"></span>
	</h3>
	<p class="modalLoginInfo">
		You must login to do that! No account? <a href="{$URL_register}" rel="nofollow">Join now!</a>
	</p>
	<div class="modalContent noLoginSocial">
		{checkActionsTpl location="tpl_widget_login_start"}
		<form action="{$URL_login}" method="post" class="otForm modalLoginForm">
			<fieldset>
				<p class="otField">
					<label for="username" class="otFieldLabel">{#PLIGG_Visual_Login_Username#}:</label>
					<input type="text" id="username" name="username" required="required" value="{if isset($login_username)}{$login_username}{/if}" />
				</p>
				<p class="otField">
					<label for="password" class="otFieldLabel">{#PLIGG_Visual_Login_Password#}:</label>
					<input type="password" id="password" name="password" required="required" />
				</p>
				<p class="otField last">
					<span class="remember">
						<input type="checkbox" id="remember" name="persistent" />
						<label for="remember" class="otFieldLabel checkRadio">{#PLIGG_Visual_Login_Remember#}</label>
					</span>
					<span class="modalLoginAction">
						<input type="hidden" name="processlogin" value="1" />
						<input type="hidden" name="return" value="{$templatelite.get.return|sanitize:3}" />
						<input type="submit" value="{#PLIGG_Visual_Login_LoginButton#}" class="button buttonAction" />
					</span>
				</p>
			</fieldset>
		</form>
		{checkActionsTpl location="tpl_widget_login_end"}
	</div>
	{checkActionsTpl location="tpl_pligg_login_link"}
</div>