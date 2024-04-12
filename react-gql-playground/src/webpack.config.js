const path = require('path');

module.exports = {
 entry: './src/index.js',
 output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'bundle.js',
 },

 module: {
  rules: [
    {
      test: /standalone\.js$/,
      use: 'null-loader',
    },
    {
      test: /\.js$/,
      exclude: /(node_modules|bower_components)/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env'],
        },
      },
    },
  ],
},
  
 resolve: {
    extensions: ['.js', '.jsx'],
 },
 mode: 'development', // Set mode to development or production as needed
};
