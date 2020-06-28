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
	<title>The Church of Pentecost | Rhema Assembly - Agona,Ashanti</title>
	<style type="text/css">
		    .mission_intro_pic .board_intro_desc h1{
  font-weight: lighter;
  font-size: 55px;
  text-align: center;
}
	</style>
</head>
<body>

	<!-- NAVIGATION BAR BEGINS -->
	<?php include 'includes/navbar.php'; ?>
	<!-- NAVIGATION BAR ENDS -->
	<div class="container-fluid mission_intro_pic">
		<div class="board_intro_desc">
			<h1>Our Sermon Series</h1>
		</div>
	</div>
	<div class="container" style="margin-bottom: 5%;">
		<div class="row">
			<div class="col-md-8" style="padding-right: 5%;">
				<div class="current_series">
					<?php
					$current_sermon = "SELECT * FROM sermon ORDER BY id DESC LIMIT 1";
					$current_sermon_query = mysqli_query($conn, $current_sermon);
					if (mysqli_num_rows($current_sermon_query) > 0) {
						while ($row = mysqli_fetch_assoc($current_sermon_query)) {
							$current_sermon_id = $row['id'];
							$current_title = $row['title'];
							$current_bible_verse = $row['bible_verses'];
							$current_sermon_link = $row['sermon_link'];
							$current_sermon_notes = $row['sermon_notes'];
							$current_author = $row['author'];
							$current_sermon_image = $row['sermon_image'];
							$current_sermon_date = $row['date'];
							$current_sermon_slug = $row['sermon_slug'];
							$current_sermon_file = $row['sermon_file'];
							if (strlen($current_sermon_notes) > 350){
								$current_sermon_notes = wordwrap($current_sermon_notes, 350);
								$current_sermon_notes =explode("\n", $current_sermon_notes);
								$current_sermon_notes = $current_sermon_notes[0]."...";
							}
						}
						?>
						<h2>Our Current Teaching Series</h2>
						<p id="line"></p>
						<div class="current_series_video">
							<img src="<?php echo $current_sermon_image; ?>" class="img-fluid">
						</div>
						<div class="current_series_desc">
							<h2><a href="service?sermon=<?php echo urlencode($current_sermon_slug); ?>"><?php echo $current_title; ?> (<?php echo $current_bible_verse; ?>)</a></h2><br />
							<span><strong>By: <?php echo $current_author; ?></strong></span>
							<p><?php echo $current_sermon_notes; ?></p>
						</div>
						<?php
					}else{
						echo "<h2>There are no sermons at the moment</h2>";
					}
					?>
				</div>
				<div class="recent_series_cards">
					<?php
					$current_sql = "SELECT * FROM sermon ORDER BY id DESC LIMIT 10";
					$current_query = mysqli_query($conn, $current_sql);
					if (mysqli_num_rows($current_query) > 0) {
						?>
						<h2>Recent Series</h2>
						<?php
						while ($row = mysqli_fetch_assoc($current_query)) {
							$sermon_id = $row['id'];
							$title = $row['title'];
							$bible_verse = $row['bible_verses'];
							$sermon_link = $row['sermon_link'];
							$sermon_notes = $row['sermon_notes'];
							$author = $row['author'];
							$sermon_image = $row['sermon_image'];
							$sermon_date = $row['date'];
							$sermon_slug = $row['sermon_slug'];
							$sermon_file = $row['sermon_file'];
							if (strlen($sermon_notes) > 350){
								$sermon_notes = wordwrap($sermon_notes, 350);
								$sermon_notes =explode("\n", $sermon_notes);
								$sermon_notes = $sermon_notes[0]."...";
							}
							?>
							<div class="row sermon_cards">
								<div class="col-md-5">
									<img src="<?php echo $sermon_image; ?>" class="img-fluid">
								</div>
								<div class="col-md-7">
									<h3><?php echo $title; ?> (<?php echo $bible_verse; ?>)</h3>
									<p><?php echo $sermon_notes; ?></p>
									<div class="sermon_card_btn">
										<p>
											<button class="btn btn-sm"><a href="service?sermon=<?php echo urlencode($sermon_slug); ?>">Read More</a></button>
										</p>
										<p>
											<button class="btn btn-sm"><a href="download.php?downloads=<?php echo urlencode($sermon_slug); ?>">Download Sermon File</a></button>
										</p>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php include 'includes/sermon_sidebar.php'; ?>
		</div>
	</div>
</div>
	<!-- FOOTER BEGINS -->
	<?php include 'includes/footer.php'; ?>
	<!-- FOOTER ENDS -->
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</body>
</html>