import apiClient from "./CommonAPI";
import { Login } from "@/types/responses/LoginResponse";
import { Signin } from "@/types/responses/SigninResponse";
import { LogoutResponse } from "@/types/responses/HeaderResponse";

export const loginAPI = async (data: { email: string; password: string }): Promise<Login> => {
    const response = await apiClient.post<Login>('/login', data);
    return response.data;
};

export const signinAPI = async (data: { name: string, email: string; password: string }): Promise<Signin> => {
    const response = await apiClient.post<Signin>('/signin', data);
    return response.data;
};

export const logoutAPI = async (): Promise<LogoutResponse> => {
    const response = await apiClient.post('/logout');
    return response.data;
}
