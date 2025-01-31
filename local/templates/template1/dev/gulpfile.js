const gulp = require("gulp");
const babel = require("gulp-babel");
const plumber = require("gulp-plumber");
const sourcemap = require("gulp-sourcemaps");
const sass = require("gulp-sass")(require("node-sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const csso = require("postcss-csso");
const rename = require("gulp-rename");
const uglify = require("gulp-uglify-es").default;
const svgstore = require("gulp-svgstore");
const sync = require("browser-sync").create();
const concat = require("gulp-concat");
const bulk = require("gulp-sass-bulk-importer");
const clear = require("gulp-clean-css");

// Styles

const styles = () => {
  return gulp
    .src("./styles/style.scss")
    .pipe(plumber())
    .pipe(sourcemap.init())
    .pipe(bulk())
    .pipe(
      sass({
        outputStyle: "compressed",
      }).on("error", sass.logError)
    )
    .pipe(postcss([autoprefixer(), csso()]))
    .pipe(clear({ level: 2 }))
    .pipe(concat("style.min.css"))
    .pipe(sourcemap.write("."))
    .pipe(gulp.dest("../public/styles"))
    .pipe(sync.stream());
};

exports.sass = styles;

// Scripts

const scripts = () => {
  return gulp
    .src("./scripts/modules/*.js")
    .pipe(sourcemap.init())
    .pipe(uglify())
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(concat("script.min.js"))
    .pipe(sourcemap.write("."))
    .pipe(gulp.dest("../public/scripts"))
    .pipe(sync.stream());
};

exports.js = scripts;

// Sprite

const sprite = () => {
  return gulp
    .src("./images/svg/*.svg")
    .pipe(
      svgstore({
        inlineSvg: true,
      })
    )
    .pipe(rename("sprite.svg"))
    .pipe(gulp.dest("../public/images"));
};

exports.sprite = sprite;

// Build

const build = gulp.series(
  gulp.parallel(styles, scripts, sprite)
);

exports.build = build;
