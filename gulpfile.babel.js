'use strict';

import browserSync from 'browser-sync';
import compiler from 'webpack';
import dotenv from 'dotenv';
import gulp from 'gulp';
import named from 'vinyl-named';
import path from 'path';
import webpack from 'webpack-stream';
import $ from 'gulp-load-plugins';

dotenv.config({
  path: path.resolve(__dirname, 'env/.env'),
});

import config from './gulp/config';

const serve = (done) => {
  browserSync.create();
  browserSync.init({
    server: {
      baseDir: config.paths.BUILD,
    },
    port: process.env.PORT,
    https: true,
    open: false,
    cors: true,
});

  gulp.watch(config.paths.BUILD + '**/*').on('change', browserSync.reload);
  gulp.watch(config.paths.SOURCE + '**/*.php').on('change', browserSync.reload);
}

const bundle = (done) => {
  gulp.src(config.paths.SOURCE + '/index.js')
    // .pipe($.env({
    //   file: '../env/env',
    // }))
    .pipe(named())
    .pipe(webpack(config.webpack, compiler))
    .pipe(gulp.dest(config.paths.BUILD));
  done();
}

gulp.task('default', gulp.series(bundle, serve));
