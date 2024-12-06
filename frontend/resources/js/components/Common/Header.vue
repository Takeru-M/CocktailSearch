<template>
    <a-layout-header :style="{ position: 'fixed', zIndex: 1, width: '100%' }">
    <div class="logo">
        <RouterLink to="/dashboard">{{ t('header.header-logo') }}</RouterLink>
    </div>
    <a-menu
        class="nav-menu"
        theme="dark"
        mode="horizontal"
        :style="{ lineHeight: '64px' }"
    >
        <a-menu-item key="1">
            <RouterLink to="/account">{{ t('header.nav.nav1') }}</RouterLink>
        </a-menu-item>
        <a-menu-item key="2">
            <RouterLink to="/login" @click="logout">{{ t('header.nav.nav2') }}</RouterLink>
        </a-menu-item>
        <a-menu-item key="3">
            <a-dropdown>
                <a class="ant-dropdown-link" @click.prevent>
                {{ t('header.nav.nav3') }}
                <DownOutlined />
                </a>
                <template #overlay>
                <a-menu>
                    <a-menu-item @click="changeLanguage('en')">En</a-menu-item>
                    <a-menu-item @click="changeLanguage('ja')">Ja</a-menu-item>
                </a-menu>
                </template>
            </a-dropdown>
        </a-menu-item>
    </a-menu>
    </a-layout-header>
</template>

<script lang="ts">
    import { defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';
    import router from '@/router';
    import { AxiosError } from 'axios';
    import { State } from '@/types/stores/CommonStore';
    import { logoutAPI } from '@/utils/AuthAPI';

    export default defineComponent ({
    setup () {
        const { t, locale } = useI18n();
        const store = useStore<State>();

        const changeLanguage = (language: string): void => {
            locale.value = language;
            console.log('Language is changed');
        };

        const logout = async (): Promise<void> => {
            try {
                // const token: string | null = localStorage.getItem('auth_token');
                const response = await logoutAPI();
                localStorage.removeItem('auth_token');
                localStorage.removeItem('login_status');
                store.dispatch('setLogoutStatus');
                console.log('Logout successful:', response.message);
                router.push('/login');
            } catch (e) {
                if (e instanceof AxiosError && e.response) {
                    console.error('Logout failed:', e.response.data.message);
                } else if (e instanceof Error) {
                    console.error('An error occurred:', e.message);
                }
            }
        };

        return {
            t,
            store,
            changeLanguage,
            logout,
        };
    },
});
</script>

<style scoped>
.nav-menu {
    display: flex;
    justify-content: flex-end;
}
.logo {
    position: absolute;
    color: white;
}
.site-layout-content {
    min-height: 280px;
    padding: 24px;
    background: #fff;
}
#components-layout-demo-top .logo {
    float: left;
    width: 120px;
    height: 31px;
    margin: 16px 24px 16px 0;
    background: rgba(255, 255, 255, 0.3);
}
.ant-row-rtl #components-layout-demo-top .logo {
    float: right;
    margin: 16px 0 16px 24px;
}

[data-theme='dark'] .site-layout-content {
    background: #141414;
}
</style>