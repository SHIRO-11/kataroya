$(function () {
    // 投稿の＋マークを押したときの処理
    $('.js-modal-open-post').on('click', function () {
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
    });

    //コメントの+マークを押したときの処理
    $(document).on('click', '.js-modal-open-comment', function () {
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close-comment').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
    });

    //タイムラインの+マークを押したときの処理
    $('.js-modal-open-commons').on('click', function () {
        $('.js-modal-commons').fadeIn();
        return false;
    });
    $('.js-modal-close-commons').on('click', function () {
        $('.js-modal-commons').fadeOut();
        return false;
    });

    // ゲストユーザがハートマークを押したときの処理
    $(document).on('click', '.js-modal-open-heart', function () {
        $('.js-modal-heart').fadeIn();
        return false;
    });
    $(document).on('click', '.js-modal-close-heart', function () {
        $('.js-modal-heart').fadeOut();
        return false;
    });
});
