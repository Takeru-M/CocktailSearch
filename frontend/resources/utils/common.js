const CommonUtils = {
    async registerCocktail (cocktailData) {
        const response = await axios.post('http://127.0.0.1:8000/api/registerCocktail', {
            cocktailData: cocktailData
            });
            console.log(response.data);
    }
}

export default CommonUtils;
