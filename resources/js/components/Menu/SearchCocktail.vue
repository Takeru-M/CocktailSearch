<template>
    <div class="CocktailSearch">
        <div class="search-box">
            <div class="search-box-logo">
                <h2>{{ t('searchCocktail.top-title') }}</h2>
            </div>
            <a-space direction="vertical" class="search-box-input">
            <a-input-search
            v-model:value="searchValue"
            :placeholder="t('searchCocktail.top-placeholder')"
            style="width: 40vw"
            @search="onSearch"
            />
            </a-space>
            <div class="detail-search-box">
                <input id="acd-check1" class="acd-check" type="checkbox">
                <label class="acd-label" for="acd-check1">{{ t('searchCocktail.detail-search.acd-lavel') }}</label>
                <div class="acd-content">
                    <div class="detail-search-menu">
                        <div class="filtering-menu">
                            <select name="base" id="base-select" v-model="selectedBase" class="filtering-select">
                            <option value="">{{ t('searchCocktail.detail-search.base.base') }}</option>
                            <option value="1">{{ t('searchCocktail.detail-search.base.gin') }}</option>
                            <option value="2">{{ t('searchCocktail.detail-search.base.voldka') }}</option>
                            <option value="3">{{ t('searchCocktail.detail-search.base.tequila') }}</option>
                            <option value="4">{{ t('searchCocktail.detail-search.base.rum') }}</option>
                            <option value="5">{{ t('searchCocktail.detail-search.base.whisky') }}</option>
                            <option value="6">{{ t('searchCocktail.detail-search.base.brandy') }}</option>
                            <option value="7">{{ t('searchCocktail.detail-search.base.liqour') }}</option>
                            <option value="8">{{ t('searchCocktail.detail-search.base.wine') }}</option>
                            <option value="9">{{ t('searchCocktail.detail-search.base.beer') }}</option>
                            <option value="10">{{ t('searchCocktail.detail-search.base.japanese-sake') }}</option>
                            <option value="0">{{ t('searchCocktail.detail-search.base.non-alcohol') }}</option>
                            </select>

                            <select name="taste" id="taste-select" v-model="selectedTaste" class="filtering-select">
                            <option value="">{{ t('searchCocktail.detail-search.taste.taste') }}</option>
                            <option value="1">{{ t('searchCocktail.detail-search.taste.sweet') }}</option>
                            <option value="2">{{ t('searchCocktail.detail-search.taste.medium-sweet') }}</option>
                            <option value="3">{{ t('searchCocktail.detail-search.taste.medium') }}</option>
                            <option value="4">{{ t('searchCocktail.detail-search.taste.medium-dry') }}</option>
                            <option value="5">{{ t('searchCocktail.detail-search.taste.dry') }}</option>
                            </select>

                            <select name="percentage" id="percentage-select" v-model="selectedPercentage" class="filtering-select">
                            <option value="">{{ t('searchCocktail.detail-search.percentage.percentage') }}</option>
                            <option value="non-alcohol">{{ t('searchCocktail.detail-search.percentage.non-alcohol') }}</option>
                            <option value="weak">{{ t('searchCocktail.detail-search.percentage.weak') }}</option>
                            <option value="normal">{{ t('searchCocktail.detail-search.percentage.normal') }}</option>
                            <option value="slightly-strong">{{ t('searchCocktail.detail-search.percentage.slightly-strong') }}</option>
                            <option value="strong">{{ t('searchCocktail.detail-search.percentage.strong') }}</option>
                            <option value="very-strong">{{ t('searchCocktail.detail-search.percentage.very-strong') }}</option>
                            </select>

                            <select name="feature" id="feature-select" v-model="selectedFeature" class="filtering-select">
                            <option value="">{{ t('searchCocktail.detail-search.feature.feature') }}</option>
                            <option value="1">{{ t('searchCocktail.detail-search.feature.standard') }}</option>
                            <option value="2">{{ t('searchCocktail.detail-search.feature.original') }}</option>
                            <option value="3">{{ t('searchCocktail.detail-search.feature.simple') }}</option>
                            <option value="4">{{ t('searchCocktail.detail-search.feature.light') }}</option>
                            <option value="5">{{ t('searchCocktail.detail-search.feature.refreshing') }}</option>
                            <option value="6">{{ t('searchCocktail.detail-search.feature.smooth') }}</option>
                            <option value="7">{{ t('searchCocktail.detail-search.feature.sharp') }}</option>
                            <option value="8">{{ t('searchCocktail.detail-search.feature.sour') }}</option>
                            <option value="9">{{ t('searchCocktail.detail-search.feature.rich') }}</option>
                            <option value="10">{{ t('searchCocktail.detail-search.feature.strong') }}</option>
                            <option value="11">{{ t('searchCocktail.detail-search.feature.easy-to-drink') }}</option>
                            <option value="12">{{ t('searchCocktail.detail-search.feature.sober') }}</option>
                            <option value="13">{{ t('searchCocktail.detail-search.feature.fun') }}</option>
                            <option value="14">{{ t('searchCocktail.detail-search.feature.beautiful') }}</option>
                            <option value="15">{{ t('searchCocktail.detail-search.feature.hot') }}</option>
                            <option value="16">{{ t('searchCocktail.detail-search.feature.tropical') }}</option>
                            <option value="17">{{ t('searchCocktail.detail-search.feature.elegant') }}</option>
                            <option value="18">{{ t('searchCocktail.detail-search.feature.masculine') }}</option>
                            <option value="19">{{ t('searchCocktail.detail-search.feature.recommended-for-women') }}</option>
                            <option value="10">{{ t('searchCocktail.detail-search.feature.historic') }}</option>
                            <option value="21">{{ t('searchCocktail.detail-search.feature.pousse-cafe') }}</option>
                            <option value="22">{{ t('searchCocktail.detail-search.feature.good-with-food') }}</option>
                            <option value="23">{{ t('searchCocktail.detail-search.feature.va-11-hall-1') }}</option>
                            <option value="24">{{ t('searchCocktail.detail-search.feature.cyberpunk-2077') }}</option>
                            </select>
                        </div>
                        <div class="filtering-btn-wrapper">
                            <button @click="onSearch" class="filtering-btn">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent, defineProps, ref, watch } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';

    export default defineComponent ({
        props: {
            current: {
                type: Number
            }
        },
        setup(props) {
            const { t } = useI18n();
            const store = useStore();

            const searchValue = ref('');
            const selectedBase = ref('');
            const selectedTaste = ref('');
            const selectedFeature = ref('');
            const selectedPercentage = ref('');
            let cocktailData = {};

            const fetchCocktailData = async () => {
                cocktailData = await store.dispatch('fetchCocktailData', {
                    word: searchValue.value,
                    base: selectedBase.value,
                    taste: selectedTaste.value,
                    percentage: selectedPercentage.value,
                    tag: selectedFeature.value,
                    page: props.current
                });
                setCocktailData(cocktailData);
            };

            const setCocktailData = (cocktailData) => {
                store.dispatch("setCocktailData", cocktailData);
            }

            watch(() => props.current, (newValue, oldValue) => {
                fetchCocktailData();
            });

            //The function for searching cocktail using api
            const onSearch = () => {
                fetchCocktailData();
            };
            return {
                t,
                store,
                searchValue,
                selectedBase,
                selectedTaste,
                selectedFeature,
                selectedPercentage,
                setCocktailData,
                fetchCocktailData,
                onSearch,
            }
        }
    })
