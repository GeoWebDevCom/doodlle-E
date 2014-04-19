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
		<li class="active"><a href="{$otsliderSettingsPath}&amp;do=addSlide">{#PLIGG_OTslider_Edit_Tab#}</a></li>
		<li><a href="{$otsliderSettingsPath}&amp;do=addSlide">{#PLIGG_OTslider_Add#}</a></li>
	</ul>
	<div class="panel-body">
		{if $editSlideError}
			<div class="alert alert-danger">
				{foreach from=$editSlideErrorMsg item=errorMsgs}
					<p>{$errorMsgs}</p>
				{/foreach}
			</div>
		{/if}
		{if $editSlideImgError}
			<div class="alert alert-danger">
				{$editSlidImgeErrorMsg}
			</div>
		{/if}
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label for="inputSlideTitle" class="col-sm-3 control-label">{#PLIGG_OTslider_Title#}</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideTitle" name="inputSlideTitle" value="{$slideRow.otslider_title}" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURL" class="col-sm-3 control-label">{#PLIGG_OTslider_URL#}</label>
				<div class="col-sm-9">
					<input type="url" id="inputSlideURL" name="inputSlideURL" value="{$slideRow.otslider_link}" placeholder="http://" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURLTarget" class="col-sm-3 control-label">{#PLIGG_OTslider_URL_Target#}</label>
				<div class="col-sm-9">
					<select id="inputSlideURLTarget" name="inputSlideURLTarget" class="form-control">
						<option value="_parent"{if $slideRow.otslider_link_target eq "_parent"} selected="slected"{/if}>_parent</option>
						<option value="_blank"{if $slideRow.otslider_link_target eq "_blank"} selected="slected"{/if}>_blank</option>
						<option value="_self"{if $slideRow.otslider_link_target eq "_self"} selected="slected"{/if}>_self</option>
						<option value="_top"{if $slideRow.otslider_link_target eq "_top"} selected="slected"{/if}>_top</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideOrder" class="col-sm-3 control-label">{#PLIGG_OTslider_Order#}</label>
				<div class="col-sm-9">
					<input type="number" id="inputSlideOrder" name="inputSlideOrder" value="{$slideRow.otslider_rank}" min="1" max="100" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImage" class="col-sm-3 control-label">{#PLIGG_OTslider_Image_Current#}</label>
				<div class="col-sm-9">
					<img src="{$otsliderPath}data/uploads/{$slideRow.otslider_image}" alt="{$slideRow.otslider_image_alt}" class="img-responsive" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImage" class="col-sm-3 control-label">{#PLIGG_OTslider_Image_Change#}</label>
				<div class="col-sm-9">
					<input type="file" id="inputSlideImage" name="inputSlideImage" value="" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImageAlt" class="col-sm-3 control-label">{#PLIGG_OTslider_Image_Alt#}</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideImageAlt" name="inputSlideImageAlt" value="{$slideRow.otslider_image_alt}" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideStatus" class="col-sm-3 control-label">{#PLIGG_OTslider_Status#}</label>
				<div class="col-sm-9">
					<select id="inputSlideStatus" name="inputSlideStatus" class="form-control">
						<option value="Enabled"{if $slideRow.otslider_status eq "Enabled"} selected="slected"{/if}>Enabled</option>
						<option value="Disabled"{if $slideRow.otslider_status eq "Disabled"} selected="slected"{/if}>Disabled</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<a href="{$otsliderSettingsPath}" class="btn btn-default">Cancel</a>
					<input type="hidden" name="editSlide" value="updateSlide" />
					<input type="submit" value="{#PLIGG_OTslider_Edit_Tab#}" class="btn btn-success" />
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