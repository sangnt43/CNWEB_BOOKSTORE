<script>
    var vue_js = {
        el: "#embed",
        data: {
            step: 1,
            user: {
                username: "",
                password: ""
            }
        },
        computed: {},
        methods: {
            onSubmit() {
                if (this.username.trim() == "" || this.password.trim() == "") event.preventDefault();
            }
        }
    }
</script>