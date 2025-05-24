'use strict';

// Class definition
var KTImageInputDemo = function () {
	// Private functions
	var initDemos = function () {
		var avatar5 = new KTImageInput('kt_image_5');

		avatar5.on('remove', function(imageInput) {
			$('#kt_image_5 .image-input-wrapper').css('backgroundImage','unset');
		});

		avatar5.on('cancel', function(imageInput) {
			$('#kt_image_5 .image-input-wrapper').css('backgroundImage','unset');
		});

	}

	return {
		// public functions
		init: function() {
			initDemos();
			$('#kt_datetimepicker_1').datetimepicker();
			$('#kt_touchspin_1, #kt_touchspin_2').TouchSpin({
	            buttondown_class: 'btn btn-secondary',
	            buttonup_class: 'btn btn-secondary',
	            min: 1,
	            max: 10000,
	            step: 1,
	            decimals: 0,
	            boostat: 1,
	            maxboostedstep: 10,
	        });

		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();

	$('.navi-link').on('click',function(){
        $(this).addClass('active').parent('li').siblings('li.navi-item').children('.navi-link.active').removeClass('active');   
        $('.tab-pane').removeClass('show').removeClass('active');
        $('.tab-pane'+$(this).attr('href')).addClass('show').addClass('active');
    })
});
