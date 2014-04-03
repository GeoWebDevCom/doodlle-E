/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

(function($)
{
	// $(document).ready(function()
	// {
	// 	$('*[rel=tooltip]').tooltip()
	// 
	// 	// Turn radios into btn-group
	// 	$('.radio.btn-group label').addClass('btn');
	// 	$(".btn-group label:not(.active)").click(function()
	// 	{
	// 		var label = $(this);
	// 		var input = $('#' + label.attr('for'));
	// 
	// 		if (!input.prop('checked')) {
	// 			label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
	// 			if (input.val() == '') {
	// 				label.addClass('active btn-primary');
	// 			} else if (input.val() == 0) {
	// 				label.addClass('active btn-danger');
	// 			} else {
	// 				label.addClass('active btn-success');
	// 			}
	// 			input.prop('checked', true);
	// 		}
	// 	});
	// 	$(".btn-group input[checked=checked]").each(function()
	// 	{
	// 		if ($(this).val() == '') {
	// 			$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
	// 		} else if ($(this).val() == 0) {
	// 			$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
	// 		} else {
	// 			$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
	// 		}
	// 	});
	// })
	
	$(document).ready(function()
	{
		$('#content, #sidebar').css({opacity: 0}).
		    animate({opacity: 1}, 500);		
		
		var loginBox = $('#form-login-username, #form-login-password, #form-login-remember, .userdata .unstyled, #form-login-secretkey');
		var boxHidden = true;
		
		// function to show login box by clicking login
		$('#form-login-submit').click(function() {		
			if (boxHidden){	
				loginBox.fadeIn(300); 									// fade in above selectors
				var loginButton = $('#form-login-submit').position(); 	// sets login button position	
				$('#login-form').css({top: loginButton.top - 120 + "px",	left: loginButton.left - 20 + "px"}).fadeIn(300);
				$('#login-form').addClass("login-box-visible");			//adds css
				boxHidden = false;										// sets box to hidden
				$('#login-form').after( '<div class="transparentBackground" style="opacity:0; display:block;"></div>'); // adds background target
				return false;											// no redirect
			} else {					
				return true;											// redirect
			}
		});
		
		// function to hide login box when clicked away				
		var $parent = $(".header-search");								// selects parent
		$parent.on("click", ".transparentBackground ", function(){		// binds dynamic element with click and function
			loginBox.hide();											
			$('#login-form').removeAttr('style').removeClass("login-box-visible");	
			$('.transparentBackground').remove();						// removes div for new .transparentBackground
			boxHidden = true;

		});
		
		// function to fix top menu
		var num = 139; 													//number of pixels before modifying styles
		$(window).on('scroll', function () {						
		    if ($(window).scrollTop() > num && $('#lightbox-nav').length==0) { //launches when 130 px from top and lightbox is not launched
		        $('.navigation').addClass('navbar-fixed-top container');
		    } else {
		        $('.navigation').removeClass('navbar-fixed-top container');
		    }
		});
		
		// fadeout on click
		jQuery("#SPForm_Target,.nav-pills a, #SPcontent a").on('click', function(e){
			jQuery('#content, .sidebar-nav').animate({opacity : 0}, 300);
		})
		

	})
})(jQuery);