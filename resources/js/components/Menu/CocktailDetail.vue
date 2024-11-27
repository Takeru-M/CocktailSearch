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
                    <div class="cocktail-title">
                        <div class="cocktail-digest">{{ selectedCocktail.cocktail_digest }}</div>
                        <div class="cocktail-name">
                            <div class="cocktail-name-ja">{{ selectedCocktail.cocktail_name }}</div>
                            <div class="cocktail-name-en">{{ selectedCocktail.cocktail_name_english }}</div>
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
                        <ul class="cocktail-tags">
                            <li class="cocktail-tag" v-for="tag in selectedCocktail.tags" :key="tag.tag_id">{{ tag.tag_name }}</li>
                        </ul>
                        <ul class="cocktail-attributes">
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
                        <ul class="cocktail-recipes">
                            <li class="cocktail-recipe" v-for="recipe in selectedCocktail.recipes" :key="recipe.ingredient_id">
                                <div class="recipe-name">{{ recipe.ingredient_name }}</div>
                                <div class="recipe-amount">{{ recipe.amount }}{{ recipe.unit }}</div>
                            </li>
                        </ul>
                        <div class="cocktail-desc">{{ selectedCocktail.cocktail_desc }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a-layout-content>
</template>

<script>
    import { computed, ref } from 'vue';
    import { defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useRoute } from 'vue-router';
    import axios from 'axios';
    import { HeartFilled } from '@ant-design/icons-vue';

    export default defineComponent ({
        components: {
            HeartFilled,
        },
        setup() {
            const store = useStore();
            const route = useRoute();

            const selectedCocktail = computed(() => store.getters.selectedCocktail);
            let favFlag = false;
            const favBtnColor = ref('gray');

            const favBtn = () => {
                const user = computed(() => store.getters.user);
                favBtnColor.value = favBtnColor.value === 'gray' ? 'red' : 'gray';
                if (!favFlag) {
                    registerFav(user);
                    favFlag = true;
                } else {
                    removeFav(user);
                    favFlag = false;
                }
            };

            const registerFav = async user => {
                try {
                    const responseFromRegisterFav = await axios.post('http://127.0.0.1:8000/api/registerFav', {
                        userID: user.value.id,
                        cocktailID: selectedCocktail.value.cocktail_id,
                    });
                    console.log(responseFromRegisterFav.data);
                } catch (error) {
                    console.error('An error occurred:', error.message);
                }
            };

            const removeFav = async user => {
                try {
                    const responseFromRemoveFav = await axios.post('http://127.0.0.1:8000/api/removeFav', {
                        userID: user.value.id,
                        cocktailID: selectedCocktail.value.cocktail_id,
                    });
                    console.log(responseFromRemoveFav.data);
                } catch (error) {
                    console.error('An error occurred:', error.message);
                }
            }

            return {
                store,
                route,
                favFlag,
                selectedCocktail,
                favBtnColor,
                favBtn,
                registerFav,
                removeFav,
            }
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
        background-color: red;
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
