'use strict';


var fs = require('fs'),
    ini = require('ini');

var basePort,
    config;

basePort = 9160;

config = {
  build: '.build',
  buildPort: basePort,
  dist: 'dist',
  distPort: basePort + 1,
  ini: ini.parse(fs.readFileSync('./src/conf/config.ini', 'utf-8')),
  liveReloadPort: basePort + 9,
  pkg: JSON.parse(fs.readFileSync('./package.json', 'utf-8')),
  src: 'src',
  templatePort: basePort + 2
};


module.exports = config;
