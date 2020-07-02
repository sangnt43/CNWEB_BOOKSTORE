<script>
    vue_js = {
        el: "#embed",
        mounted() {
            document.querySelector("#changePassword").addEventListener("submit", function(e) {
                let _password = document.querySelector("input[name='new_pasword']").value;
                let c_password = document.querySelector("input[name='confirm_pasword']").value;

                if (_password != c_password) {
                    e.preventDefault();

                    showNoti("Mật khẩu không trùng nhau", "danger");
                }

                return false;
            })
        }
    }
</script>