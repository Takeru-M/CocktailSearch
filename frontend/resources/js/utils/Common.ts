import axios from "axios";
import { Cocktail } from '@/types/stores/CommonStore';
import { registerCocktailResponse } from "@/types/responses/Common";
import { getCocktailAPI, registerCocktailAPI } from "./CocktialAPI";

const CommonUtils = {
    async registerCocktail (cocktailData: Cocktail): Promise<void> {
        // const token: string | null = localStorage.getItem('auth_token');
        const response = await registerCocktailAPI({
            cocktailData: cocktailData
        })
        console.log(response.message);
    }
};

export default CommonUtils;
