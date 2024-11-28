import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Dashboard from '../views/Dashboard.vue';
import Account from '../views/Account.vue';
import SignIn from '../views/SignIn.vue';
import CocktailDetail from '../components/Menu/CocktailDetail.vue';
import AccountSetting from '../views/AccountSetting.vue';
import History from '../views/History.vue';
import FavCocktails from '../views/FavCocktails.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/signin',
            name: 'siginin',
            component: SignIn
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/account',
            name: 'account',
            component: Account
        },
        {
            path: '/cocktail/:id',
            name: 'CocktailDetail',
            component: CocktailDetail
        },
        {
            path: '/setting',
            name: 'AccountSetting',
            component: AccountSetting
        },
        {
            path: '/history',
            name: 'history',
            component: History
        },
        {
            path: '/fav',
            name: 'favCocktails',
            component: FavCocktails
        },
    ]
})

export default router
