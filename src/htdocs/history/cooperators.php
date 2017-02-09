<?php

include_once '../../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Cooperators';
  $NAVIGATION = true;

  include 'template.inc.php';
}

?>

<table>
  <tr>
    <th colspan="2">Owner Agency</th>
    <th>Stations</th>
    <th>Recorders*</th>
  </tr>
  <tr>
    <td>ACOE</td>
    <td>Army Corps of Engineers</td>
    <td>74</td>
    <td>184</td>
  </tr>
  <tr>
    <td>Altarock</td>
    <td>Altarock Energy</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>ARH</td>
    <td>Alaska Regional Hospital</td>
    <td>01</td>
    <td>03</td>
  </tr>
  <tr>
    <td>BYU</td>
    <td>Brigham Young University</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>CCSF</td>
    <td>City-County San Francisco</td>
    <td>01</td>
    <td>02</td>
  </tr>
  <tr>
    <td>CDWR</td>
    <td>California Department of Water Resources</td>
    <td>03</td>
    <td>06</td>
  </tr>
  <tr>
    <td>Calpine</td>
    <td>Calpine Corporation</td>
    <td>02</td>
    <td>02</td>
  </tr>
  <tr>
    <td>GSA</td>
    <td>U.S. General Services Administration</td>
    <td>09</td>
    <td>23</td>
  </tr>
  <tr>
    <td>ICL</td>
    <td>California, Imperial County Landfill</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>JPL</td>
    <td>NASA, Jet Propulsion Laboratory</td>
    <td>08</td>
    <td>09</td>
  </tr>
  <tr>
    <td>MWD</td>
    <td>Metropolitan Water District of Southern California</td>
    <td>23</td>
    <td>54</td>
  </tr>
  <tr>
    <td>NEU</td>
    <td>Northeastern University</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>ODOT</td>
    <td>Oregon Department of Transportation</td>
    <td>10</td>
    <td>12</td>
  </tr>
  <tr>
    <td>SCL</td>
    <td>Seattle City Light</td>
    <td>01</td>
    <td>04</td>
  </tr>
  <tr>
    <td>SLCC</td>
    <td>Salt Lake City Cooperation</td>
    <td>01</td>
    <td>03</td>
  </tr>
  <tr>
    <td>UAGI</td>
    <td>University of Alaska Geophysical Institute</td>
    <td>22</td>
    <td>22</td>
  </tr>
  <tr>
    <td>UCSB</td>
    <td> University of California Santa Barbara</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td>UDOT</td>
    <td>Utah Department of Transportation</td>
    <td>01</td>
    <td>02</td>
  </tr>
  <tr>
    <td>UPRM</td>
    <td> University of Puerto Rico, Mayaguez</td>
    <td>100</td>
    <td>108</td>
  </tr>
  <tr>
    <td>USGS</td>
    <td>U.S. Geological Survey</td>
    <td>449</td>
    <td>491</td>
  </tr>
  <tr>
    <td>VA</td>
    <td>U.S. Department of Veterans Affairs</td>
    <td>84</td>
    <td>91</td>
  </tr>
  <tr>
    <td>WDNR</td>
    <td>Washington Department of Natural Resources</td>
    <td>01</td>
    <td>01</td>
  </tr>
  <tr>
    <td colspan="2"><strong>TOTALS</strong></td>
    <td><strong>792**</strong></td>
    <td><strong>1018</strong></td>
  </tr>
</table>

<p>* Does not include devices that do not record time series</p>
<p>** Three stations have multiple recorders from two agencies (actual station number is 789)</p>
