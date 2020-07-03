<div class="static">
    <div class="container">
        <form class="row" action="<?= base_url("checkout") ?>">
            <div class="col-12 col-md-9 mb-5">
                <div v-for="item in cart">
                    <div>
                        <input type="hidden" name="id[ ]" :value="item['id']">
                        <img class="float-left" :src="item['avatar']" style="margin-right: 15px ;" width="75px" alt="">
                        <p class="m-0">{{item['name']}}</p>
                        <p class="m-0">
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
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <h4 class='mb-4'>Tổng tiền: <span v-if="cart" v-currency v-html="getTotal"></span></h4>
                <button type="submit" class="btn btn-block">Checkout</button>
            </div>
        </form>
    </div>
</div>