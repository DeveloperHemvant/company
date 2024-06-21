import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/scripts.js',
                'resources/css/custom.css',
                'resources/slick/slick.css',
                'resources/slick/slick-theme.css',
                'resources/slick/slick.min.js'                                                                                                  
            ],
            refresh: true,
        }),
       
        
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/images/*',
                    dest: 'images'
                }
            ]
        }),
    ],
    // build: {
    //     manifest: true,
    //     outDir: 'public/build',
    //     rollupOptions: {
    //         output: {
    //             chunkFileNames: 'js/[name].[hash].js',
    //             entryFileNames: 'js/[name].[hash].js',
    //             assetFileNames: (assetInfo) => {
    //                 let extType = assetInfo.name.split('.').pop();
    //                 if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
    //                     return 'images/[name].[hash].[ext]';
    //                 }
    //                 return '[ext]/[name].[hash].[ext]';
    //             },
    //         },
    //     },
    // },
});
