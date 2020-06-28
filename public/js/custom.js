const call_next_page = function(page = 1) {
    let _ = new FormData();
    _.append("page", page);
    return fetch("", {
        method: "POST",
        headers: {
            "HTTP_X_REQUESTED_WITH": "AJAX"
        },
        body: _
    }).then(b => b.json());
}

$(document).ready(function() {
    $("#owl-demo").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1,
        autoPlay: 3000,
        loop: true,
    });
    $("#testimonal").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1,
        autoPlay: 3000,
        loop: true,
    });
});