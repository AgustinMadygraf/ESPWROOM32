// webpack.config.js
const webpack = require('webpack');
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //.addEntry('app', './assets/js/app.js')
    .addEntry('vue_app', './assets/js/vue_app.js')
    .addStyleEntry('global', './assets/css/global.scss')
    .enableVueLoader()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .autoProvidejQuery()
    .addPlugin(new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
    }));

module.exports = Encore.getWebpackConfig();
