<link rel="stylesheet" type="text/css" href="<?= base_url("public/libs/suggestags/amsify.suggestags.css") ?>">
<style media="screen">
    .my_resizeable_div input {
        width: calc(100% - var(--minus));
        border: none;
        border-bottom: 1px solid #eceff1
    }

    @media only screen and (max-width: 430px) {
        .my_resizeable_div input {
            width: 100%;
        }
    }
</style>

<script src="<?= base_url() ?>public/libs/suggestags/jquery.amsify.suggestags.js"></script>

<script>
    var vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                bookCategory: {
                    name: '',
                    seo: ''
                },
                _bookCategory: null,
                title: '',
                bookCategoryError: [],
                ckeditor: null,
                categoryList: null,
                <?= $_vueData ?>
            }
        },
        created() {
            fetch("<?= base_url() ?>Admin/bookCategory/getById/<?= $id ?>").then(b => b.json()).then(b => {
                this.bookCategory = b.data;
                this._bookCategory = JSON.parse(JSON.stringify(b.data));

                this.title = b.data.title;
            });
        },
        mounted() {
            this.$nextTick(() => {
                $("form").bind("keypress", e => (e.keyCode != 13));

                let dockWidth = document.querySelector('.my_resizeable_div strong').offsetWidth + 15;
                document.querySelector('.my_resizeable_div input').style.setProperty('--minus', dockWidth + "px");
            })
            <?= $_vueMounted ?>
        },
        watch: {
            'bookCategory.name'(value) {
                this.bookCategory.seo = this.makeUrl(this.bookCategory.name);
            }
        },
        methods: {
            checkValidate() {
                this.bookCategoryError = [];

                if (this.bookCategory.name.trim() == '') this.bookCategoryError.push('title');
                if (this.bookCategory.seo == '') this.bookCategoryError.push('seo');

                return this.bookCategoryError.length == 0;
            },
            sendData() {
                if (!this.checkValidate()) return;

                let form = new FormData();
                if (this._bookCategory.name != this.bookCategory.name)
                    form.append("name", this.bookCategory.name);
                if (this._bookCategory.seo != this.bookCategory.seo)
                    form.append("seo", this.bookCategory.seo);

                fetch("<?= base_url() ?>Admin/bookCategory/updateBookCategory/<?= $id ?>", {
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
                            title: "Không thể cập nhật được",
                            type: "error",
                            timer: 500
                        })
                    }
                });
            },
            isError(e) {
                return this.bookCategoryError.length != 0 && this.bookCategoryError.indexOf(e) != -1
            },
            makeUrl(title) {
                return title.toLowerCase().trim().replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a').replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o').replace(/[éèẻẽẹêếềểễệ]/g, 'e').replace(/[íìỉĩị]/g, 'i').replace(/[úùủũụưứừửữự]/g, 'u').replace(/[ýỳỷỹỵ]/g, 'y').replace(/[đ]/g, 'd').replace(/[^a-z0-9- ]/g, '').replace(/[ ]/g, '-').replace(/[--]+/g, '-');
            }
            <?= $_vueMethods ?>
        },
    })
</script>