'use strict';

import CleanWebpackPlugin from 'clean-webpack-plugin';
import dotenv from 'dotenv';
import Dotenv from 'dotenv-webpack';
import historyApiFallback from 'connect-history-api-fallback';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import incstr from 'incstr';
import JsDocPlugin from 'jsdoc-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import path from 'path';
import webpack from 'webpack';

const createUniqueIdGenerator = () => {
  const index = {};
  const generateNextId = incstr.idGenerator({
    alphabet: 'abcefghijklmnopqrstuvwxyz0123456789',
  });

  return (name) => {
    if (index[name]) {
      return index[name];
    }

    let nextId;
    do {
      nextId = generateNextId();
    } while (/^[0-9]/.test(nextId));

    index[name] = generateNextId();

    return index[name];
  };
};

const uniqueIdGenerator = createUniqueIdGenerator();

const generateScopedName = (localName, resourcePath) => {
  const componentFile = resourcePath.split('/').slice(-1);
  const componentName = componentFile.toString().split('.').slice(0, 1);

  if (process.env.NODE_ENV !== 'production') {
    return localName;
  } else {
    return uniqueIdGenerator(componentName) + '_' + uniqueIdGenerator(localName);
  }
};

const config = {
  webpack: {
    web: {},
    backend: {},
  },
  server: {
    react: {},
    wordpress: {},
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

config.server.react = {
  server: {
    baseDir: config.paths.BUILD,
    middleware: [historyApiFallback()],
    index: 'index.html',
  },
  port: process.env.WEB_PORT,
  browser: 'Google Chrome',
  open: false,
  cors: true,
  ui: false,
};
config.server.wordpress = {
  proxy: process.env.WP_SERVER,
  browser: 'Google Chrome',
  open: true,
  https: true,
  ui: false,
};

const modules = {
  rules: [
    // {
    //   enforce: 'pre',
    //   test: /\.js$/,
    //   use: 'eslint-loader',
    // },
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
        {
          loader: 'babel-loader',
          options: {
            babelrc: false,
            extends: path.resolve(__dirname, '../.babelrc'),
            plugins: [
              [
                'react-css-modules',
                {
                  'filetypes': {
                    '.scss': {
                      'syntax': 'postcss-scss',
                    },
                  },
                  generateScopedName,
                  'handleMissingStyleName': 'throw',
                },
              ],
            ],
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
            context: 'src/**',
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
  contentBase: config.paths.BUILD,
  compress: true,
  port: process.env.WEB_PORT,
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
  target: 'node',
  stats: {
    warnings: false,
  },
  cache: true,
};
let web = {};
web.entry = {
  react: config.paths.SOURCE + '/index.tsx',
  vendors: config.paths.SOURCE + '/assets/js/vendors.js',
};
web.output = {
  filename: 'assets/js/[name].js',
  chunkFilename: 'assets/js/[name].js',
  publicPath: '/',
};
web.module = {
  rules: [
    {
      test: /\.(s)?css$/,
      use: [
        // process.env.NODE_ENV !== 'production' ?
        //   'style-loader' :
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            modules: true,
            camelCase: true,
            getLocalIdent: (context, localIdentName, localName) => {
              return generateScopedName(localName, context.resourcePath);
            },
            localIdentName: '[name]_[local]_[hash:base64:5]',
            sourceMap: true,
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
            sourceMap: true,
          },
        },
        {
          loader: 'sass-loader',
          options: {
            includePaths: [
              path.resolve(__dirname, '../node_modules'),
              path.resolve(__dirname, '../node_modules/foundation-sites/scss'),
            ],
            sourceMap: true,
          },
        },
      ],
    },
    ...modules.rules,
  ],
};
web.plugins = [
  new HtmlWebpackPlugin({
    filename: 'index.html',
    template: config.paths.SOURCE + '/index.html',
  }),
  new MiniCssExtractPlugin({
    filename: 'style.css',
    chunkFilename: process.env.NODE_ENV !== 'production' ?
      'assets/css/[id].css' : 'assets/css/[id].[hash].css',
  }),
  ...plugins,
];

let api = {};
api.entry = {
  api: config.paths.SOURCE + '/react/config/server.ts',
};
api.output = {
  filename: 'assets/js/[name].js',
  chunkFilename: 'assets/js/[name].js',
  publicPath: '/',
};

config.webpack.web = {...webpackBase, ...web};
config.webpack.api = {...webpackBase, ...api};

export default config;
