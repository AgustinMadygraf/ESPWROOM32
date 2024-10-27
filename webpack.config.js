// webpack.config.js
const webpack = require('webpack');
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js') // Mantener esta para tu JS principal
    .addEntry('vue_app', './assets/js/vue_app.js') // Agregar esta línea para el archivo Vue
    .addStyleEntry('global', './assets/css/global.scss') // Para estilos globales
    .enableVueLoader() // Habilitar soporte para Vue
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .autoProvidejQuery()
    .addPlugin(new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
    }));

module.exports = Encore.getWebpackConfig();
