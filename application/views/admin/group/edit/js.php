
<link rel="stylesheet" href="<?= base_url() ?>public/libs/jstree/themes/default/style.min.css">
<script src="<?= base_url() ?>public/libs/jstree/jstree.min.js"></script>
<script>
    vue_js = {
        el: "#main-wrapper",
        data: {
            group: {
                Name: "",
                Roles: ""
            },
            RoleList: null
        },
        created() {
            this.group = <?= json_encode($group) ?>;
            this.RoleList = <?= json_encode($controllerList) ?>;
        },
        mounted() {
            <?php if (isset($error)) : ?>
                <?php if (isset($error['upload'])) : ?>
                    showNoti("<?= $error['upload'] ?>", "Không thể thêm");
                <?php elseif (isset($error['data'])) : ?>
                    showNoti("Dự liệu không phù hợp", "Không thể thêm");

                    this.group = <?= json_encode($error['data']) ?>
                <?php endif; ?>
            <?php endif; ?>

            this.jstree = $(this.$refs['jstree']).jstree({
                'plugins': ['search', 'checkbox', 'wholerow'],
                'core': {
                    'data': this.RoleList,
                    'animation': true,
                    'expand_selected_onload': false,
                    'themes': {
                        'icons': true,
                        'jstree-wholerow': false
                    }
                },
                'search': {
                    'show_only_matches': true,
                    'show_only_matches_children': true
                }
            })

            this.jstree = this.jstree.jstree();

            $(this.$refs['search']).on("keyup change", e => {
                this.jstree.search(e.target.value);
            })
        },
        methods: {
            onSubmit() {
                let isError = false;

                this.group.Roles = this.getJsonPermisstion();

                if (isError) event.preventDefault();
            },
            getJsonPermisstion() {
                let arr = {};
                this.jstree.get_selected().forEach(x => {
                    let tmp = x.split('/');
                    if (tmp.length == 2 && tmp[1] == "index") {
                        if (!arr[tmp[0]]) arr[tmp[0]] = [];
                        if (arr[tmp[0]].indexOf(tmp[1]) == -1)
                            arr[tmp[0]].push(tmp[1]);
                    } else if (tmp.length == 2) {
                        if (!arr[tmp[0]]) arr[tmp[0]] = [];
                        if (arr[tmp[0]].indexOf(tmp[1]) == -1)
                            arr[tmp[0]].push(tmp[1]);
                    }
                })
                return JSON.stringify(arr)
            }
        }
    }
</script>