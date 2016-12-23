const path = require('path');

const basePath = path.resolve(__dirname, 'resources/assets');

module.exports = {
    entry: './resources/assets/js/app.js',
    output: {
        path: path.resolve(__dirname, 'public/build'),
        filename: 'app.js',
    },
    module: {
        loaders: [{
            test: /\.vue$/, 
            use: ['vue-loader'], 
            include: [basePath],
        }, {
            test: /\.ts$/,
            use: [{
                loader: 'ts-loader',
                options: {
                    appendTsSuffixTo: [/\.vue$/],
                },
            }], 
            include: [basePath],
        }, {
            test: /\.js$/, 
            use: ['babel-loader'], 
            include: [basePath],
        }],
    },
    resolve: {
        extensions: ['.js', '.ts', '.vue'],
    },
};