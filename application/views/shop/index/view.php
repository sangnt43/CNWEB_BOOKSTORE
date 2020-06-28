<section class="static col-9">
    <div class="container">
        <h2 class="text-center">{{pageTitle}}</h2>
        <hr>
        <div class="recent-book-sec" v-if="books.length">
            <div class="row">
                <div class="col-md-3" v-for="item in books">
                    <shop-item :item="item"></shop-item>
                </div>
            </div>
            <div class="btn-sec">
                <pagination @click="onPageChange" :total-page="totalPage"></pagination>
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

<section class="col-3" style="border: 0.5px solid gray">
    <h4 class="text-center">Thể loại</h4>
    <hr>
    <div class="row category">
        <p class="col-12"><a href="#">Tất cả</a></p>
        <p class="col-6 active"><a href="#">1</a></p>
        <p class="col-6"><a href="#">2</a></p>
    </div>
</section>