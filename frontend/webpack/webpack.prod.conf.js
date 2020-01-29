/* eslint "import/no-extraneous-dependencies": ["error", {"optionalDependencies": false} ] */
const Path = require('path');
const fs = require('fs');
const Webpack = require('webpack');
const merge = require('webpack-merge');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const PrerenderSpaPlugin = require('prerender-spa-plugin');
const WorkboxPlugin = require('workbox-webpack-plugin');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');
const dotenv = require('dotenv');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');

const baseWebpackConfig = require('./webpack.base.conf');
const getClientEnvironment = require('./utils/env');
const routes = require('../src/router/routes.json');

const Renderer = PrerenderSpaPlugin.PuppeteerRenderer;
const prerenderPath = Object.keys(routes).map((key) => routes[key]);

// https://github.com/bkeepers/dotenv#what-other-env-files-can-i-use
const dotenvFiles = [
  Path.resolve(__dirname, '../.env.production.local'),
  Path.resolve(__dirname, '../.env.production'),
  Path.resolve(__dirname, '../.env')
].filter((dotenvFile) => fs.existsSync(dotenvFile));

console.log(`${dotenvFiles[0]} will be used.\n`);

// Load env variables
dotenv.config({
  path: dotenvFiles[0]
});

const clientEnv = getClientEnvironment('production');

module.exports = merge(baseWebpackConfig, {
  mode: 'production',
  // devtool: 'source-map',
  stats: 'errors-only',
  bail: true,
  output: {
    path: Path.join(__dirname, `../dist${process.env.VUE_APP_CONTEXT}`),
    filename: 'assets/js/[name].[chunkhash:8].js',
    chunkFilename: 'assets/js/[name].[chunkhash:8].chunk.js',
    publicPath: process.env.VUE_APP_CONTEXT
  },
  plugins: [
    new Webpack.DefinePlugin(clientEnv.stringified),
    new Webpack.optimize.ModuleConcatenationPlugin(),
    new MiniCssExtractPlugin({
      filename: 'assets/css/bundle.css'
    }),
    new PrerenderSpaPlugin({
      staticDir: Path.join(__dirname, '../dist'),
      indexPath: Path.join(__dirname, `../dist${process.env.VUE_APP_CONTEXT}index.html`),
      outputDir: Path.join(__dirname, `../dist${process.env.VUE_APP_CONTEXT}`),
      routes: prerenderPath,
      renderer: new Renderer({
        renderAfterElementExists: '.page-content',
        args: [
          '--disable-web-security' // To solve CORS issue when rendering API
        ],
        inject: {
          disableInPrerender: true
        }
      })
      // postProcess(renderedRoute) {
      //   renderedRoute.html = renderedRoute.html.replace(/<script (.*?)src="(.*?)google(.*?)"(.*?)><\/script>/g, '');
      //   return renderedRoute;
      // }
    }),
    new WorkboxPlugin.GenerateSW({
      clientsClaim: true,
      skipWaiting: true,
      globIgnores: ['**/.DS_Store'],
      runtimeCaching: [
        {
          urlPattern: /^https:\/\/pinkylam\.me\/playground\/wuhan-pneumonia\/api\/(live-data|historical-data).*/,
          handler: 'NetworkFirst'
        }
      ]
    }),
    new BundleAnalyzerPlugin({
      analyzerMode: 'static',
      reportFilename: Path.join(__dirname, '../bundle-analyzer-plugin-report.html')
    })
  ],
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.(js)$/,
        exclude: /node_modules/,
        use: 'babel-loader'
      },
      {
        test: /\.s?css/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../../'
            }
          },
          {
            loader: 'css-loader'
          },
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [
                autoprefixer(),
                cssnano(
                  {
                    preset: ['default', {
                      discardComments: {
                        removeAll: true
                      }
                    }]
                  }
                )
              ]
            }
          },
          {
            loader: 'sass-loader'
          }
        ]
      }
    ]
  }
});
