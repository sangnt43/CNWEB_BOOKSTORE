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
            orders: <?= json_encode($orders) ?>,
            previewData: null,
            isPreview: false,
            isChangeStatus: false,
            orderStatuses: [],
            cache: {},
            status: 0,
            table: null
        },
        created() {
            fetch("<?= base_url("Admin/Order/getAllStatus") ?>")
                .then(b => b.json())
                .then(b => this.orderStatuses = b);
        },
        mounted() {
            this.table = $("#__table__").DataTable();
            $.fn.dataTable.ext.search.push((s, data, index) => {
                if (this.status != -1) {
                    let id = this.table.row(index).node().id;
                    return this.orders.findIndex(x => x['Id'] == id && x['StatusCode'] == this.status) != -1;
                }
                return true;
            })
        },
        computed: {
            getStatus() {
                switch (this.status) {
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
            getColor(order) {
                switch (order['StatusCode']) {
                    case "0":
                        return "btn-primary";
                    case "1":
                        return "btn-warning";
                    case "2":
                        return "btn-success";
                    case "3":
                        return "btn-danger";
                }
            },
            changeStatus(status) {
                this.status = status;
                this.table.draw();
            },
            changeOrderStatus(order) {
                this.previewData = order;
                this.isChangeStatus = true;
            },
            async preview(order) {
                if (!this.cache.hasOwnProperty(order['Id'])) {
                    let res = await fetch("<?= base_url() ?>Admin/Order/getById/" + order['Id']).then(b => b.json());

                    if (res.exitcode == 1) this.cache[order['Id']] = res.data;
                    else {
                        alert(res.message)
                        return;
                    }
                }
                this.previewData = this.cache[order['Id']];
                this.isPreview = true;
            },
            async onChangeStatus(status) {
                fetch(`<?= base_url("Admin/Order/ChangeStatus/") ?>${this.previewData['Id']}/${status['Id']}`)
                    .then(b => b.json())
                    .then(b => {
                        if (b.exitcode == 200) {
                            this.previewData['Status'] = b.status['Status'];
                            this.previewData['StatusCode'] = b.status['StatusCode'];
                            this.previewData['StatusId'] = b.status['StatusId'];

                            this.isChangeStatus = false;
                            this.previewData = null;
                        } else {
                            showNoti("Không thể cập nhật trạng thái", "Update Error");
                        }
                    })
            }
        }
    }
</script>