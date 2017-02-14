/* global L */
'use strict';


var Util = require('util/Util');

require('leaflet.label');


var _DEFAULTS;

_DEFAULTS = {
  data: {},
};

/**
 * Factory for Buildings overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *     }
 *
 * @return {L.FeatureGroup}
 */
var BuildingsLayer = function (options) {
  var _initialize,
      _this,

      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = {};

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);

    _showCount(options.data.count);

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
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
        '<h2>{}</h2>' +
        '<dl>' +
          '<dt></dt><dd>{}</dd>' +
        '</dl>' +
      '</div>';
    popup = L.Util.template(popupTemplate, data);

    layer.bindPopup(popup, {
      autoPanPadding: L.point(50, 10)
    }).bindLabel(data.staname);
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
        marker;



    marker = L.marker(latlng, {
      opacity: 0.8,
      icon: icon
    });

    return marker;
  };

  /**
   * Show building count on web page
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el;

    el = document.querySelector('.count');
    el.innerHTML = count + ' buildings on this map';
  };

  _initialize(options);
  options = null;
  return _this;
};


L.buildingsLayer = BuildingsLayer;

module.exports = BuildingsLayer;
