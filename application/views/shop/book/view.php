<section class="product-sec">
    <div class="container" :key="book.id">
        <!-- lưu ý key -->
        <h1>{{book.Name}}</h1>
        <div class="row">
            <div class="col-md-6 slider-sec">
                <!-- main slider carousel -->
                <div id="myCarousel" class="carousel slide" style="min-height: 560px">
                    <!-- main slider carousel items -->
                    <div class="carousel-inner">
                        <div class="item carousel-item" :class="index == 0? 'active': ''" v-for="(image,index) in book.Images" :data-slide-number="index">
                            <img :src="image" class="img-fluid" style="min-height: 555px;">
                        </div>
                    </div>
                    <!-- main slider carousel nav controls -->
                    <ul class="carousel-indicators list-inline">
                        <li class="list-inline-item" :class="index == 0? 'active': ''" v-for="(image,index) in book.Images" :data-slide-number="index">
                            <a :id="'carousel-selector-'+index" :class="index == 0 ? 'selected' : ''" :data-slide-to="index" data-target="#myCarousel">
                                <img :src="image" class="img-fluid">
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/main slider carousel-->
            </div>
            <div class="col-md-6 slider-content">
                <p v-html="book['Description']"></p>
                <ul v-if="book.discount">
                    <li>
                        <span class="name">Discount</span><span class="clm">:</span>
                        <span class="price" v-currency>{{book.Price}}</span>
                    </li>
                    <li>
                        <span class="name">Kindle Price</span><span class="clm">:</span>
                        <span class="price final" v-currency>{{book.Price - (book.Price * book.Discount / 100)}}</span>
                    </li>
                </ul>
                <ul v-else>
                    <li>
                        <span class="name">Kindle Price</span><span class="clm">:</span>
                        <span class="price final" v-currency>{{book.Price}}</span>
                    </li>
                </ul>
                <div class="btn-sec">
                    <button class="btn" @click="addItem">Add To cart</button>
                    <button class="btn black">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="related-books">
    <div class="container">
        <h2>You may also like these book</h2>
        <div class="recomended-sec">
            <div class="row">
                <div class="col-lg-3 col-md-6" v-for="item in recommendes">
                    <recommend :item="item" @click.prevent="onClick(item)"></recommend>
                </div>
            </div>
        </div>
    </div>
</section>