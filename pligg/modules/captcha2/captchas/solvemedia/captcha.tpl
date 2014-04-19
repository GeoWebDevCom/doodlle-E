{literal}
<script>
var ACPuzzleOptions = {
	theme : {/literal} "<?php echo get_misc_data('adcopy_theme'); ?>"{literal},
	lang : {/literal} "<?php echo get_misc_data('adcopy_lang'); ?>"
{literal}};
</script>
{/literal}
{php}
	require_once(captcha_captchas_path . '/solvemedia/lib/solvemedialib.php');
	$publickey = get_misc_data('adcopy_pubkey'); // you got this from the portal
	echo solvemedia_get_html($publickey);
{/php}