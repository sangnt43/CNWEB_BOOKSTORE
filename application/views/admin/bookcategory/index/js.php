<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<script src="<?= base_url() ?>public/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.html5.min.js"></script>

<script>
    var vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                table: null,
                previewData: null,
                cache: {},
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.table = $("#__table__").DataTable({
                    "ajax": "<?= base_url() ?>Admin/BookCategory/getAll",
                    "deferRender": true,
                    "columns": [{
                            "render": function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            "data": "Name"
                        },
                        {
                            "data": "Seo"
                        },
                        {
                            "render": function(d, t, r) {
                                return `
                                    <div>
                                        <a class="btn btn-custom btn-info btn-edit text-white" title="Sửa"><i class="material-icons">mode_edit</i></a>
                                        <a class="btn btn-custom btn-danger btn-delete text-white" title="Xóa"><i class="material-icons">delete</i></a>
                                    </div>`
                            },
                            "min-width": "150px"
                        }
                    ]
                });
                this.table.on("xhr", e => {
                    $(e.target).on("click", "a.btn-edit", e => {
                        var row = this.table.row($(e.target).parents('tr'));
                        window.location.href = `<?= base_url() ?>Admin/BookCategory/edit/${row.data()['id']}`;
                    })
                    $(e.target).on("click", "a.btn-delete", e => {
                        var row = this.table.row($(e.target).parents('tr'));
                        swal({
                                title: "Bạn đã đã chắn chắn?",
                                text: "Hành động này sẽ xóa tất cả các dữ liệu liên quan, và không thể phục hồi",
                                type: "warning",
                                showCancelButton: true,
                                cancelButtonText: "Bỏ qua",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Đồng ý!",
                                closeOnConfirm: false
                            },
                            function() {
                                fetch("<?= base_url() ?>Admin/BookCategory/delete/" + row.data()['id'])
                                    .then(b => b.json()).then(c => {
                                        if (c.exitcode == 1) {
                                            row.remove().draw(false)
                                            swal("Thành công!", "Dữ liệu của bạn đã được xóa!", "success");
                                        } else swal("Thất bại!", "Dữ liệu của bạn không xóa được!", "error");
                                    })
                                    .catch(e => swal("Thất bại!", "Dữ liệu của bạn không xóa được!", "error"));
                            });
                    })
                });
            })
        },
        methods: {},
    })
</script>