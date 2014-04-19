<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:09:46 UTC */ ?>

<?php echo '
<script>
var ACPuzzleOptions = {
   theme : '; ?>
 "<?php echo get_misc_data('adcopy_theme'); ?>"<?php echo ',
   lang : '; ?>
 "<?php echo get_misc_data('adcopy_lang'); ?>"
<?php echo '};
</script>
'; ?>


<div class="control-group<?php if (isset ( $this->_vars['register_captcha_error'] )): ?> error<?php endif; ?>">
	<label for="input01" class="control-label">CAPTCHA</label>
	<div class="controls">
		<?php if (isset ( $this->_vars['register_captcha_error'] )): ?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->_vars['register_captcha_error']; ?>

			</div>
		<?php endif; ?>
		<div id="solvemedia_display">
			<?php 
				require_once(captcha_captchas_path . '/solvemedia/lib/solvemedialib.php');
				$publickey = get_misc_data('adcopy_pubkey'); // you got this from the portal
				echo solvemedia_get_html($publickey);
			 ?>	
		</div>
		<br />
	</div>
</div>
