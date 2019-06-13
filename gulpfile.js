var gulp = require("./node_modules/gulp");
var sass = require("./node_modules/gulp-sass");
var newer = require("./node_modules/gulp-newer");
var postcss = require("./node_modules/gulp-postcss");
var imagemin = require("./node_modules/gulp-imagemin");
var concat = require("./node_modules/gulp-concat");
var uglify = require("./node_modules/gulp-uglify");
var livereload = require("./node_modules/gulp-livereload");
var cleanCSS = require("./node_modules/gulp-clean-css");
var sourcemaps = require("./node_modules/gulp-sourcemaps");

var src = "./assets";
var dist = "./dist";

var paths = {
  js: src + "/js/**/*.js",
  scss: src + "/scss/*.scss",
  imgs: src + "/imgs/**/*"
};
var sassOpts = {
  outputStyle: "nested",
  imagePath: dist + "/imgs",
  precision: 3,
  errLogToConsole: true,
  processors: [
    require("./node_modules/postcss-assets")({
      loadPaths: ["imgs/"],
      basePath: "/wp-content/themes/Avada-Child-Theme/",
      baseUrl: "/wp-content/themes/Avada-Child-Theme/"
    })
  ]
};
// image processing
gulp.task("images", function() {
  return gulp
    .src(paths.imgs)
    .pipe(newer(dist + "/imgs"))
    .pipe(imagemin())
    .pipe(gulp.dest(dist + "/imgs"));
});

gulp.task("js", function() {
  return gulp
    .src([paths.js])
    .pipe(concat("index-min-build.js"))
    .pipe(uglify())
    .pipe(gulp.dest(dist));
});

gulp.task("sass", function() {
  return gulp
    .src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass(sassOpts))
    .pipe(cleanCSS())
    .pipe(postcss(sassOpts.processors))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(dist + "/"));
});

// 파일 변경 감지 및 브라우저 재시작
gulp.task("watch", function() {
  livereload.listen();
  gulp.watch(paths.js, gulp.series("js"));
  gulp.watch(paths.imgs, gulp.series("images"));
  gulp.watch(paths.scss, gulp.series("sass"));
  gulp.watch(dist + "/**").on("change", livereload.changed);
});

//기본 task 설정
gulp.task("default", gulp.parallel("js", "images", "sass", "watch"));
