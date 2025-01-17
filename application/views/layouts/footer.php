<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="address">
                    <h4>Our Address</h4>
                    <h6>The BookStore Theme, 4th Store Beside that building, USA</h6>
                    <h6>Call : 800 1234 5678</h6>
                    <h6>Email : info@bookstore.com</h6>
                </div>
                <div class="timing">
                    <h4>Timing</h4>
                    <h6>Mon - Fri: 7am - 10pm</h6>
                    <h6>​​Saturday: 8am - 10pm</h6>
                    <h6>​Sunday: 8am - 11pm</h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="navigation">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a href="<?= base_url("about") ?>">About Us</a></li>
                        <li><a href="<?= base_url("policy") ?>">Privacy Policy</a></li>
                        <li><a href="<?= base_url("terms-condition") ?>">Terms</a></li>
                        <li><a href="<?= base_url("all") ?>">Products</a></li>
                    </ul>
                </div>
                <div class="navigation">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="<?= base_url("shipping-return") ?>">Shipping & Returns</a></li>
                        <li><a href="<?= base_url("policy") ?>">Privacy</a></li>
                        <li><a href="<?= base_url("faq") ?>">FAQ’s</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form">
                    <h3>Quick Contact us</h3>
                    <h6>We are now offering some good discount on selected books go and shop them</h6>
                    <form method="POST" action="<?= base_url("contact") ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <input placeholder="Name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="col-md-12">
                                <textarea placeholder="Messege" name="message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn black">Alright, Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>(C) 2017. All Rights Reserved. BookStore Wordpress Theme</h5>
                </div>
                <div class="col-md-6">
                    <div class="share align-middle">
                        <span class="fb"><i class="fa fa-facebook-official"></i></span>
                        <span class="instagram"><i class="fa fa-instagram"></i></span>
                        <span class="twitter"><i class="fa fa-twitter"></i></span>
                        <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                        <span class="google"><i class="fa fa-google-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</footer>