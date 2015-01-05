$.ajaxSetup({cache: false});

$(function () {
    $('#carousel').carouFredSel({
        responsive: true,
        items: {
            visible: 1,
            width: 694,
            height: 300
        },
        scroll: {
            duration: 250,
            timeoutDuration: 2500,
            fx: 'uncover-fade'
        },
        pagination: '#pager'
    });
    $('#readMoreClose').click(function () {
        closeReadMore();
    });
    $('#bookProduct').click(function () {
        closeReadMore();
    });
});


function bookProduct(id) {
    if (id !== 1) {
        closeReadMore();
    }
    $('#readMoreBack').fadeIn();
    $('#readMoreCont').fadeIn('slow');
    $('#title').html('Book Product');
    $.ajax({
        url: "getBookPanel",
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
    $('#readMoreBack').fadeIn();
    $('#readMoreCont').fadeIn('slow');
    $('#title').html('Product Details');
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
    setScrollPosition();
}

function closeReadMore() {
    $('#readMoreBack').fadeOut('slow');
    $('#readMoreCont').fadeOut();
    unsetScrollPosition();
}

function setScrollPosition() {
    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft, self.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
    ];
    var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
    html.data('scroll-position', scrollPosition);
    html.data('previous-overflow', html.css('overflow'));
    html.css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function unsetScrollPosition() {
    // un-lock scroll position
    var html = jQuery('html');
    var scrollPosition = html.data('scroll-position');
    html.css('overflow', html.data('previous-overflow'));
    window.scrollTo(scrollPosition[0], scrollPosition[1])
}

function menu_list_on() {
    $('#product').css({
        'color': '#003399'
    });
    $('.menu_list').css({
        "display": "block"
    });
}

function menu_list_off() {
    $('#product').css({
        'color': '#fff'
    });
    $('.menu_list').css({
        "display": "none"
    });
}
