'use strict';

import CleanWebpackPlugin from 'clean-webpack-plugin';
import dotenv from 'dotenv';
import NodemonPlugin from 'nodemon-webpack-plugin';
import path from 'path';
import TypedocWebpackPlugin from 'typedoc-webpack-plugin';
import webpack from 'webpack';

const config = {
  webpack: {},
};

// Setup for environment variables
config.envfile = path.resolve(__dirname, '.env');
dotenv.config({
  path: config.envfile,
});

// Define paths
config.paths = {
  SOURCE: path.resolve(__dirname, '../src'),
  BUILD: process.env.NODE_ENV !== 'production' ?
    path.resolve(__dirname, '../.build') :
    path.resolve(__dirname, '../dist'),
};

// Define webpack settings
const entry = {
  api: config.paths.SOURCE + '/index.ts',
};
const output = process.env.NODE_ENV !== 'production' ? {
    path: config.paths.BUILD,
    filename: 'main.[name].js',
    chunkFilename: '[name].chunk.js',
  } : {
    path: config.paths.BUILD,
    filename: 'main.[hash].chunk.js',
    chunkFilename: '[hash].chunk.js',
};
const modules = {
  rules: [
    {
      test: /\.(j|t)s(x)?$/,
      exclude: /node_modules/,
      use: [
        {
          loader: 'babel-loader',
          options: {
            babelrc: false,
            extends: path.resolve(__dirname, '../.babelrc'),
          },
        },
        {
          loader: 'awesome-typescript-loader',
          options: {
            configFileName: path.resolve(__dirname, './tsconfig.json'),
          },
        },
      ],
    },
  ],
};
const resolve = {
  alias: {
    logger: config.paths.SOURCE + '/utils/logger.ts',
  },
  extensions: [
    '*', '.js', '.jsx', '.ts', '.tsx',
  ],
};
const plugins = [
  new CleanWebpackPlugin(
    [
      config.paths.BUILD + '/**/*',
    ], {
      allowExternal: true,
    }
  ),
  new NodemonPlugin(),
  new TypedocWebpackPlugin({
    ignoreCompilerErrors: true,
  }),
  new webpack.NoEmitOnErrorsPlugin(),
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
  port: process.env.API_PORT,
  historyApiFallback: true,
  open: true,
  hot: true,
};

config.webpack = {
  mode: process.env.NODE_ENV,
  entry: entry,
  output: output,
  module: modules,
  resolve: resolve,
  plugins: plugins,
  optimization: optimization,
  devServer: devServer,
  watch: process.env.NODE_ENV !== 'production' ? true : false,
  watchOptions: watchOptions,
  devtool: 'eval-source-map',
  target: 'node',
  node: {
    __dirname: true,
  },
  stats: {
    warnings: false,
  },
  cache: true,
};

export default config.webpack;