</script>

<style>
    .search-box-logo {
        margin-top: 10vh;
        text-align: center;
    }
    .search-box-input {
        margin-top: 10vh;
        display: flex;
        text-align: center;
    }
    .detail-search-box {
        margin-top: 8vh;
    }
    .detail-search-menu {
        padding: 2vh 2vw;
    }
    .filtering-btn-wrapper {
        text-align: center;
        margin-top: 5vh;
    }
    .filtering-btn {
        background-color: #333;
        color: #fff;
        padding: 2vh 4vw;
    }
    .filtering-select {
        width: 20%;
        margin: 2vh 2vw;
    }
    .filtering-menu {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .acd-check{
    display: none;
    }
    .acd-label{
        background: #333;
        color: #fff;
        display: block;
        margin: 3vh auto 0 auto;
        padding: 10px;
        width: 10vw;
        text-align: center;
    }
    .acd-content{
        border: 1px solid #333;
        /* height: 0; */
        opacity: 0;
        width: 50vw;
        padding: 0 10px;
        margin-top: 3vh;
        transition: .5s;
        visibility: hidden;
        position: relative;
        /* 要検討 */
        left: 21.5%;
    }
    .acd-check:checked + .acd-label + .acd-content{
        /* height: 40px; */
        opacity: 1;
        padding: 10px;
        visibility: visible;
    }
</style>