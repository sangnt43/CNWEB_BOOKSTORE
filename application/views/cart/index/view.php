<div class="static">
    <div class="container">
        <form v-if="cart && cart.length != 0" class="row" action="<?= base_url("checkout") ?>" method="POST">
            <input type="hidden" name="fromCart" value="cart">
            <div class="col-12 col-md-9 mb-5">
                <div v-for="item in cart">
                    <div class="row mb-3">
                        <input type="hidden" name="id[ ]" :value="item['id']">
                        <div class="col-2">
                            <img class="float-left" :src="item['avatar']" width="75px" alt="">
                        </div>
                        <div class="col-10">
                            <p class="m-0">{{item['name']}}</p>
                            <div class="d-flex">
                                <div class="input-group mb-2 mr-2" style="min-width: 125px;width: 25%">
                                    <div class="input-group-prepend" style="cursor: pointer" @click="onDown(item)">
                                        <div class="input-group-text">-</div>
                                    </div>
                                    <input type="text" @change="onChange(item)" name="quantity[ ]" v-model="item['quantity']" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                    <div class="input-group-append" style="cursor: pointer" @click="onUp(item)">
                                        <div class="input-group-text">+</div>
                                    </div>
                                </div>
                                <div style="margin-top: 0.4rem;"> x <span v-currency>{{item['price']}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-5">
                <h4 class='mb-4'>Tổng tiền: <span v-if="cart" v-currency v-html="getTotal"></span></h4>
                <button type="submit" class="btn btn-block">Thanh toán</button>
            </div>
        </form>
        <div v-else class="text-center">
            <h1>Hiện chưa có sản phẩm nào</h1>
        </div>
    </div>
</div>