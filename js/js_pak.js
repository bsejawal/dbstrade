$(function() {
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
});

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
        'background': 'none'
    });
    $('.menu_list').css({
        "display": "none"
    });
}