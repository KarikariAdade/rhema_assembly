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
</head>
<body>
	<?php
	include 'includes/navbar.php';
	$current_year = date('Y');
	$fetch_theme = $conn->query("SELECT * FROM themes WHERE theme_year = '$current_year'");
	$fetch_theme_count = mysqli_num_rows($fetch_theme);


	// If current year theme is not uploaded, previous year theme will show
	$start_year = strtotime('Today');
	$end_year = strtotime('-1 year', $start_year);
	$end_year = date('Y', $end_year);
	$fetch_last_year = $conn->query("SELECT * FROM themes WHERE theme_year = '$end_year'");
	$fetch_last_year_count = mysqli_num_rows($fetch_last_year);

	// Below is for current year theme
	if ($fetch_theme_count > 0){
		$row = mysqli_fetch_assoc($fetch_theme);
		$theme_pic = explode('/', $row['theme_picture']);
		$theme_pic = $theme_pic[4].'/'.$theme_pic[5].'/'.$theme_pic[6].'/'.$theme_pic[7].'/'.$theme_pic[8];
	}

	if ($fetch_last_year_count > 0) {
		$last_year = mysqli_fetch_assoc($fetch_last_year);
		$last_theme_pic = explode('/', $last_year['theme_picture']);
		$last_theme_pic = $last_theme_pic[4].'/'.$last_theme_pic[5].'/'.$last_theme_pic[6].'/'.$last_theme_pic[7].'/'.$last_theme_pic[8];
	}
	?>
	<div class="container-fluid themepic">
		<?php if($fetch_theme_count > 0):?>
			<img src="<?= $theme_pic; ?>" class="img-fluid">
		<?php else:?>
			<img src="<?= $last_theme_pic; ?>" class="img-fluid">
		<?php endif;?>
	</div>
	<div class="container themeDesc">
		<div class="row">
			<?php if($fetch_theme_count > 0):?>
				<div class="col-md-8">
					<h3>Meaning of the Theme - <span>"<?= $row['theme_title'].' ('.$row['bible_verse'].')'; ?>"</span></h3>
					<p><?= nl2br($row['theme_description']);?></p>
					<div class="vc_column-inner"><div class="wpb_wrapper"><h4 class="vc_custom_heading vc_custom_1518864283429">PENTECOST SONGS</h4>
						<div class="wpb_raw_code wpb_content_element wpb_raw_html">
							<div class="wpb_wrapper">
								<iframe width="100%" height="350" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/403952418&amp;color=%233a54a4&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php else:?>
			<?php if($fetch_last_year_count > 0):?>
			<div class="col-md-8">
				<h2 id="previous_year_theme"><strong>NB: </strong>Theme for <?= $current_year;?> has not been uploaded yet. You are viewing <?= $end_year;?> theme instead.</h2>
					<h3>Meaning of the Theme - <span>"<?= $last_year['theme_title'].' ('.$last_year['bible_verse'].')'; ?>"</span></h3>
					<p><?= $last_year['theme_description'];?></p>
					<div class="vc_column-inner"><div class="wpb_wrapper"><h4 class="vc_custom_heading vc_custom_1518864283429">PENTECOST SONGS</h4>
						<div class="wpb_raw_code wpb_content_element wpb_raw_html">
							<div class="wpb_wrapper">
								<iframe width="100%" height="350" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/403952418&amp;color=%233a54a4&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif;?>
		<?php endif;?>

		<?php include 'includes/sidebar.php'; ?>
	</div>

</div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
</body>
</html>