import { CocktailResponse } from "./CommonResponse";

export interface GetHistoryResponse {
    message: string;
    history: CocktailResponse;
}

export interface GetFavCocktail {
    message: string;
    favCocktail: CocktailResponse;
}
