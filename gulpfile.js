const { src, dest, watch, parallel } = require('gulp');
//plumber
const plumber = require('gulp-plumber');
//css
const sass = require('gulp-sass')(require('sass'));

const cache = require('gulp-cache');
//js
const terser = require('gulp-terser-js');

function css(done) {

    src('src/scss/app.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(dest('./public/build/css'))


    done();
}




function javascript(done) {

    src('src/js/**/*.js')
        .pipe(dest('./public/build/js', css));
    done();
}




function dev(done) {

    watch('src/scss/**/*.scss', css)
    watch('src/js/**/*.js', javascript)
    done();
}

exports.css = css;

exports.dev = parallel(dev, javascript);