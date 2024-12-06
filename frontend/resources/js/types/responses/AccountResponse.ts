import { CocktailResponse, UserResponse } from "./CommonResponse";

export interface GetHistoryResponse {
    message: string;
    history: CocktailResponse[] | null;
}

export interface GetFavCocktail {
    message: string;
    favCocktail: CocktailResponse[] | null;
}

export interface GetUser {
    message: string;
    user: UserResponse;
}
