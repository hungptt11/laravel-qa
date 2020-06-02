/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueIziToast from "vue-izitoast";
import "izitoast/dist/css/iziToast.css";
Vue.use(VueIziToast);

import Authorazation from "./authorization/authorize";
Vue.use(Authorazation);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//import authorinfor from "./components/author.vue";
import AuthorInfo from "./components/author.vue";
import AnswerInfo from "./components/answer.vue";
import FavoritedInfo from "./components/favorite.vue";
import AcceptInfo from "./components/accept.vue";
import VoteInfo from "./components/vote.vue";

Vue.component("author-infor", AuthorInfo);
Vue.component("answer-infor", AnswerInfo);
Vue.component("favorite-infor", FavoritedInfo);
Vue.component("accept-infor", AcceptInfo);
Vue.component("vote-infor", VoteInfo);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    data: function() {
        return {
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
                                            onClosing: function(
                                                instance,
                                                toast,
                                                closedBy
                                            ) {
                                                console.info(
                                                    "closedBy: " + closedBy
                                                );
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
    }
});

const app = new Vue({
    el: "#app"
});
