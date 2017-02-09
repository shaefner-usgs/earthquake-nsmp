<?php

$section = $CONFIG['MOUNT_PATH'];
$url = $_SERVER['REQUEST_URI'];

$matches_index = false;
if (preg_match("@^$section(/index.php)?$@", $url)) {
  $matches_index = true;
}
$matches_arrays = false;
if (preg_match("@^$section/arrays(/index.php)?$@", $url)) {
  $matches_arrays = true;
}

$NAVIGATION =
  navGroup('NSMP',
    navItem("$section/index.php", 'Overview') .
    navItem("$section/stations.php", 'Station Map') .
    navItem("$section/arrays/index.php", 'Structural Arrays') .
    navItem("$section/buildings/index.php", 'Buildings') .
    navItem("$section/nsmpdata.php", 'Data') .
    navItem("$section/history.php", 'History')
  );

print $NAVIGATION;
