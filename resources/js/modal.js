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

    $('.js-modal-open').on('click', function () {
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click', function () {
        $('.js-modal').fadeOut();
        return false;
    });

    // ゲストユーザがハートマークを押したときの処理
    2
    3
    $(document).on('click', '.js-modal-open-heart', function () {
        $('.js-modal-heart').fadeIn();
        return false;
    });
    $(document).on('click', '.js-modal-close-heart', function () {
        $('.js-modal-heart').fadeOut();
        return false;
    });
});
