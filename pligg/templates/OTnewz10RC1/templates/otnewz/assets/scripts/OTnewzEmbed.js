jQuery(document).ready(function($) {
	$.embedly.defaults.key = 'YOUR_EMBEDLY_API_KEY_HERE';
	function embedThumb() {
		$('.xfolkentryThumb>a').embedly({
			display: function(embedData) {
				var embedType = embedData.type;
				var entryLink = $(this).attr('data-xfolkentry-url');
				var entryExternalLink = $(this).attr('href');
				var embedHeight, embedMaxWidth;
				
				if (embedData.thumbnail_url) {
					var embedThumbCSS = {
						'background': 'url(templates/otnewz/assets/images/default/loader.gif) 100% 0 no-repeat',
						'min-height': '24px',
						'min-width': '24px'
					}
					$(this).parent().css(embedThumbCSS);
					
					if(embedType == 'link') {
						if (embedData.thumbnail_width >= 240) {
							$(this).html('<img src="'+embedData.thumbnail_url+'" alt="'+embedData.title+'" class="embedThumbnail" />').append('<span class="xfolkentryThumbZoom"></span>');
						}
						else {
							$(this).replaceWith('<a href="'+entryLink+'"><img src="'+embedData.thumbnail_url+'" alt="'+embedData.title+'" class="embedThumbnail" /></a>')
						}
						embedHeight = embedData.thumbnail_height + 'px';
						embedMaxWidth = embedData.thumbnail_width + 'px';
					}
					else if (embedType == 'video') {
						$(this).html('<img src="'+embedData.thumbnail_url+'" alt="'+embedData.title+'" class="embedVideoThumbnail" />').append('<span class="xfolkentryThumbPlay"></span>');
						
						if (embedData.width) {
							embedMaxWidth = embedData.width + 'px';
						}
						else {
							embedMaxWidth = '660px';
						}
						if (embedData.height) {
							embedHeight = embedData.height + 'px';
						}
						else {
							embedHeight = '80%';
						}
					}
					else {
						$(this).html('<img src="'+embedData.thumbnail_url+'" alt="'+embedData.title+'" class="embedThumbnail" />').append('<span class="xfolkentryThumbZoom"></span>');
						
						if (embedData.width) {
							embedMaxWidth = embedData.width + 'px';
						}
						else {
							embedMaxWidth = '800px';
						}
						if (embedData.height) {
							embedHeight = embedData.height + 'px';
						}
						else {
							embedHeight = '80%';
						}
					}
				}
				else {
					if(embedData.type == 'photo') {
						$(this).html('<img src="'+embedData.url+'" alt="'+embedData.title+'" class="embedThumbnail" />').append('<span class="xfolkentryThumbZoom"></span>');
						embedHeight = embedData.height + 'px';
						embedMaxWidth = embedData.width + 'px';
					}
					else {
						$(this).replaceWith('<a href="'+entryExternalLink+'" rel="nofollow" target="_blank"><img src="http://api.webthumbnail.org?width=100&amp;height=100&amp;format=png&amp;screen=1024&amp;url='+entryExternalLink+'" alt="'+embedData.title+'" /></a>')
					}
				}
				var xfolkentryThumbObjAttr = {
					'data-embed-height' : embedHeight,
					'data-embed-max-width' : embedMaxWidth
				}
				$(this).attr(xfolkentryThumbObjAttr);
				$('.embedThumbnail, .embedVideoThumbnail').imagesLoaded(function() {
					$('.xfolkentryThumb').removeAttr('style');
				});
				$('.embedThumbnail').imagesLoaded(function() {
					$('.xfolkentryThumbZoom').css('display','block');
				});
				$('.embedVideoThumbnail').imagesLoaded(function() {
					$('.xfolkentryThumbPlay').css('display','block');
				});
			}
		});
	}
	$('.embedModalTrigger').on('click', function(e){
		e.preventDefault();
		
		var embedURL = $(this).attr('href'), embedSetHeight = $(this).attr('data-embed-height'), embedSetMaxWidth = $(this).attr('data-embed-max-width');
			
		$('#embedModal').bPopup({
			amsl: 0,
			transition: 'slideDown',
			transitionClose: 'slideUp',
			onOpen: function() {
				var embedModalAttr = {
					'height': embedSetHeight,
					'max-width': embedSetMaxWidth
				}
				$(this).css(embedModalAttr);
				
				$.embedly.oembed(embedURL, {
					query: {
						autoplay: true
					}
				}).progress(function(data) {
					if (data.type == 'link') {
						$('#embedModal').append('<div><img src="' + data.thumbnail_url + '" alt="" /></div>');
					}
					else if (data.type == 'video' || data.type == 'rich') {
						$('#embedModal').append('<div><div class="embedRich">'+data.html+'</div></div>');
					}
					else {
						if (data.url) {
							$('#embedModal').append('<div><img src="' + data.url + '" alt="" /></div>');
						}
						else {
							$('#embedModal').append('<div><img src="' + data.thumbnail_url + '" alt="" /></div>');
						}
					}
				});
			},
			onClose: function(){
				var embedModalReset = $('#embedModal .embedModalClose').detach();
				$(this).empty().html(embedModalReset).removeAttr('style');
			}
		});
	});
	$('.embedModalClose').on('click', function(e){
		$('#embedModal').bPopup().close();
	});
	enquire.register("screen and (min-width: 30em)", {
		deferSetup : true,
		match : function() {
			//embedThumb();
		},
		unmatch : function() {
			$('.xfolkentryThumb>a').html('');
		}
	});
});