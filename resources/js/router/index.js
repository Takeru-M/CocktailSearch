import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Menu from '../components/Menu.vue';
import CocktailDetail from '../components/Menu/CocktailDetail.vue';

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
            component: Menu
        },
        {
            path: '/cocktail/:id',
            name: 'CocktailDetail',
            component: CocktailDetail
        }
    ]
})

export default router
