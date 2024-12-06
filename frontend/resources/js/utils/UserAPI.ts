import apiClient from "./CommonAPI";
import { GetUser } from "@/types/responses/AccountResponse";

export const getUser = async (userId: number): Promise<any> => {
    return await apiClient.get(`/user/${userId}`);
};

export const createUser = async (data: { name: string; email: string; password: string }): Promise<any> => {
    return await apiClient.post('/user', data);
};

export const getUserAPI = async (userID: number): Promise<GetUser> => {
    const response = await apiClient.get<GetUser>(`/user/${userID}`);
    return response.data;
};
