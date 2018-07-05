'use strict';

import browser_       from 'browser-sync';
import gulp          from 'gulp';
import plugins       from 'gulp-load-plugins';
import requireDir    from 'require-dir';
import webpackStream from 'webpack-stream';
import webpack2      from 'webpack';

const tasks = requireDir('./gulp/tasks');
const browser = browser_.create();

gulp.task('build', 
  gulp.series('clean', gulp.parallel('copy', 'scripts', 'styles'/* , 'docs' */))
);

gulp.task('serve', 
  gulp.series('build', function(done){
    browser.init({
      proxy: 'localhost:9587'
    });
    done();
  })
);

gulp.task('reload', function(done){
  browser.reload();
  done();
});

gulp.task('watch', function(){
//   gulp.watch('./src/**/*.{php,html}', gulp.series('docs', 'reload')),
  gulp.watch('./src/**/*.{ts,js}', gulp.series('scripts', 'reload')),
  gulp.watch('./src/**/*.scss', gulp.series('styles', 'reload'))
});

gulp.task('default', 
  gulp.series('serve', 'watch')
);