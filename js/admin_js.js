$(document).ready(function () {
    $('#name_link').click(function () {
        show_logout();
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
        showImg(this);
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