<template>
    <div class="account">
        <div class="account-wrapper">
            <div class="account-info">
                <div class="account-name">
                    <h1>aiueo</h1>
                </div>
                <div class="account-mail">
                    <h3>aiueo</h3>
                </div>
                <div class="account-menu">
                    <RouterLink to="/setting">aiueo</RouterLink>
                </div>
            </div>
            <div class="account-history">
                <div class="top">
                    <h2>履歴</h2>
                    <div class="all-display-btn">
                        <a-space wrap>
                            <a-button>
                                <RouterLink to="/history">全て表示</RouterLink>
                            </a-button>
                        </a-space>
                    </div>
                </div>
                <ul class="cocktail-items">
                    <li class="cocktail-item">
                        <RouterLink
                        :to="{ name: 'CocktailDetail', params: { id: 1 } }"
                        @click=""
                        >
                            <div class="cocktail-item-img"></div>
                            <div class="cocktail-content-explanation">
                                <div class="cocktail-content-explanation-wrapper">
                                    <div class="cocktail-content-name">
                                        <div class="cocktail-content-name-ja">
                                            aiueo
                                        </div>
                                        <div class="cocktail-content-name-en">
                                            aiueo
                                        </div>
                                    </div>
                                    <div class="cocktail-content-alcohol">
                                        aiueo
                                    </div>
                                </div>
                            </div>
                        </RouterLink>
                    </li>
                </ul>
            </div>
            <div class="account-fav">
                <div class="top">
                    <h2>お気に入り</h2>
                    <div class="all-display-btn">
                        <a-space wrap>
                            <a-button>
                                <RouterLink to="/fav">全て表示</RouterLink>
                            </a-button>
                        </a-space>
                    </div>
                </div>
                <ul class="cocktail-items">
                    <li class="cocktail-item">
                        <RouterLink
                    :to="{ name: 'CocktailDetail', params: { id: 1 } }"
                    @click=""
                    >
                            <div class="cocktail-item-img"></div>
                            <div class="cocktail-content-explanation">
                                <div class="cocktail-content-explanation-wrapper">
                                    <div class="cocktail-content-name">
                                        <div class="cocktail-content-name-ja">
                                            aiueo
                                        </div>
                                        <div class="cocktail-content-name-en">
                                            aiueo
                                        </div>
                                    </div>
                                    <div class="cocktail-content-alcohol">
                                        aiueo
                                    </div>
                                </div>
                            </div>
                        </RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { RouterLink } from 'vue-router';
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
        font-size: 30px;
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
        margin-top: 3vh;
    }
    .cocktail-item {
        margin: 0 0.5%;
    }
    .cocktail-item-img {
        height: 30vh;
        width: 15vw;
        padding: 2%;
        background-color: red;
    }
    .cocktail-content-explanation {
        padding: 5% 10%;
        background-color: gray;
    }
    .cocktail-content-name {
        display: flex;
        align-items: center;
    }
    .cocktail-content-name-ja {
        font-size: 20px;
        margin-right: 5%;
    }
    .cocktail-content-alcohol {
        margin-top: 5%;
    }
    .account-fav {
        margin-top: 15vh;
    }
</style>
