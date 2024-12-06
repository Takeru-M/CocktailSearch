import { Recipe, Tag } from "../stores/CommonStore";

export interface UserResponse {
    id: number;
    name: string;
    email: string;
}

export interface CocktailResponse {
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
    created_at: string;
    updated_at: string;
}

export interface CocktailResponse {
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
    created_at: string;
    updated_at: string;
}
