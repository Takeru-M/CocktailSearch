import axios from "axios";

const CommonUtils = {
    async registerCocktail (cocktailData) {
        const token = localStorage.getItem('auth_token');
        const response = await axios.post('http://127.0.0.1:8000/api/registerCocktail', {
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
