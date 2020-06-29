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
        mounted() {
            document.querySelector("#category").addEventListener("click", async e => {
                e.preventDefault();
                let seo = e.target.dataset["href"];

                if (e.target.tagName != "A" || `<?= base_url() ?>seo` == window.location.href) return;

                if (!this.$data._slide[seo]) {
                    let _ = await call_next_category(`<?= base_url() ?>${seo}`);
                    this.$data._slide[seo] = {
                        breadcrumb: _["breadcrumb"],
                        pageTitle: _["category"]["Name"],
                        totalPage: _["totalPage"],
                    };
                    if (_.books.length)
                        this.$data._slide[seo]["_books"] = {
                            1: _.books
                        };
                }

                this.currentCategory = seo;
                this.currentPage = 1;
                this.books = this._books ? this._books[1] : null;
                change_breadcrumb(this.current["breadcrumb"]);

                window.history.pushState("", "", `<?= base_url() ?>${seo}`);
            })
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
                this.currentPage = value;
                if (!this._books[value])
                    this._books[value] = (await call_next_page(value))['books'];
                this.books = this._books[value];
            }
        }
    }
</script>