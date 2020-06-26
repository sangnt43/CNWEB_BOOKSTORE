<section class="static">
    <div class="container">
        <h2>Mua Nhiều Nhất</h2>
        <div class="recomended-sec">
            <div class="row" v-if="recommendes.length">
                <div class="col-lg-3 col-md-6" v-for="item in recommendes">
                    <recommend :item="item"></recommend>
                </div>
            </div>
            <div class="text-center" v-else>
                <hr>
                <h1>Hiện Chưa Có Sách Nào</h1>
                <hr>
            </div>
        </div>
        <h2>Sách Mới Nhất</h2>
        <div class="recent-book-sec" v-if="books.length">
            <div class="row">
                <div class="col-md-3" v-for="item in books">
                    <shop-item :item="item"></shop-item>
                </div>
            </div>
            <div class="btn-sec">
                <a href="products.html" class="btn gray-btn">load More books</a>
            </div>
        </div>
        <div class="recent-book-sec" v-else>
            <div class="text-center">
                <hr>
                <h1>Hiện Chưa Có Sách Nào</h1>
                <hr>
            </div>
        </div>
    </div>
</section>