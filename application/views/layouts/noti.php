<script>
    window.addEventListener("DOMContentLoaded", function(e) {
        <?= isset($script) ? "$script" : "" ?>
        if (typeof showNoti != 'undefined')
            showNoti("<?= $message ?>", "<?= $type ?>");
    })
</script>