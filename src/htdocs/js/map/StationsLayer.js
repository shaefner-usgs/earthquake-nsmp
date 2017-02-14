/* global L */
'use strict';


var Util = require('util/Util');

require('leaflet.label');


var _DEFAULTS;

_DEFAULTS = {
  data: {},
};

/**
 * Factory for Stations overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *     }
 *
 * @return {L.FeatureGroup}
 */
var StationsLayer = function (options) {
  var _initialize,
      _this,

      _icons,

      _getIcon,
      _getStaionType,
      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = {};

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);
    _icons = [];

    _showCount(options.data.count);

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };

  /**
   * Get station type based on cosmos code
   *
   * @param num {Integer}
   *
   * @return {Object}
   */
  _getStaionType = function (num) {
    var codes,
        names;

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
    names = {
      'array': 'Geotechnical Array',
      'bridge': 'Bridge, overpass',
      'building': 'Building',
      'dam': 'Dam',
      'misc': 'Miscellaneous',
      'ref': 'Free-field and reference'
    };

    return {
      code: codes[num],
      name: names[codes[num]]
    };
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
    var colors = {
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
   * Leaflet GeoJSON option: called on each created feature layer. Useful for
   * attaching events and popups to features.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    var data,
        popup,
        popupTemplate,
        props;

    props = feature.properties;
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

    layer.bindPopup(popup, {
      autoPanPadding: L.point(50, 10)
    }).bindLabel(data.staname, {
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
    var icon,
        marker,
        props,
        type;

    props = feature.properties;

    type = _getStaionType(props.cosmoscode);
    icon = _getIcon(type.code, props.owner);

    marker = L.marker(latlng, {
      opacity: 0.8,
      icon: icon
    });

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
