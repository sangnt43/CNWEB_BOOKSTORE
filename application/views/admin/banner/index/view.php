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
            <th></th>
            <th style="max-width: 15em">Tên</th>
            <th>Hiển thị</th>
            <th style="min-width: 110px">Tác vụ</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" ref="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" v-if="previewData">
      <div class="modal-header">
        <h5 class="modal-title">{{previewData.title}}</h5>
      </div>
      <div class="modal-body">
        <div class="avatar text-center">
          <img :src="previewData.image" width="256" heigh=144 alt="Không thể tải">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>