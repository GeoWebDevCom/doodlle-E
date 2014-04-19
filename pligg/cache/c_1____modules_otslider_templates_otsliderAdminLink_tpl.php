<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 15:57:49 UTC */ ?>

<?php $this->config_load(otsliderLangConf, null, null); ?>
<li<?php if ($this->_vars['modulename'] == "otslider"): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_vars['otsliderSettingsPath']; ?>
"><?php echo $this->_confs['PLIGG_OTslider_Module']; ?>
</a></li>
<?php $this->config_load(otsliderPliggLangConf, null, null); ?>
