<header class="content__title">
  <h1>Quản lý Banner</h1>
  <div class="actions">
    <a href="<?= base_url(); ?>Admin/Banner/add">
      <button class="btn btn-danger btn--icon zmdi zmdi-plus-circle zmdi-hc-fws" style="font-size: 25px" data-original-title="Thêm" data-placement="bottom" data-toggle="tooltip">
      </button>
    </a>
  </div>
</header>
<div class="card">
  <div class="card-body">
    <div class="table-responsive px-1">
      <table id="__table__" class="table table-bordered text-center">
        <thead class="thead-default">
          <tr>
            <th style="width: 150px;">#</th>
            <th>Tên</th>
            <th style="width: 150px;">Hiển thị</th>
            <th style="width: 15rem;">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="banners.length > 0" v-for="(banner,index) in banners" :key="index" :id="banner['Id']">
            <td v-once>{{index + 1}}</td>
            <td>{{banner['Title']}}</td>
            <td>
              <div class="toggle-switch center">
                <input type="checkbox" @change.prevent="onChangeActive(banner)" style="margin-left: 20px ;" class="toggle-switch__checkbox" v-model="banner['IsActive']">
                <i class="toggle-switch__helper"></i>
              </div>
            </td>
            <td style="width: 15rem;">
              <a @click="preview(banner)" href="javascript:void(0)" class="btn btn-xs btn-info btn-custom" data-original-title="Xem thử" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">preview</i></a>
              <a :href="'<?= base_url(); ?>Admin/Banner/edit/' + banner['Id']" class="btn btn-xs btn-warning btn-custom" data-original-title="Chỉnh sửa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">mode_edit</i></a>
              <a @click="onDelete(banner)" href="#" class="btn btn-xs btn-danger btn-custom" data-original-title="Xóa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">delete_forever</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<v-model :is-active.sync="isPreview">
  <div class="modal-body">
    <div class="item" v-if="previewData">
      <div class="slide">
        <img :src="previewData['Image']" width="100%" alt="slide1">
        <div class="content p-0">
          <div class="title text-center" style="position: absolute;text-align: right;transform: translate(-50%,-50%);top: 50%;left: 50%;">
            <h3 class="text-white">{{previewData['Title']}}</h3>
            <h5 class="text-white">{{previewData['Content'] ? previewData['Content'] : ""}}</h5>
            <a v-if="previewData['Url']" href="#" class="btn btn-warning">{{previewData['btn_text']}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</v-model>