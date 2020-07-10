<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Cập nhật Quản trị viên</h4>
        <hr>
        <div class="form-row">
            <div class="col-sm-6">
                <div class='form-group'>
                    <label>Tài khoản</label>
                    <input v-model="admin.Username" type="text" name="Username" class="form-control" disabled>
                    <i class='form-group__bar'></i>
                </div>
                <i class='form-group__bar'></i>
            </div>
            <div class="col-sm-6">
                <div class='form-group'>
                    <label>Mật khẩu</label>
                    <input v-model="admin.Password" type="password" name="Password" class="form-control">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-sm-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên <strong>*</strong></label>
                    <input v-model="admin.FullName" name="FullName" class='form-control' placeholder='Tên admin' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Thêm</strong></button>
</form>