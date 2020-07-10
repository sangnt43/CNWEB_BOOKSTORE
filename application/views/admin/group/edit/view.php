<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Chỉnh sửa Group</h4>
        <hr>
        <div class="form-row">
            <div class='col-sm-12'>
                <div class='form-group'>
                    <label class="font-weight-bold">Tên Group <strong>*</strong></label>
                    <input v-model="group.Name" name="Name" class='form-control' placeholder='Tên group' required>
                    <i class='form-group__bar'></i>
                </div>
            </div>
            <div class='col-md-12 row'>
                <div class='form-group col-md-6'>
                    <label>Chức năng</label>
                    <input type="hidden" name="Roles" v-model="group.Roles">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" multiple class="form-control" ref="search" placeholder="Tìm kiếm">
                        <i class="form-group__bar"></i>
                    </div>
                </div>
                <div class="col-md-12">
                    <div ref="jstree" style="height:255px; overflow-y:auto"></div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
</form>