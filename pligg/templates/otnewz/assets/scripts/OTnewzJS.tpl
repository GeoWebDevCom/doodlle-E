{literal}
<script>
jQuery(document).ready(function($) {
	{/literal}{if $user_authenticated neq true && $pagename neq 'login'}{literal}
	$('.navAcctLogin>a').click(function(e) {
		e.preventDefault();
		$('#modalLogin').bPopup({
			amsl: 0,
			transition: 'slideDown',
			transitionClose: 'slideUp'
		},
		function(){
			$('#username').focus();
		});
	});
	$('.loginRequired').click(function(e) {
		e.preventDefault();
		$('#modalLogin').bPopup({
			amsl: 0,
			transition: 'slideDown',
			transitionClose: 'slideUp',
			onOpen: function(){
				$('.modalLoginInfo').css('display','block');
			},
			onClose: function(){
				$('.modalLoginInfo').css('display','none');
			}
		},
		function(){
			$('#username').focus();
		});
	});
	$('#modalLogin .modalClose').on('click', function(e){
		$('#modalLogin').bPopup().close();
	});
	{/literal}{/if}{literal}
	
	$('#navMainHeading').click(function(e) {
		e.preventDefault();
		$(this).next().slideToggle();
		$(this).toggleClass('navMainHeaderActive');
	});

	$('#navCatsHeading').click(function(e) {
		e.preventDefault();
		$(this).next().slideToggle();
		$(this).toggleClass('navCatsHeaderActive');
	});
	$('.navCats').superfish({
		autoArrows: false,
		animation: {height:'show'},
		animationOut: {height:'hide'}
	});
	var $navCatsWrapper = $('.navCats');
	function checkNavCatsWidth() {
		var navCatsWidth = $navCatsWrapper.width();
		var navCatsHeight = $navCatsWrapper.height();
		if ((navCatsWidth >= 880) && (navCatsHeight > 80)) {
			$('.navCatsDivider').show();
		}
		else {
			$('.navCatsDivider').hide();
		}
    }
	
	$('#otSliderEntries').responsiveSlides({
		speed: 1000,
		timeout: 5000,
		nav: true,
		pause: true,
		namespace: "otSlider"
	});
	
	// Link Summary / Story
	$('.xfolkentryCtrlShare>a').click(function(e) {
		e.preventDefault();
		var shareModal = $(this).attr('data-share-popup');
		$('#'+shareModal).bPopup({
			amsl: 0,
			transition: 'slideDown',
			transitionClose: 'slideUp'
		});
	});
	$('.xfolkentryShare .modalClose').click(function(e){
		var shareModalClose = $(this).attr('data-share-modal');
		$('#'+shareModalClose).bPopup().close();
	});
	{/literal}{if $user_authenticated eq true}{literal}
	$( '.xfolkentryCtrlSave>a' ).click(function(e) {
		e.preventDefault();
		
		var saveAction = $(this).attr('data-bookmark-action');
		var saveEntryID = $(this).attr('data-bookmark-id');
		var saveDataString = 'action='+saveAction+'&link_id='+saveEntryID;
		var saveReturnValue = '';
		var saveContainer = $(this);
		
		$.ajax({
			type: "POST",
			url: siteURL+siteBase+"/user_add_remove_links.php",
			data: saveDataString,
			cache: false,
			success: function(saveResult) {
				saveReturnValue = saveResult;
				
				if(saveReturnValue == 1) {
					saveContainer.attr('data-bookmark-action','remove').html('{/literal}{#PLIGG_MiscWords_Save_Links_Remove#}{literal}');
				}
				else if(saveReturnValue == 2) {
					saveContainer.attr('data-bookmark-action','add').html('{/literal}{#PLIGG_MiscWords_Save_Links_Save#}{literal}');
				}
				else {
					alert(saveResult);
				}
			}
		});
	});
	{/literal}{/if}{literal}
	{/literal}{if $pagename eq "story"}{literal}
	$('.xfolkentryCtrlDiscuss>a').click(function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $('#commentsAdd').offset().top
		}, 1000);
		{/literal}{if $user_authenticated eq true}{literal}$('#comment_content').focus();{/literal}{/if}{literal}
		return false;
	});
	{/literal}{/if}{literal}

	$('#sidebarTopUsers').easytabs({
		defaultTab: 'h3#topPublishersTab',
		tabs : '> div > h3',
		transitionIn: 'slideDown',
		transitionOut: 'fadeOut',
		updateHash: false
	});
	$('#sidebarNewUsers').easytabs({
		defaultTab: 'h3#newUsersTab',
		tabs : '> div > h3',
		transitionIn: 'slideDown',
		transitionOut: 'fadeOut',
		updateHash: false
	});
		
	// The Great IE8 :(
	if ($('html').hasClass('ie8')) {
		$('#navAcctMenu ul>li:nth-child(even)').addClass('navAcctMenuEvenChild');
		$('#navAcctMenu ul>li:last-child').addClass('navAcctMenuLastChild');
		$('.entrySorter ul>li:nth-child(odd)').addClass('entrySorterOddChild');
		$('.xfolkentryShareSites li:nth-child(even)').css('border-left','1px solid #e4ecef');
		$('#sidebar div.sidebarBlock:last-of-type, #sidebar div.sidebarTab:last-of-type').css('margin-bottom','0');
		$('.sidebarAds125 li:nth-child(even)').css({
			'margin-left': '-4px',
			'text-align': 'right'
		});
		$('.footerLinks li:last-child a').css('padding','0 0 0 10px');
	}
	
	$(window).on("load", function() {
		var wWidth = $(window).width();

		if(wWidth >= 880) {
			checkNavCatsWidth();
		}
	});
	$(window).on('resize',function() {
		var wWidth = $(window).width();
		var navMain = $('.navMain');
		var navCats = $('.navCats');
		
		if(wWidth >= 480 && navMain.is(':hidden')) {
			navMain.removeAttr('style');
		}
		if(wWidth >= 880 && navCats.is(':hidden')) {
			navCats.removeAttr('style');
		}
		if(wWidth >= 880) {
			checkNavCatsWidth();
		}
	});
});
</script>
{/literal}