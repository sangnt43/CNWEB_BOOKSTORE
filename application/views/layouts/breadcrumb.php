<?php if (!empty($breadcrumb) && strtolower($breadcrumb[count($breadcrumb) - 1]['name']) != 'home') : ?>
    <div class="breadcrumb">
        <div class="container">
            <?php foreach ($breadcrumb as $key => $bread) : ?>
                <?php if ($key == count($breadcrumb) - 1) : ?>
                    <span class="breadcrumb-item active"><?= $bread['name'] ?></span>
                <?php else : ?>
                    <a class="breadcrumb-item" href="<?= base_url(isset($bread['url']) ? $bread['url'] : "") ?>"><?= $bread['name'] ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif ?>