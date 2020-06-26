<?php if (!empty($breadcrumbs) && strtolower($breadcrumbs[count($breadcrumbs) - 1]['name']) != 'home') : ?>
    <div class="breadcrumb">
        <div class="container">
            <?php foreach ($breadcrumbs as $key => $breadcrumb) : ?>
                <?php if (count($breadcrumbs) - 1 == $key) : ?>
                    <span class="breadcrumb-item active"><?= $breadcrumb['name'] ?></span>
                <?php else : ?>
                    <a class="breadcrumb-item" href="<?= base_url(isset($breadcrumb['url']) ? $breadcrumb['url'] : "") ?>"><?= $breadcrumb['name'] ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif ?>