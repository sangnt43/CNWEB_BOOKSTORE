<script src="<?= base_url("public/vue/recommend.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            book: <?= json_encode($book) ?>,
            base_url: "",
            recommendes: <?= json_encode($recommendes) ?>,
            quantity: 1,
            wich: []
        },
        created() {
            this.base_url = document.querySelector("meta[name='base_url']").dataset['value'];
            this.wich = get_cookie("wich").split(',');
        },
        computed: {
            liked() {
                return this.wich.indexOf(this.book['Id']) != -1;
            }
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
            },
            toogleWich() {
                let index = this.wich.indexOf(this.book["Id"]);
                if (index != -1) this.wich.splice(index, 1);
                else this.wich.push(this.book["Id"]);
                set_cookie("wich", this.wich.join(","));
            }
        }
    }
</script>