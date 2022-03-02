'use strict';


var config = require('./config');

var copy = {
  options: {
    mode: true,
    timestamp: true
  },

  build: {
    cwd: config.src,
    dest: config.build + '/' + config.src,
    expand: true,
    filter: 'isFile',
    src: [
      '**/*',
      '!**/*.js',
      '!**/*.scss'
    ]
  },

  dist: {
    cwd: config.build + '/' + config.src,
    dest: config.dist,
    expand: true,
    filter: 'isFile',
    src: [
      '**/*',
      '!**/*.css',
      '!**/*.js',
      '!**/*.map'
    ]
  },

  leaflet: {
    expand: true,
    cwd: 'node_modules/leaflet/dist',
    dest: config.build + '/' + config.src + '/htdocs/lib/leaflet-0.7.7',
    rename: function (dest, src) {
      var newName;

      // swap -src version to be default and add -min to compressed version
      // this is nice for debugging but allows production to use default
      // version as compressed
      newName = src.replace('leaflet.js', 'leaflet-min.js');
      newName = newName.replace('leaflet-src.js', 'leaflet.js');

      return dest + '/' + newName;
    },
    src: [
      '**/*'
    ]
  },

  leaflet_fullscreen: {
    cwd: 'node_modules/leaflet-fullscreen/dist',
    dest: config.build + '/' + config.src + '/htdocs/img',
    expand: true,
    src: [
      '*.png'
    ]
  },

  oms: {
    cwd: 'src/lib/oms',
    dest: config.build + '/' + config.src + '/htdocs/lib/oms',
    expand: true,
    src: [
      '**/*'
    ]
  }
};


module.exports = copy;
