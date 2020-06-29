<script src="<?= base_url("public/js/jquery.min.js") ?>"></script>
<script src="<?= base_url("public/js/bootstrap.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("public/js/owl.carousel.min.js") ?>"></script>
<script src="<?= base_url("public/js/custom.js") ?>"></script>
<script src="<?= base_url("public/vue/scroll-top.js") ?>"></script>
<script src="<?= base_url("public/vue/shop-cart.js") ?>"></script>
<script src="<?= base_url("public/vendors/notify.min.js") ?>"></script>

<script>
    Vue.directive("currency", {
        bind(el, ) {
            if (!window.formater) window.formater = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: '<?= __CURRENCY__ ?>',
                minimumFractionDigits: <?= __CURRENCY_DECIAML__ ?>
            })
            el.innerHTML = formater.format(el.innerText);
        }
    })
</script>