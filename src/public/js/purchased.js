$('div').find("[data-purchased='1']").each(function() {
    $(this).attr('class', 'main__item sold');
    let span = $(this).find('span');
    span.html('sold out');
});