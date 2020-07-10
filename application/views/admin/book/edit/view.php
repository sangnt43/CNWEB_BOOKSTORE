<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title font-weight-bold">Cập nhật sản phẩm</h4>
        <hr>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="col-sm-">
                    <div class="form-group">
                        <input type="file" name="Avatar" @change="preview($event)" id="avatar" accept="image/*" style="display:none" class="form-control" placeholder="Type avatar here...." />
                    </div>
                </div>
                <div class="col-sm-6" style="margin: auto;text-align:center">
                    <a href="javascript:$('#avatar').click();" data-original-title="Cick to change image" data-placement="bottom" data-toggle="tooltip" data-fancybox data-type="iframe" class="btn btn-raised waves-effect waves-light fancy">
                        <img ref="preview" class="shadow" :src="book.Avatar" alt="avatar" width="150px" height="150px" id="prev_img"></a>
                    <div class="form-line">
                        <label style="font-style: italic;" for="fullname">Chọn Hình Ảnh Cho Sách (<small>Recommended image size: 400x400 - Allow type gif|jpg|png|jpeg</small>)</label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                    </div>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên sản phẩm <strong>*</strong></label>
                    <input v-model="book.Name" name="Name" class='form-control' placeholder='Tên sản phẩm' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Loại <strong>*</strong></label>
                    <v-select v-model="book.BookCategoryId" name="BookCategoryId" :options="categoryList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }" required></v-select>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-3 col-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Giá ($)<strong>*</strong></label>
                    <input v-model="book.Price" name="Price" type="number" class='form-control' value="1" min="1">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-3 col-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Giảm (%)<strong>*</strong></label>
                    <input v-model="book.Discount" name="Discount" type="number" class='form-control' value="0" min="0" max="100">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tác giả<strong>*</strong></label>
                    <input type="text" name="AuthId" hidden>
                    <input v-model="book.Auth" name="Auth" list="authes" type="text" class='form-control'>
                    <datalist id="authes">
                        <?php foreach ($authes as $auth) : ?>
                            <option value="<?= $auth['Name'] ?>" data-id="<?= $auth['Id'] ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Nhà xuất bản<strong>*</strong></label>
                    <input type="text" name="PublisherId" hidden>
                    <input v-model="book.Publisher" name="Publisher" list="publishers" type="text" class='form-control'>
                    <datalist id="publishers">
                        <?php foreach ($publishers as $publisher) : ?>
                            <option value="<?= $publisher['Name'] ?>" data-id="<?= $publisher['Id'] ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Mô tả <strong>*</strong></label>
                    <textarea name="Description" id="ckeditor"></textarea>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <input type="hidden" name="Images" v-model="book.Images">
                    <label class="font-weight-bold">Hình ảnh/video liên quan</label>
                    <p><i>Recommended Image Size: 1280x720 - Allow type gif|jpg|png|jpeg</i></p>

                    <div class="p-2 my-2 d-flex" style="border: 1px solid #eceff1;max-width: 100%;flex-wrap: wrap">
                        <div class="MyImage m-2 shadow" v-for="image in book.Images">
                            <img style="height:60px" :src="correctUrl(image)" />
                            <button type="button" @click="remove_image(image)" class="btn bg-transparent w-100 h-100">
                                <i class="zmdi zmdi-close-circle-o text-secondary m-auto" style="font-size:2rem"></i>
                            </button>
                        </div>
                        <div id="imageList" style="max-width: 100%;flex-wrap: wrap" class="d-flex">
                            <a style="height: 60px; width: 60px; border-width: 1.1px;" @click="open_popup" class="d-flex justify-content-center align-content-center btn btn-outline-secondary m-2 shadow">
                                <i class="zmdi zmdi-plus m-auto" style="font-size: 2rem"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class='col-md-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Seo <strong>*</strong></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><?= base_url() ?></div>
                        </div>
                        <input type="text" name='Seo' v-model="book.Seo" class="form-control" required>
                        <i class='form-group__bar'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
</form>