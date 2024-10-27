// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .enableVueLoader()  // Agrega esto para activar Vue en Webpack
    .enableSingleRuntimeChunk();

module.exports = Encore.getWebpackConfig();