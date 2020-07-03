<section class="recomended-sec">
    <div class="container">
        <div class="title">
            <h2>highly recommendes books</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6" v-for="item in recommendes">
                <recommend :item="item"></recommend>
            </div>
        </div>
    </div>
</section>
<section class="about-sec">
    <div class="about-img">
        <figure style="background:url(./public/images/about-img.jpg)no-repeat;"></figure>
    </div>
    <div class="about-content">
        <h2>About bookstore,</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. Lorem Ipsum has been the book. </p>
        <p>It has survived not only fiveLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and</p>
        <div class="btn-sec">
            <a href="<?= base_url("all") ?>" class="btn yellow">shop books</a>
            <a href="<?= base_url("subscriptions") ?>" class="btn black">subscriptions</a>
        </div>
    </div>
</section>
<section class="recent-book-sec">
    <div class="container">
        <div class="title">
            <h2>highly recommendes books</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4" v-for="item in top_buy">
                <shop-item :item="item"></shop-item>
            </div>
        </div>
        <div class="btn-sec">
            <a href="<?= base_url("all") ?>" class="btn gray-btn">view all books</a>
        </div>
    </div>
</section>
<section class="features-sec">
    <div class="container">
        <ul>
            <li>
                <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                <h3>SAFE SHOPPING</h3>
                <h5>Safe Shopping Guarantee</h5>
                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
            </li>
            <li>
                <span class="icon return"><i class="fa fa-reply-all" aria-hidden="true"></i></span>
                <h3>30- DAY RETURN</h3>
                <h5>Moneyback guarantee</h5>
                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
            </li>
            <li>
                <span class="icon chat"><i class="fa fa-comments" aria-hidden="true"></i></span>
                <h3>24/7 SUPPORT</h3>
                <h5>online Consultations</h5>
                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
            </li>
        </ul>
    </div>
</section>
<section class="offers-sec" style="background:url(public/images/offers.jpg)no-repeat;">
    <div class="cover"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="detail">
                    <h3>Top 50% OFF on Selected</h3>
                    <h6>We are now offering some good discount on selected books go and shop them</h6>
                    <a href="<?= base_url("all") ?>" class="btn blue-btn">view all books</a>
                    <span class="icon-point percentage">
                        <img src="public/images/precentagae.png" alt="">
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail">
                    <h3>Shop $ 500 Above and Get Extra!</h3>
                    <h6>We are now offering some good discount on selected books go and shop them</h6>
                    <a href="<?= base_url("all") ?>" class="btn blue-btn">view all books</a>
                    <span class="icon-point amount"><img src="public/images/amount.png" alt=""></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="testimonial-sec">
    <div class="container">
        <div id="testimonal" class="owl-carousel owl-theme">
            <div class="item">
                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                <div class="box-user">
                    <h4 class="author">Susane Mathew</h4>
                    <span class="country">Australia</span>
                </div>
            </div>
            <div class="item">
                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                <div class="box-user">
                    <h4 class="author">Susane Mathew</h4>
                    <span class="country">Australia</span>
                </div>
            </div>
            <div class="item">
                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                <div class="box-user">
                    <h4 class="author">Susane Mathew</h4>
                    <span class="country">Australia</span>
                </div>
            </div>
            <div class="item">
                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                <div class="box-user">
                    <h4 class="author">Susane Mathew</h4>
                    <span class="country">Australia</span>
                </div>
            </div>
        </div>
    </div>
    <div class="left-quote">
        <img src="public/images/left-quote.png" alt="quote">
    </div>
    <div class="right-quote">
        <img src="public/images/right-quote.png" alt="quote">
    </div>
</section> -->