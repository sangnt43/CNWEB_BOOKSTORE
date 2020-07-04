<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<script src="<?= base_url() ?>public/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.html5.min.js"></script>

<script>
    let vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                table: null,
                previewData: {
                    title: '',
                    image: ''
                }
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.table = $("#__table__").DataTable({
                    "ajax": "<?= base_url() ?>Admin/Banner/getAll",
                    "deferRender": true,
                    "columns": [{
                            "render": function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            "data": "Title"
                        },
                        {
                            "data": "isActive",
                            "render": function(d, t, r) {
                                return `
                                <div class="toggle-switch center">
                                    <input type="checkbox" ${ d == 1 ? "checked":""} class="toggle-switch__checkbox" name="isShowName">
                                    <i class="toggle-switch__helper"></i>
                                </div>
                                `;
                            }
                        },
                        {
                            "render": function(d, t, r) {
                                return `
                                    <div>
                                        <a class="btn btn-custom btn-warning btn-preview text-white" title="Xem"><i class="material-icons">image_search</i></a>
                                        <a class="btn btn-custom btn-info btn-edit text-white" title="Sửa"><i class="material-icons">mode_edit</i></a>
                                        <a class="btn btn-custom btn-danger btn-delete text-white" title="Xóa"><i class="material-icons">delete</i></a>
                                    </div>`
                            },
                            "min-width": "150px"
                        }
                    ]
                });
                this.table.on("xhr", e => {
                    $(e.target).on("click", "input[name='isActive']", e => {
                        let id = this.table.row($(e.target).parents('tr')).data()['id'];
                        let form = new FormData();
                        form.append("id", id);
                        form.append("ShowName", e.target.checked);
                        fetch("<?= base_url() ?>/Admin/Banner/changeShow", {
                            method: "POST",
                            body: form
                        })
                    });
                    $(e.target).on("click", "a.btn-preview", e => {
                        var row = this.table.row($(e.target).parents('tr'));
                        this.previewData.image = row.data()['Image'];
                        this.previewData.title = row.data()['Name'];
                        $(this.$refs['modal']).modal("show");
                    })

                    $(e.target).on("click", "a.btn-edit", e => {
                        let row = this.table.row($(e.target).parents('tr'));
                        window.location.href = `<?= base_url() ?>Admin/Banner/edit/${row.data()['id']}`;
                    })
                    $(e.target).on("click", "a.btn-delete", e => {
                        let row = this.table.row($(e.target).parents('tr'));
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
                                fetch("<?= base_url() ?>Admin/Banner/delete/" + row.data()['id'])
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