<template>
    <div class="account">
        <div class="account-wrapper">
            <div class="account-info">
                <div class="account-name">
                    <h1>{{ user.name }}</h1>
                </div>
                <div class="account-mail">
                    <h3>{{ user.email }}</h3>
                </div>
                <div class="account-menu">
                    <button>
                        <RouterLink to="/setting">{{ t('account.account-setting') }}</RouterLink>
                    </button>
                </div>
            </div>
            <div class="account-history">
                <div class="top">
                    <h2>{{ t('account.account-history-title') }}</h2>
                    <div class="all-display-btn">
                        <a-space wrap>
                            <a-button>
                                <RouterLink to="/history">{{ t('account.account-btn') }}</RouterLink>
                            </a-button>
                        </a-space>
                    </div>
                </div>
                <ul class="cocktail-items" v-if="histories">
                    <li class="cocktail-item" v-for="history in histories" :key="history.cocktail_id">
                        <RouterLink
                        :to="{ name: 'CocktailDetail', params: { id: history.cocktail_id } }"
                        @click="setSelectedCocktail(history.cocktail_id)"
                        >
                            <div class="cocktail-item-img"></div>
                            <div class="cocktail-content-explanation">
                                <div class="cocktail-content-explanation-wrapper">
                                    <div class="cocktail-content-name">
                                        <div class="cocktail-content-name-ja">{{ history.cocktail_name }}</div>
                                        <div class="cocktail-content-name-en">{{ history.cocktail_name_english }}</div>
                                    </div>
                                    <div class="cocktail-content-alcohol">{{ history.alcohol }}</div>
                                </div>
                            </div>
                        </RouterLink>
                    </li>
                </ul>
            </div>
            <div class="account-fav">
                <div class="top">
                    <h2>{{ t('account.account-fav-title') }}</h2>
                    <div class="all-display-btn">
                        <a-space wrap>
                            <a-button>
                                <RouterLink to="/favorite">{{ t('account.account-btn') }}</RouterLink>
                            </a-button>
                        </a-space>
                    </div>
                </div>
                <ul class="cocktail-items" v-if="favCocktails">
                    <li class="cocktail-item" v-for="cocktail in favCocktails" :key="cocktail.cocktail_id">
                        <RouterLink
                        :to="{ name: 'CocktailDetail', params: { id: cocktail.cocktail_id } }"
                        @click="setSelectedCocktail(cocktail.cocktail_id)"
                        >
                            <div class="cocktail-item-img"></div>
                            <div class="cocktail-content-explanation">
                                <div class="cocktail-content-explanation-wrapper">
                                    <div class="cocktail-content-name">
                                        <div class="cocktail-content-name-ja">{{ cocktail.cocktail_name }}</div>
                                        <div class="cocktail-content-name-en">{{ cocktail.cocktail_name_english }}</div>
                                    </div>
                                    <div class="cocktail-content-alcohol">{{ cocktail.alcohol }}{{ t('account.account-alcohol') }}</div>
                                </div>
                            </div>
                        </RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent, computed, ref, onMounted } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';
    import axios from 'axios';
    import { State } from '@/types/stores/CommonStore';
    import { User } from '@/types/stores/CommonStore';
    import { GetFavCocktail, GetHistoryResponse } from '@/types/responses/AccountResponse';
    import { CocktailResponse } from '@/types/responses/CommonResponse';
import { GetCocktailResponse } from '@/types/responses/GetCocktail';

    export default defineComponent ({
        setup() {
            const { t } = useI18n();
            const store = useStore<State>();
            let histories = ref<CocktailResponse[] | null>([]);
            let favCocktails = ref<CocktailResponse[] | null>([]);

            const user = computed<User>(() => store.getters.user);

            onMounted(() => {
                getHistory();
                getFavCocktail();
            });

            //Get the histories of the user from the database
            const getHistory = async (): Promise<void> => {
                const token: string | null = localStorage.getItem('auth_token');
                const response = await axios.post<GetHistoryResponse>('http://127.0.0.1:8000/api/cocktail/get_five_histories', {
                        userID: user.value.id
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        }
                    }
                );
                histories.value = response.data.history;
                console.log(response.data.message);
            };

            //Get the favorie cocktails of the user from the database
            const getFavCocktail = async (): Promise<void> => {
                const token: string | null = localStorage.getItem('auth_token');
                const response = await axios.post<GetFavCocktail>('http://127.0.0.1:8000/api/cocktail/get_five_fav_cocktails', {
                        userID: user.value.id
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        },
                    }
                );
                favCocktails.value = response.data.favCocktail;
                console.log(response.data.message);
            };

            const setSelectedCocktail = async (cocktail_id: number): Promise<void> => {
                const token: string | null = localStorage.getItem('auth_token');
                const response = await axios.post<GetCocktailResponse>('http://127.0.0.1:8000/api/getCocktail', {
                        cocktailID: cocktail_id,
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        },
                    }
                );
                console.log(response.data.message);
                store.dispatch('setSelectedCocktail', response.data.cocktail);
                console.log(store.state.selectedCocktail);
            }

            return {
                t,
                store,
                user,
                histories,
                favCocktails,
                getHistory,
                getFavCocktail,
                setSelectedCocktail,
            };
        },
    });
</script>

<style>
    .account h1 {
        font-size: 40px;
        margin: 0;
    }
    .account h2 {
        font-size: 30px;
        margin: 0;
    }
    .account h3 {
        font-size: 20px;
        margin: 0;
    }
    .account-wrapper {
        margin-top: 13vh;
        padding: 2% 5%;
    }
    .account-name {
        margin-bottom: 2vh;
    }
    .account-mail {
        margin-bottom: 2vh;
    }
    .account-menu {
        font-size: 20px;
    }
    .account-history {
        margin-top: 15vh;
    }
    .top {
        margin-bottom: 5vh;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .all-display-btn {
        position: relative;
        right: 10vw;
    }
    .cocktail-items {
        display: flex;
        justify-content: left;
        margin-top: 3vh;
    }
    .cocktail-item {
        margin: 0 0.5%;
        width: 18%;
    }
    .cocktail-item-img {
        height: 30vh;
        padding: 2%;
        background-color: rgb(200, 200, 200);
    }
    .cocktail-content-explanation {
        height: 23vh;
        padding: 5% 10%;
        background-color: gray;
    }
    .cocktail-content-name-ja {
        font-size: 15px;
    }
    .cocktail-content-alcohol {
        margin-top: 5%;
    }
    .account-fav {
        margin-top: 15vh;
    }
</style>
