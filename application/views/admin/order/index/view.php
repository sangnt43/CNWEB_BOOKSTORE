<header class="content__title">
  <h1>Quản lý đơn hàng {{getStatus}}</h1>
</header>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-2 col-4 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-info px-4" @click="changeStatus(null)">Tất cả</button>
      </div>
      <div class="col-lg-2 col-4 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-primary px-4" @click="changeStatus(0)">Mới tạo</button>
      </div>
      <div class="col-lg-2 col-4 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-warning text-black" @click="changeStatus(1)">Đã xác nhận</button>
      </div>
      <div class="col-lg-2 col-6 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-success  px-4" @click="changeStatus(2)">Đã giao</button>
      </div>
      <div class="col-lg-2 col-6 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-danger" @click="changeStatus(3)">Đơn bị hàng hủy</button>
      </div>
    </div>
    <div class="table-responsive px-1">
      <table id="__table__" class="table table-bordered text-center">
        <thead class="thead-default">
          <tr>
            <th></th>

            <th style="max-width: 15em">Người mua</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Tình trạng</th>
            <!-- <th>Thanh toán</th> -->
            <th style="min-width: 150px">Tác vụ</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


<div class="modal fade" ref="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" v-if="previewData">
      <div class="modal-header">
        <h4 class="modal-title">Đơn hàng của {{previewData.fullname}}</h4>
      </div>
      <div class="modal-body row pb-0">
        <div class="col-12 col-lg-6">
          <div class="card">
            <div class="card-header bg-success text-white">
              Thông tin khách hàng
            </div>
            <div class="card-body">
              <div class="card-text d-flex mb-1">
                <i class="material-icons mr-2">person</i>
                <p class="mt-1">{{previewData.CustomerInfo_FullName}}</p>
              </div>
              <div class="card-text d-flex mb-1">
                <i class="material-icons mr-2">email</i>
                <p class="mt-1">{{previewData.CustomerInfo_Email}}</p>
              </div>
              <div class="card-text d-flex">
                <i class="material-icons mr-2">phone</i>
                <p class="mt-1">{{previewData.CustomerInfo_Phone}}</p>
              </div>
              <div class="card-text d-flex">
                <i class="material-icons mr-2">home</i>
                <p class="mt-1">{{previewData.CustomerInfo_Address}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">

          <div class="card">
            <div class="card-header bg-success text-white">
              Đơn hàng
            </div>
            <div class="card-body">
              <div class="card-text d-flex mb-1" title="Tiền ship">
                <i class="material-icons mr-2">local_shipping</i>
                <p class="mb-0 mt-1" v-currency>{{ previewData.CustomerInfo_ShippingPrice }}</p>
              </div>
              <div class="card-text d-flex" title="Tin nhắn">
                <i class="material-icons mr-2">message</i>
                <p class="mb-0">{{previewData.message? previewData.message : "Không có ghi chú"}}</p>
              </div>
              <hr>
              <h5 class="card-title mb-0">Tổng tiền: <strong v-currency>{{previewData.Total}}</strong></h5>
            </div>
          </div>

        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-success text-white">
              Sản phẩm được mua
            </div>
            <div class="card-body m-0">
              <table class="table table-bordered mb-0">
                <thead class="thead-light">
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Giá tiền</th>
                </thead>
                <tbody style="max-height: 250px; overflow-y: auto">
                  <tr v-for="product in previewData.books">
                    <td><a :href="'<?= base_url('') ?>/'+product.seo" target="__blank">{{product.Name}}</a></td>
                    <td>{{product.Quantity}}</td>
                    <td v-currency>{{product.Price * product.Quantity}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
