$(function (){

    $('.checkbox_all').on('click', function () {
        $(this).parents('.col-md-12').find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
        $(this).parents('.col-md-12').find('.checkbox_child').prop('checked', $(this).prop('checked'));
    });
    $('.checkbox_wrapper').on('click', function () {
        $(this).parents('.card').find('.checkbox_child').prop('checked', $(this).prop('checked'));
    });
});

