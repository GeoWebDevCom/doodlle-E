{config_load file=otsliderLangConf}
<div id="otslider" class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">{#PLIGG_OTslider_Module#}</h3>
	</div>
	<div class="panel-body">
		<p>{#PLIGG_OTslider_Desc#}</p>
	</div>
	<ul class="nav nav-tabs">
		<li class="active"><a href="{$otsliderSettingsPath}">{#PLIGG_OTslider_Slides#}</a></li>
		<li><a href="{$otsliderSettingsPath}&amp;do=addSlide">{#PLIGG_OTslider_Add#}</a></li>
	</ul>
	<div class="panel-body">		
		<table id="otsliderList" class="table table-bordered table-striped">
			<thead>
				<tr>
					<td>Image</td>
					<td class="text-center">Order</td>
					<td>{#PLIGG_OTslider_Title#}</td>
					<td>{#PLIGG_OTslider_Status#}</td>
					<td class="text-right">{#PLIGG_OTslider_Actions#}</td>
				</tr>
			</thead>
			{section name=otSlides loop=$slidesList}
				<tr>
					<td width="68">
						<div class="thumbWrap">
							<a href="#" data-toggle="modal" data-target="#slideModal-{$slidesList[otSlides].otslider_id}"><img src="{$otsliderPath}data/thumbs/{$slidesList[otSlides].otslider_image_thumb}" alt="" class="img-responsive" /></a>
						</div>
						<div class="modal fade" id="slideModal-{$slidesList[otSlides].otslider_id}" tabindex="-1" role="dialog" aria-labelledby="slideModalLabel-{$slidesList[otSlides].otslider_id}" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="slideModalLabel-{$slidesList[otSlides].otslider_id}">{$slidesList[otSlides].otslider_title}</h4>
									</div>
									<div class="modal-body">
										<img src="{$otsliderPath}data/uploads/{$slidesList[otSlides].otslider_image}" alt="" class="img-responsive" />
									</div>
								</div>
							</div>
						</div>
					</td>
					<td width="60" class="text-center">{$slidesList[otSlides].otslider_rank}</td>
					<td>{$slidesList[otSlides].otslider_title}</td>
					<td width="95">
						{if $slidesList[otSlides].otslider_user_id eq $user_id}
							{if $slidesList[otSlides].otslider_status eq "Enabled"}
								<a href="{$otsliderSettingsPath}&amp;do=disableSlide&amp;slideID={$slidesList[otSlides].otslider_id}" title="Disable Slide">
									<span class="glyphicon glyphicon-ok text-success"></span>
									<span class="text-success">{$slidesList[otSlides].otslider_status}</span>
								</a>
							{else}
								<a href="{$otsliderSettingsPath}&amp;do=enableSlide&amp;slideID={$slidesList[otSlides].otslider_id}" title="Enable Slide">
									<span class="glyphicon glyphicon-remove text-danger"></span>
									<span class="text-danger">{$slidesList[otSlides].otslider_status}</span>
								</a>
							{/if}
						{else}
							{if $slidesList[otSlides].otslider_status eq "Enabled"}
								<span class="glyphicon glyphicon-ok text-success"></span>
							{else}
								<span class="glyphicon glyphicon-remove text-danger"></span>
							{/if}
							<span class="{if $slidesList[otSlides].otslider_status eq "Enabled"}text-success{else}text-danger{/if}">{$slidesList[otSlides].otslider_status}</span>
						{/if}
					</td>
					<td width="140" class="text-right">
						{if $slidesList[otSlides].otslider_user_id eq $user_id}
							<a href="{$otsliderSettingsPath}&amp;do=editSlide&amp;slideID={$slidesList[otSlides].otslider_id}" class="btn btn-warning">{#PLIGG_OTslider_Actions_Edit#}</a>
							<a href="{$otsliderSettingsPath}&amp;do=deleteSlide&amp;slideID={$slidesList[otSlides].otslider_id}" onclick="return confirm('Delete &quot;{$slidesList[otSlides].otslider_title}&quot; Slide?')" class="btn btn-danger">{#PLIGG_OTslider_Actions_Delete#}</a>
						{else}
							<span class="glyphicon glyphicon-remove text-danger"></span>
							<span class="text-danger">No Permissions</span>
						{/if}
					</td>
				</tr>
			{sectionelse}
				<tr>
					<td colspan="5" class="text-center">
						There are no slides to show here at the moment.
						<a href="{$otsliderSettingsPath}&amp;do=addSlide" class="btn btn-success btn-xs">Add Slide Now!</a>
					</td>
				</tr>
			{/section}
		</table>
	</div>
	<div class="panel-footer">
		<a href="#">OTslider Documentation</a>
		&nbsp; &bull; &nbsp;
		<a href="http://www.oxythemes.com/forums/7-otslider-pligg-module/" target="_blank">OTslider Support Forum</a>
	</div>
</div>
{config_load file=otsliderPliggLangConf}