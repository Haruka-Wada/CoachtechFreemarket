const div = $('.1');
    if (div) {
        div.attr('class', 'main__item 1 sold');
        let span = div.find('span');
        span.html('sold out');
    }