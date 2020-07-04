<div class="card">
    <div class="card-body">
        <h4 class="card-title">Cập nhật Banner</h4>
        <hr>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <div class="form-group">
                        <input id="avatar" type="file" @change="preview($event)" accept="image/*" style="display:none" class="form-control" />
                    </div>
                </div>
                <div class="col-sm-6" style="margin: auto;text-align:center">
                    <a href="javascript:$('#avatar').click()" data-original-title="Chọn ảnh bìa" data-placement="bottom" data-toggle="tooltip" data-fancybox data-type="iframe" style="width: 256px; height: 144px; padding:0; box-shadow: 2px 2px 6px 0px;" class="btn btn-raised waves-effect waves-light fancy">
                        <img ref="preview" src="" alt="" width="256px" height="144px"></a>
                    <div class="form-line">
                        <br>
                        <label style="font-style: italic;" for="fullname">Chọn ảnh bìa (<small>Kích thước đề nghị cho trang chủ: 600x500 - Với các định dạng gif | jpg | png | jpeg</jpeg></small>)</label>
                        <br>
                        <span class="text-danger" v-if="isError('image')">Chưa chọn Banner</span>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                    </div>
                </div>
            </div>
            <div class='col-lg-10 col-md-10 col-sm-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên Banner <strong>*</strong></label>
                    <input v-model="banner.name" class='form-control' placeholder='Tên banner' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <div class='form-group'>
                    <label>Thứ tự <strong>*</strong> <span class="text-danger" v-if="isError('sortOrder')">Chưa chọn thứ tự</span></label>
                    <input v-model="banner.sortOrder" type=number value=1 class='form-control' min="1">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-12">
                <div class='form-group'>
                    <label>Mô tả <strong>*</strong></label>
                    <textarea v-model="banner.description" type=number class='form-control' rows="2" placeholder='Mô tả'></textarea>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-12">
                <div class='form-group'>
                    <label>Liên kết <strong>*</strong></label>
                    <input v-model="banner.url" class='form-control' placeholder='Tên sản phẩm' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class='form-group'>
                    <label>Ngày bắt đầu <strong>*</strong> <span class="text-danger" v-if="isError('activeDate')">Chưa chọn ngày sinh</span></label>
                    <input v-model="banner.activeDate" type=datetime-local class='form-control' min="1">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class='form-group'>
                    <label>Ngày kết thúc <strong>*</strong> <span class="text-danger" v-if="isError('deactiveDate')">Chưa chọn ngày sinh</span></label>
                    <input v-model="banner.deactiveDate" type=datetime-local class='form-control' min="1">
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class='form-group'>
                    <label>Vị trí <strong>*</strong></label>
                    <select2 v-model="banner.type" :options="typeList" :settings="{ placeholder: 'Chọn vị trí banner', width:'100%' }"></select2>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class='form-group'>
                    <label>Hiện Tên</label>
                    <div class="form-row pt-3 ml-1">
                        <div class="toggle-switch mx-3">
                            <input type="checkbox" v-model="banner.isShowName" class="toggle-switch__checkbox">
                            <i class="toggle-switch__helper"></i>
                        </div>
                    </div>
                    <i class='form-group__bar'></i>
                </div>
                <i class='form-group__bar'></i>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class='form-group'>
                    <label>Hiện mô tả</label>
                    <div class="form-row pt-3 ml-1">
                        <div class="toggle-switch mx-3">
                            <input type="checkbox" v-model="banner.isShowDescription" class="toggle-switch__checkbox">
                            <i class="toggle-switch__helper"></i>
                        </div>
                    </div>
                    <i class='form-group__bar'></i>
                </div>
                <i class='form-group__bar'></i>
            </div>
        </div>

    </div>
    <button type="submit" @click="sendData" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
</div>
</div>
