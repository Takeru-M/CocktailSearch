import { FavoriteResponse } from "./CommonResponse";

export interface RegisterFavResponse {
    message: string;
}

export interface RemoveFavResponse {
    message: string;
}

export interface GetFavResponse {
    message: string;
    isFav: boolean;
}
