// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.js')
    .addStyleEntry('global', './assets/css/global.scss') // para estilos globales
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader() // Habilitar Sass
    .autoProvidejQuery(); // Agregar jQuery automáticamente

module.exports = Encore.getWebpackConfig();
