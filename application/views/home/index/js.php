<script src="<?= base_url("public/vue/recommend.js") ?>"></script>
<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            isDrag: false,
            top_buy: <?= json_encode($top_buy) ?>,
            recommendes: <?= json_encode($recommendes) ?>
        },
        computed: {
            cartCount() {
                return this.cart.reduce((a, b) => b.quantity + a, 0);
            }
        },
        methods: {
        }
    }
</script>