<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:59:41 UTC */ ?>

<?php $this->config_load(otsliderLangConf, null, null); ?>
<div id="otslider" class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $this->_confs['PLIGG_OTslider_Module']; ?>
</h3>
	</div>
	<div class="panel-body">
		<p><?php echo $this->_confs['PLIGG_OTslider_Desc']; ?>
</p>
	</div>
	<ul class="nav nav-tabs">
		<li class="active"><a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
"><?php echo $this->_confs['PLIGG_OTslider_Slides']; ?>
</a></li>
		<li><a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=addSlide"><?php echo $this->_confs['PLIGG_OTslider_Add']; ?>
</a></li>
	</ul>
	<div class="panel-body">		
		<table id="otsliderList" class="table table-bordered table-striped">
			<thead>
				<tr>
					<td>Image</td>
					<td class="text-center">Order</td>
					<td><?php echo $this->_confs['PLIGG_OTslider_Title']; ?>
</td>
					<td><?php echo $this->_confs['PLIGG_OTslider_Status']; ?>
</td>
					<td class="text-right"><?php echo $this->_confs['PLIGG_OTslider_Actions']; ?>
</td>
				</tr>
			</thead>
			<?php if (isset($this->_sections['otSlides'])) unset($this->_sections['otSlides']);
$this->_sections['otSlides']['name'] = 'otSlides';
$this->_sections['otSlides']['loop'] = is_array($this->_vars['slidesList']) ? count($this->_vars['slidesList']) : max(0, (int)$this->_vars['slidesList']);
$this->_sections['otSlides']['show'] = true;
$this->_sections['otSlides']['max'] = $this->_sections['otSlides']['loop'];
$this->_sections['otSlides']['step'] = 1;
$this->_sections['otSlides']['start'] = $this->_sections['otSlides']['step'] > 0 ? 0 : $this->_sections['otSlides']['loop']-1;
if ($this->_sections['otSlides']['show']) {
	$this->_sections['otSlides']['total'] = $this->_sections['otSlides']['loop'];
	if ($this->_sections['otSlides']['total'] == 0)
		$this->_sections['otSlides']['show'] = false;
} else
	$this->_sections['otSlides']['total'] = 0;
if ($this->_sections['otSlides']['show']):

		for ($this->_sections['otSlides']['index'] = $this->_sections['otSlides']['start'], $this->_sections['otSlides']['iteration'] = 1;
			 $this->_sections['otSlides']['iteration'] <= $this->_sections['otSlides']['total'];
			 $this->_sections['otSlides']['index'] += $this->_sections['otSlides']['step'], $this->_sections['otSlides']['iteration']++):
$this->_sections['otSlides']['rownum'] = $this->_sections['otSlides']['iteration'];
$this->_sections['otSlides']['index_prev'] = $this->_sections['otSlides']['index'] - $this->_sections['otSlides']['step'];
$this->_sections['otSlides']['index_next'] = $this->_sections['otSlides']['index'] + $this->_sections['otSlides']['step'];
$this->_sections['otSlides']['first']	  = ($this->_sections['otSlides']['iteration'] == 1);
$this->_sections['otSlides']['last']	   = ($this->_sections['otSlides']['iteration'] == $this->_sections['otSlides']['total']);
?>
				<tr>
					<td width="68">
						<div class="thumbWrap">
							<a href="#" data-toggle="modal" data-target="#slideModal-<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
"><img src="<?php echo $this->_vars['otsliderPath']; ?>
data/thumbs/<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_image_thumb']; ?>
" alt="" class="img-responsive" /></a>
						</div>
						<div class="modal fade" id="slideModal-<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" tabindex="-1" role="dialog" aria-labelledby="slideModalLabel-<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="slideModalLabel-<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
"><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_title']; ?>
</h4>
									</div>
									<div class="modal-body">
										<img src="<?php echo $this->_vars['otsliderPath']; ?>
data/uploads/<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_image']; ?>
" alt="" class="img-responsive" />
									</div>
								</div>
							</div>
						</div>
					</td>
					<td width="60" class="text-center"><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_rank']; ?>
</td>
					<td><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_title']; ?>
</td>
					<td width="95">
						<?php if ($this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_user_id'] == $this->_vars['user_id']): ?>
							<?php if ($this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status'] == "Enabled"): ?>
								<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=disableSlide&amp;slideID=<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" title="Disable Slide">
									<span class="glyphicon glyphicon-ok text-success"></span>
									<span class="text-success"><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status']; ?>
</span>
								</a>
							<?php else: ?>
								<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=enableSlide&amp;slideID=<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" title="Enable Slide">
									<span class="glyphicon glyphicon-remove text-danger"></span>
									<span class="text-danger"><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status']; ?>
</span>
								</a>
							<?php endif; ?>
						<?php else: ?>
							<?php if ($this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status'] == "Enabled"): ?>
								<span class="glyphicon glyphicon-ok text-success"></span>
							<?php else: ?>
								<span class="glyphicon glyphicon-remove text-danger"></span>
							<?php endif; ?>
							<span class="<?php if ($this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status'] == "Enabled"): ?>text-success<?php else: ?>text-danger<?php endif; ?>"><?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_status']; ?>
</span>
						<?php endif; ?>
					</td>
					<td width="140" class="text-right">
						<?php if ($this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_user_id'] == $this->_vars['user_id']): ?>
							<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=editSlide&amp;slideID=<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" class="btn btn-warning"><?php echo $this->_confs['PLIGG_OTslider_Actions_Edit']; ?>
</a>
							<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=deleteSlide&amp;slideID=<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_id']; ?>
" onclick="return confirm('Delete &quot;<?php echo $this->_vars['slidesList'][$this->_sections['otSlides']['index']]['otslider_title']; ?>
&quot; Slide?')" class="btn btn-danger"><?php echo $this->_confs['PLIGG_OTslider_Actions_Delete']; ?>
</a>
						<?php else: ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							<span class="text-danger">No Permissions</span>
						<?php endif; ?>
					</td>
				</tr>
			<?php endfor; else: ?>
				<tr>
					<td colspan="5" class="text-center">
						There are no slides to show here at the moment.
						<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=addSlide" class="btn btn-success btn-xs">Add Slide Now!</a>
					</td>
				</tr>
			<?php endif; ?>
		</table>
	</div>
	<div class="panel-footer">
		<a href="#">OTslider Documentation</a>
		&nbsp; &bull; &nbsp;
		<a href="http://www.oxythemes.com/forums/7-otslider-pligg-module/" target="_blank">OTslider Support Forum</a>
	</div>
</div>
<?php $this->config_load(otsliderPliggLangConf, null, null); ?>