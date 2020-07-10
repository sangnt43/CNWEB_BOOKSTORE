<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">

<script src="<?= base_url() ?>public/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>public/vue/v-model.js"></script>

<script src="<?= base_url() ?>public/vue/v-model.js"></script>

<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            informations: <?= json_encode($informations) ?>,
            isPreview: false,
            previewData: null
        },
        mounted() {
            $("#__table__").DataTable();
        },
        methods: {
            preview(item) {
                this.previewData = item;
                this.isPreview = true;
            }
        }
    }
</script>