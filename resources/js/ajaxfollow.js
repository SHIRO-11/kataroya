$(function () {
    var id;
    var html;
    var follow_unfollow_btn = $('.follow-unfollow-btn');

    $(document).on('click', '.follow-btn', function () {
        var $this = $(this);
        // クリックした要素の親要素を取得
        var parent = $this.parent();
        id = $this.data('id');

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/users/' + id + '/follow',
                type: 'Post',
                data: {
                    'id': id,
                },
            })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
                // 書き換える内容
                html = `<a href="" data-id="${id}" class="btn-sm btn-danger btn-block unfollow-btn">アンフォロー</a>`;
                // 親要素の中身を書き換える
                parent.html(html);
                console.log('成功');
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });

        return false;
    });

    $(document).on('click', '.unfollow-btn', function () {
        var $this = $(this);
        // クリックした要素の親要素を取得
        var parent = $this.parent();
        id = $this.data('id');

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/users/' + id + '/unfollow',
                type: 'Post',
                data: {
                    'id': id,
                    '_method': 'DELETE'
                },
            })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
                // 書き換える内容
                html = `<a href="" data-id="${id}" class="btn-sm btn-primary btn-block follow-btn">フォロー</a>`;
                // 親要素の中身を書き換える
                parent.html(html);
                console.log('成功');
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});