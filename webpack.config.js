// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableSingleRuntimeChunk()
    .addEntry('app', './assets/js/app.js')
    .addEntry('vue_app', './assets/js/vue_app.js') // Asegúrate de agregar esta línea
    .addStyleEntry('global', './assets/css/global.scss')
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();