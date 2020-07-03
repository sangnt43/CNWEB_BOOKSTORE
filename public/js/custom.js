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