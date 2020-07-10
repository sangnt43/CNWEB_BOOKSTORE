<link rel="stylesheet" href="<?= base_url() ?>public/libs/duallistbox/bootstrap-duallistbox.min.css">
<script src="<?= base_url() ?>public/libs/duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url() ?>public/vue/v-listbox.js"></script>
<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            userInGroup: [],
            _userInGroup: [],
            users: null
        },
        created() {
            this.users = <?= json_encode($users) ?>;
            this.userInGroup = <?= json_encode($userInGroup) ?>;
            this.$data._userInGroup = <?= json_encode($userInGroup) ?>;
        },
        computed: {
            userList() { // array mới so với array cũ 
                return JSON.stringify(this.userInGroup.filter(u => !this.$data._userInGroup.includes(u)));
            },
            removeList() { // array cũ so với array mới
                return JSON.stringify(this.$data._userInGroup.filter(u => !this.userInGroup.includes(u)));
            }
        },
        methods: {
            onSubmit() {

            }
        }
    }
</script>