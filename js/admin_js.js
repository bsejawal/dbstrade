$(document).ready(function() {
    $('#name_link').click(function() {
        show_logout();
    });
    $('#name_link').focusout(function() {
        hide_logout();
    });
});

function show_flash(id) {
    $("#" + id).fadeIn('slow');
    setInterval(function() {
        $("#" + id).fadeOut('slow');
    }, 3000);
}

function show_logout() {
    $("#logout_box").fadeIn('slow');
}

function hide_logout() {
    $("#logout_box").fadeOut('slow');
}