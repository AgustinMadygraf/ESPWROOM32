// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    // Directorio donde se generarán los archivos compilados
    .setOutputPath('public/build/')
    // Ruta pública utilizada por Symfony para acceder a los archivos
    .setPublicPath('/build')
    // Habilitar Single Runtime Chunk
    .enableSingleRuntimeChunk()
    // Otras configuraciones de Encore...
    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('global', './assets/css/global.scss')
    // Habilitar Sass/SCSS
    .enableSassLoader()
    // Habilitar la generación de archivos de fuente
    .enableSourceMaps(!Encore.isProduction())
    // Habilitar la versión de archivos (hashing)
    .enableVersioning(Encore.isProduction())
    // Otras configuraciones adicionales...
;

module.exports = Encore.getWebpackConfig();