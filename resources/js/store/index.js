import { createStore } from "vuex";
import axios from 'axios';

export default createStore ({
    state: {
        login: false,
        user: {},
        selectedCocktailID: 0,
        cocktailData: {},
        selectedCocktail: {},
    },
    getters: {
        user (state) {
            return state.user;
        },
        login (state) {
            return state.login;
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
        login (state) {
            state.login = true;
        },
        logout (state) {
            state.login = false;
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
        ex (name, pass) {
            console.log(name, pass);
        },
        setUser ({commit}, user) {
            commit('setUser', user);
        },
        login ({commit}) {
            commit('login');
        },
        logout ({commit}) {
            commit('logout');
        },
        async fetchCocktailData ({word, base, taste, percentage, tag, page}) {
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
                const response = await axios.get('http://127.0.0.1:8000/api/dashboard', {
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
        async setCocktailData ({ commit }, results) {
            await commit('setCocktailData', results);
        },
        async setSelectedCocktail ({ commit }, result) {
            await commit('setSelectedCocktail', result);
        },
    },
});