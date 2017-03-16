<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Stations';
  $NAVIGATION = true;
  $HEAD = '
    <link rel="stylesheet" href="/lib/leaflet-0.7.7/leaflet.css" />
    <link rel="stylesheet" href="css/stations.css"/>
  ';
  $FOOT = '
    <script>
      var MOUNT_PATH = "' . $CONFIG['MOUNT_PATH'] . '";
    </script>
    <script src="/lib/leaflet-0.7.7/leaflet.js"></script>
    <script src="lib/oms/oms.js"></script>
    <script src="js/stations.js"></script>
  ';

  include 'template.inc.php';
}

?>

<p>This map shows the location of seismic data loggers from which the NSMP
  acquires strong motion accelerograms. Each data logger records the signal
  from several accelerometer sensors (note that some stations may have multiple
  data loggers). At structures like dams or the Bill Emerson Memorial Bridge,
  which spans the Mississippi River at Cape Girardeau, MO, the location of data
  loggers correspond to the location of the accelerometers. At buildings like
  the Transamerica Tower in downtown San Francisco, it is infeasible to depict
  the location of all of the sensors on this map, and we refer you to the
  &ldquo;<a href="arrays/">Structural Arrays</a>&rdquo;
  section for additional information on the number of sensors and a schematic
  of the sensor deployment.</p>

<div class="map"></div>

<p class="count"></p>

<ul class="legend types no-style">
  <li>
    <img src="img/pin-m-building+48a.png" alt="marker icon">
    <span>Building</span>
  </li>
  <li>
    <img src="img/pin-m-bridge+48a.png" alt="marker icon">
    <span>Bridge, overpass</span>
  </li>
  <li>
    <img src="img/pin-m-dam+48a.png" alt="marker icon">
    <span>Dam</span>
  </li>
  <li>
    <img src="img/pin-m-ref+48a.png" alt="marker icon">
    <span>Free-field and reference</span>
  </li>
  <li>
    <img src="img/pin-m-array+48a.png" alt="marker icon">
    <span>Geotechnical Array</span>
  </li>
  <li>
    <img src="img/pin-m-misc+48a.png" alt="marker icon">
    <span>Misc</span>
  </li>
</ul>
<ul class="legend owners no-style">
  <li>
    <img src="img/pin-m+48a.png" alt="marker icon">
    <span>USGS site</span>
  </li>
  <li>
    <img src="img/pin-m+c34.png" alt="marker icon">
    <span>non-USGS site</span>
  </li>
</ul>
