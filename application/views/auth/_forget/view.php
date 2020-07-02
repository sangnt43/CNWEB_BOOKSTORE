<section class="static about-sec">
    <div class="container">
        <div class="my-5 mx-auto">
            <?php if (!isset($success) || $success == false) : ?>
                <form action="" method="POST" class="card">
                    <div class="card-header">
                        Tìm lại tài khoản của bạn
                    </div>
                    <div class="card-body">
                        <input type="text" <?= isset($email) ? "value='$email'" : "" ?> class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="card-footer text-muted">
                        <a href="<?= base_url() ?>" class="float-right btn black p-2" style="font-size: 14px;">Hủy</a>
                        <button type="submit" class="float-right btn blue-btn p-2" style="font-size: 14px;">Tìm kiếm</button>
                    </div>
                </form>
            <?php else : ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Đăng nhập vào mail để thay đổi mật khẩu</h5>
                    </div>
                    <div class="card-body">
                        <h5>Mã khích hoạt sẽ bị vô hiệu hóa trong <span id="timer">180</span>s</h5>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="<?= base_url() ?>" class="float-right btn black p-2" style="font-size: 14px;">Trang chủ</a>
                        <a href="https://gmail.com/" class="float-right btn blue-btn p-2" style="font-size: 14px;">Gmail</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>