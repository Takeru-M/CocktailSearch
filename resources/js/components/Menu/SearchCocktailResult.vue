<template>
    <div class="result">
        <div class="result-contents">
            <ul class="result-content-ui" v-if="cocktailData">
                <li v-for="result in cocktailData.cocktails" :key="result.cocktail_id">
                    <RouterLink
                    :to="{ name: 'CocktailDetail', params: { id: result.cocktail_id } }"
                    @click="setSelectedCocktail(result)"
                    >
                        <div class="result-content">
                            <div class="result-content-wrapper">
                                <div class="result-content-img"></div>
                                <div class="result-content-explanation">
                                    <div class="result-content-explanation-wrapper">
                                        <div class="result-content-name">
                                            <div class="result-content-name-ja">
                                                {{ result.cocktail_name }}
                                            </div>
                                            <div class="result-content-name-en">
                                                <h4>{{ result.cocktail_name_english }}</h4>
                                            </div>
                                        </div>
                                        <div class="reuslt-content-alcohol">
                                            <h5>{{ t('searchCocktailResult.percentage') }} {{ result.alcohol }}</h5>
                                        </div>
                                        <div class="result-content-desc">
                                            <p>{{ result.cocktail_desc }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </RouterLink>
                </li>
            </ul>
            <div v-else-if="status" class="no-result-msg">
                <h3>No results found.</h3>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';
    import { ClickOutside } from 'element-plus';
    import { defineComponent, defineProps, computed } from 'vue';
    import { useI18n } from 'vue-i18n';
    import { RouterLink } from 'vue-router';
    import { useStore } from 'vuex';

    export default defineComponent ({
        props: {
            status: {
                type: Boolean,
            },
        },
        setup(props) {
            const { t } = useI18n();
            const store = useStore();

            const cocktailData = computed(() => store.getters.cocktailData);
            const setSelectedCocktail = (result) => {
                store.dispatch("setSelectedCocktail", result);
            };

            return {
                t,
                store,
                cocktailData,
                setSelectedCocktail,
            };
        },
    });
</script>

<style>
    .result-contents {
        padding: 2%;
    }
    .result-content-ui {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .result-content {
        height: 40vh;
        width: 40vw;
        margin: 2vh 0;
        background-color: gray;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .result-content-wrapper {
        height: 85%;
        width: 100%;
        padding: 0 2%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .result-content-img {
        height: 100%;
        width: 40%;
        background-color: red;
    }
    .result-content-explanation {
        height: 100%;
        width: 55%;
        background-color: white;
    }
    .result-content-explanation-wrapper {
        padding: 5%;
    }
    .result-content-name {
        display: flex;
    }
    .result-content-name-ja {
        margin-right: 1vw;
    }
    .no-result-msg {
        text-align: center;
        margin-top: 10vh;
    }
</style>