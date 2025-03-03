<template>
    <a-layout-content :style="{ padding: '0 50px', marginTop: '64px' }">
    <!-- <a-breadcrumb :style="{ margin: '16px 0' }">
        <a-breadcrumb-item>Home</a-breadcrumb-item>
        <a-breadcrumb-item>List</a-breadcrumb-item>
        <a-breadcrumb-item>App</a-breadcrumb-item>
    </a-breadcrumb> -->
    <div :style="{ background: '#fff', padding: '24px', minHeight: '380px' }" class="contents-wrapper">
        <div class="cocktail-detail">
            <div class="cocktail-detail-wrapper">
                <div class="cocktail-top">
                    <div class="cocktail-title" v-if="selectedCocktail">
                        <div class="cocktail-digest">{{ selectedCocktail.cocktail_digest }}</div>
                        <div class="cocktail-name">
                            <template v-if="selectedCocktail">
                                <div class="cocktail-name-ja">{{ selectedCocktail.cocktail_name }}</div>
                                <div class="cocktail-name-en">{{ selectedCocktail.cocktail_name_english }}</div>
                            </template>
                        </div>
                    </div>
                    <div class="fav-btn-wrapper">
                        <button @click="favBtn"><HeartFilled class="fav-btn" :style="{ color: favBtnColor }" /></button>
                    </div>
                </div>
                <div class="cocktail-content">
                    <div class="cocktail-img-wrapper">
                        <div class="cocktailo-img"></div>
                    </div>
                    <div class="cocktail-info">
                        <ul class="cocktail-tags" v-if="selectedCocktail">
                            <li class="cocktail-tag" v-for="tag in selectedCocktail.tags" :key="tag.tag_id">{{ tag.tag_name }}</li>
                        </ul>
                        <ul class="cocktail-attributes" v-if="selectedCocktail">
                            <li class="cocktail-base cocktail-attribute">{{ selectedCocktail.base_name }}</li>
                            <li class="cocktail-technique cocktail-attribute">{{ selectedCocktail.technique_name }}</li>
                            <li class="cocktail-taste cocktail-attribute">{{ selectedCocktail.taste_name }}</li>
                            <li class="cocktail-style cocktail-attribute">{{ selectedCocktail.style_name }}</li>
                            <li class="cocktail-alcohol cocktail-attribute">{{ selectedCocktail.alcohol }}</li>
                            <li class="cocktail-tpo cocktail-attribute">{{ selectedCocktail.tpo_name }}</li>
                            <li class="cocktial-glass cocktail-attribute">{{ selectedCocktail.glass_name }}</li>
                            <li class="cocktail-type cocktail-attribute">{{ selectedCocktail.type_name }}</li>
                            <li class="cocktail-color cocktail-attribute">{{ selectedCocktail.color_name }}</li>
                        </ul>
                        <ul class="cocktail-recipes" v-if="selectedCocktail">
                            <li class="cocktail-recipe" v-for="recipe in selectedCocktail.recipes" :key="recipe.ingredient_id">
                                <div class="recipe-name">{{ recipe.ingredient_name }}</div>
                                <div class="recipe-amount">{{ recipe.amount }}{{ recipe.unit }}</div>
                            </li>
                        </ul>
                        <template v-if="selectedCocktail">
                            <div class="cocktail-desc">{{ selectedCocktail.cocktail_desc }}</div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a-layout-content>
</template>

