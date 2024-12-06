import { computed } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useStore } from 'vuex';
import Login from '../views/Login.vue';
import Dashboard from '../views/Dashboard.vue';
import Account from '../views/Account.vue';
import SignIn from '../views/SignIn.vue';
import CocktailDetail from '../components/Menu/CocktailDetail.vue';
import AccountSetting from '../views/AccountSetting.vue';
import History from '../views/History.vue';
import Favorite from '../views/Favorite.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/signin',
            name: 'siginin',
            component: SignIn,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {requireAuth: true}
        },
        {
            path: '/account',
            name: 'account',
            component: Account,
            meta: {requireAuth: true}
        },
        {
            path: '/cocktail/:id',
            name: 'CocktailDetail',
            component: CocktailDetail,
            meta: {requireAuth: true}
        },
        {
            path: '/setting',
            name: 'AccountSetting',
            component: AccountSetting,
            meta: {requireAuth: true}
        },
        {
            path: '/history',
            name: 'History',
            component: History,
            meta: {requireAuth: true}
        },
        {
            path: '/favorite',
            name: 'Favorite',
            component: Favorite,
            meta: {requireAuth: true}
        },
    ]
});

router.beforeEach((to, from, next) => {
    const isAuthenticated: string | null  = localStorage.getItem('login_status');
    if (to.matched.some(record => record.meta.requireAuth)) {
        if (!isAuthenticated) {
            next({ path: '/login' });
        } else {
            next();
        }
    }
    else {
        next();
    }
});

export default router
