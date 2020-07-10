<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            admin: {
                Username: "",
                FullName: ""
            }
        },
        created() {
            this.admin = <?= json_encode($admin) ?>;
        },
        mounted() {
            <?php if (isset($error)) : ?>
                <?php if (isset($error['upload'])) : ?>
                    showNoti("<?= $error['upload'] ?>", "Không thể thêm");
                <?php elseif (isset($error['data'])) : ?>
                    showNoti("Dự liệu không phù hợp", "Không thể thêm");
                    this.admin = <?= json_encode($error['data']) ?>
                <?php endif; ?>
            <?php endif; ?>
        },
        methods: {
            preview() {
                var file = event.target.files[0];
                if (file.size / (1024 * 1024) > 5)
                    showNoti("Kích thước quá to", "Kích thước quá to", "error");
                else
                    this.$refs['preview'].src = URL.createObjectURL(file);
            },
            onSubmit() {
                let isError = false;

                if (isError) event.preventDefault();
            }
        }
    }
</script>