<?php

include_once '../../conf/config.inc.php'; // app config

if (!isset($TEMPLATE)) {
  $TITLE = 'Evolution of Seismic Structural Health Monitoring of Buildings (2000-2008)';
  $HEAD = '<link href="../css/evolution.css" rel="stylesheet" />';
  $NAVIGATION  = true;
  $FOOT = '';

  include 'template.inc.php';
}

?>

<p>Following an earthquake, rapid and accurate assessment of the damage or performance of a building is of paramount importance to stakeholders including building owners, leasers, occupants, city officials and rescue teams. These stakeholders require answers to key questions such as:</p>

<ol>
  <li>Is there visible or hidden damage?</li>
  <li>If damage occurred, what is the extent?</li>
  <li>Does the damage threaten other nearby structures?</li>
  <li>Can the structure be occupied immediately without compromising life safety or is life safety questionable?</li>
</ol>

<p>As a result, property damage and economical loss due to lack of a permit to enter and/or re-occupy a building may be significant.</p>

<h2>Tagging Following an Earthquake</h3>

<p>In general, assessments of damage to buildings (tagging) following an earthquake are performed by city-designated engineers following procedures similar to ATC-20 tagging requirements (ATC 1989). Tagging usually involves visual inspection only and is implemented by colored tags indicative of potential hazard to occupants:</p>

<ul class="no-style">
  <li><mark class="green">Green</mark> indicates the building can be occupied (the building does not pose a threat to life safety)</li>
  <li><mark class="yellow">Yellow</mark> indicates limited occupation (the building is hazardous to life safety but allows limited entrance to retrieve possessions)</li>
  <li><mark class="red">Red</mark> indicates entrance is prohibited (the building is hazardous to life)</li>
</ul>

<h2>Alternative Solution: Evolution of Sensor-based Real-time Seismic Health Monitoring</h3>

<p>In early 2000, an alternative to tagging allowed building owners and engineers to utilize sensors to monitor the real-time response of a structure instrumented as a health monitoring tool. There are two types, which were examined as &ldquo;cover stories&rdquo; in Earthquake Spectra:</p>

<ul class="no-style linklist">
  <li>
    <a href="#">
      <img src="img/spectra1.png" alt="Earthquake Spectra cover" />
    </a>
    <p>Differential GPS (&Ccedil;elebi and Sanli, 2002) with high sampling ratios to obtain displacements. Since GPS units need line of site to GPS satellites, they can only be deployed on the roof of a building, limiting data availability. Also, GPS sampling rates are limited and therefore, applications could be used only for tall buildings.</p>
  </li>
  <li>
    <a href="#">
      <img src="img/spectra2.png" alt="Earthquake Spectra cover" />
    </a>
    <p>Classical accelerometer-deployed structures (&Ccedil;elebi and others, 2004) are configured to obtain acceleration data in real-time and compute displacement by double-integration.</p>
  </li>
</ul>

<p>After a building is instrumented, drift ratios<sup><a href="#fn1" id="fnr1">1</a></sup> are computed from relative displacements between consecutive floors and used as the main parametric indicator of damage to a building.</p>

<div class="fig1-fig2">
  <figure class="fig1">
    <img src="img/figure1.png" alt="drift ratio schematic" />
    <figcaption>Figure 1. Schematic depicting drift ratio in a building, &Ccedil;elebi et al, 2004 and modified from Figure C2-3 of FEMA-274 (ATC 1997)</figcaption>
  </figure>

  <figure class="fig2">
    <img src="img/figure2.jpg" alt="schematic of displacements" />
    <figcaption>Figure 2. Schematic of hypothetical thresholds of level of displacements related to performance curve, illustrated in FEMA-273 (FEMA, 1997).</figcaption>
  </figure>
</div>

<p>The next step is to relate drift ratios to the performance-based, force-deformation curve hypothetically represented in Figure 1. When drift ratios are determined from measured responses of the building, the performance and &ldquo;damage state&rdquo; of the building can be estimated as in Figure 2. Hypothetical levels of deformation (displacements and/or drift ratios) are established and related to the performance curve FEMA-274.</p>

<figure class="fig3">
  <img src="img/figure3.png" alt="flow chart" />
  <figcaption>Figure 3. Flow-chart depicting accelerometer-based structural health monitoring software. This is the basis that serves as the original specification and has been adopted by two major seismic monitoring companies in the U.S.</figcaption>
</figure>

<p>To date, experience with both types of sensor deployments (GPS and accelerometers) indicate that they are reliable enough and provide pragmatic alternatives to alert owners and other authorized parties to make informed decisions and select choices for pre-defined actions following significant events. Thus, in the United States, and, as well as we know, in the world, the sensor-based data processes described in this flowchart and discussed in detail in &Ccedil;elebi et al. (2002, 2004) and &Ccedil;elebi (2008) are the first near real-time seismic health monitoring developments. Furthermore, recent adoption of such methods by financial and industrial enterprises is testimony to their viability. Two major companies developed software based on the flowchart in Figure 3 provided by USGS research and development.</p>

