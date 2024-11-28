<template>
    <a-layout>
        <Header v-if="loginStatus"></Header>
        <div class="contents">
            <router-view></router-view>
        </div>
        <Footer v-if="loginStatus"></Footer>
    </a-layout>
</template>

<script>
    import { computed, defineComponent, watch, onMounted } from 'vue';
    import Header from './components/Common/Header.vue';
    import Footer from './components/Common/Footer.vue';
    import { useStore } from 'vuex';

    export default defineComponent ({
        components: {
            Header,
            Footer,
        },
        setup() {
            const store = useStore();
            let loginStatus = computed(() => store.getters.loginStatus);

            onMounted(() => {
                const tmp = localStorage.getItem('login_status');
                if (tmp == 'true') {
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