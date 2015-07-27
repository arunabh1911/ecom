/*
 * 	Additional function for profile.html
 *	Written by ThemePixels	
 *	http://themepixels.com/
 *
 *	Copyright (c) 2012 ThemePixels (http://themepixels.com)
 *	
 *	Built for Amanda Premium Responsive Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */

jQuery(document).ready(function(){
								
	jQuery('#followbtn').click(function(){
		if(jQuery(this).text() == 'Inactive') {
			jQuery(this).text('Active')
						.removeClass('btn_yellow')
						.addClass('btn_lime');
		} else {
			jQuery(this).text('Inactive')
						.removeClass('btn_lime')
						.addClass('btn_yellow');
			
		
		}
	});
	
	///// ACTIVE STATUS ON HOVER /////
	jQuery('.bq2').hover(function(){
		jQuery(this).find('.edit_status').show();	
	},function(){
		jQuery(this).find('.edit_status').hide();	
	});
	
	
	///// CONTENT SLIDER /////
	jQuery('#slidercontent').bxSlider({
		prevText: '',
		nextText: ''
	});
	

	///// AUTOGROW TEXTAREA /////
	jQuery('#comment').autogrow();


	
	
});
