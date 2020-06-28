<?php
 $elder_sql = "SELECT * FROM admin_profile WHERE position LIKE '%Elder%'";
            $elder_query = mysqli_query($conn, $elder_sql);
            if (mysqli_num_rows($elder_query) > 0) {
?>
<div class="container church_board">
		<h1>Evangelism Ministry</h1>
		<p id="board_header_desc">and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church</p>
		<div class="row">
			<?php
                while ($row = mysqli_fetch_assoc($elder_query)) {
                    $full_name = $row['first_name']." ".$row['last_name'];
                    $position = $row['position'];
                    $admin_image = $row['admin_image'];
            ?>
            <div class="team-member-one col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="<?php echo $admin_image; ?>" alt="">
                        </figure>
                        <div class="lower-content">
                            <h3><a href="team-single.html"><?php echo $full_name; ?></a></h3>
                            <div class="designation"><?php echo $position; ?></div>
                        </div>
                    </div>
                </div>
                <?php
                   }
                ?>
		</div>
	</div>
<?php }?>
