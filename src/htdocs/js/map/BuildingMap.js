/* global L, MOUNT_PATH */
'use strict';


var AppUtil = require('util/AppUtil');

// Leaflet plugins
require('leaflet-fullscreen');
require('leaflet-mouse-position');
require('leaflet-restore-map');

// Factories for map layers
require('map/BuildingsLayer');
// require('map/DarkLayer');
require('map/EarthquakesLayer');
require('map/FaultsLayer');
// require('map/GreyscaleLayer');
require('map/SatelliteLayer');
require('map/TerrainLayer-alt');


/*
 * Create and render the Leaflet map.
 */
var BuildingMap = function (options) {
  var _initialize,
      _this,

      _buildings,
      _earthquakes,
      _el,
      _map,

      _getLayers,
      _initMap,
      _loadBuildings,
      _loadEarthquakes,
      _render;


  _this = {};

  _initialize = function (options) {
    options = options || {};

    _el = options.el || document.createElement('div');

    _initMap();
    _loadBuildings();
    _loadEarthquakes();
  };

  /**
   * Get all map layers.
   *
   * @return layers {Object}
   *     {
   *       baseLayers: {Object}
   *       overlays: {Object}
   *       defaults: {Array}
   *     }
   */
  _getLayers = function () {
    var layers,
        terrain;

    terrain = L.terrainLayer();
    layers = {
      baseLayers: {
        // 'Greyscale': L.greyscaleLayer(),
        // 'Dark': L.darkLayer(),
        'Terrain': terrain,
        'Satellite': L.satelliteLayer()
      },
      overlays: {},
      defaults: [
        terrain
      ]
    };

    // Add building layers to overlays, defaults
    Object.keys(_buildings.layers).forEach(key => {
      var name = _buildings.names[key] + ' (' + _buildings.count[key] + ')';

      layers.overlays[name] = _buildings.layers[key];
      layers.defaults.push(_buildings.layers[key]);
    });

    // Add eqs, faults after building layers
    Object.assign(layers.overlays, {
      'Earthquakes': _earthquakes,
      'Faults': L.faultsLayer()
    });

    return layers;
  };

  /**
   * Create the Leaflet map instance.
   */
  _initMap = function () {
    _map = L.map(_el, {
      attributionControl: false,
      scrollWheelZoom: false,
      worldCopyJump: true
    });

    L.control.attribution({ prefix: '' }).addTo(_map);
    L.control.fullscreen({
      pseudoFullscreen: true
    }).addTo(_map);
    L.control.mousePosition().addTo(_map);
    L.control.scale().addTo(_map);
  };

  /**
   * Load buildings layer from geojson data via ajax
   */
  _loadBuildings = async function () {
    var json,
        response,
        url;

    try {
      url = MOUNT_PATH + '/_getBuildings.json.php';
      response = await AppUtil.fetchWithTimeout(url);
      json = await response.clone().json();

      _buildings = L.buildingsLayer({
        json: json,
        map: _map
      });

      _render();
    } catch (error) {
      console.error(error);
    }
  };

  /**
   * Load earthquakes layer from geojson data via ajax
   */
  _loadEarthquakes = async function () {
    var json,
        response,
        url;

    try {
      url = 'https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&minmagnitude=2.5&orderby=time-asc';
      response = await AppUtil.fetchWithTimeout(url);
      json = await response.clone().json();

      _earthquakes = L.earthquakesLayer({
        json: json,
        map: _map
      });

      _render();
    } catch (error) {
      console.error(error);
    }
  };

  /**
   * Render the map layers and layer controller.
   */
  _render = function () {
    var layers;

    if (!_buildings || !_earthquakes) {
      return; // continue when both async layers are loaded
    }

    layers = _getLayers();
    layers.defaults.forEach(layer => {
      _map.addLayer(layer);
    });

    L.control.layers(
      layers.baseLayers,
      layers.overlays
    ).addTo(_map);

    _map.fitBounds(_buildings.getBounds());

    // Remember user's settings (selected layers, map extent, etc.)
    _map.restoreMap({
      baseLayers: layers.baseLayers,
      id: 'buildings',
      overlays: layers.overlays
    });
  };


  _initialize(options);
  options = null;
  return _this;
};


module.exports = BuildingMap;
