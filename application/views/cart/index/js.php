<script src="<?= base_url("public/vue/recommend.js") ?>"></script>

<script>
    vue_js = {
        el: "#embed",
        data: {

        },
        computed: {
            getTotal() {
                return this.cart.reduce((a, b) => a + Number(b['quantity']) * Number(b['price']), 0);
            }
        },
        methods: {
            onChange(item) {
                this.$refs["shop-cart"].update();
            },
            onUp(item) {
                item['quantity']++;
                console.log(item);
                this.$refs["shop-cart"].update();
            },
            onDown(item) {
                item['quantity'] -= (item['quantity'] != 0);
                this.$refs["shop-cart"].update();
            }
        }
    }
</script>