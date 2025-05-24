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

		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();

	if (window.editors == undefined) {
        $.each(editors, function (index, editor) {
            editor.updateSourceElement()
        });
    }
});
