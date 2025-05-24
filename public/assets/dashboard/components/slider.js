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

$(function(){
	$('select[name="brand_id"]').on('change',function(){
		let brand_id = $(this).val();
		let placeHolder = $('select[name="model_id"] option:first').text();
		let optionsText = '<option value="">'+placeHolder+'</option>';

		if(brand_id){
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		    $.ajax({
		        type: 'GET',
		        url: '/dashboard/carModels?brand_id='+brand_id,
		        data:{'_token': $('meta[name="csrf-token"]').attr('content'),},
		        success:function(data){
		            if(data.data){
		                $.each(data.data , function(index,item){
		                	optionsText+= '<option value="'+item.id+'">'+item.title+'</option>';
		                });
		            }else{
		                errorNotification("Not Found");
		            }
					updateSelect($('select[name="model_id"]'),optionsText);
		        },
		    });
		}else{
			updateSelect($('select[name="model_id"]'),optionsText);
		}
	});

	function updateSelect(selector,optionsText){
		selector.empty();
		selector.select2('destroy')
        selector.append(optionsText);
        selector.select2()
	}

	$('#kt_datetimepicker_7_1').datetimepicker();
    $('#kt_datetimepicker_7_2').datetimepicker({
        useCurrent: false
    });
    $('#kt_datetimepicker_7_1').on('change.datetimepicker', function(e) {
        $('#kt_datetimepicker_7_2').datetimepicker('minDate', e.date);
    });
    $('#kt_datetimepicker_7_2').on('change.datetimepicker', function(e) {
        $('#kt_datetimepicker_7_1').datetimepicker('maxDate', e.date);
    });

    $('select[name="color"]').on('change',function(){
    	if($(this).val() == '@'){
    		$('#color-1').addClass('show').addClass('active');
    		$('#colorModal').modal('show');
    	}
    });

    $('select[name="type"]').on('change',function(){
    	if($(this).val() == '@'){
    		$('#type-1').addClass('show').addClass('active');
    		$('#typeModal').modal('show');
    	}
    });

    $('#colorModal .save').on('click',function(){
    	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	    $.ajax({
	        type: 'POST',
	        url: '/dashboard/colors/create',
	        data:{
	        	'_token': $('meta[name="csrf-token"]').attr('content'),
	        	'title_ar': $('#colorModal input[name="title_ar"]').val(),
	        	'title_en': $('#colorModal input[name="title_en"]').val(),
	        	'color': $('#colorModal input[name="color"]').val(),
	        	'status': $('#colorModal input[name="status"]').is(":checked") ? 1 : 0,
	        },
	        success:function(data){
	            if(data && data.title){
	            	let selectedText = $('#colorModal input[name="status"]').is(":checked") ? 'selected' : '';
	            	$("select[name='color'] option:last").before("<option value='"+data.id+"' "+selectedText+">"+data.title+"</option>");
					fixSelect($("select[name='color']"));
	                $('#colorModal').modal('hide');
	                successNotification("Alert! Created Successfully !!");	            	
	            }else{
	                errorNotification("Not Found");	            	
	            }
	        },
	    });
    })

    $('#typeModal .save').on('click',function(){
    	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	    $.ajax({
	        type: 'POST',
	        url: '/dashboard/carTypes/create',
	        data:{
	        	'_token': $('meta[name="csrf-token"]').attr('content'),
	        	'title_ar': $('#typeModal input[name="title_ar"]').val(),
	        	'title_en': $('#typeModal input[name="title_en"]').val(),
	        	'status': $('#typeModal input[name="status"]').is(":checked") ? 1 : 0,
	        },
	        success:function(data){
	            if(data && data.title){
	            	let selectedText = $('#typeModal input[name="status"]').is(":checked") ? 'selected' : '';
	            	$("select[name='type'] option:last").before("<option value='"+data.id+"' "+selectedText+">"+data.title+"</option>");
					fixSelect($("select[name='type']"));
	                $('#typeModal').modal('hide');
	                successNotification("Alert! Created Successfully !!");	            	
	            }else{
	                errorNotification("Not Found");	            	
	            }
	        },
	    });
    })

    function fixSelect(selector){
		selector.select2('destroy')
        selector.select2()
	}
})