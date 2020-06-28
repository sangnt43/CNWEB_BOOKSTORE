<section class="slider">
    <div class="container">
        <div id="owl-demo" class="owl-carousel owl-theme">

            <?php foreach ($banners as $banner) : ?>
                <div class="item">
                    <div class="slide">
                        <img src="<?= $banner["Image"] ?>" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3><?= $banner["Title"] ?></h3>
                                <h5><?= $banner["Content"] ?></h5>
                                <?php if (!empty($banner["Url"])) : ?>
                                    <a href="<?= $banner["Url"] ?>" class="btn"><?= $banner["btn_text"] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>