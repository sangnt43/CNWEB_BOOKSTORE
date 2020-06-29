<section class="static col-9">
    <div class="container">
        <h2 class="text-center" style="position: relative; top: 10px">{{pageTitle}}</h2>
        <hr>
        <div class="recent-book-sec" v-if="books">
            <div class="row">
                <div class="col-md-3" v-for="(item,index) in books" :key="index">
                    <shop-item :item="item"></shop-item>
                </div>
            </div>
            <div class="btn-sec">
                <pagination :page.sync="currentPage" :total-page="totalPage"></pagination>
            </div>
        </div>
        <div class="recent-book-sec" v-else>
            <div class="text-center">
                <hr>
                <h1 class="mt-3">Hiện Chưa Có Sách Nào</h1>
                <hr>
            </div>
        </div>
    </div>
</section>

<section class="col-3" style="border: 0.5px solid gray">
    <h4 class="text-center" style="position: relative; top: 10px">Thể loại</h4>
    <hr>
    <div class="row category" id="category">
        <p class="col-12" :class="{active: currentCategory == 'all'}"><a href="<?= base_url("all") ?>" data-href="all">Tất cả</a></p>
        <?php foreach (getAllCategories() as $category) : ?>
            <p class="col-6" :class="{active: currentCategory == '<?= $category['Seo'] ?>'}">
                <a href="<?= base_url($category["Seo"]) ?>" data-href="<?= $category["Seo"] ?>"><?= $category["Name"] ?></a>
            </p>
        <?php endforeach; ?>
    </div>
</section>