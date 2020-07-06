<script src="<?= base_url("public/vue/shop-item.js") ?>"></script>

<script>
    vue_js = {
        el: "#embed",
        data: {
            "wich": <?= json_encode($wich) ?>
        },
        methods: {

        }
    }
</script>