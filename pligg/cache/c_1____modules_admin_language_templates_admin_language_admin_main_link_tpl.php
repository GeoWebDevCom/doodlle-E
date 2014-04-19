<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:57:25 UTC */ ?>

<?php $this->config_load(admin_language_lang_conf, null, null); ?>
<li<?php if ($this->_vars['modulename'] == "admin_language"): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/module.php?module=admin_language"><?php echo $this->_confs['PLIGG_Admin_Language']; ?>
</a></li>
<?php $this->config_load(admin_language_pligg_lang_conf, null, null); ?>
