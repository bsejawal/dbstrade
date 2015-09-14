$(document).ready(function () {
    $('#readMoreClose').click(function () {
        closeReadMore();
    });
    $('#bookProduct').click(function () {
        closeReadMore();
    });
    $('#name_link').click(function () {
        show_logout();
    });

    $('#title').focusout(function () {
        return countChars();
    });

    $('#name_link').focusout(function () {
        hide_logout();
    });
    $('#newPass').focus(function () {
        removeShadow('newPass');
    });
    $('#conPass').focus(function () {
        removeShadow('conPass');
    });
    $('#img').change(function () {
        var filesize = this.files[0].size;
        if (filesize >= 2097152) {
            alert('File size should be less than 2 MB.');
            this.value = '';
        } else {
            showImg(this);
        }
    });
    $("#deleteImage").change(function () {
        if (this.checked) {
            $("#browseBtn").css({
                'display': 'block'
            });
        } else {
            $("#browseBtn").css({
                'display': 'none'
            });
        }
    });
});

function countChars() {
    var val = $('#title').val().length;
    if (val > 20) {
        alert('Only 20 characters are allowed in title.');
        $('#title').css({
            'color': '#f00'
        });
        return false;
    } else {
        $('#title').css({
            'color': '#555'
        });
        return true;
    }

}

function show_flash(id) {
    $("#" + id).fadeIn('slow');
    setInterval(function () {
        $("#" + id).fadeOut('slow');
    }, 5000);
}

function show_logout() {
    $("#logout_box").fadeIn('slow');
}

function hide_logout() {
    $("#logout_box").fadeOut('slow');
}

function checkPassword() {
    if (checkNull($("#newPass").val()) || checkNull($("#conPass").val()) || checkNull($("#oldPass").val())) {
        $('#newPass, #conPass').css({
            'box-shadow': '0px 0px 3px #f00'
        });
        alert('empty');
        return false;
    }
    if ($("#newPass").val() !== $("#conPass").val()) {
        $('#newPass, #conPass').css({
            'box-shadow': '0px 0px 3px #f00'
        });
        alert('not equal');
        return false;
    }
}

function showImg(img) {
    if (img.files && img.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgLocation').attr('src', e.target.result);
        },
                reader.readAsDataURL(img.files[0]);
    }
}

function removeShadow(id) {
    $('#' + id).css({
        'box-shadow': 'none'
    });
}


function checkNull(str) {
    if (str === null || str === "")
        return true;
    else
        return false;

}
$.ajaxSetup({cache: false});

function bookProduct(id, prodId) {
    if (id !== 0) {
        closeReadMore();
    }
    $('#readMoreBack').fadeIn();
    $('#readMoreCont').fadeIn('slow');
    $('#title').html('Book Product');
    $.ajax({
        url: "getBookPanel?id=" + prodId,
        type: "GET",
        success: function (recieved) {
            $('#content').html(recieved);
        },
        failure: function () {
            $('#content').html('No data recieved.');
        },
        dataType: 'html'
    });
    setScrollPosition();
}

function readMore(id) {
    if (id !== 0) {
        $.ajax({
            url: "getReadMore?id=" + id,
            type: "GET",
            success: function (recieved) {
                $('#content').html(recieved);
            },
            failure: function () {
                $('#content').html('No data recieved.');
            },
            dataType: 'html'
        });
        $('#title').html('Product Details');
    }
    $('#readMoreBack').fadeIn();
    $('#readMoreCont').fadeIn('slow');
    setScrollPosition();
}

function closeReadMore() {
    $('#readMoreBack').fadeOut('slow');
    $('#readMoreCont').fadeOut();
    $('#content').html('');
    unsetScrollPosition();
}

function setScrollPosition() {
    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft, self.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
    ];
    var html = jQuery('html');
    html.data('scroll-position', scrollPosition);
    html.data('previous-overflow', html.css('overflow'));
    html.css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function unsetScrollPosition() {
    var html = jQuery('html');
    var scrollPosition = html.data('scroll-position');
    html.css('overflow', html.data('previous-overflow'));
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function menu_list_on() {
    $('#product').css({
        'background': '#003399'
    });
    $('.menu_list').css({
        "display": "block"
    });
}

function menu_list_off() {
    $('#product').css({
        'background': '#ff6600'
    });
    $('.menu_list').css({
        "display": "none"
    });
}