<script lang="ts">
    import { computed, ref, onMounted, nextTick, watch } from 'vue';
    import { defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useRoute } from 'vue-router';
    import { AxiosError } from 'axios';
    import { HeartFilled } from '@ant-design/icons-vue';
    import { State } from '@/types/stores/CommonStore';
    import { Cocktail } from '@/types/stores/CommonStore';
    import { getFavAPI, registerFavAPI, removeFavAPI } from '@/APIs/FavoriteAPI';

    export default defineComponent ({
        components: {
            HeartFilled,
        },
        setup() {
            const store = useStore<State>();
            const route = useRoute();

            onMounted(async () => {
                await setSelectedCocktail();
            });

            const getCocktailFlag = computed(() => store.getters.getCocktailFlag);
            watch(getCocktailFlag, (newValue, oldValue) => {
                if (newValue == true) {
                    console.log(localStorage.getItem('SelectedCocktail'));
                    const selectedCocktailJson = localStorage.getItem('SelectedCocktail');
                    if (selectedCocktailJson) {
                        selectedCocktail.value = JSON.parse(selectedCocktailJson) as Cocktail;
                    }
                    store.dispatch('setGetCocktailFlag', false);
                    judgeFavCocktail();
                }
            })

            // const selectedCocktail = computed<Cocktail>(() => store.getters.selectedCocktail);
            let selectedCocktail = ref<Cocktail | null>(null)
            const selectedCocktailJson = localStorage.getItem('SelectedCocktail');
            const setSelectedCocktail = async (): Promise<void> => {
                if (selectedCocktailJson) {
                    selectedCocktail.value = await JSON.parse(selectedCocktailJson) as Cocktail;
                }
            }
            // const selectedCocktail = localStorage.getItem('SelectedCocktail') != null ?  JSON.parse(localStorage.getItem('SelectedCocktail')) as Cocktail : null;
            let favFlag: boolean = false;
            const favBtnColor = ref<string>('gray');

            const userID: number = Number(localStorage.getItem('user_id'));
            const judgeFavCocktail = async (): Promise<void> => {
                if (selectedCocktail.value) {
                    const response = await getFavAPI(userID, selectedCocktail.value.cocktail_id);
                    if (response.isFav) {
                        favBtnColor.value = 'red';
                        favFlag = true;
                    } else {
                        favFlag = false;
                    }
                }
            }

            //Register and remove the favorite cocktial if the button is pushed
            const favBtn = (): void => {
                const userID: number = Number(localStorage.getItem('user_id'));
                favBtnColor.value = favBtnColor.value === 'gray' ? 'red' : 'gray';
                // const token: string | null = localStorage.getItem('auth_token');
                if (!favFlag) {
                    registerFav(userID);
                    favFlag = true;
                } else {
                    removeFav(userID);
                    favFlag = false;
                }
            };

            //Register the favorite cocktail from the database
            const registerFav = async (userID: number): Promise<void> => {
                try {
                    if (selectedCocktail.value) {
                        const response = await registerFavAPI({
                            userID: userID,
                            cocktailID: selectedCocktail.value.cocktail_id
                        });
                        console.log(response.message);
                    }
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                    console.error('Registering favorite cocktail failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };

            //Remove the favorite cocktail from the database
            const removeFav = async (userID: number): Promise<void> => {
                try {
                    if (selectedCocktail.value) {
                        const response = await removeFavAPI({
                            userID: userID,
                            cocktailID: selectedCocktail.value.cocktail_id
                        });
                        console.log(response.message);
                    }
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                        console.error('Removing favorite cocktail failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };

            return {
                store,
                route,
                favFlag,
                setSelectedCocktail,
                selectedCocktail,
                favBtnColor,
                favBtn,
                registerFav,
                removeFav,
            };
        },
    });
</script>

<style>
    .cocktail-detail-wrapper {
        padding: 2%;
    }
    .cocktail-top {
        display: flex;
        justify-content: space-between;
    }
    .fav-btn-wrapper {
        margin: 10vh 5vw 0 0;
    }
    .fav-btn {
        color: gray;
        font-size: 25px;
    }
    .cocktail-content {
        display: flex;
    }
    .cocktail-title {
        padding: 2%;
    }
    .cocktail-digest {
        font-size: 18px;
        margin-bottom: 1%;
    }
    .cocktail-name-ja {
        font-size: 23px;
        margin-bottom: 1%;
    }
    .cocktail-name-en {
        font-size: 18px;
    }
    .cocktail-img-wrapper {
        width: 40%;
        background-color: rgb(200, 200, 200);
    }
    .cocktail-info {
        width: 60%;
        padding: 3% 2%;
        background-color: gray;
    }
    .cocktail-tags {
        display: flex;
    }
    .cocktail-tag {
        padding: 1%;
        background-color: white;
        margin-right: 2%;
    }
    .cocktail-attributes {
        display: flex;
        flex-wrap: wrap;
    }
    .cocktail-attribute {
        padding: 1%;
        background-color: white;
        margin:2% 2% 0 0;
    }
    .cocktail-recipes {
        padding: 2%;
    }
    .cocktail-recipe {
        display: flex;
        justify-content: space-between;
        padding: 3% 2%;
    }
    .recipe-amount {
        padding-right: 10%;
    }
</style>
