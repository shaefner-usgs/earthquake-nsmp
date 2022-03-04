/* global L, OverlappingMarkerSpiderfier */
'use strict';


var Util = require('hazdev-webutils/src/util/Util');


var _DEFAULTS,
    _LAYERNAMES,
    _MARKER_DEFAULTS;

_MARKER_DEFAULTS = {
  opacity: 0.8
};
_DEFAULTS = {
  data: {},
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
 * Factory for Stations overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *       markerOptions: {Object} L.Marker options
 *     }
 *
 * @return {L.FeatureGroup}
 */
var StationsLayer = function (options) {
  var _initialize,
      _this,

      _icons,
      _markerOptions,
      _oms,

      _getIcon,
      _getStaionType,
      _initLayers,
      _initOms,
      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = L.featureGroup();

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);
    _markerOptions = Util.extend({}, _MARKER_DEFAULTS, options.markerOptions);

    _icons = [];

    _showCount(options.data.count);
    _initOms();
    _initLayers();

    L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };

  /**
   * Get Leaflet icon for a point
   *
   * @param code {String}
   * @param owner {String}
   *
   * @return {L.icon}
   */
  _getIcon = function (code, owner) {
    var colors;

    colors = {
      USGS: '48a',
      other: 'c34'
    };
    if (owner !== 'USGS') {
      owner = 'other';
    }
    if (!_icons[code]) {
      _icons[code] = {};
    }
    if (!_icons[code][owner]) {
      _icons[code][owner] = L.icon({
        iconUrl: 'img/pin-m-' + code + '+' + colors[owner] + '.png',
        iconSize: [30, 70],
        iconAnchor: [15, 35],
        popupAnchor: [0, -35]
      });
    }

    return _icons[code][owner];
  };

  /**
   * Get station type based on cosmos code
   *
   * @param num {Integer}
   *
   * @return {String}
   */
  _getStaionType = function (num) {
    var codes;

    codes = {
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

    return codes[num];
  };

  /**
   * Create a featureGroup for each type of station
   */
  _initLayers = function () {
    _this.count = {};
    _this.layers = {};
    _this.names = _LAYERNAMES;
    Object.keys(_LAYERNAMES).forEach(function (key) {
      _this.count[key] = 0;
      _this.layers[key] = L.featureGroup();
      _this.addLayer(_this.layers[key]); // add to 'master' featureGroup
    });
  };

  /**
   * Initialize OverlappingMarkerSpiderfier Leaflet plugin
   */
  _initOms = function () {
    var map,
        popup;

    map = options.map;
    _oms = new OverlappingMarkerSpiderfier(map, {
      keepSpiderfied: true,
      nearbyDistance: 5
    });
    popup = L.popup({
      autoPanPadding: L.point(50, 10)
    });

    _oms.addListener('click', function(marker) {
      popup.setContent(marker.popup);
      popup.setLatLng(marker.getLatLng());
      map.openPopup(popup);
    });
  };

  /**
   * Leaflet GeoJSON option: called on each created feature layer. Useful for
   * attaching events and popups to features.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    layer.bindTooltip(feature.properties.staname, {
      pane: 'popupPane'
    });
  };

  /**
   * Leaflet GeoJSON option: used for creating layers for GeoJSON points
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return marker {L.CircleMarker}
   */
  _pointToLayer = function (feature, latlng) {
    var data,
        icon,
        marker,
        popup,
        popupTemplate,
        props,
        type;

    props = feature.properties;
    type = _getStaionType(props.cosmoscode);
    icon = _getIcon(type, props.owner);
    _markerOptions.icon = icon;

    marker = L.marker(latlng, _markerOptions);

    // Group stations in separate layers by type
    _this.layers[type].addLayer(marker);
    _this.count[type] ++;

    // Create popup
    data = {
      owner: props.owner,
      numchan: props.numchan,
      rectype: props.rectype,
      sentype: props.sentype,
      stacode: props.stacode,
      staname: props.staname
    };

    popupTemplate = '<div class="popup">' +
        '<h2>{staname}</h2>' +
        '<dl>' +
          '<dt>Station Code</dt><dd>{stacode}</dd>' +
          '<dt>Sensor Type</dt><dd>{sentype}</dd>' +
          '<dt>Recorder Type</dt><dd>{rectype}</dd>' +
          '<dt>Owner</dt><dd>{owner}</dd>' +
          '<dt>Number of Channels</dt><dd>{numchan}</dd>' +
        '</dl>' +
      '</div>';

    popup = L.Util.template(popupTemplate, data);
    marker.popup = popup;

    _oms.addMarker(marker);

    return marker;
  };

  /**
   * Show station count on web page
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el;

    el = document.querySelector('.count');
    el.innerHTML = count + ' stations on this map';
  };


  _initialize(options);
  options = null;
  return _this;
};


L.stationsLayer = StationsLayer;

module.exports = StationsLayer;
