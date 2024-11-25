import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Dashboard from '../components/Dashboard.vue';
import Account from '../components/Account.vue';
import SignIn from '../components/SignIn.vue';
import CocktailDetail from '../components/Menu/CocktailDetail.vue';
import History from '../components/History.vue';
import FavCocktails from '../components/FavCocktails.vue';

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
