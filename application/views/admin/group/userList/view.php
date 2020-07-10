<form class="card" @submit="onSubmit" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <h4 class="card-title">Cập nhật thành viên group : <?= $group['Name'] ?></h4>
        <hr>
        <div class="form-row">
            <div class="container">
                <input type="hidden" name="userList" v-model="userList">
                <input type="hidden" name="removeList" v-model="removeList">
                <div id="listbox" class="form-group col-md-12">
                    <v-listbox class="bootstrap-duallistbox-container" v-model="userInGroup" style="width:100%">
                        <option v-for="user in users" :value="user['Id']">{{user['FullName']}}</option>
                    </v-listbox>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-sm bg-red text-white waves-effect"><strong>Cập nhật</strong></button>
</form>