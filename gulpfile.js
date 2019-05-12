var gulp = require('gulp'),
    util = require('gulp-util'),
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    uncss = require('gulp-uncss'),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    pxtorem = require('postcss-pxtorem'),
    inlineSvg = require('postcss-inline-svg'),
    mqpacker = require('css-mqpacker'),
    assets = require('postcss-assets'),
    cssnano = require('cssnano'),
    production = !!util.env.production;

gulp.task('scss', function () {
    var processors = [
            pxtorem(),
            inlineSvg(),
            mqpacker({
                sort: require('sort-css-media-queries').desktopFirst
            }),
            assets({
                loadPaths: ['assets/images/'],
                relativeTo: 'assets/css/'
            }),
        ];
        // uncssConfig = {
        //     html: ['http://localhost:8888/universal-landing/'],
        //     ignore: [
        //         /\.is-active/,
        //         /\.is-black/,
        //         /\.has-error/,
        //         /^\.slick-.*/,
        //         /.slick-dots/,
        //         /.slick-arrow/,
        //         /.modal/,
        //         /.fade.show/,
        //         /.l-page/,
        //         /.close/,
        //         /.loading/,
        //     ]
        // }

    if (production) {
        processors.push(cssnano())
    }

    return gulp.src('assets/src/scss/main.scss')
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(postcss(processors))
        // .pipe(production ? uncss(uncssConfig) : util.noop())
        .pipe(util.noop())
        .pipe(gulp.dest('assets/css/'))
});

gulp.task('js', function (cb) {
    return gulp.src([
        'assets/src/js/!(main).js',
        'assets/src/js/main.js'
    ])
        .pipe(concat('main.js'))
        .pipe(babel({ presets: ['env'] }))
        .pipe(production ? uglify() : util.noop())
        .pipe(gulp.dest('assets/js/'))
});

gulp.task('js-libs', function (cb) {
    return gulp.src([
        'assets/src/js/libs/!(main).js',
    ])
        .pipe(concat('libs.js'))
        // .pipe(babel({ presets: ['env'] }))
        // .pipe(production ? uglify() : util.noop())
        .pipe(util.noop())
        .pipe(gulp.dest('assets/js/'))
});

gulp.task('watch', function() {
    gulp.watch('assets/src/scss/**/*.scss', ['scss']);
    gulp.watch('assets/src/js/*.js', ['js']);
    gulp.watch('assets/src/js/libs/*.js', ['js-libs']);
});

gulp.task('build', [
  'scss',
  'js',
  'js-libs'
]);

gulp.task('default', [
    'build',
    'watch'
]);
