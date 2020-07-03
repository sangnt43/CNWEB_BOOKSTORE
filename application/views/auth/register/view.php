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
        <form id="msform" action="<?= base_url("register") ?>" @submit="onSubmit" method="POST">
            <!-- progressbar -->
            <ul id="progressbar">
                <li :class="step >= 1 ? 'active' : ''">Tạo tài khoản</li>
                <li :class="step >= 2 ? 'active' : ''">Thông tin cá nhân</li>
            </ul>
            <!-- fieldsets -->
            <fieldset v-if="step == 1">
                <h2 class="fs-title">Tạo tài khoản</h2>
                <input type="text" required v-model="user['username']" placeholder="Username" />
                <input type="password" required v-model="user['password']" placeholder="Password" />
                <input type="password" required v-model="user['cpassword']" placeholder="Confirm Password" />
                <input type="button" required @click.prvent="step = 2" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset v-else>
                <h2 class="fs-title">Thông tin cá nhân</h2>
                <input type="text" required v-model="user['fullname']" placeholder="Full Name" />
                <input type="text" required v-model="user['email']" placeholder="Email" />
                <input type="text" requiredv-model="user['phone']" placeholder="Phone" />
                <textarea required v-model="user['address']" placeholder="Address"></textarea>
                <input type="button" @click.prvent="step = 1" name="previous" class="previous action-button" value="Previous" />
                <input type="submit" class="submit action-button" value="Submit" />
            </fieldset>
            <fieldset hidden>
                <input type="hidden" name="username" v-model="user['username']">
                <input type="hidden" name="password" v-model="user['password']">
                <input type="hidden" name="fullName" v-model="user['fullname']">
                <input type="hidden" name="email" v-model="user['email']">
                <input type="hidden" name="phone" v-model="user['phone']">
                <input type="hidden" name="address" v-model="user['address']">
            </fieldset>
        </form>
    </div>
</body>

<script src="<?= base_url("public/js/jquery.min.js") ?>"></script>
<script src="<?= base_url("public/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("public/vendors/notify.min.js") ?>"></script>
<script src="<?= base_url("public/js/custom.js") ?>"></script>
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