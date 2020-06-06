export default {
    data() {
        return {
            editing: false,
            endPoint: ""
        };
    },
    methods: {
        edit() {
            this.setEditCache();
            this.editing = true;
        },
        cancel() {
            this.restoreCachData();
            this.editing = false;
        },
        setEditCache() {},
        restoreCachData() {},
        update() {
            debugger;
            axios
                .put(this.getEndPoint(), this.bodyBinding())
                .then(result => {
                    this.$toast.success(
                        result.data.message,
                        "OK",
                        this.notificationSystem.options.success
                    );
                    this.body_html = result.data.body_html;
                    this.editing = false;
                })
                .catch(err => {
                    this.$toast.warning(
                        "Update Error!",
                        "OK",
                        this.notificationSystem.options.warning
                    );
                    this.cancel();
                });
        },
        bodyBinding() {},
        destroyExecution() {},
        destroy() {
            this.$toast.question("Are you sure about that?", "Hi", {
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: "once",
                id: "question",
                zindex: 999,
                title: "Hey",
                position: "center",
                buttons: [
                    [
                        "<button><b>YES</b></button>",
                        (instance, toast) => {
                            this.destroyExecution();
                            instance.hide(
                                { transitionOut: "fadeOut" },
                                toast,
                                "button"
                            );
                        },
                        true
                    ],
                    [
                        "<button>NO</button>",
                        function(instance, toast) {
                            instance.hide(
                                { transitionOut: "fadeOut" },
                                toast,
                                "button"
                            );
                        }
                    ]
                ]
            });
        },
        getEndPoint() {}
    }
};
