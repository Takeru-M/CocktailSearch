import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'

export default defineConfig({
    server: {
      host: '0.0.0.0',
      port: 5173,
      strictPort: true, // ポートが占有されている場合はエラーを出す

      // Nginxなどのリバースプロキシ経由でアクセスされることを Vite に伝えます。
      // これがないと、ViteはセルフホストのURLを使用しようとし、HMRが失敗します。
      hmr: {
          host: 'localhost', // Nginxにアクセスするホスト名（ブラウザから見える名前）
          port: 5173,        // Nginxでプロキシしているポート
          protocol: 'ws'     // WebSocketプロトコルを使用
      },
      // Dockerコンテナ内で外部からのアクセスを許可するために0.0.0.0でリッスン
      host: '0.0.0.0',
      port: 5173,
      // Vite開発サーバーが使用するオリジンを明示的に指定
      strictPort: true,
      // Nginxのプロキシ設定に基づき、外部アクセス可能なホスト名を指定
      // これにより、Viteは正しいHMR接続URLを生成できます
      // Nginxの設定で使われているホスト名と同じものを設定することが多い
      origin: 'http://localhost:5173',
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.ts',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        AutoImport({
            resolvers: [ElementPlusResolver()],
        }),
        Components({
            resolvers: [ElementPlusResolver()],
        }),
    ],
    test: {
        globals: true,
        environment: 'jsdom',
        setupFiles: './tests/setup.ts',
        include: ['**/*.spec.ts'],
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    // root: 'frontend',
    base: '/',
    build: {
        outDir: './public/build',
        assetsDir: 'assets',
    },
});
