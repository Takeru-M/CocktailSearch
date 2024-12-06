import apiClient from "./CommonAPI";
import { Cocktail, CocktailParams, Cocktails, PreCocktailParams } from "@/types/stores/CommonStore";
import { registerCocktailResponse } from "@/types/responses/Common";
import { GetCocktailResponse } from "@/types/responses/GetCocktailResponse";

export const fetchCocktailsAPI = async (params: CocktailParams): Promise<Cocktails> => {
    const response = await apiClient.get<Cocktails>('/cocktail/fetchCocktails', {
        params: params
    });
    return response.data;
}

export const registerCocktailAPI = async (data: {cocktailData: Cocktail}): Promise<registerCocktailResponse> => {
    const response = await apiClient.post('/cocktail', data);
    return response.data
}

export const getCocktailAPI = async (cocktail_id: number): Promise<GetCocktailResponse> => {
    const response = await apiClient.get<GetCocktailResponse>(`/cocktail/${cocktail_id}`);
    return response.data;
}
