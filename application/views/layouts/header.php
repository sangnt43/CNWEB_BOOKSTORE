<header>
    <div class="main-menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url("public/images/logo.png") ?>" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-item <?= isCurrentTab("home") ? "active" : "" ?>">
                            <a href="<?= base_url() ?>" class="nav-link">Home</a>
                        </li>
                        <li class="navbar-item <?= isCurrentTab("shop") ? "active" : "" ?>">
                            <a href="<?= base_url("all") ?>" class="nav-link">Shop</a>
                        </li>
                        <li class="navbar-item <?= isCurrentTab("about") ? "active" : "" ?>">
                            <a href="<?= base_url("about") ?>" class="nav-link">About</a>
                        </li>
                        <li class="navbar-item <?= isCurrentTab("faq") ? "active" : "" ?>">
                            <a href="<?= base_url("faq") ?>" class="nav-link">FAQ</a>
                        </li>
                        <?php if (empty(currentUser())) : ?>
                            <li class="navbar-item <?= isCurrentTab("login") ? "active" : "" ?>">
                                <a href="<?= base_url("login") ?>" class="nav-link">Login</a>
                            </li>
                        <?php else : ?>

                        <?php endif; ?>
                    </ul>
                </div>
                <div class="break"></div>
                <div style="display: contents;">
                    <shop-cart ref="shop-cart" class="cart my-2 my-lg-0"></shop-cart>
                    <form class="form-inline my-2 my-lg-0 search-form">
                        <input class="form-control" type="search" placeholder="Search here..." aria-label="Search">
                        <span class="fa fa-search"></span>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</header>