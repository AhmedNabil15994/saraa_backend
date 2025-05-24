$(function(){
    $('input.main[type="checkbox"]').on('change',function(){
        // if($(this).is(':checked')){
        //     $(this).parent('label').siblings('.catRow').children('.checkbox-list').find('input[type="checkbox"]').prop('checked',true);
        // }else{
        //     $(this).parent('label').siblings('.catRow').children('.checkbox-list').find('input[type="checkbox"]').prop('checked',false);
        // }
    });

    $('.btn-default').on('click',function(){
        if($(this).children('i').hasClass('fa-minus')){
            $(this).children('i').removeClass('fa-minus').addClass('fa-plus')
            $(this).next('.catRow').children('.checkbox-list').find('.btn-default').children('i').removeClass('fa-minus').addClass('fa-plus')
        }else{
            $(this).children('i').removeClass('fa-plus').addClass('fa-minus')
            $(this).next('.catRow').children('.checkbox-list').find('.btn-default').children('i').removeClass('fa-plus').addClass('fa-minus')
        }
        $(this).next('.catRow').children('.checkbox-list').find('.catRow:not(.fixButtons)').slideToggle(250)
    })
});