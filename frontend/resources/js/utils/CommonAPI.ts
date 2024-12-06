import axios from 'axios';

// Axiosインスタンスを作成
const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // バックエンドのベースURL
    headers: {
        'Content-Type': 'application/json',
    },
});

// リクエストにトークンを付与する (認証が必要な場合)
apiClient.interceptors.request.use((config) => {
    const token = localStorage.getItem('auth_token');
    if (token) {
    config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default apiClient;
