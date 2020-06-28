<script src="<?= base_url("public/vue/recommend.js") ?>"></script>
<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>
<script src="<?= base_url("public/vue/pagination.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            data: "1",
            _books: {},
            pageTitle: "Tất cả",
            totalPage: <?= $totalPage ?>,
            books: <?= json_encode($books) ?>
        },
        mounted() {
            this.$data._books[1] = this.books;
        },
        methods: {
            async onPageChange(value) {
                if (!this.$data._books[value])
                    this.$data._books[value] = (await call_next_page(value))['books'];
                this.books = this.$data._books[value];
            }
        }
    }
</script>