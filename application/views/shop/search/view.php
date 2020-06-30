<section class="static about-sec">
    <div class="container">
        <div class="recent-book-sec">
            <div class="row">
                <div class="col-md-3" v-for="(item,index) in books" :key="index">
                    <shop-item :item="item"></shop-item>
                </div>
            </div>
            <div class="btn-sec">
                <pagination v-if="totalPage > 1" :page.sync="currentPage" :total-page="totalPage"></pagination>
            </div>
        </div>
    </div>
</section>