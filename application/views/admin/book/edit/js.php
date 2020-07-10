<link rel="stylesheet" href="<?= base_url() ?>public/css/custom.css">
<script src="<?= base_url() ?>public/libs/ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>public/vue/v-select.js"></script>

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
    vue_js = {
        el: '#main-wrapper',
        data() {
            return {
                book: {
                    Name: '',
                    Description: '',
                    Images: [],
                    BookCategoryId: '',
                    Auth: '',
                    Publisher: '',
                    Price: 1,
                    Discount: 0,
                    Seo: '',
                },
                editor: null,
                categoryList: null,
            }
        },
        created() {
            this.book = <?= json_encode($book) ?>
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
                                    this.book.Images.push(raw);
                                })
                            });
                        }
                    }
                }
            }

            this.editor = CKEDITOR.replace('ckeditor');

            fetch("<?= base_url() ?>Admin/BookCategory/getAllCategory")
                .then(result => result.json()).then(data => this.categoryList = data)

            this.$nextTick(() => {
                this.editor.setData(this.book.Description)
            })
        },
        watch: {
            'book.Name'(value) {
                if (!this.categoryList || this.categoryList.length == 0 || this.book.BookCategoryId == '') return;
                let category = this.categoryList.find(x => x.id == this.book.BookCategoryId);
                this.book.Seo = `${category.seo}/${this.makeUrl(value)}`;
            },
            'book.BookCategoryId'(value) {
                if (!this.categoryList || this.categoryList.length == 0 || this.book.Name == "") return;
                let category = this.categoryList.find(x => x.id == value);
                this.book.Seo = `${category.seo}/${this.makeUrl(this.book.Name)}`;
            }
        },
        methods: {
            preview() {
                var file = event.target.files[0];
                if (file.size / (1024 * 1024) > 5)
                    showNoti("Kích thước quá to", "Kích thước quá to", "error");
                else
                    this.$refs['preview'].src = URL.createObjectURL(file);
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
            },
            onSubmit() {
                let _auth = document.querySelector(`#authes option[value='${this.book.Auth}']`)
                if (_auth)
                    document.querySelector("input[name='AuthId']").value = _auth.dataset['id'];
                let _publisher = document.querySelector(`#publishers option[value='${this.book.Publisher}']`);
                if (_publisher)
                    document.querySelector("input[name='PublisherId']").value = _publisher.dataset['id'];

            }
        },
    }
</script>