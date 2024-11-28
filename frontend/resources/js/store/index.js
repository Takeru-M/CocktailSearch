import { createStore } from "vuex";
import axios from 'axios';

export default createStore ({
    state: {
        loginStatus: false,
        user: {},
        currentPage: 1,
        totalOfItems: 0,
        selectedCocktailID: 0,
        cocktailData: {},
        selectedCocktail: {},
    },
    getters: {
        user (state) {
            return state.user;
        },
        loginStatus (state) {
            return state.loginStatus;
        },
        currentPage (state) {
            return state.currentPage;
        },
        totalOfItems (state) {
            return state.totalOfItems;
        },
        cocktailData (state) {
            return state.cocktailData;
        },
        selectedCocktail (state) {
            return state.selectedCocktail;
        }
    },
    mutations: {
        setUser (state, user) {
            state.user = user;
        },
        setLoginStatus (state) {
            state.loginStatus = true;
        },
        setLogoutStatus (state) {
            state.loginStatus = false;
        },
        setCurrentPage (state, currentPage) {
            state.currentPage = currentPage;
        },
        setTotalOfItems (state, totalOfItems) {
            state.totalOfItems = totalOfItems;
        },
        setCocktailID (state, id) {
            state.selectedCocktailID = id;
        },
        setCocktailData (state, results) {
            state.cocktailData = results;
        },
        setSelectedCocktail (state, result) {
            state.selectedCocktail = result;
        }
    },
    actions: {
        initializeStore({ commit }) {
            const loginStatus = JSON.parse(localStorage.getItem('loginStatus'));
            if (loginStatus !== null) {
                commit('setLoginStatus', loginStatus);
            }
        },
        setUser (context, user) {
            context.commit('setUser', user);
        },
        setLoginStatus (context) {
            context.commit('setLoginStatus');
        },
        setLogoutStatus (context) {
            context.commit('setLogoutStatus');
        },
        setCurrentPage (context, currentPage) {
            context.commit('setCurrentPage', currentPage);
        },
        setTotalOfItems (context, totalOfItems) {
            context.commit('setTotalOfItems', totalOfItems);
        },
        async fetchCocktailData (context, {word, base, taste, percentage, tag, page}) {
            let alcohol_from = '';
            let alcohol_to = '';
            switch (percentage) {
                case 'weak':
                    alcohol_from = 1;
                    alcohol_to = 10;
                    break;
                case 'normal':
                    alcohol_from = 11;
                    alcohol_to = 20;
                    break;
                case 'slightly-strong':
                    alcohol_from = 21;
                    alcohol_to = 30;
                    break;
                case 'strong':
                    alcohol_from = 31;
                    alcohol_to = 40;
                    break;
                case 'very-strong':
                    alcohol_from = 41;
                    alcohol_to = 100;
                    break;
            };
            try {
                const token = localStorage.getItem('auth_token');
                const response = await axios.get('http://127.0.0.1:8000/api/dashboard', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    params: {
                        word: word,
                        base: base,
                        taste: taste,
                        tag: tag,
                        alcohol_from: alcohol_from,
                        alcohol_to: alcohol_to,
                        page: page
                    }
                });
                return response.data;
            } catch (e) {
                console.error(e.message);
            };
        },
        setCocktailData (context, results) {
            context.commit('setCocktailData', results);
        },
        setSelectedCocktail (context, result) {
            context.commit('setSelectedCocktail', result);
        },
    },
});
