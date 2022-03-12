/* global L, OverlappingMarkerSpiderfier */
'use strict';


var _DEFAULTS,
    _LAYERNAMES,
    _MARKER_DEFAULTS;

_MARKER_DEFAULTS = {
  opacity: 0.8
};
_DEFAULTS = {
  json: {},
  markerOptions: _MARKER_DEFAULTS
};
_LAYERNAMES = {
  array: 'Geotechnical Array',
  bridge: 'Bridge, overpass',
  building: 'Building',
  dam: 'Dam',
  misc: 'Miscellaneous',
  ref: 'Free-field and reference'
};


/**
 * Factory for Stations overlay.
 *
 * @param options {Object}
 *     {
 *       json: {String} Geojson data
 *       map: {L.Map}
 *       markerOptions: {Object} L.Marker options (optional)
 *     }
 *
 * @return _this {L.FeatureGroup}
 *     {
 *       count: {Integer}
 *       layers: {Object}
 *       names: {Object}
 *     }
 */
L.StationsLayer = function (options) {
  var _initialize,
      _this,

      _icons,
      _map,
      _markerOptions,
      _oms,

      _createLayers,
      _getContent,
      _getIcon,
      _getType,
      _initOms,
      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = L.featureGroup();

  _initialize = function (options) {
    options = Object.assign({}, _DEFAULTS, options);

    _icons = {};
    _map = options.map;
    _markerOptions = Object.assign({}, _MARKER_DEFAULTS, options.markerOptions);

    _createLayers();
    _initOms();
    _showCount(options.json.count);

    L.geoJson(options.json, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };

  /**
   * Create the map layers for each station type.
   */
  _createLayers = function () {
    _this.count = {};
    _this.layers = {};
    _this.names = _LAYERNAMES;

    Object.keys(_LAYERNAMES).forEach(function (key) {
      _this.count[key] = 0;
      _this.layers[key] = L.featureGroup();

      _this.addLayer(_this.layers[key]); // add map layer to featureGroup
    });
  };

  /**
   * Get the content for a popup.
   *
   * @param data {Object}
   *
   * @return {String}
   */
  _getContent = function (data) {
    var template =
      '<div class="popup">' +
        '<h2>{staname}</h2>' +
        '<dl>' +
          '<dt>Station Code</dt><dd>{stacode}</dd>' +
          '<dt>Sensor Type</dt><dd>{sentype}</dd>' +
          '<dt>Recorder Type</dt><dd>{rectype}</dd>' +
          '<dt>Owner</dt><dd>{owner}</dd>' +
          '<dt>Number of Channels</dt><dd>{numchan}</dd>' +
        '</dl>' +
      '</div>';

    return L.Util.template(template, data);
  };

  /**
   * Get the icon for a marker.
   *
   * @param type {String}
   * @param owner {String}
   *
   * @return {L.Icon}
   */
  _getIcon = function (type, owner) {
    var colors = {
      other: 'c34',
      USGS: '48a'
    };

    if (owner !== 'USGS') {
      owner = 'other';
    }

    // Only create each icon once
    if (!_icons[type]) {
      _icons[type] = {};
    }
    if (!_icons[type][owner]) {
      _icons[type][owner] = L.icon({
        iconAnchor: [15, 35],
        iconSize: [30, 70],
        iconUrl: `img/pin-m-${type}+${colors[owner]}.png`,
        popupAnchor: [0, -35]
      });
    }

    return _icons[type][owner];
  };

  /**
   * Get the station type based on the COSMOS code.
   *
   * @param code {Integer}
   *
   * @return {String}
   */
  _getType = function (code) {
    var types = {
      0: 'misc',
      1: 'ref',
      2: 'ref',
      3: 'ref',
      4: 'ref',
      5: 'ref',
      6: 'ref',
      7: 'misc',
      8: 'misc',
      9: 'misc',
      10: 'building',
      11: 'bridge',
      12: 'dam',
      13: 'misc',
      14: 'misc',
      15: 'misc',
      50: 'array',
      52: 'array'
    };

    return types[code];
  };

  /**
   * Initialize OverlappingMarkerSpiderfier Leaflet plugin.
   */
  _initOms = function () {
    var popup = L.popup({
      autoPanPadding: L.point(60, 10)
    });

    _oms = new OverlappingMarkerSpiderfier(_map, {
      keepSpiderfied: true,
      nearbyDistance: 5
    });

    _oms.addListener('click', function(marker) {
      popup.setContent(_getContent(marker.props));
      popup.setLatLng(marker.getLatLng());
      _map.openPopup(popup);
    });
  };

  /**
   * Add tooltips and group features into separate layers by type; add markers
   * to oms.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    var props,
        type;

    props = feature.properties;
    type = _getType(props.cosmoscode);

    layer.bindTooltip(props.staname);
    layer.props = props; // for oms lib to create popup content

    _this.count[type] ++;
    _this.layers[type].addLayer(layer);

    _oms.addMarker(layer);
  };

  /**
   * Create Leaflet markers.
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return {L.Marker}
   */
  _pointToLayer = function (feature, latlng) {
    var options,
        props,
        type;

    props = feature.properties;
    type = _getType(props.cosmoscode);
    options = Object.assign({}, _markerOptions, {
      icon: _getIcon(type, props.owner)
    });

    return L.marker(latlng, options);
  };

  /**
   * Show the number of stations below the map.
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el = document.querySelector('.count');

    el.innerHTML = count + ' stations on this map';
  };


  _initialize(options);
  options = null;
  return _this;
};


L.stationsLayer = function (options) {
  return new L.StationsLayer(options);
};
