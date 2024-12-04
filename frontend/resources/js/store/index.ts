import { createStore } from "vuex";
import axios from 'axios';
import { State } from '@/types/stores/CommonStore';
import { CommonActionContext, User, Cocktail, Cocktails, FetchCocktailParams } from '@/types/stores/CommonStore';

export default createStore<State> ({
    state: {
        loginStatus: false,
        user: null,
        currentPage: 1,
        totalOfItems: 0,
        selectedCocktailID: 0,
        cocktailData: null,
        selectedCocktail: null,
        searchStatus: false,
    },
    getters: {
        user (state: State): User | null {
            return state.user;
        },
        loginStatus (state: State) {
            return state.loginStatus;
        },
        currentPage (state: State): number {
            return state.currentPage;
        },
        totalOfItems (state: State): number {
            return state.totalOfItems;
        },
        cocktailData (state: State): Cocktails | null {
            return state.cocktailData;
        },
        selectedCocktail (state: State): Cocktail | null {
            return state.selectedCocktail;
        },
        searchStatus (state: State): boolean {
            return state.searchStatus;
        }
    },
    mutations: {
        setUser (state: State, user: User | null): void {
            state.user = user;
        },
        setLoginStatus (state: State): void {
            state.loginStatus = true;
        },
        setLogoutStatus (state: State): void {
            state.loginStatus = false;
        },
        setCurrentPage (state: State, currentPage: number): void {
            state.currentPage = currentPage;
        },
        setTotalOfItems (state: State, totalOfItems: number): void {
            state.totalOfItems = totalOfItems;
        },
        setCocktailID (state: State, id: number): void {
            state.selectedCocktailID = id;
        },
        setCocktailData (state: State, results: Cocktails): void {
            state.cocktailData = results;
        },
        setSelectedCocktail (state: State, result: Cocktail): void {
            state.selectedCocktail = result;
        },
        setSearchStatus (state: State): void {
            state.searchStatus = true;
        }
    },
    actions: {
        initializeStore(context: CommonActionContext): void {
            const loginStatus: string | null = localStorage.getItem('loginStatus');
            if (loginStatus !== null) {
                context.commit('setLoginStatus', loginStatus);
            }
        },
        setUser (context: CommonActionContext, user: User): void {
            context.commit('setUser', user);
        },
        setLoginStatus (context: CommonActionContext): void {
            context.commit('setLoginStatus');
        },
        setLogoutStatus (context: CommonActionContext): void {
            context.commit('setLogoutStatus');
        },
        setCurrentPage (context: CommonActionContext, currentPage: number): void {
            context.commit('setCurrentPage', currentPage);
        },
        setTotalOfItems (context: CommonActionContext, totalOfItems: number): void {
            context.commit('setTotalOfItems', totalOfItems);
        },
        async fetchCocktailData (context: CommonActionContext, {word, base, taste, percentage, tag, page}: FetchCocktailParams) {
            let alcohol_from: number | null = null;
            let alcohol_to: number | null = null;
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
                const token: string | null = localStorage.getItem('auth_token');
                const response = await axios.get<Cocktails>('http://127.0.0.1:8000/api/dashboard', {
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
            } catch (e: unknown) {
                if (e instanceof Error) {
                    console.error(e.message);
                } else {
                    console.error('An unknown error occurred');
                }
            };
        },
        setCocktailData (context: CommonActionContext, results: Cocktails): void {
            context.commit('setCocktailData', results);
        },
        setSelectedCocktail (context: CommonActionContext, result: Cocktail): void {
            context.commit('setSelectedCocktail', result);
        },
        setSearchStatus (context: CommonActionContext): void {
            context.commit('setSearchStatus');
        }
    },
});
