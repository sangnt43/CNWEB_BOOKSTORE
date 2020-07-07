const call_api = function(url, form = null) {
    return fetch(url, {
        method: "POST",
        headers: {
            "HTTP_X_REQUESTED_WITH": "AJAX"
        },
        body: form
    }).then(b => b.json());
}

const call_next_page = function(page = 1) {
    let _ = new FormData();
    _.append("page", page);
    return call_api("", _);
}

const call_next_category = function(url) {
    return call_api(url);
}

const create_node = function(htmlString) {
    var t = document.createElement('template');
    t.innerHTML = htmlString;
    return t.content.cloneNode(true);
}

const change_breadcrumb = function(htmlString) {
    var _node = create_node(htmlString);
    document.querySelector(".breadcrumb").replaceWith(_node);
}

const showNoti = function(message, type) {
    if (type == "danger") type = 'error';
    $.notify(message, type);
}

function set_cookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function get_cookie(cname) {
    var name = cname + "=";
    for (let item of document.cookie.split(';'))
        if (item.trim().indexOf(name) != -1)
            return item.trim().substring(name.length);
    return "";
}

$(document).ready(function() {
    if ($("#owl-demo")) {
        $("#owl-demo").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            autoPlay: 3000,
            loop: true,
        });
    }
    if ($("#testimonal")) {
        $("#testimonal").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            items: 1,
            autoPlay: 3000,
            loop: true,
        });
    }
});