<?php
 		$sunday = "SELECT * FROM announcement WHERE category='General Announcement'";
 		$sunday_query = mysqli_query($conn, $sunday);
 		$sunday_counter = mysqli_num_rows($sunday_query);

 		$evangelism = "SELECT * FROM announcement WHERE category='Evangelism Ministry'";
 		$evangelism_query = mysqli_query($conn, $evangelism);
 		$evangelism_counter = mysqli_num_rows($evangelism_query);

 		$children = "SELECT * FROM announcement WHERE category='Children Ministry'";
 		$children_query = mysqli_query($conn, $children);
 		$children_counter = mysqli_num_rows($children_query);

 		$men = "SELECT * FROM announcement WHERE category='Men Ministry'";
 		$men_query = mysqli_query($conn, $men);
 		$men_counter = mysqli_num_rows($men_query);

 		$women = "SELECT * FROM announcement WHERE category='Women Ministry'";
 		$women_query = mysqli_query($conn, $women);
 		$women_counter = mysqli_num_rows($women_query);

 		$youth = "SELECT * FROM announcement WHERE category='Youth Ministry'";
 		$youth_query = mysqli_query($conn, $youth);
 		$youth_counter = mysqli_num_rows($youth_query);
 		?>