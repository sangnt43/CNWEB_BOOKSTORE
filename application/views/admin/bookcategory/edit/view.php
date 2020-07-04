<div class="card">
    <div class="card-body">
        <h4 class="card-title">Cập nhật thể loại bài viết</h4>
        <hr>
        <div class="form-row">
            <div class='col-lg-10 col-md-10 col-sm-12'>
                <div class='form-group'>
                    <label>Thể loại <strong>*</strong> <span class="text-danger" v-if="isError('title')">Chưa nhập tên thể loại</span></label>
                    <input v-model="productCategory.name" class='form-control' placeholder='Title'>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <div class='form-group'>
                    <label>Thứ tự <strong>*</strong></label>
                    <input v-model="productCategory.sortOrder" type=number class='form-control' min="1" value="1" placeholder='Order'>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-12">
                <label>Mô tả <strong>*</strong></label>
                <textarea v-model="productCategory.description" type=number class='form-control' rows="2" placeholder='Mô tả'></textarea>
                <i class='form-group__bar'></i>
            </div>
            <div class='col-md-12'>
                <div class='form-group'>
                    <label>Seo Url <strong>*</strong> <span class="text-danger" v-if="isError('seo')">Seo Url Không thể rỗng</span></label>
                    <div class="my_resizeable_div">
                        <strong><?= base_url("products/") ?></strong>
                        <input ref='seo' placeholder='seo' v-model="productCategory.seo" />
                        <i class='form-group__bar'></i>
                    </div>
                </div>
            </div>
            <button type="submit" @click="sendData" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
        </div>
    </div>