<script src="<?= base_url("publics/vue/recommend.js") ?>"></script>
<script src="<?= base_url("publics/vue/shop-item.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            isDrag: false,
            cart: [],
            recommendes: <?= json_encode($recommendes) ?>,
            top_buy: <?= json_encode($top_buy) ?>
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