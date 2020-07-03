<script>
    window.addEventListener("DOMContentLoaded", function(e) {
        if (typeof showNoti != 'undefined')
            showNoti("<?= $message ?>", "<?= $type ?>");
    })
</script>