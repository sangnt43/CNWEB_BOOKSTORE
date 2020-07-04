<div class="card">
    <div class="card-body form-row mb-1">
        <h4 class="card-title font-weight-bold col-md-10">Cập nhật sản phẩm: {{title}}</h4>
        <hr>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <div class="form-group">
                        <input type="file" @change="preview($event)" id="avatar" accept="image/*" style="display:none" class="form-control" placeholder="Type avatar here...." />
                    </div>
                </div>
                <div class="col-sm-6" style="margin: auto;text-align:center">
                    <a href="javascript:$('#avatar').click();" data-original-title="Cick to change image" data-placement="bottom" data-toggle="tooltip" data-fancybox data-type="iframe" class="btn btn-raised waves-effect waves-light fancy">
                        <img ref="preview" class="shadow" src="https://via.placeholder.com/300?text=Avatar+Product" alt="avatar" width="150px" height="150px" id="prev_img"></a>
                    <div class="form-line">
                        <br>
                        <label style="font-style: italic;" for="fullname">Choose image book (<small>Recommended image size: 400x400 - Allow type gif|jpg|png|jpeg</small>)</label>
                        <br>
                        <span class="text-danger" v-if="isError('avatar')">Chưa chọn ảnh bìa</span>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                    </div>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên sản phẩm <strong>*</strong> <span class="text-danger" v-if="isError('name')">Chưa nhập tên sản phẩm</span></label>
                    <input v-model="book.Name" class='form-control' placeholder='Tên sản phẩm' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Loại <strong>*</strong> <span class="text-danger" v-if="isError('bookCategory')">Chưa chọn thể loại</span></label>
                    <select2 v-model="book.BookCategoryId" :options="categoryList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }"></select2>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-group'>
                    <label class="font-weight-bold">Giá ($)<strong>*</strong> <span class="text-danger" v-if="isError('price')">Giá không hợp lệ</span></label>
                    <input type="number" class='form-control' v-model="book.Price" value="0">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Mô tả <strong>*</strong> <span class="text-danger" v-if="isError('description')"> Chưa nhập mô tả</span></label>
                    <textarea id="ckeditor"></textarea>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Hình ảnh video liên quan</label>
                    <p><i>Recommended image size: 1280x720 - Allow type gif|jpg|png|jpeg</i></p>

                    <div class="p-2 my-2 d-flex" style="border: 1px solid #eceff1;max-width: 100%;flex-wrap: wrap">
                        <div class="MyImage m-2 shadow" v-for="image in book.Images">
                            <img style="height:60px" :src="image" />
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
                    <label class="font-weight-bold">Seo Url <strong>*</strong><span class="text-danger" v-if="isError('seo')">Chưa nhập Seo</span></label>
                    <div class="my_resizeable_div">
                        <strong><?= base_url("books/") ?></strong>
                        <input name='seo' v-model="book.Seo" required>
                        <i class='form-group__bar'></i>
                    </div>
                </div>
            </div>
            <button @click="sendData" type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
        </div>
    </div>
</div>