'use strict';


var config = require('./config');

var eslint = {
  options: {
    configFile: '.eslintrc.json',
    format: 'stylish'
  },

  build: {
    src: [
      'Gruntfile.js',
      'grunt/**/*.js',
      config.src + '/htdocs/**/*.js'
    ]
  }
};


module.exports = eslint;
