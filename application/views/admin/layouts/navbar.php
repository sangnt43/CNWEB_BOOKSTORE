<header class="header">
    <div class="navigation-trigger <?= (isset($_full_menu) && $_full_menu) ? "hidden-xl-up" : "" ?>" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>
    <div class="header__logo hidden-sm-down">
        <h1><a href="<?= base_url() ?>"><?= getenv('APP_NAME') ?></a></h1>
    </div>
</header>