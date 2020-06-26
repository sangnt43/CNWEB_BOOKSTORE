<script src="<?= base_url("publics/vue/recommend.js") ?>"></script>
<script src="<?= base_url("publics/vue/shop-item.js") ?>"></script>

<script>
    var vue_js = {
        el: "#embed",
        data: {
            data: "1",
            recommendes: <?= json_encode($recommendes) ?>,
            books: <?= json_encode($books) ?>
        },
        mounted() {},
        methods: {}
    }
</script>