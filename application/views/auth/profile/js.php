<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>
<script src="<?= base_url("public/vue/v-model.js") ?>"></script>
<script>
    const password = () => ({
        old: "",
        new: "",
        cnew: ""
    })
    vue_js = {
        el: "#embed",
        data: {
            user: {
                "Username": "",
                "Fullname": "",
                "Address": "",
                "Phone": "",
                "Email": ""
            },
            _user: null,
            password: password(),
            transactions: null,
            wich: null,
            isActive: false,
            showShippingStatus: false,
            shippingSrc: null
        },
        created() {
            <?php if (isset($user)) : ?>
                this.user = <?= json_encode($user) ?>;
                this.$data._user = JSON.parse(JSON.stringify(this.user));
            <?php endif; ?>
            <?php if (isset($transactions)) : ?>
                this.transactions = <?= json_encode($transactions) ?>;
            <?php endif ?>
            <?php if (isset($wich)) : ?>
                this.wich = <?= json_encode($wich) ?>;
            <?php endif; ?>

            <?php if (!isCurrentTab("profile")) : ?>
                call_api("<?= base_url("profile") ?>").then(b => {
                    this.user = b.user;
                    this.$data._user = JSON.parse(JSON.stringify(this.user));
                });
            <?php endif; ?>
            <?php if (!isCurrentTab("transaction")) : ?>
                call_api("<?= base_url("transaction") ?>").then(b => this.transaction = b.books);
            <?php endif; ?>
            <?php if (!isCurrentTab("wich")) : ?>
                call_api("<?= base_url("wich") ?>").then(b => this.wich = b.wich);
            <?php endif; ?>
        },
        mounted() {
            document.querySelector(".nav-tabs").addEventListener("click", e => {
                if (e.target.tagName == "A") {
                    let current = e.target;
                    history.pushState(current.dataset["aria-controls"], current.dataset["aria-controls"], current.dataset["href"]);
                }
            })
        },
        computed: {
            isChange() {
                return JSON.stringify(this.user) != JSON.stringify(this.$data._user);
            },
            canChangePassword() {
                return this.password.new.length > 5 && this.password.new.trim() != "" &&
                    this.password.new != this.password.old && this.password.new == this.password.cnew;
            }
        },
        methods: {
            async tryChangePassword() {
                let form = new FormData();
                form.append("new_password", this.password.new);
                form.append("password", this.password.old);

                let res = await call_api('<?= base_url("changePassword") ?>', form);

                switch (res.success) {
                    case -1:
                        showNoti("Mật khẩu không chính xác", "warning");
                        break;
                    case 0:
                        showNoti("Không thể cập nhật mật khẩu", "danger");
                        break;
                    case 1:
                        this.isActive = false;
                        showNoti("Thành Công", "success");
                        break;
                }

            },
            async tryChangProfile() {
                let form = new FormData();

                for (let i in this.user)
                    form.append(i, this.user[i]);

                let res = await call_api("<?= base_url("changeProfile") ?>", form);

                switch (res.success) {
                    case 0:
                        showNoti("Thất bại", "danger");
                        break;

                    default:
                        showNoti("Thành công", "danger");
                        break;
                }
            }
        }
    }
</script>