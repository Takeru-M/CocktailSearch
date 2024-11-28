import { mount } from '@vue/test-utils';
import { describe, it, expect, vi } from 'vitest';
import Header from '../resources/js/components/Common/Header.vue';
import { createStore } from 'vuex';
import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';

const store = createStore({
    actions: {
        setLogoutStatus: vi.fn()
    }
})

// const router = createRouter({
//     history: createWebHistory(),
//     routes: [
//         { path: '/dashboard', name: 'Dashboard' },
//         { path: '/account', name: 'Account' },
//         { path: '/login', name: 'Login' }
//     ]
// });
