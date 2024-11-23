import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Menu from '../components/Menu.vue';
import CocktailDetail from '../components/Menu/CocktailDetail.vue';
import { KeepAlive } from 'vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Login',
            component: Login
        },
        {
            path: '/menu',
            name: 'Menu',
            component: Menu,
            meta: {
                KeepAlive: true
            },
        },
        {
            path: '/cocktail/:id',
            name: 'CocktailDetail',
            component: CocktailDetail
        }
    ]
})

export default router
