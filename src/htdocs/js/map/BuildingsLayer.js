/* global L, MOUNT_PATH, OverlappingMarkerSpiderfier */
'use strict';


var _DEFAULTS,
    _LAYERNAMES,
    _MARKER_DEFAULTS;

_MARKER_DEFAULTS = {
  fillOpacity: 0.3,
  opacity: 0.7,
  radius: 8,
  weight: 1
};
_DEFAULTS = {
  json: {},
  markerOptions: _MARKER_DEFAULTS
};
_LAYERNAMES = {
  array: 'Building Array',
  reference: 'Reference Site'
};


/**
 * Factory for Buildings overlay.
 *
 * @param options {Object}
 *     {
 *       json: {String} Geojson data
 *       map: {L.Map}
 *       markerOptions: {Object} L.CircleMarker options (optional)
 *     }
 *
 * @return _this {L.FeatureGroup}
 */
L.BuildingsLayer = function (options) {
  var _initialize,
      _this,

      _map,
      _markerOptions,
      _oms,

      _createLayers,
      _getContent,
      _getImages,
      _initOms,
      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = L.featureGroup();

  _initialize = function (options) {
    options = Object.assign({}, _DEFAULTS, options);

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
   * Create the map layers for each building type.
   */
  _createLayers = function () {
    _this.count = {};
    _this.layers = {};
    _this.names = _LAYERNAMES;

    Object.keys(_LAYERNAMES).forEach(type => {
      _this.count[type] = 0;
      _this.layers[type] = L.featureGroup();

      _map.createPane(type, _map.getPane('overlayPane'));
      _this.addLayer(_this.layers[type]); // add map layer to featureGroup
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
        '<h2>{name}</h2>' +
        '<p>{city}, {state}</p>' +
        '<div class="images">{images}</div>' +
        '<dl>' +
          '<dt>Station number</dt><dd>{station}</dd>' +
          '<dt>Building number</dt><dd>{building}</dd>' +
          '<dt>Sensors in building</dt><dd>{sensors_structure}</dd>' +
          '<dt>Sensors in ground</dt><dd>{sensors_ground}</dd>' +
        '</dl>' +
      '</div>';

    return L.Util.template(template, data);
  };

  /**
   * Get the images for a popup.
   *
   * @param props {Object}
   *
   * @return images {String}
   */
  _getImages = function (props) {
    var images,
        path;

    images = '';
    path = MOUNT_PATH + '/data/buildings';

    if (props.photo) {
      images +=
        `<a href="${path}/photos/${props.photo}" target="_blank" title="Photo">` +
          `<img src="${path}/photos/thumbs/${props.photo}" alt="building photo" />` +
        '</a>';
    }
    if (props.layout) {
      images +=
        `<a href="${path}/layouts/${props.layout}" target="_blank" title="Building Layout">` +
          `<img src="${path}/layouts/thumbs/${props.layout_thumb}" alt="building layout" />` +
        '</a>';
    }

    return images;
  };

  /**
   * Initialize the OverlappingMarkerSpiderfier (oms) Leaflet plugin.
   */
  _initOms = function () {
    var popup = L.popup({
      autoPanPadding: L.point(60, 10),
      minWidth: 240
    });

    _oms = new OverlappingMarkerSpiderfier(_map, {
      nearbyDistance: 1 // use min. distance: only for markers w/ identical coords
    });

    _oms.addListener('click', marker => {
      var data = Object.assign({}, marker.props, {
        images: _getImages(marker.props)
      });

      popup.setContent(_getContent(data));
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
    type = props.type;

    layer.bindTooltip(props.name);
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
   * @return {L.CircleMarker}
   */
  _pointToLayer = function (feature, latlng) {
    var options,
        type;

    type = feature.properties.type;
    options = {
      pane: type
    };

    if (type === 'array') {
      Object.assign(options, _markerOptions, {
        color: '#0c0',
        fillColor: '#0c0'
      });
    } else if (type === 'reference') {
      Object.assign(options, _markerOptions, {
        color: '#00c',
        fillColor: '#00c'
      });
    }

    return L.circleMarker(latlng, options);
  };

  /**
   * Show the number of buildings below the map.
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el = document.querySelector('.count');

    el.innerHTML = count + ' structures on this map';
  };


  _initialize(options);
  options = null;
  return _this;
};


L.buildingsLayer = function (options) {
  return new L.BuildingsLayer(options);
};
