$(document).on("change", "#profile_image", function (e) {
    var reader;
    if (e.target.files.length) {
        reader = new FileReader;
        reader.onload = function (e) {
            var userThumbnail;
            userThumbnail = document.getElementById('preview_profile_image');
            console.log(userThumbnail);
            userThumbnail.setAttribute('src', e.target.result);
        };
        return reader.readAsDataURL(e.target.files[0]);
    }
});