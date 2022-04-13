<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Contacts';
  $NAVIGATION = true;
  $HEAD = '';
  $FOOT = '';

  include 'template.inc.php';
}

?>

<ul>
  <li><a href="https://www.usgs.gov/staff-profiles/lisa-schleicher">Lisa Schleicher</a>, NSMP Data Center Manager</li>
  <li><a href="https://www.usgs.gov/staff-profiles/lind-s-gee">Lind S. Gee</a>, Earthquake Monitoring Project Chief</li>
  <li><a href="https://www.usgs.gov/staff-profiles/dean-childs">Dean Childs</a>, NSMP Operations Manager</li>
</ul>
