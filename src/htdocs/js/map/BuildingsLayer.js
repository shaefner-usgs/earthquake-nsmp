/* global L, OverlappingMarkerSpiderfier */
'use strict';


var Util = require('util/Util');

require('leaflet.label');


var _DEFAULTS,
    _LAYERNAMES,
    _OVERLAY_DEFAULTS;

_OVERLAY_DEFAULTS = {
  fillOpacity: 0.3,
  opacity: 0.7,
  radius: 8,
  weight: 1
};
_DEFAULTS = {
  data: {},
  overlayOptions: _OVERLAY_DEFAULTS
};
_LAYERNAMES = {
  array: 'Building Array',
  reference: 'Reference Site'
};

/**
 * Factory for Buildings overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *       overlayOptions: {Object} L.CircleMarker options
 *     }
 *
 * @return {L.FeatureGroup}
 */
var BuildingsLayer = function (options) {
  var _initialize,
      _this,

      _oms,
      _overlayOptions,

      _initLayers,
      _initOms,
      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = L.featureGroup();

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);
    _overlayOptions = Util.extend({}, _OVERLAY_DEFAULTS, options.overlayOptions);

    _showCount(options.data.count);
    _initOms();
    _initLayers();

    L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
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
      nearbyDistance: 1 // using min. distance b/c it's for markers w/ identical coords
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
    layer.bindLabel(feature.properties.name);
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
        imgs,
        marker,
        popup,
        popupTemplate,
        props,
        type;

    imgs = '';
    props = feature.properties;
    type = feature.properties.type;

    // Set color then create marker
    if (type === 'array') {
      _overlayOptions.color = '#ff7800';
      _overlayOptions.fillColor = '#ff7800';
    } else if (type === 'reference') {
      _overlayOptions.color = '#00c';
      _overlayOptions.fillColor = '#00c';
    }
    marker = L.circleMarker(latlng, _overlayOptions);

    // Group stations in separate layers by type
    _this.layers[type].addLayer(marker);
    _this.count[type] ++;

    // Create popup
    if (props.photo) {
      imgs += '<a href="img/photos/' + props.photo + '" target="_blank">' +
          '<img src="img/photos/thumbs/' + props.photo + '" alt="building photo" />' +
        '</a>';
    }
    if (props.layout) {
      imgs += '<a href="img/layouts/' + props.layout + '" target="_blank">' +
          '<img src="img/layouts/thumbs/' + props.layout_thumb + '" alt="building layout" />' +
        '</a>';
    }

    data = {
      building: props.building,
      city: props.city,
      imgs: imgs,
      name: props.name,
      photo: props.photo,
      sensors_ground: props.sensors_ground,
      sensors_structure: props.sensors_structure,
      state: props.state,
      station: props.station,
    };

    popupTemplate = '<div class="popup">' +
        '<h2>{name}</h2>' +
        '<p>{city}, {state}</p>' +
        '<div class="images">{imgs}</div>' +
        '<dl>' +
          '<dt>Station number</dt><dd>{station}</dd>' +
          '<dt>Building number</dt><dd>{building}</dd>' +
          '<dt>Sensors in building</dt><dd>{sensors_structure}</dd>' +
          '<dt>Sensors in ground</dt><dd>{sensors_ground}</dd>' +
        '</dl>' +
      '</div>';

    popup = L.Util.template(popupTemplate, data);
    marker.popup = popup;

    _oms.addMarker(marker);

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
    el.innerHTML = count + ' structures on this map';
  };

  _initialize(options);
  options = null;
  return _this;
};


L.buildingsLayer = BuildingsLayer;

module.exports = BuildingsLayer;
