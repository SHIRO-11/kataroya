$(document).on("change", "#profile_image", function (e) {
    var reader;
    if (e.target.files.length) {
        reader = new FileReader;
        reader.onload = function (e) {
            var userThumbnail;
            userThumbnail = document.getElementById('preview_profile_image');
            userThumbnail.setAttribute('src', e.target.result);
        };
        return reader.readAsDataURL(e.target.files[0]);
    }
});

// 投稿に画像が追加された時
$(document).on("change", "#post_image", function (e) {
    var reader;
    if (e.target.files.length) {
        reader = new FileReader;
        reader.onload = function (e) {
            var postImage;
            postImage = document.getElementById('preview_post_image');
            postImage.setAttribute('src', e.target.result);
        };
        return reader.readAsDataURL(e.target.files[0]);
    }
});

// 投稿に画像が追加された時
$(document).on("change", "#comment_image", function (e) {
    var reader;
    if (e.target.files.length) {
        reader = new FileReader;
        reader.onload = function (e) {
            var commentImage;
            commentImage = document.getElementById('preview_comment_image');
            commentImage.setAttribute('src', e.target.result);
        };
        return reader.readAsDataURL(e.target.files[0]);
    }
});

$(document).on("click", ".reply", function (e) {
    var $this = $(this);
    comment = document.getElementById('comment');
    index = $this.data('index');
    console.log(index);

    comment.value = `返信先>>>>>${index} さん`
    return false;
}
);