<script src="<?= base_url("public/vue/recommend.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            book: <?= json_encode($book) ?>,
            base_url: "",
            recommendes: <?= json_encode($recommendes) ?>,
            quantity: 1
        },
        created() {
            this.base_url = document.querySelector("meta[name='base_url']").dataset['value'];
        },
        methods: {
            async onClick(item) {
                let res = await call_api(`${item['Seo']}`)
                this.book = res.book;
                change_breadcrumb(res["breadcrumb"]);
                history.pushState(item['Name'], item['Name'], `${item['Seo']}`);
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            },
            addItem() {
                this.$refs['shop-cart'].push(this.book, this.quantity);
            }
        }
    }
</script>