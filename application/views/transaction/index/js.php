<script>
    vue_js = {
        el: "#embed",
        data: {
            order: <?= json_encode($order) ?>,
            books: <?= json_encode($books) ?>
        }
    }
</script>