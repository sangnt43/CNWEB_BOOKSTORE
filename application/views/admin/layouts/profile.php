<script>
    Vue.component("select2", {
        template: `
        <div> 
            <select :class="selectClass" :id="id" :disabled="disabled" :required="required" :multiple="multiple">
            </select>
        </div>
        `,
        data() {
            return {
                select2: null,
            };
        },
        model: {
            prop: 'value',
            event: 'change'
        },
        props: {
            id: {
                type: String
            },
            selectClass: {
                type: String,
            },
            options: {
                type: Array,
                default: () => []
            },
            disabled: {
                type: Boolean,
                default: false
            },
            multiple: {
                type: Boolean,
                default: false
            },
            required: {
                type: Boolean,
                default: false
            },
            settings: {
                type: Object,
                default: () => {}
            },
            value: null
        },
        watch: {
            options(val) {
                this.setOption(val);
            },
            value(val) {
                this.setValue(val);
            }
        },
        methods: {
            setOption(val = []) {
                this.select2.empty();
                this.select2.select2({
                    ...this.settings,
                    data: val
                });
                this.setValue(this.value);
            },
            setValue(val) {
                if (val instanceof Array)
                    this.select2.val([...val]);
                else this.select2.val([val]);
                this.select2.trigger('change');
            }
        },
        mounted() {
            this.select2 = $(this.$el)
                .find('select')
                .select2({
                    ...this.settings,
                    data: this.options
                })
                .on('select2:select select2:unselect', ev => {
                    this.$emit('change', this.select2.val());
                    this.$emit('select', ev['params']['data']);
                });
            this.setValue(this.value);
        },
        beforeDestroy() {
            this.select2.select2('destroy');
        }
    })
</script>
<div class="card">
    <div class="card-body">
        <button class="btn btn-primary text-white float-right mt-1" data-toggle="modal" data-target="#changePasswordModal"><i class="icon-key"></i> Đổi mật khẩu</button>
        <div id="changePasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Đổi mật khẩu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="resetPassword()">
                            <div class="form-group">
                                <label for="password">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" v-model="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu mới</label>
                                <input type="password" class="form-control" v-model="password1" id="password1">
                            </div>
                            <div class="form-group">
                                <label for="password">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" v-model="password2" id="password2">
                            </div>
                            <div class="text-center">
                                <button type="submit" :disabled="!isCorrectPassword" class="btn btn-primary">Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal form-material mt-5 row">
            <div class="form-group col-md-6">
                <label>Username</label>
                <div>
                    <input type="text" disabled class="form-control form-control-line" v-model="user.username">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>Ngày sinh</label>
                <div>
                    <input type="date" class="form-control form-control-line" v-model="user.birthday">
                </div>
            </div>
            <div class='form-group col-md-3'>
                <label>Giới tính</label>
                <div class="form-row pt-3 ml-1">
                    <label for="">Nam</label>
                    <div class="toggle-switch mx-3">
                        <input type="checkbox" v-model="user.gender" class="toggle-switch__checkbox">
                        <i class="toggle-switch__helper"></i>
                    </div>
                    <label for="">Nữ</label>
                </div>

                <i class='form-group__bar'></i>
            </div>
            <div class="form-group col-md-12">
                <label>Họ và tên</label>
                <div>
                    <input type="text" class="form-control form-control-line" v-model="user.fullname">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <div>
                    <input type="email" class="form-control form-control-line" v-model="user.email">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Điện thoại</label>
                <div>
                    <input type="tel" class="form-control form-control-line" v-model="user.phone">
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class='form-group'>
                    <label>Tỉnh/Thành phố<strong>*</strong></label>
                    <select2 v-model="user.idCity" :options="cityList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }"></select2>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class='form-group'>
                    <label>Quận/Huyện <strong>*</strong> </label>
                    <select2 v-model="user.idDistrict" :diabled="districtList.length == 0" :options="districtList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }"></select2>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class='form-group'>
                    <label>Phường/xã <strong>*</strong></label>
                    <select2 v-model="user.idWard" :diabled="wardList.length == 0" :options="wardList" :settings="{ placeholder: 'Chọn thể loại', width:'100%' }"></select2>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class='form-group'>
                    <label>Địa chỉ <strong>*</strong></label>
                    <input v-model="user.address" type=text class='form-control' min="1">
                    <i class='form-group__bar'></i>
                </div>
            </div>
        </form>
        <div class="form-group">
            <div class="col-sm-4 mx-auto">
                <button type="button" @click="sendData" class="btn btn-success btn-block ">Cập nhật hồ sơ</button>
            </div>
        </div>
    </div>
</div>
