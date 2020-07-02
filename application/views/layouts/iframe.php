<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("layouts/" . __HEAD__) ?>

<body>
    <div id="embed">
        <?php if (isset($_view_) && is_file(VIEWPATH . explode(".", $_view_)[0] . ".php")) $this->load->view($_view_);
        else echo "<hr><h1 style='text-align: center'>Directory is not exist</h1><hr>"; ?>
    </div>
</body>

<?php $this->load->view("layouts/" . __INCLUDE_SCRIPT__) ?>
<?php if (isset($_js_) && is_file(VIEWPATH . explode(".", $_js_)[0] . ".php")) $this->load->view($_js_) ?>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        var _time;

        if (typeof vue_js == 'undefined') vue_js = {
            el: "#embed"
        }

        new Vue(vue_js), vue_js = undefined;
    })
</script>

</html>