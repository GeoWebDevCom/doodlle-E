	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">{#PLIGG_Visual_Submit1_Header#}</h2>
	</div>
	<div id="submitOne" class="contentBlock contentBlockSpace">
		<form id="submitForm" action="{if $UrlMethod == "2"}{$URL_submit}{else}submit.php{/if}" method="post" class="otForm">
			<ol class="submitStep">
				<li class="submitStepOne current">1</li>
				<li class="submitStepLast">2</li>
			</ol>
			<fieldset>
				<p class="otField">
					<input type="url" id="url" name="url" required="required" autofocus="autofocus" value="" placeholder="http://" class="otFieldInput" />
					<input type="submit" value="Continue" class="button buttonAction submitOneButton" />
				</p>
				<p class="otField submitURLField">
					<label for="url" class="submitURLLabel">{#PLIGG_Visual_Submit1_NewsURL#}</label>
					<span class="submitURLDesc">
						Fill in the unique URL of the story or news you are going to submit in our {#PLIGG_Visual_Name#} social bookmarking website. It should begin with <strong>http://</strong> or <strong>https://</strong>
					</span>
				</p>
				<p class="otField otFieldAction aRight last">
					<input type="hidden" name="phase" value="1" />
					<input type="hidden" name="randkey" value="{$submit_rand}" />
					<input type="hidden" name="id" value="c_1" />
					<input type="submit" value="{#PLIGG_Visual_Submit1_Continue#}" class="button buttonAction submitOneButtonExtra" />
				</p>
				{checkActionsTpl location="tpl_pligg_submit_step1_end"}
			</fieldset>
			<div id="submitBookmarklet" class="formBox">
				<h2 class="formBoxHeader">{#PLIGG_Visual_User_Profile_Bookmarklet_Title#}</h2>
				<div class="formBoxContent">
					<p>
						{#PLIGG_Visual_User_Profile_Bookmarklet_Title_1#} {#PLIGG_Visual_Name#}.{#PLIGG_Visual_User_Profile_Bookmarklet_Title_2#}
					</p>
					<ul>
						<li><strong>{#PLIGG_Visual_User_Profile_IE#}:</strong> {#PLIGG_Visual_User_Profile_IE_1#}</li>
						<li><strong>{#PLIGG_Visual_User_Profile_Firefox#}:</strong> {#PLIGG_Visual_User_Profile_Firefox_1#}</li>
						<li><strong>{#PLIGG_Visual_User_Profile_Opera#}:</strong> {#PLIGG_Visual_User_Profile_Opera_1#}</li>
					</ul>
					<span class="submitBookmarkletLink">{#PLIGG_Visual_User_Profile_The_Bookmarklet#}: <a href="javascript:q=(document.location.href);void(open('{$my_base_url}{$my_pligg_base}/submit.php?url='+escape(q),'','resizable,location,menubar,toolbar,scrollbars,status'));">{#PLIGG_Visual_Name#}</a></span>
				</div>
			</div>
		</form>
		{checkActionsTpl location="tpl_pligg_submit_step1_middle"}
		<div id="submitRules" class="formBox">
			<h2 class="formBoxHeader">Submission Guidelines</h2>
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