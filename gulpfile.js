'use strict';

const { src, dest, series, parallel, watch } = require('gulp');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const csso = require('gulp-csso');
const cssbeautify = require('gulp-cssbeautify');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const imagemin = require('gulp-imagemin');
const svgstore = require('gulp-svgstore');
const svgmin = require('gulp-svgmin');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const run = require('run-sequence');
const del = require('del');

const folder = {
  assets: 'assets/',
  nodeModules: 'node_modules/'
};

// Очищаем папку build перед сборкой
function clean() {
  return del('img');
}

// Server
function serve() {
  browserSync.init({
    proxy: 'monitor:8888',
    browser: 'google chrome'
  });

  watch(folder.assets + 'scss/**/*.scss', css);
  watch('**/*.php').on('change', browserSync.reload);
  watch('js/*.js').on('change', browserSync.reload);
}

// CSS
function css() {
  return src(folder.assets + 'scss/style.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(postcss([
      autoprefixer()
    ]))
    // .pipe(csso({
    //   forceMediaMerge: true
    // }))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./'))
    .pipe(browserSync.stream());
}

// Images
function images() {
  return src(folder.assets + 'img/**/*.{png,jpg,gif}')
    .pipe(imagemin([
      imagemin.optipng({optimizationLevel: 3}),
      imagemin.jpegtran({progressive: true})
    ]))
    .pipe(dest('./img'));
}

// SVG sprite
function svgSprite() {
  return src(folder.assets + 'img/svg-sprite/*.svg')
    .pipe(svgmin({
      plugins: [{
        removeViewBox: false
      }]
    }))
    .pipe(svgstore({
      inlineSvg: true
    }))
    .pipe(rename('sprite.svg'))
    .pipe(dest('./img'));
}


// SVG min
function svgMin() {
  return src(folder.assets + 'img/svg-min/*.svg')
    .pipe(svgmin({
      plugins: [{
        removeViewBox: false
      }]
    }))
    .pipe(dest('./img/svg'));
}

const build = series(clean, parallel(css, images, svgSprite, svgMin));

exports.images = images;
exports.svgSprite = svgSprite;
exports.svgMin = svgMin;
exports.build = build;
exports.default = series(build, serve);
