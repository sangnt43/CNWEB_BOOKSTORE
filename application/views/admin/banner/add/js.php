<script>
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
                bannerError: [],
                <?= $_vueData ?>
            }
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
                this.banner.image = e.target.files[0];
                this.$refs['preview'].setAttribute("src", file);
            },
            checkValidate() {
                this.bannerError = [];

                if (this.banner.Image == null) this.bannerError.push('image');
                if (this.banner.Title.trim() == '') this.bannerError.push('name');
                if (this.banner.Content == '') this.bannerError.push('description');

                return this.bannerError.length == 0;
            },
            sendData() {
                if (!this.checkValidate()) return;
                
                let form = new FormData();
                form.append("Title", this.banner.Title);
                form.append("Content", this.banner.Content);
                form.append("Image", this.banner.Image);
                form.append("Url", this.banner.Url);
                form.append("isActive", this.banner.isActive);

                fetch("<?= base_url() ?>Admin/banner/createBanner", {
                    method: "POST",
                    mode: "same-origin",
                    body: form
                }).then(b => b.json()).then(b => {
                    if (b.exitcode == 1) {
                        //success
                        swal({
                            title: "Thêm thành công",
                            type: "success",
                            timer: 500,
                            showConfirmButton: false
                        }, function() {
                            window.location.href = b.data.returnUrl
                        })
                    } else {
                        // error
                        swal({
                            title: "Không thể thêm được",
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
