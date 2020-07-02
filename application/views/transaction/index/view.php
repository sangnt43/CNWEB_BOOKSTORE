<div class="modal-body row pb-0">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                Thông tin khách hàng
            </div>
            <div class="card-body">
                <div class="card-text d-flex mb-1">
                    <i class="fa fa-user mr-4" style="padding-top: 3px;" aria-hidden="true"></i>
                    <p>{{order['CustomerInfo_FullName']}}</p>
                </div>
                <div class="card-text d-flex mb-1">
                    <i class="fa fa-envelope mr-4" style="padding-top: 3px;" aria-hidden="true"></i>
                    <p>{{order['CustomerInfo_Email']}}</p>
                </div>
                <div class="card-text d-flex">
                    <i class="fa fa-phone mr-4" style="padding-top: 3px;" aria-hidden="true"></i>
                    <p>{{order['CustomerInfo_Phone']}}</p>
                </div>
                <div class="card-text d-flex">
                    <i class="fa fa-map-marker mr-4" style="padding-top: 3px;" aria-hidden="true"></i>
                    <p>{{order['CustomerInfo_Address']}}</p>
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
                    <i class="fa fa-truck mr-4" style="padding-top: 3px;" aria-hidden="true"></i>
                    <p v-currency>{{order['CustomerInfo_ShippingPrice']}}</p>
                </div>
                <hr>
                <h5 class="card-title mb-0">Tổng tiền: <strong v-currency>{{order['Total']}}</strong></h5>
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
                        <tr v-for="book in books">
                            <td><a :href="'<?= base_url() ?>'+book['Seo']" target="__blank">{{book['Name']}}</a></td>
                            <td>{{book['Quantity']}}</td>
                            <td v-currency>{{book['Price']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>