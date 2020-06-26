<script src="<?= base_url("publics/js/jquery.min.js") ?>"></script>
<script src="<?= base_url("publics/js/bootstrap.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("publics/js/owl.carousel.min.js") ?>"></script>
<script src="<?= base_url("publics/js/custom.js") ?>"></script>
<script src="<?= base_url("publics/vue/scroll-top.js") ?>"></script>
<script src="<?= base_url("publics/vue/shop-cart.js") ?>"></script>

<script>
    Vue.directive("currency", {
        bind(el, value, vNode) {
            if (!window.formater) window.formater = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: '<?= __CURRENCY__ ?>',
                minimumFractionDigits: <?= __CURRENCY_DECIAML__ ?>
            })
            el.innerHTML = formater.format(el.innerText);
        }
    })
</script>