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
    import { computed, ref } from 'vue';
    import { defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useRoute } from 'vue-router';
    import axios from 'axios';
    import { AxiosError } from 'axios';
    import { HeartFilled } from '@ant-design/icons-vue';
    import { State } from '@/types/stores/CommonStore';
    import { User, Cocktail } from '@/types/stores/CommonStore';
    import { RegisterFavResponse, RemoveFavResponse } from '@/types/responses/CocktailDetailResponse';

    export default defineComponent ({
        components: {
            HeartFilled,
        },
        setup() {
            const store = useStore<State>();
            const route = useRoute();

            const selectedCocktail = computed<Cocktail>(() => store.getters.selectedCocktail);
            let favFlag: boolean = false;
            const favBtnColor = ref<string>('gray');

            //Register and remove the favorite cocktial if the button is pushed
            const favBtn = (): void => {
                const user = computed<User>(() => store.getters.user).value;
                favBtnColor.value = favBtnColor.value === 'gray' ? 'red' : 'gray';
                const token: string | null = localStorage.getItem('auth_token');
                if (!favFlag) {
                    registerFav(user, token);
                    favFlag = true;
                } else {
                    removeFav(user, token);
                    favFlag = false;
                }
            };

            //Register the favorite cocktail from the database
            const registerFav = async (user: User, token: string | null): Promise<void> => {
                try {
                    const response = await axios.post<RegisterFavResponse>('http://127.0.0.1:8000/api/favorite', {
                            userID: user.id,
                            cocktailID: selectedCocktail.value.cocktail_id,
                        },
                        {
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Content-Type': 'application/json',
                            }
                        }
                    );
                    console.log(response.data.message);
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                    console.error('Registering favorite cocktail failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };

            //Remove the favorite cocktail from the database
            const removeFav = async (user: User, token: string | null): Promise<void> => {
                try {
                    const response = await axios.post<RemoveFavResponse>('http://127.0.0.1:8000/api/removeFav', {
                        userID: user.id,
                        cocktailID: selectedCocktail.value.cocktail_id,
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        }
                    }
                    );
                    console.log(response.data.message);
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
