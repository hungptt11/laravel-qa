<template></template>

<script>
export default {
  props: {
    answer: Object
  },
  data() {
    return {
      editing: false,
      body: this.answer.body,
      bodyHtml: this.answer.body_html,
      id: this.answer.id,
      questionId: this.answer.question_id,
      beforeEditCache: null,
      notificationSystem: {
        options: {
          show: {
            theme: "dark",
            icon: "icon-person",
            position: "topCenter",
            progressBarColor: "rgb(0, 255, 184)",
            buttons: [
              [
                "<button>Ok</button>",
                function(instance, toast) {
                  alert("Hello world!");
                },
                true
              ],
              [
                "<button>Close</button>",
                function(instance, toast) {
                  instance.hide(
                    {
                      transitionOut: "fadeOutUp",
                      onClosing: function(instance, toast, closedBy) {
                        console.info("closedBy: " + closedBy);
                      }
                    },
                    toast,
                    "buttonName"
                  );
                }
              ]
            ],
            onOpening: function(instance, toast) {
              console.info("callback abriu!");
            },
            onClosing: function(instance, toast, closedBy) {
              console.info("closedBy: " + closedBy);
            }
          },
          ballon: {
            balloon: true,
            position: "bottomCenter"
          },
          info: {
            position: "bottomLeft"
          },
          success: {
            position: "bottomRight"
          },
          warning: {
            position: "topLeft"
          },
          error: {
            position: "topRight"
          },
          question: {
            timeout: 20000,
            close: false,
            overlay: true,
            toastOnce: true,
            id: "question",
            zindex: 999,
            position: "center",
            buttons: [
              [
                "<button><b>YES</b></button>",
                function(instance, toast) {
                  instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                },
                true
              ],
              [
                "<button>NO</button>",
                function(instance, toast) {
                  instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                }
              ]
            ],
            onClosing: function(instance, toast, closedBy) {
              console.info("Closing | closedBy: " + closedBy);
            },
            onClosed: function(instance, toast, closedBy) {
              console.info("Closed | closedBy: " + closedBy);
            }
          }
        }
      }
    };
  },
  methods: {
    edit() {
      this.beforeEditCache = this.body;
      this.editing = true;
    },
    cancel() {
      this.body = this.beforeEditCache;
      this.editing = false;
    },
    update() {
      axios
        .patch(this.endpoint, {
          body: this.body
        })
        .then(res => {
          //console.log(res);
          this.editing = false;
          this.bodyHtml = res.data.body_html;
          this.$toast.success(
            res.data.message,
            "OK",
            this.notificationSystem.options.success
          );
        })
        .catch(err => {
          console.log(err);
          this.editing = false;
        });
    },
    destroy() {
      if (
        this.$toast.question(
          "Are you sure about that?",
          "Hi",
          this.notificationSystem.options.question
        )
      ) {
        axios.delete(this.endpoint).then(res => {
          $(this.$el).fadeOut(500, () => {
            this.$toast.success(
              res.data.message,
              "OK",
              this.notificationSystem.options.success
            );
          });
        });
      }
    }
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    },

    endpoint() {
      return `/question/${this.questionId}/answer/${this.id}`;
    }
  }
};
</script>

<style>
</style>
