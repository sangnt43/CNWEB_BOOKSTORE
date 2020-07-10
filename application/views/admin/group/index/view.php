<header class="content__title">
  <h1>Quản lý Group</h1>
  <div class="actions">
    <a href="<?= base_url(); ?>Admin/Group/add">
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
            <th style="width: 15rem;">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="groups.length > 0" v-for="(group,index) in groups" :key="index" :id="group['Id']">
            <td v-once>{{index + 1}}</td>
            <td>{{group['Name']}}</td>
            <td style="width: 15rem;">
              <a :href="'<?= base_url(); ?>Admin/Group/userList/' + group['Id']" class="btn btn-xs btn-info btn-custom" data-original-title="Danh sách quản trị" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">group_add</i></a>
              <a :href="'<?= base_url(); ?>Admin/Group/edit/' + group['Id']" class="btn btn-xs btn-warning btn-custom" data-original-title="Chỉnh sửa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">mode_edit</i></a>
              <a @click="onDelete(group)" href="#" class="btn btn-xs btn-danger btn-custom" data-original-title="Xóa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">delete_forever</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>