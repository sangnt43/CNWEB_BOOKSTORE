<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            category: {
                Name: "",
                Parent: "",
                Seo: ""
            },
            categoryList: null
        },
        mounted() {
            <?php if (isset($error)) : ?>
                <?php if (isset($error['upload'])) : ?>
                    showNoti("<?= $error['upload'] ?>", "Không thể thêm");
                <?php elseif (isset($error['data'])) : ?>
                    showNoti("Dự liệu không phù hợp", "Không thể thêm");

                    this.banner = <?= json_encode($error['data']) ?>
                <?php endif; ?>
            <?php endif; ?>

            fetch("<?= base_url() ?>Admin/BookCategory/getAllCategory")
                .then(result => result.json()).then(data => this.categoryList = data)
        },
        watch: {
            "category.Name"(value) {
                this.category.Seo = this.makeUrl(value);
            }
        },
        methods: {
            makeUrl(title) {
                return title.toLowerCase().trim().replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a').replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o').replace(/[éèẻẽẹêếềểễệ]/g, 'e').replace(/[íìỉĩị]/g, 'i').replace(/[úùủũụưứừửữự]/g, 'u').replace(/[ýỳỷỹỵ]/g, 'y').replace(/[đ]/g, 'd').replace(/[^a-z0-9- ]/g, '').replace(/[ ]/g, '-').replace(/[--]+/g, '-');
            }
        }
    }
</script>