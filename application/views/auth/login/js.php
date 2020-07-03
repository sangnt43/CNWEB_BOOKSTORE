<script>
    var vue_js = {
        el: "#embed",
        data: {
            step: 1,
            user: {
                username: "<?= isset($username) ? $username : '' ?>",
                password: ""
            }
        },
        computed: {},
        methods: {
            onSubmit() {
                if (this.user.username.trim() == "" || this.user.password.trim() == "") event.preventDefault();
            }
        }
    }
</script>