<script src="<?= base_url() ?>public/libs/popper.js/popper.min.js"></script>
<script src="<?= base_url() ?>public/libs/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/libs/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>public/libs/jquery-scrollLock/jquery-scrollLock.min.js"></script>
<script src="<?= base_url() ?>public/libs/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>public/libs/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>public/libs/toastr/dist/build/toastr.min.js"></script>

<script type="text/javascript">
    var color = window.localStorage.getItem("body-color");
    if (color == null) color = "green";

    $(`.bg-${color}`).addClass("active");
    $(`.bg-${color} input`).attr("checked", "");
    $("body").attr("data-ma-theme", color);

    if (sessionStorage.noti != undefined && sessionStorage.noti != '') {
        var varNoti = JSON.parse(sessionStorage.noti);
        noti(varNoti.content, varNoti.title, varNoti.type, false);
        sessionStorage.clear();
    }

    function noti(content = "", title = "", type = 'success', showAfterReload = false) {
        if (showAfterReload) {
            sessionStorage.noti = JSON.stringify({
                'content': content,
                'title': title,
                'type': type,
                'showAfterReload': showAfterReload,
            });
        } else {
            var html = '<div class="toast fade show" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true">' +
                '<div class="toast-header">' +
                '<strong class="mr-auto">' +
                '<i class="fas fa-check-circle toast-icon-success d-none"></i> ' +
                '<i class="fas fa-info-circle toast-icon-info d-none"></i> ' +
                '<i class="fas fa-exclamation-triangle toast-icon-warning d-none"></i> ' +
                '<i class="fas fa-minus-circle toast-icon-error d-none"></i> ' +
                title +
                '</strong>' +
                '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">' +
                '<span aria-hidden="true">×</span>' +
                '</button>' +
                '</div>' +
                '<div class="toast-body">' + content + '</div>' +
                '</div>';
            toastr[type](html, '', {
                positionClass: 'toastr toast-bottom-right',
                showMethod: "slideDown",
                hideMethod: "fadeOut",
                showEasing: "swing",
                hideEasing: "linear",
                progressBar: true,
                newestOnTop: false,
                timeOut: 5000,
            });
        }
    }
</script>
<?php
require_once(__DIR__ . '/vuejs.php');
if (isset($_js_) && $_js_[0] != '_' && is_file(VIEWPATH . $_js_ . '.php')) 
    $this->load->view($_js_);
?>
<!-- App functions and actions -->
<script src="<?= base_url() ?>public/js/admin.app.min.js"></script>