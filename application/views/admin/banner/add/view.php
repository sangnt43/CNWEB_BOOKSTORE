<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Thêm Banner</h4>
        <hr>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <div class="form-group">
                        <input id="image" type="file" hidden name="Image" @change="preview" accept="image/*" class="form-control" />
                    </div>
                </div>
                <div class="col-sm-6" style="margin: auto;text-align:center">
                    <a href="javascript:$('#image').click()" data-original-title="Chọn ảnh bìa" data-placement="bottom" data-toggle="tooltip" data-fancybox data-type="iframe" style="width: 256px; height: 144px; padding:0; box-shadow: 2px 2px 6px 0px;" class="btn btn-raised waves-effect waves-light fancy">
                        <img ref="preview" src="" alt="" width="256px" height="144px"></a>
                    <div class="form-line">
                        <br>
                        <label style="font-style: italic;" for="fullname">Chọn ảnh bìa (<small>Kích thước đề nghị cho trang chủ: 1024×683  - Với các định dạng gif | jpg | png | jpeg</small>)</label>
                        <br>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                    </div>
                </div>
            </div>
            <div class='col-sm-10'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên Banner <strong>*</strong></label>
                    <input v-model="banner.Title" name="Title" class='form-control' placeholder='Tên banner' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-sm-2">
                <div class='form-group'>
                    <label>Active</label>
                    <div class="form-row pt-3 ml-1">
                        <div class="toggle-switch mx-3">
                            <input v-model="banner.IsActive" name="IsActive" value="1" type="checkbox" class="toggle-switch__checkbox">
                            <i class="toggle-switch__helper"></i>
                        </div>
                    </div>
                    <i class='form-group__bar'></i>
                </div>
                <i class='form-group__bar'></i>
            </div>
            <div class="col-md-12">
                <div class='form-group'>
                    <label>Mô tả</label>
                    <textarea v-model="banner.Content" name="Content" type=number class='form-control' rows="2" placeholder='Mô tả'></textarea>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-9">
                <div class='form-group'>
                    <label>Liên kết</label>
                    <input v-model="banner.Url" name="Url" class='form-control' placeholder='Liên kết'>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class='form-group'>
                    <label>Chữ hiễn thị</label>
                    <input v-model="banner.btn_text" name="btn_text" class='form-control' placeholder='Chữ hiễn thị' value="Show more" required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Thêm</strong></button>
</form>