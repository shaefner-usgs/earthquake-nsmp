/* global L, MOUNT_PATH */
'use strict';


var Xhr = require('hazdev-webutils/src/util/Xhr');

// Leaflet plugins
require('leaflet-fullscreen');
require('leaflet.label');
require('map/MousePosition');
require('map/RestoreMap');

// Factories for creating map layers
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/StationsLayer');
require('map/TerrainLayer');


/*
 * Factory for Leaflet map instance
 */
var StationMap = function (options) {
  var _initialize,
      _this,

      _el,
      _map,
      _stations,

      _getMapLayers,
      _finishMapInit,
      _initMap,
      _loadStationsLayer;

  _this = {};


  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    // Create Leaflet map immediately so it can be passed to _loadStationsLayer()
    _map = _initMap();

    // Load stations layer which calls _finishMapInit() when finished
    _loadStationsLayer(_map);
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
    layers.defaults = [terrain];

    // Add stations to overlays / defaults
    Object.keys(_stations.layers).forEach(function(key) {
      name = _stations.names[key] + ' (' + _stations.count[key] + ')';
      layers.overlays[name] = _stations.layers[key];
      layers.defaults.push(_stations.layers[key]);
    });

    return layers;
  };

  /**
   * Finish Leaflet map init - separated out from initMap so we can call oms
   *   library with leaflet map instance before Stations layer is created
   */
  _finishMapInit = function () {
    var layers;

    // Get all layers and add default layers to map
    layers = _getMapLayers();
    layers.defaults.forEach(function(layer) {
      _map.addLayer(layer);
    });

    // Set intial map extent to contain stations overlay
    _map.fitBounds(_stations.getBounds());

    // Add controllers
    L.control.fullscreen({ pseudoFullscreen: true }).addTo(_map);
    L.control.layers(layers.baseLayers, layers.overlays).addTo(_map);
    L.control.mousePosition().addTo(_map);
    L.control.scale().addTo(_map);

    // Remember user's map settings (selected layers, map extent)
    _map.restoreMap({
      baseLayers: layers.baseLayers,
      id: 'stations',
      overlays: layers.overlays
    });
  };

  /**
   * Create Leaflet map instance
   */
  _initMap = function () {
    var map;

    map = L.map(_el, {
      scrollWheelZoom: false
    });

    return map;
  };

  /**
   * Load stations layer from geojson data via ajax
   */
  _loadStationsLayer = function (map) {
    Xhr.ajax({
      url: MOUNT_PATH + '/_getStations.json.php',
      success: function (data) {
        _stations = L.stationsLayer({
          data: data,
          map: map
        });
        _finishMapInit();
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


module.exports = StationMap;
