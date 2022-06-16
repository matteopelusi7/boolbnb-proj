import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter)

import NotFound from "../pages/404.vue";
import Apartments from "../pages/Apartments.index.vue";
import Apartment from "../pages/Apartment.show.vue";

const routes = [
    {
        path: "/",
        name: "apartments.index",
        component: Apartments,
        meta: {
            title: "Case vacanze e appartamenti in affitto - BoolBnB",
        },
    },
    {
        path: "/apartment/:slug",
        name: "apartment.show",
        component: Apartment,
        meta: {
            title: "Case vacanze e appartamenti in affitto - BoolBnB",
        },
    },
    {
        path: "/*",
        name: "not-found",
        component: NotFound,
        meta: {
            title: "Errore 404",
        },
    },
];

const router = new VueRouter ({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
});

export default router
