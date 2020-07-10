<script src="<?= base_url() ?>public/libs/ckeditor/ckeditor.js"></script>
<script>
    vue_js = {
        el: "#main-wrapper",
        data: {},
        mounted() {
            this.editor = CKEDITOR.replace('ckeditor');
        },
        methods: {
            onSubmit() {
                let isError = false;

                if (isError) event.preventDefault();
            }
        }
    }
</script>