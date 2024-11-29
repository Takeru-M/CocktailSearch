<template>
    <a-layout>
        <Header v-if="loginStatus"></Header>
        <div class="contents">
            <router-view></router-view>
        </div>
        <Footer v-if="loginStatus"></Footer>
    </a-layout>
</template>

<script lang="ts">
    import { computed, defineComponent, watch, onMounted } from 'vue';
    import Header from './components/Common/Header.vue';
    import Footer from './components/Common/Footer.vue';
    import { useStore } from 'vuex';
    import { State } from './types/stores/CommonStore';

    export default defineComponent ({
        components: {
            Header,
            Footer,
        },
        setup() {
            const store = useStore<State>();
            let loginStatus = computed<boolean>(() => store.getters.loginStatus);

            onMounted(() => {
                const loginStatusFromLocalStorage: string | null = localStorage.getItem('login_status');
                if (loginStatusFromLocalStorage == 'true') {
                    store.dispatch('setLoginStatus');
                }
            })

            return {
                loginStatus,
            };
        },
    });
</script>

<style>

</style>
