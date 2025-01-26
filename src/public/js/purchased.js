$('div').find("[data-purchased='1']").each(function() {
    $(this).addClass('sold');
    let span = $(this).find('span');
    span.html('sold out');
});