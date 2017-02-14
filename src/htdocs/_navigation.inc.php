<?php

$section = $CONFIG['MOUNT_PATH'];
$url = $_SERVER['REQUEST_URI'];

$matchesIndex = preg_match("@^$section/$@", $_SERVER['REQUEST_URI']);

$NAVIGATION =
  navGroup('NSMP',
    navItem("$section/", 'Overview', $matchesIndex) .
    navItem("$section/stations.php", 'Station Map') .
    navItem("$section/arrays/", 'Structural Arrays') .
    navItem("$section/buildings/", 'Buildings') .
    navItem("$section/nsmpdata.php", 'Data') .
    navItem("$section/history/", 'History')
  );

print $NAVIGATION;
