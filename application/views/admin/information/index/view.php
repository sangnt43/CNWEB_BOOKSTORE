<header class="content__title">
  <h1>Quản lý Các trang thông tin</h1>
</header>
<div class="card">
  <div class="card-body">
    <div class="table-responsive px-1">
      <table id="__table__" class="table table-bordered text-center">
        <thead class="thead-default">
          <tr>
            <th style="width: 150px;">#</th>
            <th>Vị trí</th>
            <th style="width: 15rem;">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="informations.length > 0" v-for="(information,index) in informations" :key="index" :id="information['Id']">
            <td v-once>{{index + 1}}</td>
            <td>{{information['Id']}}</td>
            <td style="width: 15rem;">
              <a @click="preview(information)" href="javascript:void(0)" class="btn btn-xs btn-info btn-custom" data-original-title="Xem thử" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">preview</i></a>
              <a :href="'<?= base_url(); ?>Admin/Information/edit/' + information['Id']" class="btn btn-xs btn-warning btn-custom" data-original-title="Chỉnh sửa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">mode_edit</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<v-model :is-active.sync="isPreview" size="lg">
  <div class="modal-body">
    <div v-if="previewData">
      <div style="overflow: auto;">
        <p v-html="previewData['Content'] ? previewData['Content'] : ''"></p>
      </div>
    </div>
  </div>
</v-model>