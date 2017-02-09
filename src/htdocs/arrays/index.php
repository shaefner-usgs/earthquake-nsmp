<?php

include_once '../../conf/config.inc.php'; // app config
include_once '../../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Structural and Geotechnical Arrays';
  $NAVIGATION = true;
  $HEAD = '';
  $FOOT = '';

  include 'template.inc.php';
}

$lookup = array(
  10 => 'Buildings',
  11 => 'Bridges, Overpasses',
  12 => 'Dams',
  13 => 'Miscellaneous',
  14 => 'Miscellaneous',
  15 => 'Miscellaneous',
  50 => 'Geotechnical Arrays'
);

$db = new Db;

$rsArrays = $db->queryArrays();

print '<pre>';
var_dump($rsArrays->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_COLUMN));

// while ($row = $rsArrays(PDO::FETCH_ASSOC)) {
//
// }

?>

<p>This list of current structural arrays is grouped into five broad categories based on the &ldquo;Station Type codes&rdquo; defined in Table 6 of the <a href="http://www.strongmotioncenter.org/NCESMD/reports/Cosmos_Tables.xls">COSMOS* data format</a>:</p>

<ul>
  <li>
    <a href="#Buildings">Buildings</a>
  </li>
  <li>
    <a href="#Bridges">Bridges, Overpasses</a>
  </li>
  <li>
    <a href="#Dams">Dams</a>
  </li>
  <li>
    <a href="#Miscellaneous">Miscellaneous</a>
  </li>
  <li>
    <a href="#Geotechnical">Geotechnical Arrays</a>
  </li>
</ul>

<p>Densely instrumented structures, such as in <a href="arrays/la.php">Los Angeles</a> and in <a href="arrays/sf.php">San Francisco</a>, may have 36 or more sensors.</p>

<p>&ldquo;Site Agency&rdquo; designations other than &ldquo;U.S. Geological Survey&rdquo; generally denote that these agencies purchased the equipment and/or partner with the NSMP in the operation and maintenance of the equipment. Supporting metadata that describes the &ldquo;SEED&rdquo; (Standard for Earthquake Data Exchange) instrument response for each data channel is available at the <a href="http://quake.geo.berkeley.edu/ftp/pub/doc/NP.info/">Northern California Earthquake Data Center</a>. The <a href="http://www.fdsn.org/">International Federation of Digital Seismograph Networks</a> code for all NSMP stations is &ldquo;NP&rdquo;.</p>
<p>* <a href="http://cosmos-eq.org/">Consortium of Organizations for Strong Motion Observation Systems</a></p>
