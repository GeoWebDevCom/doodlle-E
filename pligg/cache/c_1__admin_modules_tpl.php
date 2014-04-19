<?php require_once('/Users/RichardClark/Sites/2.0.1/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:57:25 UTC */ ?>

<!-- modules.tpl -->
<?php echo '
<script type="text/javascript">
$(document).ready(function(){ 
	
	$(function() {
		$("#contentLeft tbody").sortable({ opacity: 0.6, cursor: \'move\', update: function() {
			var order = $(this).sortable("serialize") + \'&action=updateRecordsListings\'; 
			$.post("admin_update_module_widgets.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>
'; ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_admin_modules_top"), $this);?>

<legend><?php echo $this->_vars['module_management_name']; ?>
</legend>
<?php if ($this->_vars['action'] == "readme"): ?>
	<a class="btn btn-default" href="admin_modules.php"><i class="fa fa-caret-left"></i> <?php echo $this->_vars['module_readme_return']; ?>
</a><hr />
	<?php if ($this->_vars['found'] == "yes"): ?>
		<?php echo $this->_vars['readme_content']; ?>

	<?php else: ?>
		<?php echo $this->_vars['not_found']; ?>

	<?php endif; ?>
<?php else: ?>
	<p><?php echo $this->_vars['module_management_desc']; ?>
</p>
	<?php if ($this->_vars['status'] != ""): ?>
		<ul class="nav nav-tabs">
			<li class="<?php if ($this->_vars['status'] == "installed"): ?>active<?php endif; ?>" ><a href="admin_modules.php?status=installed">Installed</a></li>
			<li class="<?php if ($this->_vars['status'] == "uninstalled"): ?>active<?php endif; ?>" ><a href="admin_modules.php?status=uninstalled">Uninstalled</a></li>
		</ul>
		<div class="tab-content" >
			<?php if ($this->_vars['status'] == "installed"): ?>
				<?php if ($this->_vars['no_module_update_require'] > '0'): ?>
					<div class="alert alert-warning">
						There are updates available for <?php echo $this->_vars['no_module_update_require']; ?>
 modules. <a href="admin_modules.php?token=1">Click here</a> to review them.
					</div>
				<?php endif; ?>
				<form name="bulk_moderate" method="post">
					
					<table class="table table-bordered" id="contentLeft">
					<thead>
						<tr>
							
							<th>Details</th>
							<th>Requires</th>
							<th style="text-align:center;">Homepage</th>
							<?php  if (!isset($_GET['token'])) {  ?>
								<th style="text-align:center;">Settings</th>
							<?php  }  ?>
							<th style="text-align:center;">Uninstall</th>
							<?php  if (isset($_GET['token'])) {  ?>
								<th style="text-align:center;">Update</th>
							<?php  }  ?>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($this->_sections['nr1'])) unset($this->_sections['nr1']);
$this->_sections['nr1']['name'] = 'nr1';
$this->_sections['nr1']['loop'] = is_array($this->_vars['module_info']) ? count($this->_vars['module_info']) : max(0, (int)$this->_vars['module_info']);
$this->_sections['nr1']['show'] = true;
$this->_sections['nr1']['max'] = $this->_sections['nr1']['loop'];
$this->_sections['nr1']['step'] = 1;
$this->_sections['nr1']['start'] = $this->_sections['nr1']['step'] > 0 ? 0 : $this->_sections['nr1']['loop']-1;
if ($this->_sections['nr1']['show']) {
	$this->_sections['nr1']['total'] = $this->_sections['nr1']['loop'];
	if ($this->_sections['nr1']['total'] == 0)
		$this->_sections['nr1']['show'] = false;
} else
	$this->_sections['nr1']['total'] = 0;
if ($this->_sections['nr1']['show']):

		for ($this->_sections['nr1']['index'] = $this->_sections['nr1']['start'], $this->_sections['nr1']['iteration'] = 1;
			 $this->_sections['nr1']['iteration'] <= $this->_sections['nr1']['total'];
			 $this->_sections['nr1']['index'] += $this->_sections['nr1']['step'], $this->_sections['nr1']['iteration']++):
$this->_sections['nr1']['rownum'] = $this->_sections['nr1']['iteration'];
$this->_sections['nr1']['index_prev'] = $this->_sections['nr1']['index'] - $this->_sections['nr1']['step'];
$this->_sections['nr1']['index_next'] = $this->_sections['nr1']['index'] + $this->_sections['nr1']['step'];
$this->_sections['nr1']['first']	  = ($this->_sections['nr1']['iteration'] == 1);
$this->_sections['nr1']['last']	   = ($this->_sections['nr1']['iteration'] == $this->_sections['nr1']['total']);
?>	
							<tr id="recordsArray_<?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['id']; ?>
"  style="cursor:move;">
								
								<td><?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['dname']; ?>
<br /><?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['desc']; ?>
</td>
								<td style="vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['requires']; ?>
</td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['homepage_url']; ?>
</td>
								<?php  if (!isset($_GET['token'])) {  ?>
									<td style="text-align:center;vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['settings_url']; ?>
</td>
								<?php  }  ?>
								<td style="text-align:center;vertical-align:middle;">
									<a class="btn btn-danger btn-xs" href="?action=remove&module=<?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['name']; ?>
"><?php echo $this->_vars['btn_module_remove']; ?>
</a>
								</td>
								<?php  if (isset($_GET['token'])) {  ?>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo $this->_vars['module_info'][$this->_sections['nr1']['index']]['version']; ?>

									</td>
								<?php  }  ?>
							</tr>
						<?php endfor; endif; ?>
					</tbody>
					</table>    
				</form>
			<?php else: ?>	
				<?php if ($this->_vars['no_module_update_require'] != '0'): ?>
					<div class="alert alert-warning">
						There are updates available for <?php echo $this->_vars['no_module_update_require']; ?>
 modules. <a href="admin_modules.php?status=uninstalled&updkey=<?php echo $this->_vars['updatekey']; ?>
&token=1">Click here</a> to review them.
					</div>
				<?php endif; ?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Details</th>
							<th>Requires</th>
							<th style="text-align:center;">Homepage</th>
							<th style="text-align:center;">Install</th>
							<?php  if (isset($_GET['token'])) {  ?>
								<th style="text-align:center;">Update</th>
							<?php  }  ?>
						</tr>
					</thead>
					<tbody>	
						<?php if (isset($this->_sections['nr'])) unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($this->_vars['module_info']) ? count($this->_vars['module_info']) : max(0, (int)$this->_vars['module_info']);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
	$this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
	if ($this->_sections['nr']['total'] == 0)
		$this->_sections['nr']['show'] = false;
} else
	$this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

		for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
			 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
			 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']	  = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']	   = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>
							<?php 
								// Check to see if all requirements are met for install
								$requires = $this->_vars['module_info'][$this->_sections['nr']['index']]['requires'];
								$needle = 'label-danger';
								if (strpos($requires,$needle) !== false) {
									$requirements_met = 'false';
								} else {
									$requirements_met = 'true';
								}
							 ?>
							
							<?php echo '
							<script type="text/javascript">
								$(document).ready(function () {
									$("a").tooltip({
										\'selector\': \'\',
										\'placement\': \'left\'
									});
								});
							</script>
							'; ?>

			
							<tr>
								<td style="vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['dname']; ?>
 <br/> <?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['desc']; ?>
 <?php echo $this->_vars['requirement_failed']; ?>
</td>
								<td style="vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['requires']; ?>
</td>
								<td style="text-align:center;vertical-align:middle;"><?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['homepage_url']; ?>
</td>
								<td style="text-align:center;vertical-align:middle;"><a <?php  if ($requirements_met == 'false'){ echo 'class="btn btn-default disabled btn-xs" rel="tooltip" title="Cannot install until requirements are met."'; }else{ echo 'class="btn btn-success btn-xs"'; }  ?> href="?action=install&module=<?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['value']; ?>
">Install</a></td>
								<?php  if (isset($_GET['token'])) {  ?>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo $this->_vars['module_info'][$this->_sections['nr']['index']]['version']; ?>

									</td>
								<?php  }  ?>
							</tr>
						<?php endfor; endif; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
<!--/modules.tpl -->