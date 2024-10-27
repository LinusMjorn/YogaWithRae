function defaultTask(cb) {
    // place code for your default task here
    cb();
  }
  
  let gulp = require("gulp"),
  sass = require("gulp-sass")(require('sass')),
  babel = require("gulp-babel"),
  sourcemaps = require("gulp-sourcemaps"),
  browserify = require('browserify'),
  cleanCss = require("gulp-clean-css"),
  rename = require("gulp-rename"),
  postcss = require("gulp-postcss"),
  autoprefixer = require("autoprefixer"),
  terser = require('gulp-terser'),
  source = require('vinyl-source-stream'),
  babelify = require('babelify'),
  buffer = require('vinyl-buffer');

const paths = {
  scss: {
    src: "./sass/style.scss",
    dest: "./",
    watch: "./sass/**/*.scss",
  },
  js: {
    src: "./js/src/*.js",
    bundleSrc: "./src/js/app.js",
    dest: "./js",
    bundleDest: "./js/",
  },
};

// Compile sass into CSS & auto-inject into browsers
function styles() {
  return gulp
    .src([paths.scss.src])
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError))
    .pipe(
      postcss([
        autoprefixer({
            overrideBrowserslist: [
            "Chrome >= 35",
            "Firefox >= 38",
            "Edge >= 12",
            "Explorer >= 10",
            "iOS >= 8",
            "Safari >= 8",
            "Android 2.3",
            "Android >= 4",
            "Opera >= 12",
          ],
        }),
      ])
    )
    .pipe(cleanCss())
    .pipe(sourcemaps.write('../css'))
    /* .pipe(rename(function(path) {
      if (!path.extname.endsWith('.map')) {
          path.basename += '.min';
      }
  })) */
    .pipe(gulp.dest(paths.scss.dest))
}

// Move the javascript files into our js folder

function jsStatic() {
  return gulp
    .src(paths.js.src)
    .pipe(sourcemaps.init())
    .pipe(babel({presets:['@babel/env']}))
    .pipe(terser())
    .pipe(sourcemaps.write('../js'))
    .pipe(rename(function(path) {
      if (!path.extname.endsWith('.map')) {
          path.basename += '.min';
      }
  }))
    .pipe(gulp.dest(paths.js.dest));
}

function js() {
  let b = browserify({
    entries:paths.js.bundleSrc,
    debug:true
  })
  .transform(babelify, {
    presets: ["@babel/preset-env"],
    global: true, 
    ignore: [/\/node_modules\/(?!swiper\/)/]
  });
  return  b.bundle()
    .pipe(source('./app.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init())
    .pipe(terser())
    .pipe(sourcemaps.write('../js'))
    .pipe(rename(function(path) {
      if (!path.extname.endsWith('.map')) {
          path.basename += '.min';
      }
  }))
    .pipe(gulp.dest(paths.js.bundleDest))
}

function watch() {
  gulp.watch([paths.scss.watch], styles);
 // gulp.watch('./src/js/*', js);
  gulp.watch([paths.js.src], jsStatic);
}

exports.watch = watch;
exports.styles = styles;
exports.js = js;
exports.jsStatic = jsStatic;

exports.default = watch; 
