import { Cocktail } from '@/types/stores/CommonStore';
import { registerCocktailAPI } from "../APIs/CocktialAPI";

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
