/* global L */
'use strict';


require('map/MouseOverLayer');


/**
 * Factory for Faults overlay.
 *
 * @return  {L.layerGroup}
 */
L.FaultsLayer = function () {
  var faults,
      plates,
      urlPrefix;

  urlPrefix = 'https://bayquakealliance.org/faults/tiles/';
  faults = L.mouseOverLayer({
    dataUrl: urlPrefix + 'faults/{z}/{x}/{y}.grid.json?callback={cb}',
    tileOpts: {
      maxZoom: 17,
      minZoom: 6
    },
    tileUrl: urlPrefix + 'faults/{z}/{x}/{y}.png',
    tiptext: '{NAME}'
  });
  plates = L.tileLayer(urlPrefix + 'plates/{z}/{x}/{y}.png', {
    minZoom: 0,
    maxZoom: 5
  });

  return L.layerGroup([
    plates,
    faults
  ]);
};


L.faultsLayer = function () {
  return new L.FaultsLayer();
};
