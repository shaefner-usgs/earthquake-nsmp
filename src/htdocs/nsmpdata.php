<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Data';
  $NAVIGATION = true;
  $HEAD = '';
  $FOOT = '';

  include 'template.inc.php';
}

?>

<p>Processed strong-motion records of engineering interest are available at the <a href="https://strongmotioncenter.org/">Center for Engineering Strong Motion Data</a> (CESMD), a cooperative effort between the USGS and the California Geological Survey.</p>

<p>At the CESMD, access to ground and structural response data for earthquakes in the U.S. is provided via <a href="https://strongmotioncenter.org/cgi-bin/CESMD/iqr1.pl">Internet Quick Reports</a>, which summarize strong-motion records recovered for very recent earthquakes, and through <a href="https://strongmotioncenter.org/cgi-bin/CESMD/archive.pl">Internet Data Reports</a> for older events.</p>

<p>Two data search options are currently supported by the CESMD, one for U.S. ground and structural response data at the <a href="https://strongmotioncenter.org/cgi-bin/CESMD/search1.pl">Engineering Data Center</a> (EDC), and one for worldwide ground response data at the <a href="https://strongmotioncenter.org/vdc/scripts/default.plx">Virtual Data Center</a> (VDC). The USGS also has an archive of <a href="https://escweb.wr.usgs.gov/nsmp-data/">older NSMP data</a> not yet available at the CESMD.</p>

<p><a href="http://quake.geo.berkeley.edu/ftp/pub/doc/NP.info">Station metadata</a> describing the coordinates, instrument response, and epochs of operation for all equipment operated by the NSMP is available from the Northern California Earthquake Data Center.</p>
