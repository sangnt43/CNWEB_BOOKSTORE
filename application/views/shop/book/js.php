<script src="<?= base_url("public/vue/recommend.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            book: <?= json_encode($book) ?>,
            base_url: "",
            recommendes: <?= json_encode($recommendes) ?>
        },
        created() {
            this.base_url = document.querySelector("meta[name='base_url']").dataset['value'];
        },
        methods: {
            onClick(item) {
                fetch(`${item['Seo']}`, {
                        headers: {
                            "HTTP_X_REQUESTED_WITH": true
                        }
                    })
                    .then(b => b.json())
                    .then(b => {
                        this.book = b.book;
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    });
            },
            addItem() {
                this.$refs['shop-cart'].push(this.book);
            }
        }
    }
</script>