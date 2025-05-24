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
					updateCity(optionsText);
		        },
		    });
		}else{
			updateCity(optionsText);
		}
	});

	function updateCity(optionsText){
		$('select[name="city_id"]').empty();
		$('select[name="city_id"]').select2('destroy')
        $('select[name="city_id"]').append(optionsText);
        $('select[name="city_id"]').select2()
	}
})