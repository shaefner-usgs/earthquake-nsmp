/* global L */
'use strict';


var Luxon = require('luxon');


var _COLORS,
    _DEFAULTS,
    _MARKER_DEFAULTS;

_COLORS = {
  pasthour: '#f00',
  pastday: '#f90',
  pastweek: '#ff0',
  pastmonth: '#ffc'
};
_MARKER_DEFAULTS = {
  color: '#000',
  fillOpacity: 0.85,
  opacity: 0.6,
  weight: 1
};
_DEFAULTS = {
  data: {},
  markerOptions: _MARKER_DEFAULTS
};


/**
 * Factory for Earthquakes overlay.
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *       markerOptions: {Object} L.Path options
 *     }
 *
 * @return _this {L.FeatureGroup}
 */
L.EarthquakesLayer = function (options) {
  var _this,
      _initialize,

      _markerOptions,
      _now,
      _pastDay,
      _pastHour,
      _pastWeek,

      _getAge,
      _onEachFeature,
      _pointToLayer;


  _initialize = function (options) {
    options = Object.assign({}, _DEFAULTS, options);

    _markerOptions = Object.assign({}, _MARKER_DEFAULTS, options.markerOptions);
    _now = Luxon.DateTime.utc();
    _pastDay = _now.minus({ days: 1 });
    _pastHour = _now.minus({ hours: 1 });
    _pastWeek = _now.minus({ weeks: 1 });

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };


  /**
   * Get the 'age' of an earthquake (pasthour, pastday, etc).
   *
   * @param tiemstamp {Int}
   *     milliseconds since 1970
   *
   * @return age {String}
   */
  _getAge = function (timestamp) {
    var age,
        eqTime;

    eqTime = Luxon.DateTime.fromMillis(timestamp).toUTC();

    if (eqTime >= _pastHour) {
      age = 'pasthour';
    } else if (eqTime >= _pastDay) {
      age = 'pastday';
    } else if (eqTime >= _pastWeek) {
      age = 'pastweek';
    } else {
      age = 'pastmonth';
    }

    return age;
  };

  /**
   * Create Leaflet popups and tooltips.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    var data,
        label,
        labelTemplate,
        popup,
        popupTemplate,
        props;

    props = feature.properties;
    data = {
      mag: Math.round(props.mag * 10) / 10,
      time: Luxon.DateTime.fromMillis(props.time).toUTC().toFormat('LLL d, yyyy TT') + ' UTC',
      place: props.place,
      url: props.url
    };
    labelTemplate = 'M{mag} - {time}';
    label = L.Util.template(labelTemplate, data);
    popupTemplate =
      '<div class="popup eq">' +
        '<h2>M{mag}, {place}</h2>' +
        '<time>{time}</time>' +
        '<p><a href="{url}" target="_blank">Details</a> &raquo;</p>' +
      '</div>';
    popup = L.Util.template(popupTemplate, data);

    layer.bindPopup(popup, {
      autoPanPadding: L.point(50, 50),
      maxWidth: '265'
    }).bindTooltip(label);
  };

  /**
   * Create Leaflet markers.
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return marker {L.CircleMarker}
   */
  _pointToLayer = function (feature, latlng) {
    var age,
        fillColor,
        radius;

    age = _getAge(feature.properties.time);
    fillColor = _COLORS[age];
    radius = 3 * parseInt(Math.pow(10, (0.11 * feature.properties.mag)), 10);

    _markerOptions.fillColor = fillColor;
    _markerOptions.radius = radius;

    return L.circleMarker(latlng, _markerOptions);
  };


  _initialize(options);
  options = null;
  return _this;
};


L.earthquakesLayer = function (options) {
  return new L.EarthquakesLayer(options);
};
