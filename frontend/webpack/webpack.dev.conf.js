/* eslint "import/no-extraneous-dependencies": ["error", {"optionalDependencies": false} ] */
const Path = require('path');
const fs = require('fs');
const Webpack = require('webpack');
const merge = require('webpack-merge');
const dotenv = require('dotenv');
const autoprefixer = require('autoprefixer');

const baseWebpackConfig = require('./webpack.base.conf');
const getClientEnvironment = require('./utils/env');

// https://github.com/bkeepers/dotenv#what-other-env-files-can-i-use
const dotenvFiles = [
  Path.resolve(__dirname, '../.env.development.local'),
  Path.resolve(__dirname, '../.env.test.local'),
  Path.resolve(__dirname, '../.env.local'),
  Path.resolve(__dirname, '../.env.development'),
  Path.resolve(__dirname, '../.env.test'),
  Path.resolve(__dirname, '../.env')
].filter((dotenvFile) => fs.existsSync(dotenvFile));

console.log(`${dotenvFiles[0]} will be used.\n`);

// Load env variables
dotenv.config({
  path: dotenvFiles[0]
});

const clientEnv = getClientEnvironment('development');

module.exports = merge(baseWebpackConfig, {
  mode: 'development',
  devtool: 'cheap-eval-source-map',
  output: {
    chunkFilename: 'js/[name].chunk.js'
  },
  devServer: {
    inline: true,
    host: '0.0.0.0',
    port: 8888,
    overlay: {
      warnings: false,
      errors: true
    }
  },
  plugins: [
    new Webpack.DefinePlugin(clientEnv.stringified)
  ],
  module: {
    rules: [
      {
        test: /\.(js|vue)$/,
        include: Path.resolve(__dirname, '../src'),
        enforce: 'pre',
        loader: 'eslint-loader',
        options: {
          emitWarning: true
        }
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.(js)$/,
        include: Path.resolve(__dirname, '../src'),
        loader: 'babel-loader'
      },
      {
        test: /\.s?css$/i,
        use: [
          'style-loader',
          'css-loader?sourceMap=true',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [
                autoprefixer()
              ]
            }
          },
          'sass-loader?sourceMap=true'
        ]
      }
    ]
  }
});
