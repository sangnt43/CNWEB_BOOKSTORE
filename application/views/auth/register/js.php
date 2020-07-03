<script>
    function ValidateEmail(mail) {
        return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail));
    }
    var vue_js = {
        el: "#embed",
        data: {
            step: 1,
            user: {
                username: "",
                password: "",
                cpassword: "",
                fullname: "",
                email: "",
                phone: "",
                address: ""
            }
        },
        computed: {
            checkError() {
                let flag = true;
                for (let i in this.user)
                    if (this.user[i].trim() == "") {
                        flag = false;
                        break;
                    }

                if (!ValidateEmail(this.user.email)) flag = false;

                if (isNaN(this.user.phone)) flag = false;

                return flag;
            }
        },
        methods: {
            onSubmit() {
                if (this.checkError) return true;

                event.preventDefault();

                showNoti("Thông tin không hợp lệ", "error");
            }
        }
    }
</script>