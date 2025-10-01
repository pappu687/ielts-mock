import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import * as packages from './package.json';
import fsExtra from 'fs-extra'; // Import fs-extra as a default import
import { join } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/sass/app.scss', 
                'resources/js/app.js',                
            ],
            refresh: true,
        }),
        tailwindcss(),

        viteStaticCopy({
            targets: [
              {
                src: ([
                  'resources/assets/images/',
                  'resources/assets/audio/',
                  'resources/assets/video/',
                  'resources/assets/icon-fonts/',
                  'resources/assets/js/main.js',
                  'resources/assets/js/sticky.js',
                  'resources/assets/js/chat.js',
                  'resources/assets/js/show-password.js',
                  'resources/assets/js/coming-soon.js',
                  'resources/assets/js/two-step-verification.js',
                  'resources/assets/js/authentication-main.js',
                  'resources/assets/js/apex-github-data.js',
                  'resources/assets/js/apexcharts-candlestick-seriesdata.js',
                  'resources/assets/js/apexcharts-irregulardata.js',
                  'resources/assets/js/apexcharts-stock-prices.js',
                  'resources/assets/js/apexcharts-dayjs.js',
                  'resources/assets/js/dataseries.js',
                  'resources/assets/js/form-wizard.js',
                ]),
                dest: 'assets/'
              }
            ]
        }),
  
        {
          // Use a custom plugin for copying distribution files
          name: 'copy-dist-files',
          writeBundle: async () => {
            const destDir = 'public/build/assets/libs';  // Update the destination directory
    
            for (const dep of Object.keys(packages.dependencies)) {
              const srcPath = join('node_modules', dep, 'dist');
              const destPath = join(destDir, dep);
    
              // Check if the 'dist' directory exists for the dependency
              if (await fsExtra.pathExists(srcPath)) {
                // Copy the distribution files (contents of 'dist') to the destination directory
                await fsExtra.copy(srcPath, destPath, {
                  overwrite: true,
                  recursive: true,
                });
    
                // Remove the 'dist' directory from the destination
                await fsExtra.remove(join(destPath, 'dist'));
              } else {
                // If 'dist' folder doesn't exist, check if the package itself exists and copy it.
                const packageSrcPath = join('node_modules', dep);
                const packageDestPath = join(destDir, dep);
    
                if (await fsExtra.pathExists(packageSrcPath)) {
                  await fsExtra.copy(packageSrcPath, packageDestPath, {
                    overwrite: true,
                    recursive: true,
                  });
                }
              }
            }
          },
        },
  
        {
          name: 'blade',
          handleHotUpdate({ file, server }) {
            if (file.endsWith('.blade.php')) {
            server.ws.send({
                type: 'full-reload',
                path: '*',
            });
            }
          },
        }

    ],
    build: {
        chunkSizeWarningLimit: 1600,
        outDir: 'public/build',
        emptyOutDir: true,
    },
});
