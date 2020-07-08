<header class="content__title">
  <h1>Quản lý Book</h1>
  <div class="actions">
    <a href="<?= base_url(); ?>Admin/Book/add">
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
            <th>Số lược xem</th>
            <th>Số lược mua</th>
            <th style="width: 15rem;">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="books.length > 0" v-for="(book,index) in books" :key="index" :id="book['Id']">
            <td v-once>{{index + 1}}</td>
            <td class="text-left">{{book['Name']}}</td>
            <td>{{book['Count_View']}}</td>
            <td>{{book['Count_Buy']}}</td>
            <td style="width: 15rem;">
              <a :href="'<?= base_url(); ?>Admin/Book/edit/' + book['Id']" class="btn btn-xs btn-warning btn-custom" data-original-title="Chỉnh sửa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">mode_edit</i></a>
              <a @click="onDelete(book)" href="#" class="btn btn-xs btn-danger btn-custom" data-original-title="Xóa" data-placement="bottom" data-toggle="tooltip"><i class="material-icons">delete_forever</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>