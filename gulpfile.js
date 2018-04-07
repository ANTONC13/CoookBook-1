//Adding dependencies
'use strict';

var gulp   = require('gulp');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var util   = require('gulp-util');
var sass   = require('gulp-sass');
var cssMin = require('gulp-css');
var phpcs  = require('gulp-phpcs');
var phpcbf = require('gulp-phpcbf');

// Script task

gulp.task ('scripts', function (){
    gulp.src( 'resources/assets/js/*.js')
        .pipe (uglify ())
        .pipe(rename({ suffix: '.min' }))
        .pipe (gulp.dest ( 'public/js/'));
});


gulp.task('sass', function () {
  return gulp.src('resources/assets/sass/*.s*ss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('resources/assets/css'));
});
 

gulp.task('css', function(){
  return gulp.src('resources/assets/css/*.css')
    .pipe(cssMin())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('public/css/'));
});
 

// Rerun the task When a file changes
gulp.task ( 'watch', function () {
    gulp.watch ( 'resources/assets/js/**',   [ 'scripts']);
    gulp.watch ( 'resources/assets/css/**',  [ 'css' ]);
    gulp.watch ( 'resources/assets/sass/**', [ 'sass']);
});

gulp.task('phpcs', function () {
  return gulp.src(['app/Http/Controllers/*.php', 'app/*.php'])
  .pipe(phpcs({
    bin: 'phpcs',
    standard: 'PSR2',
    warningSeverity: 0
  }))
  .pipe(phpcs.reporter('log'));
});
 
gulp.task('phpcbf', function () {
  return gulp.src(['app/Http/Controllers/*.php', 'app/*.php'])
  .pipe(phpcbf({
    bin: 'phpcbf',
    standard: 'PSR2',
    warningSeverity: 0
  }))
  .on('error', util.log)
  .pipe(gulp.dest('src'));
});

/*
var gutil = require( 'gulp-util' );
var ftp = require( 'vinyl-ftp' );
app public
/var/www/SIA2/public/vendor/unisharp/laravel-ckeditor - МИНИМИЗИРОВАТЬ!!!

gulp.task( 'deploy', function () {

    var conn = ftp.create( {
        host:     'mywebsite.tld',
        user:     'me',
        password: 'mypass',
        parallel: 10,
        log:      gutil.log
    } );
 
    var globs = [
        'src/**',
        'css/**',
        'js/**',
        'fonts/**',
        'index.html'
    ];
 
    // using base = '.' will transfer everything to /public_html correctly
    // turn off buffering in gulp.src for best performance
 
    return gulp.src( globs, { base: '.', buffer: false } )
        .pipe( conn.newer( '/public_html' ) ) // only upload newer files
        .pipe( conn.dest( '/public_html' ) );
 
} );

*/