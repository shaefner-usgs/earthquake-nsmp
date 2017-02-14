/* global L, MOUNT_PATH */
'use strict';


var Xhr = require('util/Xhr');

// Leaflet plugins
require('leaflet-fullscreen');
require('leaflet.label');
require('map/MousePosition');
require('map/RestoreMap');

// Factories for creating map layers
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/BuildingsLayer');
require('map/TerrainLayer');


/*
 * Factory for Leaflet map instance
 */
var BuildingMap = function (options) {
  var _initialize,
      _this,

      _el,
      _buildings,

      _getMapLayers,
      _initMap,
      _loadBuildingsLayer;

  _this = {};


  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    // Load buildings layer which calls initMap() when finished
    _loadBuildingsLayer();
  };

  /**
   * Get all map layers that will be displayed on map
   *
   * @return layers {Object}
   *     {
   *       baseLayers: {Object}
   *       overlays: {Object}
   *       defaults: {Array}
   *     }
   */
  _getMapLayers = function () {
    var dark,
        greyscale,
        layers,
        name,
        satellite,
        terrain;

    dark = L.darkLayer();
    greyscale = L.greyscaleLayer();
    satellite = L.satelliteLayer();
    terrain = L.terrainLayer();

    layers = {};
    layers.baseLayers = {
      'Terrain': terrain,
      'Satellite': satellite,
      'Greyscale': greyscale,
      'Dark': dark
    };
    layers.overlays = {};
    layers.defaults = [terrain, _buildings];

    // Add buildings to overlays / defaults
    Object.keys(_buildings.layers).forEach(function(key) {
      name = _buildings.names[key] + ' (' + _buildings.count[key] + ')';
      layers.overlays[name] = _buildings.layers[key];
      layers.defaults.push(_buildings.layers[key]);
    });

    return layers;
  };

  /**
   * Create Leaflet map instance
   */
  _initMap = function () {
    var layers,
        map;

    layers = _getMapLayers();

    // Create map
    map = L.map(_el, {
      layers: layers.defaults,
      scrollWheelZoom: false
    });

    // Set intial map extent to contain buildings overlay
    map.fitBounds(_buildings.getBounds());

    // Add controllers
    L.control.fullscreen({ pseudoFullscreen: true }).addTo(map);
    L.control.layers(layers.baseLayers, layers.overlays).addTo(map);
    L.control.mousePosition().addTo(map);
    L.control.scale().addTo(map);

    // Remember user's map settings (selected layers, map extent)
    map.restoreMap({
      baseLayers: layers.baseLayers,
      id: 'main',
      overlays: layers.overlays
    });
  };

  /**
   * Load buildings layer from geojson data via ajax
   */
  _loadBuildingsLayer = function () {
    Xhr.ajax({
      url: MOUNT_PATH + '/_getBuildings.json.php',
      success: function (data) {
        _buildings = L.buildingsLayer({
          data: data
        });
        _initMap();
      },
      error: function (status) {
        console.log(status);
      }
    });
  };

  _initialize(options);
  options = null;
  return _this;
};


module.exports = BuildingMap;
