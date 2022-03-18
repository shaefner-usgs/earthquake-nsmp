<?php

include_once '../../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Stations Distributed by State';
  $NAVIGATION = true;

  include 'template.inc.php';
}

?>

<table>
  <tr>
    <th>State</th>
    <th>Stations</th>
    <th>Recorders*</th>
  </tr>
  <tr>
    <td>Alabama</td>
    <td>01</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Alaska</td>
    <td>76</td>
    <td>90</td>
  </tr>
  <tr>
    <td>Arizona</td>
    <td>04</td>
    <td>04</td>
  </tr>
  <tr>
    <td>Arkansas</td>
    <td>06</td>
    <td>06</td>
  </tr>
  <tr>
    <td>California</td>
    <td>330</td>
    <td>482</td>
  </tr>
  <tr>
    <td>Colorado</td>
    <td>01</td>
    <td>03</td>
  </tr>
  <tr>
    <td>Georgia</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Hawaii</td>
    <td>31</td>
    <td>31</td>
  </tr>
  <tr>
    <td>Idaho</td>
    <td>07</td>
    <td>08</td>
  </tr>
  <tr>
    <td>Illinois</td>
    <td>05</td>
    <td>05</td>
  </tr>
  <tr>
    <td>Indiana</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Kansas</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>Kentucky</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>Maine</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>Massachusetts</td>
    <td>08</td>
    <td>08</td>
  </tr>
  <tr>
    <td>Missouri</td>
    <td>16</td>
    <td>19</td>
  </tr>
  <tr>
    <td>Montana</td>
    <td>09</td>
    <td>12</td>
  </tr>
  <tr>
    <td>Nevada</td>
    <td>17</td>
    <td>17</td>
  </tr>
  <tr>
    <td>New Hampshire</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>New Mexico</td>
    <td>08</td>
    <td>14</td>
  </tr>
  <tr>
    <td>New York</td>
    <td>08</td>
    <td>09</td>
  </tr>
  <tr>
    <td>North Carolina</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Ohio</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Oklahoma</td>
    <td>03</td>
    <td>03</td>
  </tr>
  <tr>
    <td>Oregon</td>
    <td>30</td>
    <td>82</td>
  </tr>
  <tr>
    <td>Pennsylvania</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>Rhode Island</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>South Carolina</td>
    <td>06</td>
    <td>07</td>
  </tr>
  <tr>
    <td>Tennessee</td>
    <td>11</td>
    <td>11</td>
  </tr>
  <tr>
    <td>Utah</td>
    <td>31</td>
    <td>39</td>
  </tr>
  <tr>
    <td>Vermont</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>Virginia</td>
    <td>05</td>
    <td>05</td>
  </tr>
  <tr>
    <td>West Virginia</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>Washington</td>
    <td>39</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Puerto Rico</td>
    <td>94</td>
    <td>99</td>
  </tr>
  <tr>
    <td>Virgin Islands</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>British Virgin Islands</td>
    <td>05</td>
    <td>07</td>
  </tr>
  <tr>
    <td><strong>TOTALS</strong></td>
    <td><strong>718</strong></td>
    <td><strong>1039</strong></td>
  </tr>
</table>

<p>* Does not include devices that do not record time series data such as seismic alarms.</p>
