import axios from "axios";
import { Cocktail } from '@/types/stores/CommonStore';
import { registerCocktailResponse } from "@/types/responses/common";

const CommonUtils = {
    async registerCocktail (cocktailData: Cocktail): Promise<void> {
        const token: string | null = localStorage.getItem('auth_token');
        const response = await axios.post<registerCocktailResponse>('http://127.0.0.1:8000/api/registerCocktail', {
            cocktailData: cocktailData,
            },
            {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                }
            }
        );
        console.log(response.data);
    }
};

export default CommonUtils;
