<template>
    <a-layout>
        <Header v-if="true"></Header>
        <div class="contents">
            <router-view></router-view>
        </div>
        <Footer v-if="true"></Footer>
    </a-layout>
</template>

<script>
    import { reactive, ref, computed, defineComponent} from 'vue';
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
            const login = computed(() => store.getters.login);
            return {
                login
            }
        }
    })
</script>

<style>

</style>