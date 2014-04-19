	<div class="xFolkHeader">
		<h2 class="xFolkHeaderTitle">Submission Result</h2>
	</div>
	<div id="submitError" class="contentBlock contentBlockSpace">
		{if $submit_error eq 'invalidurl'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit2Errors_InvalidURL#}{if $submit_url eq "http://"}. {#PLIGG_Visual_Submit2Errors_InvalidURL_Specify#}{else}: {$submit_url}{/if}</p>
			</div>
			<form id="errorForm">
				<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit2Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'dupeurl'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<ul class="formErrorContent">
					<li>{#PLIGG_Visual_Submit2Errors_DupeArticleURL#}: {$submit_url}</li>
					<li>{#PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct#}</li>
					<li><a href="{$submit_search}"><strong>{#PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct2#}</strong></a></li>
				</ul>
			</div>
			<form id="errorForm">
				<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit2Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'badkey'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_BadKey#}</p>
			</div>
			<form id="errorForm">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'hashistory'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_HasHistory#}: {$submit_error_history}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}"  class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'urlintitle'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_URLInTitle#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'incomplete'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_Incomplete#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'long_title'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_Long_Title#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'long_content'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_Long_Content#}</p>
			</div>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'long_tags'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_Long_Tags#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		
		{if $submit_error eq 'short_tags'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Submit3Errors_Short_Tags#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		
		{if $submit_error eq 'long_summary'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
				<p>{#PLIGG_Visual_Submit3Errors_Long_Summary#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
		{if $submit_error eq 'nocategory'}
			<div class="formError">
				<h3 class="formErrorHeader">Error Found:</h3>
			<p>{#PLIGG_Visual_Submit3Errors_NoCategory#}</p>
			</div>
			<form id="thisform">
				<input type="button" onclick="gPageIsOkToExit=true; document.location.href='{$my_base_url}{$my_pligg_base}/{$pagename}.php?id={$link_id}';" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="button buttonLink" />
			</form>
		{/if}
	</div>