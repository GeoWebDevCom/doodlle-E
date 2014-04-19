<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:57:25 UTC */ ?>

<?php $this->config_load(captcha_lang_conf, null, null); ?>
<li<?php if ($this->_vars['modulename'] == "captcha"): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/module.php?module=captcha"><?php echo $this->_confs['PLIGG_Captcha_BreadCrumb']; ?>
</a></li>
<?php $this->config_load(captcha_pligg_lang_conf, null, null); ?>