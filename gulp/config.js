'use strict';

import CleanWebpackPlugin from 'clean-webpack-plugin';
import dotenv from 'dotenv';
import Dotenv from 'dotenv-webpack';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import NpmInstallPlugin from 'npm-install-webpack-plugin';
import path from 'path';

dotenv.config({
  path: path.resolve(__dirname, '../env/.env'),
});

const config = {};

config.paths = {
  SOURCE: path.resolve(__dirname, '../src'),
  BUILD: path.resolve(__dirname, '../dist'),
  DOCS: path.resolve(__dirname, '../docs'),
};

config.server = {
  server: {
    baseDir: config.paths.BUILD,
  },
  port: process.env.PORT,
  https: false,
  open: false,
  cors: true,
};

const entry = {
  react: config.paths.SOURCE + '/index.js',
  vendors: config.paths.SOURCE + '/assets/js/vendors.js',
};
const output = {
  filename: 'assets/js/[name].js',
  chunkFilename: 'assets/js/[name].js',
  publicPath: '/',
};
const modules = {
  rules: [
    {
      test: /\.ts(x)?$/,
      exclude: /node_modules/,
      use: [
        {
          loader: 'awesome-typescript-loader',
          options: {
            'useBabel': true,
            'babelCore': '@babel/core',
          },
        },
      ],
    },
    {
      test: /\.js(x)?$/,
      enforce: 'pre',
      exclude: /node_modules/,
      use: [
        'babel-loader',
        // 'jshint-loader',
      ],
    },
    {
      test: /\.(s)?css$/,
      use: [
        /* process.env.NODE_ENV !== 'production' ? 'style-loader' :*/ MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            importLoaders: 1,
          },
        },
        {
          'loader': 'postcss-loader',
          'options': {
            plugins: [require('autoprefixer')({
              browsers: ['last 2 versions', 'ie >= 9', 'android >= 4.4', 'ios >= 7'],
            })],
            sourceMap: true,
          },
        },
        {
          loader: 'sass-loader',
          options: {
            includePaths: [path.resolve(__dirname, '../node_modules/foundation-sites/scss')],
          },
        },
      ],
    },
  ],
};
const resolve = {
  alias: {
    config: path.resolve(__dirname, '../environments/config.js'),
    logger: path.resolve(__dirname, '../src/logger/logger.js'),
  },
  extensions: [
    '*', '.js', '.jsx', '.ts', '.tsx',
  ],
};
const plugins = [
  new CleanWebpackPlugin(
      [
        config.paths.BUILD,
        config.paths.DOCS,
      ], {
        root: path.resolve(__dirname, '../'),
      }
  ),
  new HtmlWebpackPlugin({
    filename: 'index.html',
    template: config.paths.SOURCE + '/views/index.html',
  }),
  // new NpmInstallPlugin(),
  new MiniCssExtractPlugin({
    filename: 'style.css',
    chunkFilename: 'assets/css/[name].[hash].css',
  }),
  new Dotenv({
    path: path.resolve(__dirname, '../env/.env'),
  }),
];
const optimization = {
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
  ],
};
const devServer = {
  contentBase: config.paths.BUILD,
  compress: true,
  port: process.env.PORT,
  historyApiFallback: true,
  open: true,
};

config.webpack = {
  mode: process.env.NODE_ENV,
  entry: entry,
  output: output,
  module: modules,
  resolve: resolve,
  plugins: plugins,
  optimization: optimization,
  // devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  devtool: 'eval-source-map',
};

export default config;
