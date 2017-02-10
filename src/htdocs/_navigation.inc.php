<?php

$section = $CONFIG['MOUNT_PATH'];
$url = $_SERVER['REQUEST_URI'];

$NAVIGATION =
  navGroup('NSMP',
    navItem("$section/index.php", 'Overview') .
    navItem("$section/stations.php", 'Station Map') .
    navItem("$section/arrays/", 'Structural Arrays') .
    navItem("$section/buildings/", 'Buildings') .
    navItem("$section/nsmpdata.php", 'Data') .
    navItem("$section/history/", 'History')
  );

print $NAVIGATION;
