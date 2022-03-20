
<?php
$committee_sql = "SELECT * FROM gallery WHERE category='Committee Pictures'";
$committee_query = mysqli_query($conn, $committee_sql);
$committee_counter = mysqli_num_rows($committee_query);

$events_sql = "SELECT * FROM gallery WHERE category='Events Pictures'";
$events_query = mysqli_query($conn, $events_sql);
$events_counter = mysqli_num_rows($events_query);

$ministries_sql = "SELECT * FROM gallery WHERE category='Ministries Pictures'";
$ministries_query = mysqli_query($conn, $ministries_sql);
$ministries_counter = mysqli_num_rows($ministries_query);

$church_sql = "SELECT * FROM gallery WHERE category='Service Pictures'";
$church_query = mysqli_query($conn, $church_sql);
$church_counter = mysqli_num_rows($church_query);
?>

<div class="col-md-6 picture_counters">
                <div class="row">
                  <div class="col-md-6">
                    <div class="bg-aqua">
                      <span class="fa fa-2x fa-camera"></span>
                    <h6>Committee Pictures</h6>
                    <h2><?php echo $committee_counter; ?></h2>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-navy">
                      <span class="fa fa-2x fa-camera"></span>
                    <h6>Church Service</h6>
                    <h2><?php echo $church_counter; ?></h2>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-orange">
                      <span class="fa fa-2x fa-camera"></span>
                    <h6>Events Pictures</h6>
                    <h2><?php echo $events_counter; ?></h2>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-maroon">
                      <span class="fa fa-2x fa-camera"></span>
                    <h6>Ministries Pictures</h6>
                    <h2><?php echo $ministries_counter; ?></h2>
                  </div>
                  </div>
                </div>
              </div>
