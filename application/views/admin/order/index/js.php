<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<script src="<?= base_url() ?>public/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>public/libs/datatables-buttons/buttons.html5.min.js"></script>
<!-- <script src="<?= base_url() ?>public/vue/v-model.js"></script> -->
<script>
    var vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                table: null,
                previewData: null,
                cache: {},
                quick: {
                    id: '',
                    code: '',
                    row: null
                },
                status: "",
                // isActive: false
            }
        },
        mounted() {
            this.$nextTick(async () => {
                this.table = $("#__table__").DataTable({
                    "ajax": "<?= base_url() ?>Admin/Order/getAll",
                    "deferRender": true,
                    "columns": [{
                            "render": function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            "data": "CustomerInfo_FullName"
                        },
                        {
                            "data": "CustomerInfo_Email"
                        },
                        {
                            "data": "CustomerInfo_Phone"
                        },
                        {
                            "data": "Status"
                        },
                        {
                            "render": function(d, t, r) {
                                return `
                                    <div>
                                        <a class="btn btn-custom btn-success btn-preview text-white" title="Chi tiết"><i class="material-icons">pageview</i></a>
                                        <a class="btn btn-custom btn-danger btn-delete text-white" title="Xóa"><i class="material-icons">delete</i></a>
                                    </div>`
                            },
                            "min-width": "150px"
                        }
                    ],
                    "initComplete": (settings, json) => {
                        // this.makeSelect2(".select2")
                    }
                });
                this.table.on("xhr", e => {
                    $(e.target).on("click", "a.btn-preview", async e => {
                        let data = this.table.row($(e.target).parents('tr')).data();
                        this.quick.code = data['idGhn'];
                        let id = data['Id'];
                        if (!this.cache.hasOwnProperty(id)) {
                            let res = await fetch("<?= base_url() ?>Admin/Order/getById/" + id).then(b => b.json());

                            if (res.exitcode == 1) {
                                res.data['Avatar'] = "<?= base_url() ?>" + res.data['Avatar'];
                                this.previewData = res.data;
                                this.cache[id] = res.data;
                            } else {
                                alert(res.message)
                                return;
                            }
                        } else {
                            this.previewData = this.cache[id];
                        }
                        $(this.$refs['modal']).modal("show");
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
                                fetch("<?= base_url() ?>Admin/Order/delete/" + row.data()['id'])
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
                $.fn.dataTable.ext.search.push((s, data, index) => {
                    if (this.status !== "") {
                        let _ = this.table.row(index).data();
                        if (_ != null && this.status.indexOf(parseInt(_["StatusCode"])) != -1)
                            return true;
                        return false;
                    }
                    return true;
                })
            })
        },
        computed: {
            getStatus() {
                switch (this.status[0]) {
                    case 0:
                        return "[Mới tạo]";
                    case 1:
                        return "[Đã xác nhận]";
                    case 2:
                        return "[Đã giao]";
                    case 3:
                        return "[Đơn bị hàng hủy]";
                    default:
                        return "";
                }
            }
        },
        methods: {
            saveData() {
                let form = new FormData();
                form.append("Id", this.quick.id);
                fetch("<?= base_url() ?>Admin/Order/changeQuick", {
                    method: "POST",
                    body: form
                }).then(b => b.json()).then(b => {
                    if (b.exitcode == 1) {
                        this.table.cell(this.quick.row, 4).data(this.quick.code).draw()
                        $(this.$refs['GHN']).modal("hide");
                    } else swal("Thất bại!", "Không thể cập nhật mã giao hàng!", "error");
                })
            },
            changeStatus(...status) {
                this.status = status[0] != null ? status : "";
                this.table.draw();
            }
        },
    })
</script>