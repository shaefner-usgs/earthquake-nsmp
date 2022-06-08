<?php

include_once '../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'National Strong Motion Project';
  $NAVIGATION = true;

  include 'template.inc.php';
}

?>

<figure class="right">
  <img src="img/transamerica.jpg" alt="Schematic of the Transamerica Building in San Francisco." />
  <figcaption>
    <p>The 1989 Loma Prieta earthquake (magnitude 6.9) set San Francisco&rsquo;s
      Transamerica Pyramid swaying and rocking. An array of 22 sensors (small
      arrows) recorded horizontal movement on the 49th floor of the building
      five times greater than the 1.5 inches measured in the basement, as
      indicated by the recordings (red lines).</p>
    <p>Learn more: USGS Fact Sheet 068-03 <a href="https://pubs.usgs.gov/fs/2003/fs068-03/fs068-03.pdf">Monitoring
      Earthquake Shaking in Buildings to Reduce Loss of Life and Property</a>.</p>
  </figcaption>

</figure>

<p>Strong-motion recordings of damaging earthquakes in densely urbanized areas
  are critical for designing earthquake-resistant structures to reduce property
  loss and casualties from future earthquakes. The recordings also are
  fundamental for understanding and characterizing the physics of earthquake
  rupture, the generation and propagation of damaging ground motions, and the
  shaking performance of structures.</p>

<p>The USGS National Strong-Motion Project (formerly titled the National Strong
  Motion Program) has the primary Federal responsibility for acquiring strong
  motion records of significant earthquakes in the United States recorded by
  sensors placed in the ground and in man-made structures.</p>

<p>Currently the NSMP operates and maintains <a href="stations.php">strong-motion
  instruments</a> at more than 660 ground, free-field and reference sites, and
  more than 3200 channels of data from about 180 <a href="/monitoring/nsmp/arrays/">structural
  arrays</a>.  When a significant earthquake occurs, the NSMP automatically
  retrieves strong motion recordings from its instrumentation as well as from
  more than 2000 other instruments operated throughout the US by federal,
  state, and local agencies, private companies, and academic institutions
  that participate in the <a href="https://www.usgs.gov/programs/earthquake-hazards/anss-advanced-national-seismic-system">Advanced
  National Seismic System</a> (ANSS). The NSMP rapidly processes these recordings
  according to <a href="https://www.strongmotion.org/archive/publications/reports/format_1_20.pdf">COSMOS standards</a>
  and archives the products at the <a href="https://strongmotioncenter.org/">Center
  for Engineering Strong Motion Data</a>.</p>

<p>For questions about data, metadata, and station operations, please send email
  to: <a href="mailto:nsmp@usgs.gov">nsmp@usgs.gov</a>.</p>
