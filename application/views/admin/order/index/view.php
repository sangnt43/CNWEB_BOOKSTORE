<header class="content__title">
  <h1>Quản lý đơn hàng {{getStatus}}</h1>
</header>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-2 col-4 pb-1 text-center">
        <button class="btn border border-dark btn-block  btn-info px-4" @click="changeStatus(-1)">Tất cả</button>
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
            <th style="min-width: 150px">Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="orders.length > 0" v-for="(order,index) in orders" :key="index" :id="order['Id']">
            <td v-once>{{index + 1}}</td>
            <td>{{order['CustomerInfo_FullName']}}</td>
            <td>{{order['CustomerInfo_Email']}}</td>
            <td>{{order['CustomerInfo_Phone']}}</td>
            <td><button class="btn btn-block" :class="getColor(order)" @click="changeOrderStatus(order)">{{order['Status']}}</button></td>
            <td style="width: 15rem;">
              <a @click="preview(order)" href="#" class="btn btn-xs btn-success btn-custom" title="Chi tiết"><i class="material-icons">pageview</i></a>
              <a @click="onDelete(order)" href="#" class="btn btn-xs btn-danger btn-custom" title="Xóa"><i class="material-icons">delete</i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<v-model :is-active.sync="isPreview" size="lg">
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
                <tr v-for="product in previewData.books" :key="previewData.seo">
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
</v-model>

<v-model :is-active.sync="isChangeStatus" size="sm">
  <div class="modal-content" v-if="previewData">
    <div class="modal-body">
      <button v-for="status in orderStatuses" class="btn btn-block" 
      :class="getColor(status)" 
      @click="onChangeStatus(status)">
        {{status['Status']}}
      </button>
    </div>
  </div>
</v-model>