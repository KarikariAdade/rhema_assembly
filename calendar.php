<?php include 'includes/connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The Church of Pentecost, Rhema Assembly-Agona Ashanti. Come worship with us and be Blessed">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="img/pentecost.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/swiper.min.css">
	<title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid board_intro_pic_3">
		<img src="img/calendar.jpg" style="width: 100%;">
		<div class="board_intro_desc">
		</div>
	</div>
	<div class="container-fluid themeDesc" style="margin-bottom: 5%;">
		<div class="row">
		<div class="col-md-8 event_table">
			<h2>The Church of Pentecost - Rhema Assembly</h2>
			<h2><?php echo date('Y') ?> Calender of Church Activities</h2>
			<?php
			 $event_sql = "SELECT * FROM events ORDER BY id DESC";
                $event_query = mysqli_query($conn, $event_sql);
                if (mysqli_num_rows($event_query) > 0) {
			?>
			<table class="table table-responsive table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Start Time</th>
						<th>Event</th>
						<th>Venue</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php
                  while ($row = mysqli_fetch_assoc($event_query)) {
                    $event_id = $row['id'];
                    $start_date = $row['start_date'];
                    $activity = $row['activity'];
                    $activity_slug = $row['activity_slug'];
                    $end_date = $row['end_date'];
                    $venue = $row['venue'];
                    $event_category = $row['event_category'];
                    $event_picture = $row['event_picture'];
                    $remarks = $row['remarks'];
                    $timestamp = strtotime($start_date);
                    $date = date("F d", $timestamp);
                    $time = date("h:ia", $timestamp);

                  ?>
					<tr>
						<td style="width: 23%;"><?php echo $date." - ".date("F d",strtotime($end_date));?></td>
						<td><?php echo $time; ?></td>
						<td><a href="<?php echo urlencode($activity_slug); ?>"><?php echo $activity; ?></a></td>
						<td><?php echo $venue; ?></td>
						<td><?php echo $remarks; ?></td>
					</tr>
					<?php
				}
					?>
					
				</tbody>
			</table>
			<?php
		}else{
			echo "<h2 align='center'>Sorry, there are no activities at the moment. </h2>";
		}
			?>
		</div>
		<?php include 'includes/sidebar.php'; ?>
	</div>
	<style type="text/css">
		.sidebar{
			padding: 5px 8% !important;
		}
	</style>
</div>
		<?php include 'includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/swiper.min.js"></script>

</body>
</html>