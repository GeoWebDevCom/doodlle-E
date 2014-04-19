{config_load file=otsliderLangConf}
<div id="otsliderAdd" class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">{#PLIGG_OTslider_Module#}</h3>
	</div>
	<div class="panel-body">
		<p>{#PLIGG_OTslider_Desc#}</p>
	</div>
	<ul class="nav nav-tabs">
		<li><a href="{$otsliderSettingsPath}">{#PLIGG_OTslider_Slides#}</a></li>
		<li class="active"><a href="{$otsliderSettingsPath}&amp;do=addSlide">{#PLIGG_OTslider_Add#}</a></li>
	</ul>
	<div class="panel-body">
		{if $addSlideError}
			<div class="alert alert-danger">
				{foreach from=$addSlideErrorMsg item=errorMsgs}
					<p>{$errorMsgs}</p>
				{/foreach}
			</div>
		{/if}
		{if $addSlideImgError}
			<div class="alert alert-danger">
				{$addSlidImgeErrorMsg}
			</div>
		{/if}
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label for="inputSlideTitle" class="col-sm-3 control-label">{#PLIGG_OTslider_Title#}</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideTitle" name="inputSlideTitle" value="{php} echo isset($_POST['inputSlideTitle']) ? $_POST['inputSlideTitle'] : null; {/php}" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURL" class="col-sm-3 control-label">{#PLIGG_OTslider_URL#}</label>
				<div class="col-sm-9">
					<input type="url" id="inputSlideURL" name="inputSlideURL" value="{php} echo isset($_POST['inputSlideURL']) ? $_POST['inputSlideURL'] : null; {/php}" placeholder="http://" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURLTarget" class="col-sm-3 control-label">{#PLIGG_OTslider_URL_Target#}</label>
				<div class="col-sm-9">
					<select id="inputSlideURLTarget" name="inputSlideURLTarget" class="form-control">
						<option value="_parent"{php} if ($_POST['inputSlideURLTarget'] == '_parent') echo ' selected="slected"'; {/php}>_parent</option>
						<option value="_blank"{php} if($_POST['inputSlideURLTarget'] == '_blank') echo ' selected="slected"'; {/php}>_blank</option>
						<option value="_self"{php} if($_POST['inputSlideURLTarget'] == '_self') echo ' selected="slected"'; {/php}>_self</option>
						<option value="_top"{php} if ($_POST['inputSlideURLTarget'] == '_top') echo ' selected="slected"'; {/php}>_top</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideOrder" class="col-sm-3 control-label">{#PLIGG_OTslider_Order#}</label>
				<div class="col-sm-9">
					<input type="number" id="inputSlideOrder" name="inputSlideOrder" value="{php} echo isset($_POST['inputSlideOrder']) ? $_POST['inputSlideOrder'] : null; {/php}" min="1" max="100" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImage" class="col-sm-3 control-label">{#PLIGG_OTslider_Image#}</label>
				<div class="col-sm-9">
					<input type="file" id="inputSlideImage" name="inputSlideImage" value="" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImageAlt" class="col-sm-3 control-label">{#PLIGG_OTslider_Image_Alt#}</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideImageAlt" name="inputSlideImageAlt" value="{php} echo isset($_POST['inputSlideImageAlt']) ? $_POST['inputSlideImageAlt'] : null; {/php}" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideStatus" class="col-sm-3 control-label">{#PLIGG_OTslider_Status#}</label>
				<div class="col-sm-9">
					<select id="inputSlideStatus" name="inputSlideStatus" class="form-control">
						<option value="Enabled"{php} if ($_POST['inputSlideStatus'] == 'Enabled') echo ' selected="slected"'; {/php}>Enabled</option>
						<option value="Disabled"{php} if ($_POST['inputSlideStatus'] == 'Disabled') echo ' selected="slected"'; {/php}>Disabled</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<a href="{$otsliderSettingsPath}" class="btn btn-default">Cancel</a>
					<input type="hidden" name="addSlide" value="submitSlide" />
					<input type="submit" value="{#PLIGG_OTslider_Add#}" class="btn btn-success" />
				</div>
			</div>
		</form>
	</div>
	<div class="panel-footer">
		<a href="http://www.oxythemes.com/support/docs/otslider/" target="_blank">OTslider Documentation</a>
		&nbsp; &bull; &nbsp;
		<a href="http://www.oxythemes.com/forums/7-otslider-pligg-module/" target="_blank">OTslider Support Forum</a>
	</div>
</div>
{config_load file=otsliderPliggLangConf}