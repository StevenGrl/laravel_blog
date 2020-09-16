require('./bootstrap');

/* UPLOAD ARTICLES */
$(document).ready(function () {
    let imageFile = $('#article_imageFile')
    $(imageFile).on('input', function() {
        let imageFile = $('#article_imageFile').val().split('\\').pop()
        $('#article_imageFile').next().text(imageFile)
    });
});

$('#article_imageFile').change(function (e) {
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#article-image');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
});
/* END UPLOAD ARTICLES */



/* Navbar active items */
$(document).ready(function() {
    if(!window.location.href.match('/articles')) {
        $('a[name*="home"]').addClass('active')
    } else if(window.location.href.match('/articles/index')) {
        $('a[name*="index_article"]').addClass('active');
    } else if (window.location.href.match('/articles/new')) {
        $('a[name*="new_article"]').addClass('active');
    }
})
/* End navbar active items */