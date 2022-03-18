<?php

include_once '../../conf/config.inc.php'; // app config
include_once '../../lib/classes/Db.class.php'; // db connector, queries

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Structural and Geotechnical Arrays';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="../css/arrays.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

$categories = [
  11 => 'Bridges, Overpasses',
  10 => 'Buildings',
  12 => 'Dams',
  50 => 'Geotechnical Arrays',
  13 => 'Miscellaneous',
  14 => 'Miscellaneous',
  15 => 'Miscellaneous'
];

$db = new Db;

$rsArrays = $db->queryArrays();

// Create associative array with $arrays indexed by cosmoscode (first column of result set)
$arrays = $rsArrays->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);

// Create HTML for data tables
$arraysHtml = '';
$prevCategory = '';
foreach ($categories as $key=>$value) {
  $category = $value;
  if ($category !== $prevCategory) { // need this check b/c mult 'Miscellaneous' categories
    if ($arraysHtml) {
      $arraysHtml .= '</table>'; // close open <table> tag if it exists
    }
    $arraysHtml .= sprintf ('<a class="category" id="%s"><h2>%s</h2></a>',
      strtok($value, ', '),
      $value
    );
    $arraysHtml .= '<table>
      <tr>
        <th>Station Code</th>
        <th>Name</th>
        <th>City</th>
        <th>State</th>
        <th>Location</th>
        <th>Site Agency</th>
        <th>Channels</th>
        <th>Links</th>
      </tr>';
  }
  foreach ($arrays[$key] as $array) {
    $coords = [
      $array['lat'],
      $array['lon']
    ];
    $links = [
      'map' => sprintf ('https://www.google.com/maps/place/%s',
        implode(',', $coords)
      )
    ];
    if ($array['image']) {
      $links['photo'] = $MOUNT_PATH . '/data/arrays/photos/' . $array['image'];
    }
    if ($array['schematic']) {
      $links['schematic'] = $MOUNT_PATH . '/data/arrays/schematics/' . $array['schematic'];
    }
    $linklist = [];
    foreach ($links as $anchor=>$href) {
      $linklist[] = "<a href=\"$href\">$anchor</a>";
    }
    $arraysHtml .= sprintf('<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
      </tr>',
      $array['stacode'],
      $array['name'],
      $array['city'],
      $array['state'],
      implode(', ', $coords),
      $array['agency'],
      $array['channels'],
      implode(', ', $linklist)
    );
  }
  $prevCategory = $category;
}
$arraysHtml .= '</table>';

?>

<p>This list of current structural arrays is grouped into five broad categories
  based on the &ldquo;Station Type codes&rdquo; defined in Table 6 of the
  <a href="http://www.strongmotioncenter.org/NCESMD/reports/Cosmos_Tables.xls">COSMOS*
    data format</a>:</p>

<ul>
  <li>
    <a href="#Bridges">Bridges, Overpasses</a>
  </li>
  <li>
    <a href="#Buildings">Buildings</a>
  </li>
  <li>
    <a href="#Dams">Dams</a>
  </li>
  <li>
    <a href="#Geotechnical">Geotechnical Arrays</a>
  </li>
  <li>
    <a href="#Miscellaneous">Miscellaneous</a>
  </li>
</ul>

<p>Densely instrumented structures, such as in <a href="la.php">Los
  Angeles</a> and in <a href="sf.php">San Francisco</a>, may have 36 or
  more sensors.</p>

<p>&ldquo;Site Agency&rdquo; designations other than &ldquo;U.S. Geological
  Survey&rdquo; generally denote that these agencies purchased the equipment
  and/or partner with the NSMP in the operation and maintenance of the equipment.
  Supporting metadata that describes the &ldquo;SEED&rdquo; (Standard for
  Earthquake Data Exchange) instrument response for each data channel is
  available at the <a href="http://quake.geo.berkeley.edu/ftp/pub/doc/NP.info/">Northern
  California Earthquake Data Center</a>. The <a href="http://www.fdsn.org/">International
  Federation of Digital Seismograph Networks</a> code for all NSMP stations
  is &ldquo;NP&rdquo;.</p>

<p>* <a href="http://cosmos-eq.org/">Consortium of Organizations for Strong
  Motion Observation Systems</a></p>

<?php print $arraysHtml; ?>
