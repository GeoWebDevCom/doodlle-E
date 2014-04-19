<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:59:46 UTC */ ?>

<?php $this->config_load(otsliderLangConf, null, null); ?>
<div id="otsliderAdd" class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $this->_confs['PLIGG_OTslider_Module']; ?>
</h3>
	</div>
	<div class="panel-body">
		<p><?php echo $this->_confs['PLIGG_OTslider_Desc']; ?>
</p>
	</div>
	<ul class="nav nav-tabs">
		<li><a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
"><?php echo $this->_confs['PLIGG_OTslider_Slides']; ?>
</a></li>
		<li class="active"><a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
&amp;do=addSlide"><?php echo $this->_confs['PLIGG_OTslider_Add']; ?>
</a></li>
	</ul>
	<div class="panel-body">
		<?php if ($this->_vars['addSlideError']): ?>
			<div class="alert alert-danger">
				<?php if (count((array)$this->_vars['addSlideErrorMsg'])):  foreach ((array)$this->_vars['addSlideErrorMsg'] as $this->_vars['errorMsgs']): ?>
					<p><?php echo $this->_vars['errorMsgs']; ?>
</p>
				<?php endforeach; endif; ?>
			</div>
		<?php endif; ?>
		<?php if ($this->_vars['addSlideImgError']): ?>
			<div class="alert alert-danger">
				<?php echo $this->_vars['addSlidImgeErrorMsg']; ?>

			</div>
		<?php endif; ?>
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label for="inputSlideTitle" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_Title']; ?>
</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideTitle" name="inputSlideTitle" value="<?php  echo isset($_POST['inputSlideTitle']) ? $_POST['inputSlideTitle'] : null;  ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURL" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_URL']; ?>
</label>
				<div class="col-sm-9">
					<input type="url" id="inputSlideURL" name="inputSlideURL" value="<?php  echo isset($_POST['inputSlideURL']) ? $_POST['inputSlideURL'] : null;  ?>" placeholder="http://" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideURLTarget" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_URL_Target']; ?>
</label>
				<div class="col-sm-9">
					<select id="inputSlideURLTarget" name="inputSlideURLTarget" class="form-control">
						<option value="_parent"<?php  if ($_POST['inputSlideURLTarget'] == '_parent') echo ' selected="slected"';  ?>>_parent</option>
						<option value="_blank"<?php  if($_POST['inputSlideURLTarget'] == '_blank') echo ' selected="slected"';  ?>>_blank</option>
						<option value="_self"<?php  if($_POST['inputSlideURLTarget'] == '_self') echo ' selected="slected"';  ?>>_self</option>
						<option value="_top"<?php  if ($_POST['inputSlideURLTarget'] == '_top') echo ' selected="slected"';  ?>>_top</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideOrder" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_Order']; ?>
</label>
				<div class="col-sm-9">
					<input type="number" id="inputSlideOrder" name="inputSlideOrder" value="<?php  echo isset($_POST['inputSlideOrder']) ? $_POST['inputSlideOrder'] : null;  ?>" min="1" max="100" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImage" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_Image']; ?>
</label>
				<div class="col-sm-9">
					<input type="file" id="inputSlideImage" name="inputSlideImage" value="" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideImageAlt" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_Image_Alt']; ?>
</label>
				<div class="col-sm-9">
					<input type="text" id="inputSlideImageAlt" name="inputSlideImageAlt" value="<?php  echo isset($_POST['inputSlideImageAlt']) ? $_POST['inputSlideImageAlt'] : null;  ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="inputSlideStatus" class="col-sm-3 control-label"><?php echo $this->_confs['PLIGG_OTslider_Status']; ?>
</label>
				<div class="col-sm-9">
					<select id="inputSlideStatus" name="inputSlideStatus" class="form-control">
						<option value="Enabled"<?php  if ($_POST['inputSlideStatus'] == 'Enabled') echo ' selected="slected"';  ?>>Enabled</option>
						<option value="Disabled"<?php  if ($_POST['inputSlideStatus'] == 'Disabled') echo ' selected="slected"';  ?>>Disabled</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
" class="btn btn-default">Cancel</a>
					<input type="hidden" name="addSlide" value="submitSlide" />
					<input type="submit" value="<?php echo $this->_confs['PLIGG_OTslider_Add']; ?>
" class="btn btn-success" />
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
<?php $this->config_load(otsliderPliggLangConf, null, null); ?>