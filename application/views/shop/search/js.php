<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>
<script src="<?= base_url("public/vue/pagination.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            currentPage: 1,
            _books: {},
            books: <?= json_encode($books) ?>,
            totalPage: <?= $totalPage ?>
        },
        created() {
            this.$data._books[1] = this.books;
        },
        watch: {
            async "currentPage"(value) {
                if (!this.$data._books[value]) {
                    let res = await call_next_page(value);
                    this.$data._books[value] = res.books;
                }
                this.books = this.$data._books[value];
            }
        }
    }
</script>