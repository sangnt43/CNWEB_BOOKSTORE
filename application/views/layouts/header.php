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
                            <a href="<?= base_url() ?>" class="nav-link">Trang chủ</a>
                        </li>
                        <li class="navbar-item dropdown <?= isCurrentTab("shop") ? "active" : "" ?>">
                            <a href="<?= base_url("all") ?>" class="nav-link dropdown-toggle" data-toggle="tooltip" data-placement="right" title="Tất cả">Thể loại</a>
                            <div class="dropdown-menu px-3" style="width: 20rem">
                                <div class="row">
                                    <?php foreach (getAllCategories() as $category) : ?>
                                        <div class="col-6">
                                            <a href="<?= base_url($category['Seo']) ?>"><?= $category['Name'] ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </li>
                        <?php if (empty(currentUser())) : ?>
                            <li class="navbar-item <?= isCurrentTab("login") ? "active" : "" ?>">
                                <a href="<?= base_url("login") ?>" class="nav-link">Đăng nhập</a>
                            </li>
                        <?php else : ?>
                            <li class="navbar-item dropdown <?= isCurrentTab("login") ? "active" : "" ?>">
                                <div class="nav-link dropdown-toggle">Tài khoản</div>
                                <div class="dropdown-menu px-3">
                                    <div class="text-center"><a href="<?= base_url("profile") ?>">Thông tin</a></div>
                                    <div class="text-center"><a href="<?= base_url("transaction") ?>">Giao dịch</a></div>
                                    <div class="text-center"><a href="<?= base_url("wich") ?>">Yêu thích</a></div>
                                    <div class="dropdown-divider"></div>
                                    <div class="text-center"><a href="<?= base_url("logout") ?>">Đăng xuất</a></div>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="break"></div>
                <div style="display: contents;">
                    <div class="dropdown shop-cart">
                        <shop-cart :cart.sync="cart" href="<?= base_url("checkout") ?>" ref="shop-cart" class="cart my-2 my-lg-0"></shop-cart>
                        <div class="dropdown-menu px-3" style="width: 20rem;">
                            <div v-if="cart && cart.length != 0" v-for="item in cart" class="item">
                                <a :href="item['seo']"><img :src="item['avatar']" :alt="item['name']" width="40px"></a>
                                <a :href="item['seo']">
                                    <p>{{item['name']}}</p>
                                </a>
                                <span>số lượng: {{item['quantity']}}</span>
                            </div>
                            <div v-else>
                                Hiện chưa có sản phẩm nào
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center"><a href="<?= base_url("wich") ?>">Yêu thích</a></div>
                        </div>
                    </div>
                    <shop-search href="<?= base_url("search") ?>" @fetch-value=""></shop-search>
                </div>
            </nav>
        </div>
    </div>
</header>