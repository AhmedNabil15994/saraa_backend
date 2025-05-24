$('select[name="valid_type"]').on('change',function(){
    if($(this).val() == 1){
        $('.datetimepicker-inputs').datepicker('remove');
    }else if($(this).val() == 2){
        $('.datetimepicker-inputs').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    }
    $('input[name="valid_until"]').val('');
});