<figure class="fig4">
  <img src="img/figure4.jpg" alt="data acquisition schematic" />
  <figcaption>Figure 4. General schematic of data acquisition and transmittal for seismic monitoring of a building using accelerometers as sensors.</figcaption>
</figure>

<figure class="fig5">
  <div>
    <img src="img/figure5-left.png" alt="screenshot of client application" />
    <a href="mov/stream.mp4">
      <img src="img/figure5-right.png" alt="screenshot of client application" />
    </a>
  </div>
  <figcaption>Figure 5. Example screenshots of initial software as applied in a San Francisco Building. <strong>Left</strong>: Screenshot of seismic structural health monitoring software display showing acceleration streams and computed amplitude and response spectra. <strong>Right</strong>: Screenshot of client software display showing 12-channel displacement (six pairs with each pair a different color) and corresponding six-drift ratio streams (each with the same color as the parent displacement). Also shown in the upper right are alarm systems corresponding to thresholds that must be inputted manually. The first threshold for the first drift ratio is hypothetically exceeded to indicate the starting of the recording and change in the color of the alarm from green to yellow. Click on the figure (right) for a demonstration.</figcaption>
</figure>

<h2>Data to Date</h3>

<p>The system recorded responses of a building in San Francisco to multiple earthquakes since 2003. No single event was large or close enough to cause threshold drift ratios to be exceeded and hence trigger the alarm system described in the flowchart or S2HM software (Figures 3 and 5). However, we used the data from a small earthquake to confirm the quality of the data from the system.</p>

<p>During the December 22, 2003 San Simeon, CA earthquake (Mw=6.4), at an epicentral distance of 258 km, a complete set of low-amplitude earthquake response data was recorded in the building. The largest peak acceleration was approximately 1 % of g.  Synchronized bandpass-filtered accelerations and corresponding double-integrated displacements are exhibited in Figure 6 for one side of the building.</p>

<figure class="fig6">
  <div>
    <img src="img/figure6-left.png" alt="accelerations" />
    <img src="img/figure6-right.png" alt="displacements" />
  </div>
  <figcaption>Figure 6. Bandpass-filtered accelerations (left) and double-integrated displacements (right) at each instrumented floor (from Ground floor to the roof) on one side of the building during the San Simeon earthquake on December 22, 2003.</figcaption>
</figure>

<figure class="fig7">
  <img src="img/figure7.png" alt="earthquake accleration schematic" />
  <figcaption>Figure 7. Two parallel and orthogonal earthquake accelerations recorded on the roof are used to identify the first mode translational and torsional frequencies as 0.38 Hz and 0.60Hz respectively.</figcaption>
</figure>

<h2>Summary</h3>

<p>An efficient and technically sound seismic structural health monitoring procedure using drift ratios linked to Performance Based Earthquake Engineering (PBEE) developed in early 2000 is now an established method and adopted by many users and applied in multiple buildings in the US and other countries.</p>

<h2>References</h3>

<ul class="referencelist">
  <li>Applied Technology Council (ATC), 1989.Procedures for Post-Earthquake Safety Evaluation of Buildings, ATC-20, Redwood City, CA.</li>
  <li>&Ccedil;elebi, M., 2005. Recent Advances to Obtain Real-time Displacements for Engineering Applications, PROC. ASCE 2005 Structures Congress, New York, N.Y., 12 pp.</li>
  <li>&Ccedil;elebi, M., 2007, Health monitoring of Buildings Using Threshold Drift Ratios &mdash; Now an Established Method, Int&rsquo;l Conf. on Structural Health  Monitoring, Vancouver, B.C., Canada, October 2007.</li>
  <li>&Ccedil;elebi,M., 2008, Real-time Monitoring of Drift for Occupancy Resumption, PROC. 14WCEE (CD-ROM), Beijing, China, Oct.13&ndash;17, 2008.</li>
  <li>&Ccedil;elebi, M., and Sanli, A., 2002, &ldquo;GPS in Pioneering Dynamic Monitoring of Long-Period Structures&rdquo;, Earthquake Spectra, Journal of  EERI,. Volume 18, No. 1, pages 47&ndash;61, February 2002.</li>
  <li>&Ccedil;elebi, M., Sanli, A., Sinclair, M., Gallant, S., and Radulescu, D., 2004, Real-Time Seismic Monitoring Needs of a Building Owner and the solution &mdash; A Cooperative Effort, Journal of EERI, Earthquake Spectra,  vol. 20, no. 2, pp. 333&ndash;346, May 2004.</li>
  <li>FEMA 273/274 NEHRP Guidelines for the Seismic Rehabilitation of Buildings: Case Study No. 42 [i.e. 39], Building Seismic Safety Council (U.S.)</li>
</ul>

<hr />

<ol>
  <li id="fn1">Drift ratio is defined as relative displacement between any two floors divided by the difference in elevation of the two floors. Usually, this ratio is computed for two consecutive floors. <a href="#fnr1" class="footnote-back" title="Jump back to footnote 1 in the text.">&#x21A9;&#xFE0E;</a></li>
</ol>
