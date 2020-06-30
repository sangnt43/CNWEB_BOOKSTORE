<script src="<?= base_url("public/vue/recommend.js") ?>"></script>
<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>
<script src="<?= base_url("public/vue/pagination.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            _slide: {},
            currentPage: 1,
            books: <?= json_encode($books) ?>,
            currentCategory: "<?= empty($category) ? "all" : $category["Seo"] ?>"
        },
        created() {
            this.$data._slide[this.currentCategory] = {
                _books: {},
                breadcrumb: `<?= $this->load->view("layouts/breadcrumb", [], true) ?>`,
                pageTitle: "<?= empty($category) ? "Tất cả" : $category["Name"] ?>",
                totalPage: <?= $totalPage ?>,
            }
            this._books[1] = this.books;
        },
        computed: {
            "current"() {
                if (!this.$data._slide[this.currentCategory]) return null;
                return this.$data._slide[this.currentCategory];
            },
            "_books"() {
                if (!this.current) return {};
                return this.current["_books"];
            },
            "totalPage"() {
                if (!this.current) return 0;
                return this.current["totalPage"];
            },
            "pageTitle"() {
                if (!this.current) return "";
                return this.current["pageTitle"];
            }
        },
        watch: {
            "currentPage": async function(value) {
                if (!this._books[value])
                    this._books[value] = (await call_next_page(value))['books'];
                this.books = this._books[value];
            },
            "currentCategory": async function() {
                await this.changeCategory();
            }
        },
        methods: {
            async changeCategory() {
                let value = this.currentCategory;

                if (!this.$data._slide[value]) {
                    let _ = await call_next_category(`<?= base_url() ?>${value}`);

                    this.$set(this.$data._slide, value, {
                        breadcrumb: _["breadcrumb"],
                        pageTitle: _["category"] ? _["category"]["Name"] : "Tất cả",
                        totalPage: _["totalPage"],
                    });
                    if (_.books.length)
                        this.$data._slide[value]["_books"] = {
                            1: _.books
                        };
                }

                this.$nextTick(() => {
                    this.currentPage = 1;

                    this.books = this._books ? this._books[1] : null;

                    change_breadcrumb(this.current["breadcrumb"]);

                    window.history.pushState("", "", `<?= base_url() ?>${value}`);
                })
            }
        }
    }
</script>