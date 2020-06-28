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
	<link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
		<title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid board_intro_pic_3">
		<img src="img/gallery.jpg" style="width: 100%;">
		<div class="board_intro_desc">
		</div>
	</div>
	<div class="container gallery_section">
		<h1>Church Gallery</h1>
		<div class="row">
			<?php
			$fetch_gallery = $conn->query("SELECT * FROM gallery");
			if (mysqli_num_rows($fetch_gallery) > 0) {
			?>
			<div class="col-md-4" id="lightBoxImgContainer">
				<h3 id="galleryTitle">Church Committee</h3>
				<a href="img/slider/church_committee.jpg" data-lightbox="church_committee"><img src="img/slider/slider_3.jpg" class="img-fluid" id="lightboxImg"></a>
				<?php 
				$church_committee_sql = "SELECT * FROM gallery WHERE category = 'Committee Pictures'";
				$church_committee_query = mysqli_query($conn, $church_committee_sql);
				if (mysqli_num_rows($church_committee_query) > 0) {
					while ($row = mysqli_fetch_assoc($church_committee_query)) {
						$committee_id = $row['id'];
						$committee_category = $row['category'];
						$committee_picture = $row['picture'];
				 ?>
					<a rel="lightbox" href="<?php echo $committee_picture; ?>" data-lightbox="church_committee"></a>
					<?php
					}
				}
					?>

				</div>
				<div class="col-md-4" id="lightBoxImgContainer">
				<h3 id="galleryTitle">Service Pictures</h3>
				<a href="img/service/prayer_2.jpg" data-lightbox="service_pictures"><img src="img/service/prayer_2.jpg" class="img-fluid" id="lightboxImg"></a>
				<?php 
				$church_service_sql = "SELECT * FROM gallery WHERE category = 'Service Pictures'";
				$church_service_query = mysqli_query($conn, $church_service_sql);
				if (mysqli_num_rows($church_service_query) > 0) {
					while ($row = mysqli_fetch_assoc($church_service_query)) {
						$service_id = $row['id'];
						$service_category = $row['category'];
						$service_picture = $row['picture'];
				 ?>
					
					<a rel="lightbox" href="<?php echo $service_picture; ?>" data-lightbox="service_pictures"></a>
					<?php
				}
			}
					?>
				</div>
				<div class="col-md-4" id="lightBoxImgContainer">
				<h3 id="galleryTitle">Events Pictures</h3>
				<a href="img/service/pastor_son.jpg" data-lightbox="event_pictures"><img src="img/service/pastor_son.jpg" class="img-fluid" id="lightboxImg"></a>
					<?php 
				$church_event_sql = "SELECT * FROM gallery WHERE category = 'Events Pictures'";
				$church_event_query = mysqli_query($conn, $church_event_sql);
				if (mysqli_num_rows($church_event_query) > 0) {
					while ($row = mysqli_fetch_assoc($church_event_query)) {
						$event_id = $row['id'];
						$event_category = $row['category'];
						$event_picture = $row['picture'];
				 ?>
					
					<a rel="lightbox" href="<?php echo $event_picture; ?>" data-lightbox="event_pictures"></a>
					<?php
				}
			}
					?>
				</div>
				<div class="col-md-4" id="lightBoxImgContainer" style="margin-top: 5%;">
				<h3 id="galleryTitle">Ministries Pictures</h3>
				<?php 
				$church_ministry_sql = "SELECT * FROM gallery WHERE category = 'Ministries Pictures'";
				$church_ministry_query = mysqli_query($conn, $church_ministry_sql);
				if (mysqli_num_rows($church_ministry_query) > 0) {
					while ($row = mysqli_fetch_assoc($church_ministry_query)) {
						$ministry_id = $row['id'];
						$ministry_category = $row['category'];
						$ministry_picture = $row['picture'];
				 ?>
					<a href="img/service/service_1.jpg" data-lightbox="church_ministry"><img src="img/service/service_1.jpg" class="img-fluid" id="lightboxImg"></a>
					<a href="<?php echo $ministry_picture; ?>" data-lightbox="church_ministry"></a>
					<?php
				}
			}
					?>

				</div>
				<?php
			}else{
				echo "<h2 align='center'>There are no pictures at the moment.</h2>";
			}
				?>
		</div>
	</div>
<?php include 'includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/lightbox.min.js"></script>
	<script>
		lightbox.option({
			'resizeDuration': 200,
			'wrapAround': true,
			'fitImagesInViewport': true,
			'alwaysShowNavOnTouchDevices': true,
		})

	</script>

</body>
</html>