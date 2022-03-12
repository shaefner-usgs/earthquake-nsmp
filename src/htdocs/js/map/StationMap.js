/* global L, MOUNT_PATH */
'use strict';


var AppUtil = require('util/AppUtil');

// Leaflet plugins
require('leaflet-fullscreen');
require('map/MousePosition');
require('map/RestoreMap');

// Factories for map layers
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/StationsLayer');
require('map/TerrainLayer');


/*
 * Create and render the Leaflet map.
 */
var StationMap = function (options) {
  var _initialize,
      _this,

      _el,
      _map,

      _getLayers,
      _initMap,
      _loadStations,
      _render;


  _this = {};

  _initialize = function (options) {
    options = options || {};

    _el = options.el || document.createElement('div');

    _initMap();
    _loadStations();
  };

  /**
   * Get all map layers.
   *
   * @param stations {Object}
   *
   * @return layers {Object}
   *     {
   *       baseLayers: {Object}
   *       overlays: {Object}
   *       defaults: {Array}
   *     }
   */
  _getLayers = function (stations) {
    var greyscale,
        layers,
        name;

    greyscale = L.greyscaleLayer();
    layers = {
      baseLayers: {
        'Greyscale': greyscale,
        'Dark': L.darkLayer(),
        'Terrain': L.terrainLayer(),
        'Satellite': L.satelliteLayer()
      },
      overlays: {},
      defaults: [
        greyscale
      ]
    };

    // Add station layers to overlays, defaults
    Object.keys(stations.layers).forEach(function(layer) {
      name = stations.names[layer] + ' (' + stations.count[layer] + ')';

      layers.overlays[name] = stations.layers[layer];
      layers.defaults.push(stations.layers[layer]);
    });

    return layers;
  };

  /**
   * Create the Leaflet map instance.
   */
  _initMap = function () {
    _map = L.map(_el, {
      scrollWheelZoom: false
    });

    L.control.fullscreen({
      pseudoFullscreen: true
    }).addTo(_map);
    L.control.mousePosition().addTo(_map);
    L.control.scale().addTo(_map);
  };

  /**
   * Load stations layer geojson.
   */
  _loadStations = async function () {
    var json,
        response,
        stations,
        url;

    try {
      url =  MOUNT_PATH + '/_getStations.json.php';
      response = await AppUtil.fetchWithTimeout(url);
      json = await response.clone().json();
      stations = L.stationsLayer({
        json: json,
        map: _map
      });

      _render(stations);
    } catch (error) {
      console.error(error);
    }
  };

  /**
   * Render the map layers and layer controller.
   *
   * @param stations {Object}
   */
  _render = function (stations) {
    var layers = _getLayers(stations);

    layers.defaults.forEach(function(layer) {
      _map.addLayer(layer);
    });

    L.control.layers(
      layers.baseLayers,
      layers.overlays
    ).addTo(_map);

    _map.fitBounds(stations.getBounds());

    // Remember user's settings (selected layers, map extent, etc.)
    _map.restoreMap({
      baseLayers: layers.baseLayers,
      id: 'stations',
      overlays: layers.overlays
    });
  };


  _initialize(options);
  options = null;
  return _this;
};


module.exports = StationMap;
