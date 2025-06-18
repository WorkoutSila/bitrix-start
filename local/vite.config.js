import { defineConfig } from 'vite';
import { AntDesignVueResolver } from 'unplugin-vue-components/resolvers';
import path from 'path';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'
import ElementPlus from 'unplugin-element-plus/vite'


export default defineConfig({
    base: '/local/dist/',
    build: {
        outDir: './dist', // Папка сборки
    },

    plugins: [
        laravel({
            input: ['css/main.scss', 'js/main.js'],
            refresh: true,
            publicDirectory: './dist',
        }),
        vue(),
        tailwindcss(),
        ElementPlus(),
        AutoImport({
            resolvers: [ElementPlusResolver()],
        }),
        Components({
            resolvers: [ElementPlusResolver()],
        }),
    ],

    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            js: path.resolve(__dirname, './js')
        },
    },
    server: {
        headers: {
            "Access-Control-Allow-Origin": "*",

        },
        watch: {
            ignored: '**/*.php'
        }
    }
});
