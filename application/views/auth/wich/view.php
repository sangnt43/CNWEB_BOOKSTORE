<div class="static about-sec">
    <div class="recent-book-sec">
        <div class="row mt-5">
            <div class="col-md-3" v-for="(item,index) in wich" :key="index">
                <shop-item :item="item"></shop-item>
            </div>
        </div>
    </div>
</div>