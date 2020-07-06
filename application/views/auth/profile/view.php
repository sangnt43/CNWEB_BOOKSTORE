<section class="static about-sec">
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= isCurrentTab("profile") ? "active" : "" ?>" id="profile-tab" data-toggle="tab" data-href="<?= base_url("profile") ?>" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isCurrentTab("transaction") ? "active" : ""  ?>" id="transaction-tab" data-toggle="tab" data-href="<?= base_url("transaction") ?>" href="#transaction" role="tab" aria-controls="transaction" aria-selected="false">Giao dịch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isCurrentTab("wich") ? "active" : ""  ?>" id="wich-tab" data-toggle="tab" data-href="<?= base_url("wich") ?>" href="#wich" role="tab" aria-controls="wich" aria-selected="false">Yêu Thích</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?= isCurrentTab("profile") ? "show active" : "" ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="mt-4">
                    <div class="form-group">
                        <label for="">Tên tài khoản</label>
                        <div class="input-group">
                            <input type="text" v-model="user['Username']" disabled class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text" @click="isActive = true" style="background: skyblue; cursor: pointer">
                                    Đổi mật khẩu
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" v-model="user['FullName']" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" v-model="user['Phone']" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" v-model="user['Email']" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <textarea class="form-control" rows="2" v-model="user['Address']"></textarea>
                    </div>
                    <div v-if="isChange">
                        <button @click="tryChangProfile" class="btn btn-block btn-md p-2">Lưu</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?= isCurrentTab("transaction") ? "show active" : ""  ?>" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                <div v-if="transactions && transactions.length != 0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="">Order Id</th>
                                <th scope="">Address</th>
                                <th scope="">Price</th>
                                <th scope="">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in transactions">
                                <td><a href="#" @click.prevent="onTransactionClick(item['Id'])">{{item['Id']}}</a></td>
                                <td>{{item['CustomerInfo_Address']}}</td>
                                <td>{{item['CustomerInfo_ShippingPrice']}}</td>
                                <td>{{item['Status']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="mt-5">
                    <h1 class="text-center">Hiện chưa có giao dịch nào</h1>
                </div>
            </div>
            <div class="tab-pane fade <?= isCurrentTab("wich") ? "show active" : ""  ?>" id="wich" role="tabpanel" aria-labelledby="wich-tab">
                <div class="static about-sec">
                    <div class="recent-book-sec">
                        <div class="row mt-5">
                            <div class="col-md-3" v-for="(item,index) in wich" :key="index">
                                <shop-item :item="item"></shop-item>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<v-model :is-active.sync="isActive">
    <div class="modal-header">
        <h5 class="modal-title">Thay đổi mật khảu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="">Mật khẩu cũ</label>
            <input type="password" v-model="password.old" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Mật khẩu mới</label>
            <input type="password" v-model="password.new" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" v-model="password.cnew" class="form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" :disabled="!canChangePassword" class="btn green-btn" @click="tryChangePassword">Cập nhật</button>
        <button type="button" class="btn black" data-dismiss="modal">Close</button>
    </div>
</v-model>

<v-model :is-active.sync="showShippingStatus" size="lg">
    <div class="modal-body">
        <iframe :src="shippingSrc" frameborder="1" width="100%" height="450"></iframe>
    </div>
</v-model>