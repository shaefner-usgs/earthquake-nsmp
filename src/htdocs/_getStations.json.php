<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$callback = safeParam('callback');
$now = date(DATE_RFC2822);

$db = new Db;

$rsStations = $db->queryStations();

// Initialize array template for json feed
$output = [
  'generated' => $now,
  'count' => $rsStations->rowCount(),
  'type' => 'FeatureCollection',
  'features' => []
];

// Store results from Instruments / Plots tables in features array
while ($row = $rsStations->fetch(PDO::FETCH_ASSOC)) {
  $feature = [
    'geometry' => [
      'coordinates' => [
        floatval($row['chalon']),
        floatval($row['chalat']),
        floatval($row['elevation'])
      ],
      'type' => 'Point'
    ],
    'id' => 'point' . intval($row['id']),
    'properties' => [
      'cosmoscode' => intval($row['cosmoscode']),
      'numchan' => intval($row['numchan']),
      'owner' => $row['site_agency'],
      'rectype' => $row['rectype'],
      'sentype' => $row['sentype'],
      'stacode' => $row['stacode'],
      'staname' => utf8_encode($row['staname'])
    ],
    'type' => 'Feature'
  ];

  array_push($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
