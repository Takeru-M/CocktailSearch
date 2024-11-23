<template>
    <a-layout-content :style="{ padding: '0 50px', marginTop: '64px' }">
    <!-- <a-breadcrumb :style="{ margin: '16px 0' }">
        <a-breadcrumb-item>Home</a-breadcrumb-item>
        <a-breadcrumb-item>List</a-breadcrumb-item>
        <a-breadcrumb-item>App</a-breadcrumb-item>
    </a-breadcrumb> -->
    <div :style="{ background: '#fff', padding: '24px', minHeight: '380px' }" class="contents-wrapper">
        <div class="menu-contents">
            <SearchCocktail :current="currentPage"></SearchCocktail>
        </div>
        <div class="cocktail-result">
            <SearchCocktailResult :status="searchStatus"></SearchCocktailResult>
        </div>
        <div class="pagination" v-if="cocktailData">
            <a-pagination v-model:current="currentPage" :total="50" show-less-items />
        </div>
    </div>
    </a-layout-content>
</template>

<script>
import { ref, defineComponent, computed } from 'vue';
import { useStore } from 'vuex';
import SearchCocktail from './Menu/SearchCocktail.vue';
import SearchCocktailResult from './Menu/SearchCocktailResult.vue';

export default defineComponent ({
    components: {
        SearchCocktail,
        SearchCocktailResult
    },
    setup () {
        const store = useStore();

        const selectedKeys = ref(['2']);
        const currentPage = ref(1);
        let searchStatus = ref(false);
        const cocktailData = computed(() => store.getters.cocktailData);

        return {
            currentPage,
            searchStatus,
            cocktailData,
        };
    }
})
</script>

<style scoped>
    .contents-wrapper {
        /* margin-top: 10vh; */
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

    .pagination {
        text-align: center;
    }
</style>
