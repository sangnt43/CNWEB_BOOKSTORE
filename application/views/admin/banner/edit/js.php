<script>
    const offset = new Date().getTimezoneOffset() * 1000 * 60
    const getLocalDate = value => {
        const offsetDate = new Date(value).valueOf() - offset
        const date = new Date(offsetDate).toISOString()
        return date.substring(0, 16)
    }
    var vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                banner: {
                    Title: '',
                    Content: '',
                    Image: null,
                    Url: '',
                    isAcive: false,
                },
                _banner: null,
                bannerError: [],
                <?= $_vueData ?>
            }
        },
        created() {
            fetch("<?= base_url() ?>Admin/banner/getById/<?= $id ?>").then(b => b.json()).then(b => {
                this.banner = b.data;
                this._banner = JSON.parse(JSON.stringify(b.data));
                this.$refs['preview'].setAttribute("src", `<?= base_url() ?>${this.banner.image}`);
                this.banner.Image = "";
                this.banner.isActive = this.banner.isActive == 1;
            });
        },
        mounted() {
            this.$nextTick(() => {
                $("form").bind("keypress", e => (e.keyCode != 13));
            })
            <?= $_vueMounted ?>
        },
        methods: {
            preview(e) {
                let file = URL.createObjectURL(e.target.files[0]);

                if (e.target.files[0].size / (1024 * 1024) > 10) {
                    swal("Fail!", "Your picture is too large!", "error");
                    return;
                }
                this.banner.Image = e.target.files[0];
                this.$refs['preview'].setAttribute("src", file);
            },
            checkValidate() {
                this.bannerError = [];

                if (this.banner.Title.trim() == '') this.bannerError.push('name');
                if (this.banner.Content == '') this.bannerError.push('description');

                return this.bannerError.length == 0;
            },
            sendData() {
                if (!this.checkValidate()) return;
                //
                // sendform + to banner/index;
                let form = new FormData();
                if (this._banner.Title != this.banner.Title)
                    form.append("Title", this.banner.Title);
                if (this._banner.Content != this.banner.Content)
                    form.append("Content", this.banner.Content);
                if (this.banner.Image != null && this.banner.Image != '')
                    form.append("Image", this.banner.Image);
                if (this._banner.Url != this.banner.Url)
                    form.append("Url", this.banner.Url);

                form.append("isActive", this.banner.isActive);
                fetch("<?= base_url() ?>Admin/banner/updateBanner/<?= $id ?>", {
                    method: "POST",
                    mode: "same-origin",
                    body: form
                }).then(b => b.json()).then(b => {
                    if (b.exitcode == 1) {
                        //success
                        swal({
                            title: "Cập nhật thành công",
                            type: "success",
                            timer: 500,
                            showConfirmButton: false
                        }, function() {
                            window.location.href = b.data.returnUrl
                        })
                    } else {
                        // error
                        swal({
                            title: "Không thể cập nhật",
                            type: "error",
                            timer: 500
                        })
                    }
                });
            },
            isError(e) {
                return this.bannerError.length != 0 && this.bannerError.indexOf(e) != -1
            },
            makeUrl(title) {
                return title.toLowerCase().trim().replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a').replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o').replace(/[éèẻẽẹêếềểễệ]/g, 'e').replace(/[íìỉĩị]/g, 'i').replace(/[úùủũụưứừửữự]/g, 'u').replace(/[ýỳỷỹỵ]/g, 'y').replace(/[đ]/g, 'd').replace(/[^a-z0-9- ]/g, '').replace(/[ ]/g, '-').replace(/[--]+/g, '-');
            }
            <?= $_vueMethods ?>
        },
    })
</script>