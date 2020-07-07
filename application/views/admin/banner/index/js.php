<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">

<script src="<?= base_url() ?>public/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.html5.min.js"></script>

<script src="<?= base_url() ?>public/vue/v-model.js"></script>

<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            banners: <?= json_encode($banners) ?>,
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
            },
            onDelete(item) {
                swal({
                        title: "Do you want to delete?",
                        text: "This action will delete all related data, and cannot recover!",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Cancel",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    },
                    () => {
                        fetch("<?= base_url() ?>Admin/Banner/delete/" + item['Id'], {
                                method: "post"
                            })
                            .then(b => b.json()).then(c => {
                                if (c.exitcode == 200) {
                                    let mytable = $("#data-table").DataTable();
                                    mytable.row($("#" + item['Id'])).remove().draw(false);

                                    this.banners.splice(this.banners.findIndex(x => x['Id'] == item['Id']), 1);
                                    swal("Success!", "Your data has been deleted!", "success");
                                } else swal("Fail!", "Your data cannot be deleted!", "error");
                            })
                            .catch(e => swal("Fail!", "Your data cannot be deleted!", "error"));
                    });
            },
            onChangeActive(item) {
                let form = new FormData();
                form.append("IsActive", item["IsActive"]);
                fetch("<?= base_url() ?>Admin/Banner/changeActive/" + item['Id'], {
                    method: "post",
                    body: form
                }).then(b => b.json()).then(b => {
                    if (b.exitcode != 200) item.IsActive = !item.IsActive;
                });
            }
        }
    }
</script>