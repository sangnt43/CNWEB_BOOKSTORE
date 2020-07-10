<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Cập nhật thông tin trang: <?= $information['Id'] ?></h4>
        <hr>
        <div class="form-row">
            <textarea name="Content" id="ckeditor"><?= $information['Content'] ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
</form>