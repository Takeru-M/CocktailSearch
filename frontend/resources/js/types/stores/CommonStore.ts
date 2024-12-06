import { ActionContext } from 'vuex';

export type CommonActionContext = ActionContext<State, State>;

export interface State {
    loginStatus: boolean;
    user: User | null;
    currentPage: number;
    totalOfItems: number;
    selectedCocktailID: number;
    getCocktailFlag: boolean;
    cocktailData: Cocktails | null;
    selectedCocktail: Cocktail | null;
    searchStatus: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
}

export interface Cocktails {
    status: string;
    total_pages: number;
    current_page: number;
    cocktails: Cocktail[];
}

export interface Cocktail {
    cocktail_id: number;
    cocktail_name: string;
    cocktail_name_english: string;
    base_name: string;
    technique_name: string;
    taste_name: string;
    style_name: string;
    alcohol: number;
    tpo_name: string;
    glass_name: string;
    type_name: string;
    color_name: string;
    cocktail_digest: string;
    cocktail_desc: string;
    recipe_desc: string;
    recipes: Recipe[];
    tags: Tag[];
}

export interface Recipe {
    ingredient_id: number;
    ingredient_name: string;
    amount: string | null;
    unit: string;
}

export interface Tag {
    tag_id: number;
    tag_name: string;
}

export interface PreCocktailParams {
    word: string | null;
    base: string | null;
    taste: string | null;
    percentage: string | null;
    tag: string | null;
    page: number | null;
}

export interface CocktailParams {
    word: string | null;
    base: string | null;
    taste: string | null;
    tag: string | null;
    alcohol_from: number | null,
    alcohol_to: number | null,
    page: number | null;
}
