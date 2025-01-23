$(function() {
    let like = $('.like-toggle');
    let likeItemId;
    like.on('click', function() {
        let $this = $(this);
        likeItemId = $this.data('item-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/favorite',
            method: 'POST',
            data: {
                'item_id': likeItemId
            }
        })

        .done(function (data) {
            $this.toggleClass('liked');
            $(".item__icon-star__counter").html(data.item_favorite_count);
            if ($this.hasClass('liked')) {
                let src = $this.attr('src').replace('star', 'yellow_star');
                $this.attr('src', src);
            } else {
                let src = $this.attr('src').replace('yellow_star', 'star');
                $this.attr('src', src);
            }
        })

        .fail(function() {
            console.log('fail')
        })

    })
})