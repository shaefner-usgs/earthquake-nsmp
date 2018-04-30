<?php

include_once '../../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'Structural Health Monitoring (SHM) Frequently Asked Questions';
  $HEAD = '<link rel="stylesheet" href="../css/faq.css" />';
  $NAVIGATION  = true;
  $FOOT = '';

  include 'template.inc.php';
}

?>

<h2>General</h2>

<dl>
  <dt>What is structural health monitoring (SHM)?</dt>
  <dd>Structural health monitoring is the process of measuring structural response often in near real-time (for instance via an array of sensors, GPS receivers, imaging technologies etc.) to assess conditions or serviceability after severe loading events (such as earthquakes), and track progressive deterioration. </dd>
</dl>

<h2>OpenSHM</h2>

<dl>
  <dt>What is OpenSHM?</dt>
  <dd>OpenSHM is a robust and versatile SHM software platform consisting of several data processing modules integrated into an open-source architecture. This platform compresses a large amount of measured response data into useful information for assessing the condition of a building before and after an earthquake. OpenSHM is developed and maintained by the National Seismic Motion Project (<a href="../">NSMP</a>) within the U.S. Geological Survey's (USGS) Earthquake Science Center (<a href="/contactus/menlo/">ESC</a>). It is part of the <a href="http://www.earthwormcentral.org/">Earthworm Central</a>.</dd>

  <dt>What is the main objective of OpenSHM?</dt>
  <dd>OpenSHM provides timely information about the state-of-health of the structure to enhance public safety by supporting post-event condition assessment and early damage diagnosis for rapid repair and reoccupation.</dd>

  <dt>How does OpenSHM detect structural damage?</dt>
  <dd>OpenSHM detects potential structural damage by near real-time monitoring and analysis of inter-story drift ratios, modal parameters, shear-wave travel times throughout the building, and base-shear capacity-demand ratio. The uncertainties in some of these parameters are reduced through continuous collection of ambient vibration data.</dd>

  <dt>Can OpenSHM application run in the cloud?</dt>
  <dd>OpenSHM supports both local and cloud computing.</dd>
</dl>

<h2>Installation</h2>

<dl>
  <dt>What is involved in the installation of the SHM system?</dt>
  <dd>Two main components of SHM system are hardware and software. The hardware is comprised of a dense array of wired motion sensors, installed permanently at each floor of a building, digital recorder with internal batteries and charger, cables (data, Global Positioning System (GPS), and telemetry), GPS antenna, Cellular modem and antenna (if needed). The software component includes the OpenSHM. This software runs on a dedicated server for data acquisition transmission, located at the facility to be monitored.</dd>

  <dt>Where is the SHM system located in the building?</dt>
  <dd>The digital recorder is generally located at a level close to the roof or outside wall for the shortest possible cable run to facilitate the installation of the GPS antenna for absolute timing. The SHM server is often located next to the recorder.
    <figure>
      <img src="img/recorder.jpg" alt="Photo of a digital recorder" />
      <figcaption>Photo shows the digital recorder with internal batteries mounted on the wall and the SHM server running the OpenSHM mounted to the floor. Next to the SHM server within the open frame rack is the UPS device providing uninterrupted power.</figcaption>
    </figure>
  </dd>

  <dt>How long will it take to install the SHM system?</dt>
  <dd>We estimate four-six weeks for installation of hardware and software.</dd>
</dl>

<h2>Triggering</h2>

<dl>
  <dt>How big does an earthquake need to be to trigger the SHM system?</dt>
  <dd>Currently, the SHM system triggers when an earthquake having magnitude higher than 3.5 occurs within 125 miles (~200 km) of the monitored facility.</dd>

  <dt>What else can trigger the SHM system?</dt>
  <dd>In addition to earthquakes, SHM system also triggers when the drift threshold exceedance occurs. For threshold values, the ASCE 41-06 transient drift limits are used.</dd>
</dl>

<h2>Data & Transmission</h2>

<dl>
  <dt>Where can I see the data recorded at the monitored facility?</dt>
  <dd>Images of the previous fifteen days of accelerograms from the monitored facility are available on this <a href="/monitoring/helicorders.php">web site</a>.</dd>

  <dt>What will the USGS do with the data from the SHM system?</dt>
  <dd>If the earthquake magnitude is greater than about 5, the data recorded from the monitored facility may be archived at the Center for Engineering Strong Motion Data (<a href="https://www.strongmotioncenter.org/">CESMD</a>) to promote earthquake engineering research.</dd>

  <dt>How does the SHM system access the Internet?</dt>
  <dd>In many cases, the digital recorder and SHM server has its own network completely separate (air-gapped) than the network in the facility. SHM system either uses DSL or cell modem to connect to the Internet.</dd>

  <dt>How does OpenSHM disseminate information?</dt>
  <dd>SHM broadcasts notifications including information and data via emails an SMS messages to users. The information and recorded data are also transmitted to a central web server at USGS.</dd>

  <dt>How long does it take for OpenSHM to transmit notifications to users?</dt>
  <dd>About 3-5 minutes after an earthquake.</dd>

  <dt>What happens to the seismic data if the power goes out during an earthquake?</dt>
  <dd>The digital recorder and SHM server will run on batteries.</dd>

  <dt>How can a user reach SHM information and recorded data if there is a loss of communication?</dt>
  <dd>The recorded data and SHM information can be accessed at the SHM server on the facility.</dd>
</dl>

<h2>Service & Maintenance</h2>

<dl>
  <dt>How do I know that the SHM system is working?</dt>
  <dd>SHM system is set to trigger with minimum earthquake magnitude above 3.5. This way the user gets notifications from the SHM system frequently.</dd>

  <dt>How does the USGS know that the SHM system is functioning properly?</dt>
  <dd>State-of-health messages (with information about the internal batteries, memory usage, disk usage, CPU performance, temperature, OpenSHM processes etc.) from the digital recorder and SHM server are relayed to the USGS monitoring server periodically. Also, at every hour, the SHM system connects to the USGS web server and sends the last 24 hours of accelerogram plots from all sensors.</dd>
</dl>
