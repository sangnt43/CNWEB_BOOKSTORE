<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("layouts/" . __HEAD__) ?>

<body>
    <div id="embed">
        <?php $this->load->view("layouts/" . __HEADER__) ?>
        <?php $this->load->view("layouts/" . __BREADCRUMB__) ?>
        <?php if (isset($_view_) && is_file(VIEWPATH . explode(".", $_view_)[0] . ".php")) $this->load->view($_view_);
        else echo "<hr><h1 style='text-align: center'>Directory is not exist</h1><hr>"; ?>

        <?php $this->load->view("layouts/" . __FOOTER__) ?>

        <scroll-top id="up-to-top" :show-at="250"></scroll-top>
    </div>
</body>

<?php $this->load->view("layouts/" . __INCLUDE_SCRIPT__) ?>
<?php if (isset($_js_) && is_file(VIEWPATH . explode(".", $_js_)[0] . ".php")) $this->load->view($_js_) ?>

<script>
    window.addEventListener("DOMContentLoaded", function() {
        var _time;

        if (typeof vue_js == 'undefined') vue_js = {
            el: "#embed",
            data: {}
        }

        vue_js['data']['cart'] = null;

        new Vue(vue_js), vue_js = undefined;

        $('.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(400).fadeOut(500);
        });
    })
</script>
<?php checkNoti() ?>

</html>