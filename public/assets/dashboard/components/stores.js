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

		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();
});

$(function(){
	$('select[name="country_id"]').on('change',function(){
		let country_id = $(this).val();
		let placeHolder = $('select[name="city_id"] option:first').text();
		let optionsText = '<option value="">'+placeHolder+'</option>';

		if(country_id){
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		    $.ajax({
		        type: 'GET',
		        url: '/dashboard/cities?country_id='+country_id,
		        data:{'_token': $('meta[name="csrf-token"]').attr('content'),},
		        success:function(data){
		            if(data.data){
		                $.each(data.data , function(index,item){
		                	optionsText+= '<option value="'+item.id+'">'+item.title+'</option>';
		                });
		            }else{
		                errorNotification("Not Found");
		            }
					updateSelect($('select[name="city_id"]'),optionsText);
		        },
		    });
		}else{
			updateSelect($('select[name="city_id"]'),optionsText);
		}
	});

	$('select[name="city_id"]').on('change',function(){
		let city_id = $(this).val();
		let placeHolder = $('select[name="state_id"] option:first').text();
		let optionsText = '<option value="">'+placeHolder+'</option>';

		if(city_id){
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		    $.ajax({
		        type: 'GET',
		        url: '/dashboard/states?city_id='+city_id,
		        data:{'_token': $('meta[name="csrf-token"]').attr('content'),},
		        success:function(data){
		            if(data.data){
		                $.each(data.data , function(index,item){
		                	optionsText+= '<option value="'+item.id+'">'+item.title+'</option>';
		                });
		            }else{
		                errorNotification("Not Found");
		            }
					updateSelect($('select[name="state_id"]'),optionsText);
		        },
		    });
		}else{
			updateSelect($('select[name="state_id"]'),optionsText);
		}
	});

	function updateSelect(element,optionsText){
		element.empty();
		element.select2('destroy')
        element.append(optionsText);
        element.select2()
	}

	$('.dayToggle').on('click',function(){
		$(this).parents('.switch-parent').siblings('.work_days').toggleClass('hidden')
	})
})