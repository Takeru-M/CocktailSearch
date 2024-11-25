<template>
    <a-layout-header :style="{ position: 'fixed', zIndex: 1, width: '100%' }">
    <!-- <div class="logo" /> -->
    <div class="logo">
        <RouterLink to="/dashboard">{{ t('header.header-logo') }}</RouterLink>
    </div>
    <a-menu
        class="nav-menu"
        v-model:selectedKeys="selectedKeys"
        theme="dark"
        mode="horizontal"
        :style="{ lineHeight: '64px' }"
    >
        <!-- <a-menu-item key="1">
            <RouterLink to="/menu">{{ t('header.nav.nav1') }}</RouterLink>
        </a-menu-item> -->
        <a-menu-item key="2">
            <RouterLink to="/account">{{ t('header.nav.nav2') }}</RouterLink>
        </a-menu-item>
        <a-menu-item key="3">
            <RouterLink to="/login" @click="logout">{{ t('header.nav.nav3') }}</RouterLink>
        </a-menu-item>
    </a-menu>
    </a-layout-header>
</template>

<script>
    import { ref, defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';
    import router from '../../router';
    import { RouterLink } from 'vue-router';
    import axios from 'axios';

    export default defineComponent ({
    setup () {
        const { t } = useI18n();
        const store = useStore();
        const selectedKeys = ref(['2']);

        const logout = async () => {
            try {
                const token = localStorage.getItem('auth_token'); // 保存されたトークンを取得
                const response = await axios.post("http://127.0.0.1:8000/api/logout", {}, {
                    headers: {
                        Authorization: `Bearer ${token}` // トークンをヘッダーに含める
                    },
                });
                localStorage.removeItem('auth_token');
                store.dispatch('logout');
                console.log('Logout successful:', response.data);
                router.push('/login');
            } catch (error) {
                // エラーメッセージを表示
                if (error.response) {
                    console.error('Logout failed:', error.response.data.message);
                } else {
                    console.error('An error occurred:', error.message);
                }
            }
        };

        return {
            t,
            store,
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