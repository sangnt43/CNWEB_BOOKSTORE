<div class="static">
    <div class="container mb-5">
        <form class="row" method="POST" action="<?= base_url("checkout") ?>">
            <div class="col-12 col-md-8 border">
                <div class="card my-4">
                    <div class="card-header">
                        MÃ KHUYẾN MÃI/MÃ QUÀ TẶNG
                        <button @click.prevent class="close btn px-2 py-1" style="background: blue;" data-toggle="collapse" href="#voucher" role="button" aria-expanded="false" aria-controls="voucher">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body collapse" id="voucher">
                        <input type="text" name="voucher" class="form-control" placeholder="Voucher">
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        ĐỊA CHỈ GIAO HÀNG
                        <button @click.prevent class="close btn px-2 py-1" style="background: blue;" data-toggle="collapse" href="#shipping-info" role="button" aria-expanded="false" aria-controls="shipping-info">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <div class="card-body collapse show" id="shipping-info">
                        <div class="form-group">
                            <label for="">Họ và tên</label>
                            <input type="text" required class="form-control" <?= isset($user) ? "value='$user[FullName]'" : "" ?> name="fullname" placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" required class="form-control" <?= isset($user) ? "value='$user[Email]'" : "" ?> name="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="">Điện thoại</label>
                            <input type="tel" required class="form-control" <?= isset($user) ? "value='$user[Phone]'" : "" ?> name="phone" aria-describedby="phoneHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <!-- <input type="email" class="form-control" name="Address" aria-describedby="emailHelp" placeholder="Enter email"> -->
                            <textarea name="address" required class="form-control" rows="2"> <?= isset($user) ? "$user[Address]" : "" ?></textarea>
                        </div>
                    </div>
                </div>
                <?php if (!empty($payments)) : ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            PHƯƠNG THỨC THANH TOÁN
                            <button class="close btn px-2 py-1" style="background: blue;" data-toggle="collapse" href="#payment" role="button" aria-expanded="false" aria-controls="payment">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="card-body collapse show" id="payment">
                            <?php foreach ($payments as $key => $payment) : ?>
                                <div>
                                    <input type="radio" name="payment_type" <?= $key == 0 ? "checked" : "" ?> value="<?= $payment['Id'] ?>">
                                    <label for=""><?= $payment["Type"] ?></label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="card mb-4">
                    <div class="card-header">
                        GHI CHÚ
                        <button @click.prevent class="close btn px-2 py-1" style="background: blue;" data-toggle="collapse" href="#note" role="button" aria-expanded="false" aria-controls="note">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body collapse" id="note">
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="total" value="<?= $total ?>">
                        Tổng số tiền: <span v-currency><?= $total ?></span>
                    </div>
                </div>
                <button class="btn btn-block">Thanh toán</button>
            </div>
            <div class="col-12 col-md-4 border">
                <div class='col-12 text-center my-4' style="border-bottom: 0.5px solid black;">
                    <h5>Danh sách mua</h5>
                </div>
                <?php foreach ($books as $book) : ?>
                    <div class="row mb-3">
                        <input type="hidden" name="books[ ]" value="<?= $book['Id'] ?>">
                        <input type="hidden" name="quantities[ ]" value="<?= $book['Quantity'] ?>">
                        <div class="col-3">
                            <img src="<?= $book['Avatar'] ?>" alt="">
                        </div>
                        <div class="col">
                            <div><?= $book['Name'] ?></div>
                            <div>Số lượng: <?= $book['Quantity'] ?></div>
                            <div>Giá: <span v-currency><?= $book['Total'] ?></span></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
</div>