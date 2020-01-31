/* eslint "import/no-extraneous-dependencies": ["error", {"optionalDependencies": false} ] */
const Path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const HtmlVariablesPlugin = require('html-variables-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
  entry: {
    app: [Path.resolve(__dirname, '../src/index.js')]
  },
  output: {
    path: Path.join(__dirname, '../dist'),
    filename: 'assets/js/[name].js'
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /node_modules/,
          chunks: 'initial',
          name: 'vendor',
          enforce: true
        }
      }
    }
  },
  plugins: [
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: [Path.join(__dirname, '../dist/**/*')]
    }),
    new CopyWebpackPlugin([
      { from: Path.resolve(__dirname, '../src/assets/images'), to: 'assets/images', ignore: ['**/.DS_Store'] },
      { from: Path.resolve(__dirname, '../src/manifest.json'), to: './' }
    ]),
    new VueLoaderPlugin(),
    new HtmlWebpackPlugin({
      template: Path.resolve(__dirname, '../src/index.html'),
      minify: {
        removeComments: true,
        collapseWhitespace: true,
        removeAttributeQuotes: true
      }
    }),
    new HtmlVariablesPlugin(process.env)
  ],
  resolve: {
    extensions: ['*', '.js', '.vue', '.json', '.scss'],
    alias: {
      '~': Path.resolve(__dirname, '../src'),
      '@app': Path.resolve(__dirname, '../src/App.vue'),
      '@components': Path.resolve(__dirname, '../src/components'),
      '@constants': Path.resolve(__dirname, '../src/constants'),
      '@data': Path.resolve(__dirname, '../src/data'),
      '@images': Path.resolve(__dirname, '../src/assets/images'),
      '@pages': Path.resolve(__dirname, '../src/pages'),
      '@polyfills': Path.resolve(__dirname, '../src/polyfills'),
      '@router': Path.resolve(__dirname, '../src/router'),
      '@style': Path.resolve(__dirname, '../src/assets/scss'),
      '@services': Path.resolve(__dirname, '../src/services'),
      '@utils': Path.resolve(__dirname, '../src/utils')
    }
  },
  module: {
    rules: [
      {
        test: /\.(html|htm)(\?.*)?$/,
        loader: 'html-loader'
      },
      {
        test: /\.(png|jpe?g|gif|svg|ico)(\?.*)?$/,
        loader: 'url-loader',
        exclude: [
          Path.resolve(__dirname, '../src/assets/fonts')
        ],
        options: {
          limit: -1,
          name: 'assets/images/[ext]/[name].[hash:7].[ext]',
          esModule: false // to solve [object Module] url in html
        }
      },
      {
        test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: -1,
          name: 'assets/media/[name].[hash:7].[ext]'
        }
      },
      {
        test: /\.(woff2?|eot|ttf|otf|svg)(\?.*)?$/,
        loader: 'url-loader',
        exclude: [
          Path.resolve(__dirname, '../src/assets/images')
        ],
        options: {
          limit: -1,
          name: 'assets/fonts/[name].[hash:7].[ext]'
        }
      }
    ]
  }
};
