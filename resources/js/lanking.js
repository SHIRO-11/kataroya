$(function () {
    var user_lanking_wrapper = $('.user-lanking-wrapper');

$(document).on('click', '.lanking-period', function () {
    var $this = $(this);
    var period = $this.data('period');
    var html = "";
    var nav = "";

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/users/lanking/' + period,
                type: 'GET',
                data: {
                    'period': period
                },
            })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
                nav = `
                <h4>ユーザーランキング</h4>
                <ul class="nav nav-tabs nav-justified mb-3">
                     <li class="nav-item">
                        <a href="" class="lanking-period nav-link ${period=='week' ? 'active' : ''}" data-period="week">今週</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="lanking-period nav-link ${period=='month' ? 'active' : ''}" data-period="month">今月</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="lanking-period nav-link ${period=='all' ? 'active' : ''}" data-period="all">全期間</a>
                    </li>
                </ul>
                `
                console.log(period);
                let sort = _.orderBy(data, 'total', 'desc')

                $.each(sort, function (index, value) { //dataの中身からvalueを取り出す
                    let id = value.id;
                    let profile_image = value.profile_image;
                    let name = value.name;
                    let total = value.total;

                    html += `
                    <div class="user-lanking-oner-wrapper">
                        <p><a href=""><img class="top-post-img"
                                    src="/storage/${profile_image ? 'avatar/'+ profile_image : 'images/no-image.jpg'}">
                        </p>
                        <p class="user-lanking-name">${name}</p>

                    </div>
                    `
                    console.log(value);
                })
                user_lanking_wrapper.html(nav + html);
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