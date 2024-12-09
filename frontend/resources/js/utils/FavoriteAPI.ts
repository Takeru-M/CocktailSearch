import apiClient from "./CommonAPI";
import { GetFavResponse, RegisterFavResponse, RemoveFavResponse } from "@/types/responses/CocktailDetailResponse";
import { GetFavCocktail } from "@/types/responses/AccountResponse";

export const registerFavAPI = async (data: {userID: number, cocktailID: number}): Promise<RegisterFavResponse> => {
    const response = await apiClient.post('/favorite', data);
    return response.data;
}

export const removeFavAPI = async (data: {userID: number, cocktailID: number}): Promise<RemoveFavResponse> => {
    const response = await apiClient.post('/removeFav', data);
    return response.data;
}

export const getFavAPI = async (userID: number, cocktailID: number): Promise<GetFavResponse> => {
    const response = await apiClient.get(`/favorite/${userID}/${cocktailID}`);
    return response.data;
}

export const getFiveFavCocktailsAPI = async (data: {userID: number}): Promise<GetFavCocktail> => {
    const response = await apiClient.post('/cocktail/get_five_fav_cocktails', data);
    return response.data;
}
