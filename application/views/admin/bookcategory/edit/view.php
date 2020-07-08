<form class="card" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Chỉnh sửa thể loại sách</h4>
        <hr>
        <div class="form-row">
            <div class='col-12'>
                <div class='form-group'>
                    <label>Thể loại <strong>*</strong></label>
                    <input v-model="category.Name" name="Name" class='form-control' placeholder='Title'>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <v-select v-model="category.Parent" :options="categoryList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }" required></v-select>
            <div class='col-md-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Seo <strong>*</strong></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><?= base_url() ?></div>
                        </div>
                        <input type="text" name='Seo' v-model="category.Seo" class="form-control" required>
                        <i class='form-group__bar'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Thêm</strong></button>
</form>