SobiPro.jQuery(document).ready(function(){var h='<div class="popover"><div class="arrow"></div><div class="popover-inner"><div class="pull-right close spclose">x</div><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>';SobiPro.jQuery('a[rel=popover]').popover({'html':true,'trigger':'click','template':h}).click(function(e){e.preventDefault();var a=SobiPro.jQuery(this);a.parent().find('.close').click(function(){a.popover('hide')})});setTimeout(function(){new SobiProEntryEdit()},1000);function SobiProEntryEdit(){"use strict";this.boxes=SobiPro.jQuery('.payment-box');var g=this;this.boxes.each(function(i,a){a=SobiPro.jQuery(a);a.targetContainer=SobiPro.jQuery('#'+a.attr('id').replace('-payment','-input-container'));a.toggleTarget=a.targetContainer.find('*');a.targetIframes=a.targetContainer.find('iframe').parent();a.disableTargets=function(){this.toggleTarget.attr('disabled','disabled');this.targetContainer.children().css('opacity','0.3');this.targetIframes.css('display','none')};a.disableTargets();a.change(function(){if(SobiPro.jQuery(this).is(':checked')){a.toggleTarget.removeAttr('disabled');a.targetContainer.children().css('opacity','1');a.targetIframes.css('display','')}else{a.disableTargets()}})});this.sendRequest=function(){var c=SobiPro.jQuery('#spEntryForm').serialize();SobiPro.jQuery(SobiPro.jQuery('#spEntryForm').find(':button')).each(function(i,b){var a=SobiPro.jQuery(b);if(a.hasClass('active')){c+='&'+a.attr('name')+'='+a.val()}});SobiPro.jQuery.ajax({'url':'index.php','data':c,'type':'post','dataType':'json',success:function(a){if(a.message.type=='error'){g.errorHandler(a)}else{if(a.redirect.execute==true){window.location.replace(a.redirect.url)}else if(a.message.type=='info'){SobiPro.jQuery(a.message.text).appendTo(SobiPro.jQuery('#SobiPro'));var b=SobiPro.jQuery('#SpPaymentModal').find('.modal').modal();b.on('hidden',function(){SobiPro.jQuery('#SpPaymentModal').remove()})}}}})};this.dismissAlert=function(a,b,c){a.popover('hide');b.addClass('hide');a.remove();c.removeClass('error')};this.errorHandler=function(a){var b=SobiPro.jQuery('#'+a.data.error);var c=SobiPro.jQuery('#'+a.data.error+'-message');var d=SobiPro.jQuery('#'+a.data.error+'-container');d.addClass('error');var e='right';if(c.length){var f=SobiPro.jQuery('<a class="sobipro-input-note" data-placement="'+e+'" rel="popover" data-content="'+a.message.text+'" data-original-title="'+SobiPro.Txt('ATTENTION')+'">&nbsp;</a>');c.append(f);c.removeClass('hide');f.popover({'template':h});f.popover('show');c.find('.close').click(function(){g.dismissAlert(f,c,d)});c.ScrollTo();b.focus(function(){g.dismissAlert(f,c,d)});if(e=='top'){d.find(':input').focus(function(){g.dismissAlert(f,c,d)})}}else{alert(a.message.text)}};SobiPro.jQuery('.sobipro-submit').click(function(e){SPTriggerFrakingWYSIWYGEditors();g.sendRequest()});SobiPro.jQuery('.sobipro-cancel').click(function(e){SobiPro.jQuery('#SP_task').val('entry.cancel');g.sendRequest()})}});function SPTriggerFrakingWYSIWYGEditors(){var a=['unload','onbeforeunload','onunload'];for(var i=0;i<a.length;i++){try{window.dispatchEvent(a[i])}catch(e){}try{window.fireEvent(a[i])}catch(e){}try{SobiPro.jQuery(document).triggerHandler(a[i])}catch(e){}}try{tinyMCE.triggerSave()}catch(e){}}