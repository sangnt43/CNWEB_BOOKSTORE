<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <title>FPO - CI</title> -->
    <title><?= $_TITLE_ ?></title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- new css -->
    <link rel="stylesheet" href="<?= base_url() ?>fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/login.css">

    <link href="<?= base_url(); ?>public/libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>public/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/vendors/vue.min.js"></script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" id="login-form">
                <!-- <form class="login100-form validate-form"> -->
                <div>
                    <span class="login100-form-logo">
                        <img src="<?= base_url("images/logo/zuyu-120.png") ?>" alt="">
                    </span>
                    <span class="login100-form-title p-b-34 p-t-27">
                        Đăng nhập
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" v-model="login.username" type="text" name="username" required>
                    <span class="focus-input100">
                        Tên đăng nhập
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" v-model="login.password" @keypress.enter="tryLogin" type="password" name="pass" required>
                    <span class="focus-input100">
                        Mật khẩu
                    </span>
                </div>

                <div class="container-login100-form-btn" style="margin-top: 35px">
                    <button :disabled="isError" @click="tryLogin" class="login100-form-btn">
                        Đăng nhập
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>libs/toastr/dist/build/toastr.min.js"></script>

    <script id="DELETED">
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "10000",
            "hideDuration": "10000",
            "timeOut": "50000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        new Vue({
            el: "#login-form",
            data: {
                login: {
                    username: '',
                    password: ''
                }
            },
            computed: {
                isError() {
                    return this.login.username.trim().length < 4 || this.login.password.trim().length < 4;
                }
            },
            methods: {
                tryLogin() {
                    let form = new FormData();
                    form.append("username", this.login.username);
                    form.append("password", this.login.password);
                    fetch("<?= base_url("Admin/Auth/login") ?>", {
                        method: "POST",
                        body: form
                    }).then(b => b.json()).then(b => {
                        if (b.exitcode == 1) {
                            window.location.href = b.data.returnUrl;
                        } else {
                            toastr["error"](b.message, "Không thể đăng nhập")
                        }
                    })
                }
            }
        })
        document.getElementById("DELETED").remove();
    </script>
</body>

</html>