'use strict';


var babelify = require('babelify'),
    config = require('./config');

var browserify = {
  options: {
    //banner: '/* browserified: <%= grunt.template.today("mm-dd-yyyy hh:MM:ss") %> */\n',
    browserifyOptions: {
      debug: true, // inline sourcemaps
      paths: [
        config.src + '/htdocs/js'
      ]
    },
    noParse: [
      'utfgrid'
    ],
    transform: [
      babelify.configure({
        presets: [
          '@babel/preset-env'
        ],
        plugins: [
          '@babel/plugin-transform-runtime'
        ]
      })
    ]
  },

  build: {
    files: [{
      cwd: config.src,
      dest: config.build + '/' + config.src,
      expand: true,
      src: [
        'htdocs/js/stations.js',
        'htdocs/js/va.js'
      ]
    }]
  }
};


module.exports = browserify;
