$('input').each(function() {
    if($(this).attr('required') === 'required') {
        $(this).after('<span class="astrid">*</span>');
    }
});
