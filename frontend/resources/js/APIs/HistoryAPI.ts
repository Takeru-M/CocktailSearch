import apiClient from "./CommonAPI";
import { RegisterHistory } from "@/types/responses/SearchCocktailResultResponse";
import { GetHistoryResponse } from "@/types/responses/AccountResponse";

export const registerHistoryAPI = async (data: {userID: number, cocktailID: number}): Promise<RegisterHistory> => {
    const response = await apiClient.post<RegisterHistory>('/history', data);
    return response.data;
}

export const getFiveHistoriesAPI = async(data: {userID: number}): Promise<GetHistoryResponse> => {
    const response = await apiClient.post('/cocktail/get_five_histories', data);
    return response.data;
}
