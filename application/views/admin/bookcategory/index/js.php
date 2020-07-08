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
            categories: <?= json_encode($categories) ?>
        },
        mounted() {
            $("#__table__").DataTable();
        },
        methods: {
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
                        fetch("<?= base_url() ?>Admin/BookCategory/delete/" + item['Id'], {
                                method: "post"
                            })
                            .then(b => b.json()).then(c => {
                                if (c.exitcode == 200) {
                                    let mytable = $("#__table__").DataTable();
                                    mytable.row($("#" + item['Id'])).remove().draw(false);

                                    this.categories.splice(this.categories.findIndex(x => x['Id'] == item['Id']), 1);
                                    swal("Success!", "Your data has been deleted!", "success");
                                } else swal("Fail!", "Your data cannot be deleted!", "error");
                            })
                            .catch(e => swal("Fail!", "Your data cannot be deleted!", "error"));
                    });
            }
        }
    }
</script>