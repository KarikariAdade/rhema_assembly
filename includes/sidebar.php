<?php include 'connect.php'; ?>
<div class="col-md-4">
	<div class="sidebar">
		<div class="sidebar_announcement">
			<h2>News & Events</h2>
			<p id="line" style="margin-bottom: 15%;"></p>
			<?php
			$event_sql = "SELECT * FROM events ORDER BY id DESC LIMIT 3";
			$event_query = mysqli_query($conn, $event_sql);
			if (mysqli_num_rows($event_query) > 0) {
				while ($row = mysqli_fetch_assoc($event_query)) {
					$event_id = $row['id'];
					$activity = $row['activity'];
					$start_date = $row['start_date'];
					$start_time = $row['start_time'];
					$end_date = $row['end_date'];
					$event_picture = $row['event_picture'];
					$activity_slug = $row['activity_slug'];
					?>
					<div class="card">
						<div class="card_img">
							<span><?= $row['event_category']; ?></span>
							<img src="<?php echo $event_picture; ?>" class="card-img-top">
						</div>
						<div class="card-body">
							<div>
								<h5><a href="<?php echo $activity_slug; ?>"><?php echo $activity; ?></a></h5>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
			<?php
			$news_sql = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
			$news_query = mysqli_query($conn, $news_sql);
			if (mysqli_num_rows($news_query) > 0) {
				while ($row = mysqli_fetch_assoc($news_query)) {
					$news_id = $row['id'];
					$news_title = $row['news_title'];
					$news_slug = $row['news_slug'];
					$news_category = $row['news_category'];
					$news_image = $row['news_image'];
					$news_description = $row['news_description'];
				?>
				<div class="card">
					<div class="card_img">
						<span><?php echo $news_category; ?></span>
						<img src="<?php echo $news_image; ?>" class="card-img-top">
					</div>
					<div class="card-body">
						<div>
							<h5><a href="<?php echo $news_slug; ?>"><?php echo $news_title; ?></a></h5>
						</div>
					</div>
				</div>
				<?php
			}
		}
			?>
		</div>
	</div>
</div>