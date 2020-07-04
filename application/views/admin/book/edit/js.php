<link rel="stylesheet" href="<?= base_url() ?>public/libs/flatpickr/flatpickr.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?= base_url("public/libs/suggestags/amsify.suggestags.css") ?>">
<script src="<?= base_url() ?>public/libs/ckeditor/ckeditor.js"></script>

<script src="<?= base_url() ?>public/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url() ?>public/libs/suggestags/jquery.amsify.suggestags.js"></script>
<script src="<?= base_url() ?>public/ckfinder/ckfinder.js"></script>

<script>
    function popupWindowOptions() {
        return [
            'location=no',
            'menubar=no',
            'toolbar=no',
            'dependent=yes',
            'minimizable=no',
            'modal=yes',
            'alwaysRaised=yes',
            'resizable=yes',
            'scrollbars=yes',
            'width=800',
            'height=600'
        ].join(",")
    }
    var vm = new Vue({
        el: '#main-wrapper',
        data() {
            return {
                book: {
                    name: '',
                    description: '',
                    avatar: null,
                    imageList: [],
                    bookCategory: '',
                    price: 0,
                    quantity: 0,
                    tag: [],
                    seo: '',
                    sortOrder: 1,
                    isActive: false
                },
                _book: null,
                title: '',
                bookError: [],
                editor: null,
                categoryList: null,
            }
        },
        created() {
            window.CKFinder = {
                _popupOptions: {
                    'popup-config': { // Config ID for first popup
                        chooseFiles: true,
                        onInit: (finder) => {
                            finder.on('files:choose', (evt) => {
                                var file = evt.data.files.models;
                                file.forEach(x => {
                                    let url = x.changed.url;
                                    let raw = url.substr("<?= strlen(base_url()) ?>");
                                    this.book.imageList.push(raw);
                                })
                            });
                        }
                    }
                }
            }
            fetch("<?= base_url() ?>Admin/Book/getById/<?= $id ?>").then(b => b.json()).then(b => {
                this.book = b.data;
                this._book = JSON.parse(JSON.stringify(b.data));

                this.title = b.data.name;

                this.$refs['preview'].setAttribute("src", this.book.Avatar);

                this.book.avatar = "";
                this.book.isActive = this.book.isActive == 1;

                this.$nextTick(() => {
                    this.editor = CKEDITOR.replace('ckeditor');
                    this.editor.setData(this.book.description);
                })
            });
        },
        mounted() {

            fetch("<?= base_url() ?>Admin/BookCategory/getAllCategory")
                .then(result => result.json()).then(data => this.categoryList = data)

            this.$nextTick(() => {
                $("form").bind("keypress", e => (e.keyCode != 13));

                let dockWidth = document.querySelector('.my_resizeable_div strong').offsetWidth + 20;
                document.querySelector('.my_resizeable_div input').style.setProperty('--minus', dockWidth + "px");
            })
        },
        watch: {
            'book.name'(value) {
                if (!this.categoryList || this.categoryList.length == 0 || this.book.bookCategory == '') return;

                let category = this.categoryList.find(x => x.id == this.book.bookCategory);
                this.book.seo = `${category.seo}/${this.makeUrl(value)}`;
            },
            'book.bookCategory'(value) {
                if (!this.categoryList || this.categoryList.length == 0 || this.book.name == "") return;
                let category = this.categoryList.find(x => x.id == value);
                this.book.seo = `${category.seo}/${this.makeUrl(this.book.name)}`;
            }
        },
        methods: {
            preview(e) {
                let file = URL.createObjectURL(e.target.files[0]);
                if (e.target.files[0].size / (1024 * 1024) > 10) {
                    swal("Fail!", "Your picture is too large!", "error");
                    return;
                }
                this.book.avatar = e.target.files[0];
                this.$refs['preview'].setAttribute("src", file);
            },
            checkValidate() {
                this.bookError = [];

                if (this.book.Name.trim() == "") this.bookError.push("name");
                this.book.Description = this.editor.getData();
                // if(this.book.description.trim() == "") this.bookError.push("description");
                if (this.book.Avatar == null) this.bookError.push("avatar");
                if (this.book.BookCategory == "") this.bookError.push("bookCategory");
                if (this.book.Price == "" || this.book.Price < 0) this.bookError.push("price");
                if (this.book.Quantity == "" || this.book.Quantity < 0) this.bookError.push("quantity");
                if (this.book.Seo.trim() == "") this.bookError.push("seo");

                return this.bookError.length == 0;
            },
            sendData() {
                if (!this.checkValidate()) return;

                let form = new FormData();
                if (this._book.Name != this.book.Name)
                    form.append("Name", this.book.Name);
                if (this._book.Description != this.book.Description)
                    form.append("Description", this.book.Description);
                if (this.book.Avatar != null && this.book.Avatar != "")
                    form.append("Avatar", this.book.Avatar);
                if (this._book.BookCategory != this.book.BookCategory)
                    form.append("BookCategory", this.book.BookCategory);
                if (this._book.Images != this.book.Images.join(","))
                    form.append("Images", this.book.Images.join(","));
                if (this._book.Price != this.book.Price)
                    form.append("Price", this.book.Price);
                if (this._book.Quantity != this.book.Quantity)
                    form.append("Quantity", this.book.Quantity);
                if (this._book.Seo != this.book.Seo)
                    form.append("Seo", this.book.Seo);
                form.append("isActive", this.book.isActive)

                fetch("<?= base_url() ?>Admin/Book/updateBook/<?= $id ?>", {
                    method: "POST",
                    mode: "same-origin",
                    body: form
                }).then(b => b.json()).then(b => {
                    if (b.exitcode == 1) {
                        swal({
                            title: "Cập nhật thành công",
                            type: "success",
                            timer: 500,
                            showConfirmButton: false
                        }, function() {
                            window.location.href = b.data.returnUrl
                        })
                    } else {
                        swal({
                            title: b.message,
                            type: "error",
                            timer: 500
                        })
                    }
                });
            },
            isError(e) {
                return this.bookError.length != 0 && this.bookError.indexOf(e) != -1
            },
            makeUrl(title) {
                return title.toLowerCase().trim().replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a').replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o').replace(/[éèẻẽẹêếềểễệ]/g, 'e').replace(/[íìỉĩị]/g, 'i').replace(/[úùủũụưứừửữự]/g, 'u').replace(/[ýỳỷỹỵ]/g, 'y').replace(/[đ]/g, 'd').replace(/[^a-z0-9- ]/g, '').replace(/[ ]/g, '-').replace(/[--]+/g, '-');
            },
            correctUrl(image) {
                return "<?= base_url() ?>" + image;
            },
            remove_image(image) {
                this.book.imageList.splice(this.book.imageList.indexOf(image), 1);
            },
            open_popup() {
                window.open('<?= base_url() ?>ckfinder/ckfinder.html?type=Images&popup=1&configId=popup-config', 'CKFINDER', popupWindowOptions());
            }
        },
    })
</script>