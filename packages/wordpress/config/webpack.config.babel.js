'use strict';

import BrowserSyncPlugin from 'browser-sync-webpack-plugin';
import CleanWebpackPlugin from 'clean-webpack-plugin';
import CopyWebpackPlugin from 'copy-webpack-plugin';
import Dotenv from 'dotenv-webpack';
import incstr from 'incstr';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import OptimizeCSSAssetsPlugin from 'optimize-css-assets-webpack-plugin';
import path from 'path';
import safePostCssParser from 'postcss-safe-parser';
import TerserPlugin from 'terser-webpack-plugin';

import paths from './paths';

const entry = {
  'style': paths.source + '/assets/scss/style.scss',
  'vendors': paths.source + '/assets/js/vendors.js',
};
const output = {
  path: process.env.NODE_ENV !== 'production' ? paths.build : paths.dist,
  filename: 'assets/js/[name].js',
};
const rules = [
  // js, jsx, ts, tsx
  {
    test: /\.(j|t)s(x)?$/,
    exclude: /node_modules/,
    use: [
      {
        loader: 'babel-loader',
      },
    ],
  },
  // images
  {
    test: /\.(png|svg|jpg|gif)$/,
    use: [
      {
        'loader': 'file-loader',
        'options': {
          name: '[path][name].[ext]',
          context: paths.source,
        },
      },
    ],
  },
  // fonts
  {
    test: /\.(ttf|eot|woff|woff2)$/,
    use: {
      loader: 'file-loader',
      options: {
        name: '[path][name].[ext]',
        context: paths.source,
      },
    },
  },
  // scss
  {
    test: /\.(p|s)?css$/,
    use: [
      MiniCssExtractPlugin.loader,
      {
        loader: 'css-loader',
        options: {
          camelCase: true,
          sourceMap: process.env.NODE_ENV !== 'production' ? true : false,
          importLoaders: 2,
        },
      },
      {
        loader: 'postcss-loader',
        options: {
          plugins: [require('autoprefixer')({
            browsers: [
              'last 2 versions',
              'ie >= 9',
              'android >= 4.4',
              'ios >= 7',
            ],
          })],
          sourceMap: process.env.NODE_ENV !== 'production' ? true : false,
        },
      },
      {
        loader: 'sass-loader',
        options: {
          includePaths: [
            path.resolve(__dirname, '../node_modules'),
            path.resolve(__dirname, '../node_modules/foundation-sites/scss'),
          ],
          sourceMap: process.env.NODE_ENV !== 'production' ? true : false,
        },
      },
    ],
  },
];
const modules = {
  rules,
};
const resolve = {
  modules: ['node_modules'],
  extensions: [
    '*', '.js', '.jsx', '.ts', '.tsx', '.scss', '.pcss',
  ],
};
const performance = {};
const externals = {
  jquery: 'jQuery',
};
const plugins = [
  new BrowserSyncPlugin({
    host: process.env.HOST || '0.0.0.0',
    port: process.env.WEB_PORT || 4000,
    proxy: process.env.PROXY ? process.env.PROXY : null,
    open: true,
  }),
  new CleanWebpackPlugin({
    // cleanStaleWebpackAssets: false,
    cleanAfterEveryBuildPatterns: [
      '!**/*.php',
      '!/assets/**/*',
    ],
  }),
  new CopyWebpackPlugin([
    paths.source + '/**/*.json',
    paths.source + '/**/*.php',
    paths.source + '/screenshot.*',
    paths.source + '/assets/fonts/**/*',
    paths.source + '/assets/img/**/*',
  ], {
    context: 'src',
  }),
  new Dotenv({
    path: paths.envfile,
  }),
  new MiniCssExtractPlugin({
    filename: 'style.css',
    chunkFilename: process.env.NODE_ENV !== 'production' ?
      'assets/css/[id].css' : 'assets/css/[id].[hash].css',
  }),
];
const optimization = {
  minimize: process.env.NODE_ENV === 'production' ? true : false,
  minimizer: [
    new TerserPlugin({
      terserOptions: {
        parse: {
          ecma: 8,
        },
        compress: {
          ecma: 5,
          warnings: false,
          comparisons: false,
          inline: 2,
        },
        mangle: {
          safari10: true,
        },
        output: {
          ecma: 5,
          comments: false,
          ascii_only: true,
        },
      },
      parallel: true,
      cache: true,
      sourceMap: process.env.NODE_ENV !== 'production' ? true : false,
    }),
    // This is only used in production mode
    new OptimizeCSSAssetsPlugin({
      cssProcessorOptions: {
        parser: safePostCssParser,
        map: process.env.NODE_ENV !== 'production' ? true : false
          ? {
            inline: false,
            annotation: true,
          }
          : false,
      },
    }),
  ],
  splitChunks: {
    chunks: 'async',
    minSize: 30000,
    maxSize: 0,
    minChunks: 1,
    maxAsyncRequests: 5,
    maxInitialRequests: 3,
    automaticNameDelimiter: '~',
    name: true,
    cacheGroups: {
      vendors: {
        test: /[\\/]node_modules[\\/]/,
        priority: -10,
      },
      default: {
        minChunks: 2,
        priority: -20,
        reuseExistingChunk: true,
      },
    },
  },
};
const watchOptions = {
  ignored: [
    'node_modules',
    'wp-data',
    'wp-plugins',
    'wp-uploads',
  ],
};
const devServer = {
  // contentBase: paths.build,
  // compress: true,
  // port: process.env.WEB_PORT,
  // historyApiFallback: true,
  // open: true,
  // hot: true,
};

const webpackConfig = {
  mode: process.env.NODE_ENV || 'development',
  context: path.resolve(__dirname, '../'),
  entry: entry,
  output: output,
  optimization: optimization,
  module: modules,
  resolve: resolve,
  performance: performance,
  devtool: process.env.NODE_ENV === 'production' ? false : 'inline-source-map',
  target: 'web',
  externals: externals,
  stats: 'errors-only',
  plugins: plugins,
  devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  cache: true,
};

export default webpackConfig;
