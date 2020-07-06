<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title_ ?></title>
    <link rel="stylesheet" href="<?= base_url("public/css/login.css") ?>">
    <script rel="stylesheet" src="<?= base_url("public/vendors/vue.js") ?>"></script>
</head>

<body>
    <div id="embed">
        <form id="msform" action="<?= !isset($IsAdmin) ? base_url("login") : base_url("Admin/login") ?>" method="POST" @submit="onSubmit">
            <?php if (!empty($IsAdmin)) : ?>
                <input type="hidden" name="IsAdmin" value="true">
            <?php endif; ?>
            <fieldset>
                <h2 class="fs-title">Đăng nhập</h2>
                <input type="text" name='username' v-model="user['username']" placeholder="Username" />
                <input type="password" name='password' v-model="user['password']" placeholder="Password" />
                <input type="submit" name="submit" class="next action-button" value="Đăng nhập" />
                <div>
                    <a href="<?= base_url("forget") ?>">Quên mật khẩu</a>
                </div>
                <div><a href="<?= base_url("register") ?>">Chưa có tài khoản?</a></div>
            </fieldset>
        </form>
    </div>
</body>

<script src="<?= base_url("public/js/jquery.min.js") ?>"></script>
<script src="<?= base_url("public/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("public/vendors/notify.min.js") ?>"></script>
<script src="<?= base_url("public/js/custom.js") ?>"></script>

<?php if (isset($message)) showNoti($message, "danger") ?>
<?php if (isset($_js_) && is_file(VIEWPATH . explode(".", $_js_)[0] . ".php")) $this->load->view($_js_) ?>

<script>
    window.addEventListener("DOMContentLoaded", function() {
        if (typeof vue_js == 'undefined') vue_js = {
            el: "#embed"
        }
        new Vue(vue_js), vue_js = undefined;
    })
</script>


</html>