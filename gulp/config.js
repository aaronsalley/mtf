'use strict';

import CleanWebpackPlugin from 'clean-webpack-plugin';
import dotenv from 'dotenv';
import Dotenv from 'dotenv-webpack';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import NpmInstallPlugin from 'npm-install-webpack-plugin';
import path from 'path';
import webpack from 'webpack';

const config = {
  webpack: {
    web: {},
    backend: {},
  },
};

config.envfile = path.resolve(__dirname, '../.env');

dotenv.config({
  path: config.envfile,
});

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

let web = {};
web.entry = {
  react: config.paths.SOURCE + '/web/index.js',
  vendors: config.paths.SOURCE + '/web/assets/js/vendors.js',
};
web.output = {
  filename: 'assets/js/[name].js',
  chunkFilename: 'assets/js/[name].js',
  publicPath: '/',
};
web.plugins = [
  new HtmlWebpackPlugin({
    filename: 'index.html',
    template: config.paths.SOURCE + '/web/views/index.html',
  }),
];

let api = {};
api.entry = {
  api: config.paths.SOURCE + '/api/index.js',
};
api.output = {
  filename: '[name].js',
  chunkFilename: '[name].js',
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
    {
      test: /\.(png|svg|jpg|gif)$/,
      use: [
        {
          'loader': 'file-loader',
          'options': {
            useRelativePath: true,
            name: '[name].[ext]',
            context: 'src/web/',
            publicPath: 'assets/img/',
          },
        },
      ],
    },
  ],
};
const resolve = {
  extensions: [
    '*', '.js', '.jsx', '.ts', '.tsx',
  ],
};
const plugins = [
  new webpack.NoEmitOnErrorsPlugin(),
  new CleanWebpackPlugin(
      [
        config.paths.BUILD + '**/*',
        config.paths.DOCS,
      ], {
        root: path.resolve(__dirname, '../'),
      }
  ),
  // new NpmInstallPlugin(),
  new MiniCssExtractPlugin({
    filename: 'style.css',
    chunkFilename: 'assets/css/[name].[hash].css',
  }),
  new Dotenv({
    path: config.envfile,
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
  contentBase: config.paths.BUILD + '/web',
  compress: true,
  port: process.env.PORT,
  historyApiFallback: true,
  open: true,
};

const webpackBase = {
  mode: process.env.NODE_ENV,
  module: modules,
  resolve: resolve,
  plugins: plugins,
  optimization: optimization,
  // devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  devtool: 'eval-source-map',
  stats: {
    warnings: false,
  },
};

config.webpack.web = {...web, ...webpackBase};
config.webpack.api = {...api, ...webpackBase};

export default config;
