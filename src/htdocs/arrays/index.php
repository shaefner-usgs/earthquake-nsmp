<?php

include_once '../../conf/config.inc.php'; // app config
include_once '../../lib/classes/Database.class.php'; // db connector, queries

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
  50 => 'Geotechnical Arrays, Boreholes',
  51 => 'Geotechnical Arrays, Boreholes',
  52 => 'Geotechnical Arrays, Boreholes',
  13 => 'Miscellaneous',
  14 => 'Miscellaneous',
  15 => 'Miscellaneous'
];
$db = new Database;
$html = '';
$prevCategory = '';
$rsArrays = $db->queryArrays();

// Create an Array with $arrays indexed by cosmoscode (first column of result set)
$arrays = $rsArrays->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);

// Create the HTML for the data tables
foreach ($categories as $code => $category) {
  if ($category !== $prevCategory) { // necessary due to mult. 'Miscellaneous' categories
    if ($html) {
      $html .= '</table>';
    }

    $html .= sprintf ('<a class="category" id="%s"><h2>%s</h2></a>',
      strtok($category, ', '),
      $category
    );
    $html .= '
      <table>
        <tr>
          <th>Station Code</th>
          <th>Network Code</th>
          <th>Name</th>
          <th>City</th>
          <th>State</th>
          <th>Location</th>
          <th>Site Agency</th>
          <th>Channels</th>
          <th>Links</th>
        </tr>';
  }

  foreach ($arrays[$code] as $array) {
    $coords = [
      $array['lat'],
      $array['lon']
    ];
    $linklist = [];
    $links = [
      'map' => sprintf ('https://maps.google.com/maps?t=k&q=loc:%s',
        implode('+', $coords)
      )
    ];
    $station = $array['stacode'];

    if ($array['decommissioned']) {
      $station .= ' <sup><a href="#fn2">2</a></sup>';
    }

    if ($array['data']) {
      $links['data'] = $array['data'];
    }

    if ($array['nees']) {
      $links['NEES portal'] = $array['nees'];
    }

    if ($array['station']) {
      $links['photo and schematic'] = $array['station'];
    }

    foreach ($links as $description => $href) {
      $linklist[] = sprintf('<a href="%s">%s</a>',
        $href,
        $description
      );
    }

    $html .= sprintf('
      <tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
      </tr>',
      $station,
      $array['network'],
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

$html .= '</table>';

?>

<p>This list of current structural arrays is grouped into five broad categories
  based on the &ldquo;Station Type codes&rdquo; defined in
  <a href="https://www.strongmotioncenter.org/NCESMD/reports/Cosmos_Tables.xls">Table 6</a>
  of the COSMOS<sup><a href="#fn1">1</a></sup> data format:</p>

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
    <a href="#Geotechnical">Geotechnical Arrays, Boreholes</a>
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
  available at the <a href="https://www.ncedc.org/ftp/pub/doc/NP.info/">Northern
  California Earthquake Data Center</a>. The <a href="https://www.fdsn.org/">International
  Federation of Digital Seismograph Networks</a> code for all NSMP stations
  is &ldquo;NP&rdquo;.</p>

<p>All NSMP waveform products are publicly available for download at the
  <a href="https://www.strongmotioncenter.org/">Center for Engineering Strong
  Motion Data</a>.</p>

<?php print $html; ?>

<p class="partners">Strong motion networks that partner with the NSMP:
  <a href="https://www.conservation.ca.gov/cgs/smip">CE</a>,
  <a href="https://www.scsn.org/">CI</a>,
  <a href="https://www.memphis.edu/ceri/">NM</a>,
  <a href="http://www.prsmp.uprm.edu/prsmp2/">PR</a>.
</p>

<p>For SB network stations, complete borehole array data must be downloaded from
  <a href="http://nees.ucsb.edu/data-portal">NEES@UCSB</a>.</p>

<hr />

<ol>
  <li id="fn1">
    <a href=" https://www.strongmotion.org/">Consortium of Organizations for Strong
      Motion Observation Systems</a>
  </li>
  <li id="fn2">Station has been decommissioned</li>
</ol>
