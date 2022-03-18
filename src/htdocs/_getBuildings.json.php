<?php

include_once '../conf/config.inc.php'; // app config
include_once '../lib/_functions.inc.php'; // app functions
include_once '../lib/classes/Db.class.php'; // db connector, queries

$callback = safeParam('callback');
$now = date(DATE_RFC2822);

$db = new Db;

$rsBuildings = $db->queryBuildings();

// Initialize array template for json feed
$output = [
  'generated' => $now,
  'count' => $rsBuildings->rowCount(),
  'type' => 'FeatureCollection',
  'features' => []
];

$thumbPath = $DATA_DIR . '/buildings/layouts/thumbs/';

// Store results from Instruments / Plots tables in features array
while ($row = $rsBuildings->fetch(PDO::FETCH_ASSOC)) {
  // NOTE: ImageMagick adds '-0', '-1', etc when converting multipage .pdf to .png
  $thumb = '';
  if ($row['filename_layout']) {
    $thumb = preg_replace('/pdf$/', 'png', $row['filename_layout']);
    // Try file-0.png if file.png doesn't exist
    if (!file_exists("$thumbPath/$thumb")) {
      $thumb = preg_replace('/\.pdf$/', '-0.png', $row['filename_layout']);
    }
  }

  $feature = [
    'geometry' => [
      'coordinates' => [
        floatval($row['lon']),
        floatval($row['lat'])
      ],
      'type' => 'Point'
    ],
    'id' => 'point' . intval($row['id']),
    'properties' => [
      'building' => $row['building'],
      'city' => $row['city'],
      'layout' => $row['filename_layout'],
      'layout_thumb' => $thumb,
      'name' => $row['name'],
      'photo' => $row['filename_photo'],
      'repositories' => $row['repositories'],
      'sensors_ground' => $row['sensors_ground'],
      'sensors_structure' => $row['sensors_structure'],
      'state' => $row['state'],
      'station' => $row['station'],
      'type' => $row['type']
    ],
    'type' => 'Feature'
  ];

  array_push($output['features'], $feature);
}

// Send json stream to browser
showJson($output, $callback);
