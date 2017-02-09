<?php

include_once '../../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'NSMP Instrumentation of Multi-Story Buildings in the Los Angeles Region';
  $NAVIGATION = true;

  include 'template.inc.php';
}

?>

<p>To study the transmission and propagation of seismic waves in
multi-story buildings, the U.S. Geological Survey in cooperation with the California
Institute of Technology (Caltech) and the University of California at Los Angeles (UCLA)
installed dense strong-motion arrays at the Millikan Library at Caltech and the
Factor (Health Sciences) Building at UCLA.</p>

<h2>Millikan Library at Caltech</h2>

<figure class="left">
  <img src="../img/millikan.jpg" alt="Millikan library" style="max-width: 225px;" />
</figure>

<p>The 9-story reinforced concrete
frame/shear-wall Millikan Library has a total of 36 channels, three horizontals on each
floor plus three verticals in the basement. The building also serves as a full-scale test structure for the development and
testing of structural health and performance monitoring methodologies. There are
currently two web-based monitoring systems installed in the buildin. The two web-based
systems are the COMET system and the R-SHAPE system. The R-SHAPE system provides
real-time access to the all 36 channels of data available in the building. The
COMET system provides online modal identification and data warehousing using the
9th floor accelerations. Both systems are continually under development and are
used for research as well as educational purposes.</p>

<img src="../img/millikan_inst.gif" alt="Millikan instrumentation" />

<h2>Factor (Health Sciences) Building at UCLA</h2>

<figure class="left">
  <img src="../img/factor.jpg" alt="Factor building" style="max-width: 225px;" />
</figure>

<p>The 17-story, steel-frame Factor building has a Kinemetrics FBA-11
accelerometer network (72 channels total) composed of four horizontal channels
per floor except for the basement and subbasement which have two vertical and two
horizontal channels each. The horizontal sensors are oriented north-south and
east-west along the mid-sections of most floors  The force-balance accelerometer sensors have
a natural frequency of 50 Hz, normal damping at 70% of critical, and a dynamic
range of 135 dB from 0.01 to 50 Hz. The output range scale is ±4g. The
digitizers, located in the building's top floor, consist of 9 Quanterra 4128s,
each recording 8 channels of continuous data.</p>

<p>In July, 2005, a 100-m-deep borehole and an overhead surface seismometer were
installed in the nearby Botanical Gardens ~25 m from the building. They consist
of a 3-component shallow 1g Episensor at 100 meters depth (Kinemetrics
SBEPI-110) and a 2g Episensor at the surface, both connected to a Quanterra
4128. The GPS antennae is on the roof of the building. The waveform data from
the borehole seismometers are included in the array datasets being archived
onsite and at the IRIS Data Management Center.</p>

<img src="../img/factin.gif" alt="Factor instrumentation" />
