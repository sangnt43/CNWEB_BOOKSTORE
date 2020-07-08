<header class="content__title">
  <h1>Quản lý thể loại sách</h1>
  <div class="actions">
    <a href="<?= base_url(); ?>Admin/BookCategory/add">
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
            <th>Seo</th>
            <th style="width: 15rem;">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="categories.length > 0" v-for="(category,index) in categories" :key="index" :id="category['Id']">
            <td v-once>{{index + 1}}</td>
            <td class="text-left">{{category['Name']}}</td>
            <td>{{category['Seo']}}</td>
            <td style="width: 15rem;">
              <a :href="'<?= base_url(); ?>Admin/BookCategory/edit/' + category['Id']" class="btn btn-xs btn-warning btn-custom" data-original-title="Chỉnh sửa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">mode_edit</i></a>
              <a @click="onDelete(category)" href="#" class="btn btn-xs btn-danger btn-custom" data-original-title="Xóa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">delete_forever</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>