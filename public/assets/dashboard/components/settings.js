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

		var avatar6 = new KTImageInput('kt_image_6');

		avatar6.on('remove', function(imageInput) {
			$('#kt_image_6 .image-input-wrapper').css('backgroundImage','unset');
		});

		avatar6.on('cancel', function(imageInput) {
			$('#kt_image_6 .image-input-wrapper').css('backgroundImage','unset');
		});

		var avatar7 = new KTImageInput('kt_image_7');

		avatar7.on('remove', function(imageInput) {
			$('#kt_image_7 .image-input-wrapper').css('backgroundImage','unset');
		});

		avatar7.on('cancel', function(imageInput) {
			$('#kt_image_7 .image-input-wrapper').css('backgroundImage','unset');
		});


		$('#kt_touchspin_1, #kt_touchspin_2').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            min: 1,
            max: 10000,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
        });
	}

	return {
		// public functions
		init: function() {
			initDemos();
		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();
});
