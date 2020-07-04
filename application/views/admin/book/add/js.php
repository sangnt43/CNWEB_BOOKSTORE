<link rel="stylesheet" href="<?= base_url() ?>public/libs/flatpickr/flatpickr.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<link rel="stylesheet" type="text/css" href="<?= base_url("public/libs/suggestags/amsify.suggestags.css") ?>">
<script src="<?= base_url() ?>public/libs/ckeditor/ckeditor.js"></script>

<script src="<?= base_url() ?>public/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url() ?>public/libs/suggestags/jquery.amsify.suggestags.js"></script>
<script src="<?= base_url() ?>public/ckfinder/ckfinder.js"></script>

<style media="screen">

</style>

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
                    sortOrder: 1
                },
                bookError: [],
                editor: null,
                categoryList: null,
            }
        },
        mounted() {
            window.CKFinder = {
                _popupOptions: {
                    'popup-config': { // Config ID for first popup
                        chooseFiles: true,
                        onInit: (finder) => {
                            finder.on('files:choose', (evt) => {
                                var file = evt.data.files.models;
                                file.forEach(x => {
                                    let url = x.changed.url;
                                    let raw = url.substr("<?= base_url() ?>".length);
                                    this.book.imageList.push(raw);
                                })
                            });
                        }
                    }
                }
            }

            this.editor = CKEDITOR.replace('ckeditor');

            $(this.$refs['tag']).amsifySuggestags({
                type: 'amsify',
                afterAdd: (value) => this.book.tag.push(value),
                afterRemove: value => this.book.tag.splice(this.book.tag.indexOf(value), 1),
            });

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
                console.log(value);
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

                if (this.book.name.trim() == "") this.bookError.push("name");
                this.book.description = this.editor.getData();
                if (this.book.description.trim() == "") this.bookError.push("description");
                if (this.book.tag.length == 0) this.bookError.push("tag");
                if (this.book.avatar == null) this.bookError.push("avatar");
                if (this.book.bookCategory == "") this.bookError.push("bookCategory");
                if (this.book.price == "" || this.book.price < 0) this.bookError.push("price");
                if (this.book.quantity == "" || this.book.quantity < 0) this.bookError.push("quantity");
                if (this.book.seo.trim() == "") this.bookError.push("seo");
                if (this.book.sortOrder == "" || this.book.sortOrder < 0) this.bookError.push("sortOrder");

                return this.bookError.length == 0;
            },
            sendData() {
                if (!this.checkValidate()) return;

                let form = new FormData();
                form.append("name", this.book.name);
                form.append("description", this.book.description);
                form.append("avatar", this.book.avatar);
                form.append("bookCategory", this.book.bookCategory);
                form.append("imageList", this.book.imageList.join(","));
                form.append("tag", this.book.tag.join(","));
                form.append("price", this.book.price);
                form.append("quantity", this.book.quantity);
                form.append("seo", this.book.seo);
                form.append("sortOrder", this.book.sortOrder);

                fetch("<?= base_url() ?>Admin/book/createBook", {
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
                return "<?= base_url("public/") ?>" + image;
            },
            remove_image(image) {
                this.book.imageList.splice(this.book.imageList.indexOf(image), 1);
            },
            open_popup() {
                window.open('<?= base_url() ?>public/ckfinder/ckfinder.html?type=Images&popup=1&configId=popup-config', 'CKFINDER', popupWindowOptions());
            }
        },
    })
</script>