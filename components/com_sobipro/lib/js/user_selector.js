SobiPro.jQuery(document).ready(function(){new SpUserSelector()});function SpUserSelector(){"use strict";var SpUserSelector=this;var site=1;var form=null;var modal=null;var active=false;var selected=0;var responseContainer=null;var query='';SobiPro.jQuery('.SobiPro .spUserSelector .trigger').click(function(ev){if(this.semaphor){return true}this.semaphor=true;SpUserSelector.modal=SobiPro.jQuery(this).parent().parent().find('.modal');SpUserSelector.form=SobiPro.jQuery(this).parent().parent().find(':input[type=hidden]');SpUserSelector.responseContainer=SpUserSelector.modal.find('.response');SpUserSelector.getUsers(SpUserSelector.getForm(SpUserSelector.form),SpUserSelector.modal);SpUserSelector.modal.find('.save').click(function(){if(SpUserSelector.selected){SobiPro.jQuery(this).parent().parent().parent().find('[rel^="selected"]').val(SpUserSelector.selected['id']);SobiPro.jQuery(this).parent().parent().parent().find('.user-name').val(SpUserSelector.selected['text'])}});SpUserSelector.modal.modal();var proxy=this;SpUserSelector.modal.on('hidden',function(){proxy.semaphor=0;SpUserSelector.modal.find('.response').html('');SpUserSelector.site=1;SpUserSelector.active=false})});SobiPro.jQuery('.spUserSelector .more').click(function(){var request=SpUserSelector.getForm(SpUserSelector.form);request['site']=++SpUserSelector.site;request['q']=SpUserSelector.query;SpUserSelector.getUsers(request)});SobiPro.jQuery('.spUserSelector .search').keyup(function(){var request=SpUserSelector.getForm(SpUserSelector.form);request['q']=SobiPro.jQuery(this).val();SpUserSelector.query=request['q'];SpUserSelector.modal.find('.response').html('');request['site']=1;SpUserSelector.getUsers(request)});this.getForm=function(form){var data={'site':this.site};form.each(function(i,e){var el=SobiPro.jQuery(e);if(el.attr('rel')=='selected'){data['selected']=el.val();SpUserSelector.selected=data['selected']}else{if(el.attr('name').indexOf('Ssid')!=-1){data['ssid']=el.val()}else{data[el.attr('name')]=el.val()}}});return data};this.getUsers=function(data){SobiPro.jQuery.ajax({'type':'post','url':SobiProUrl.replace('%task%','user.search'),'data':data,'dataType':'json',success:function(response){SpUserSelector.site=response.site;if(response.sites>response.site){SpUserSelector.modal.find('.more').removeClass('hide')}else{SpUserSelector.modal.find('.more').addClass('hide')}response.users.each(function(e){var active='';if(e.id==SpUserSelector.selected&&!(SpUserSelector.active)){active=' btn-success active'}SpUserSelector.responseContainer.html(SpUserSelector.responseContainer.html()+'<div class="spUserName"><button class="btn btn-small'+active+'" type="button" value="'+e.id+'" name="userSelect">'+e.text+'</button></div>')});SpUserSelector.responseContainer.find('.btn').click(function(){SpUserSelector.active=true;SpUserSelector.selected={'id':SobiPro.jQuery(this).val(),'text':SobiPro.jQuery(this).html()};SpUserSelector.responseContainer.find('.btn').removeClass('active');SpUserSelector.responseContainer.find('.btn').removeClass('btn-success');SobiPro.jQuery(this).addClass('btn-success')})}})}}