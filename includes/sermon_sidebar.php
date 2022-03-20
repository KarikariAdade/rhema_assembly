	<?php
    $news_counter_sql = "SELECT * FROM news";
    $news_counter_query = mysqli_query($conn, $news_counter_sql);
    $news_count = mysqli_num_rows($news_counter_query);

    $announcement_counter_sql = "SELECT * FROM announcement";
    $announcement_counter_query = mysqli_query($conn, $announcement_counter_sql);
    $announcement_count = mysqli_num_rows($announcement_counter_query);

    $event_counter_sql = "SELECT * FROM events";
    $event_counter_query = mysqli_query($conn, $event_counter_sql);
    $event_count = mysqli_num_rows($event_counter_query);

    $sermon_counter_sql = "SELECT * FROM sermon";
    $sermon_counter_query = mysqli_query($conn, $sermon_counter_sql);
    $sermon_count = mysqli_num_rows($sermon_counter_query);
    ?>
    <div class="blog-sidebar col col-lg-4 col-md-4 col-md-pull-8 col-sm-5">
       <!--  <div class="widget search-widget">
            <form class="form" method="POST" action="search">
                <input type="text" class="form-control" placeholder="Search here..">
            </form>
        </div> -->

        <div class="widget category-widget">
            <!-- <h3>Category</h3> -->
            <div class="vc_column-inner" style="margin-top: -50px !important; -bottom: 20px;"><div class="wpb_wrapper"><h4 class="vc_custom_heading vc_custom_1518864283429">PENTECOST SONGS</h4>
                <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                    <div class="wpb_wrapper">
                        <iframe width="100%" height="350" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/403952418&amp;color=%233a54a4&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
                    </div>
                </div>
            </div></div>
        </div>
        <div class="widget category-widget">
            <h3>Categories</h3>
            <ul>
                <li><a href="news-and-events">News <span class="badge"><?php echo $news_count; ?></span></a></li>
                <li><a href="events">Events <span class="badge"><?php echo $event_count; ?></span></a></li>
                <li><a href="announcements">Announcements <span class="badge"><?php echo $announcement_count; ?></span></a></li>
                 <li><a href="sermon">Sermons <span class="badge"><?php echo $sermon_count; ?></span></a></li>
            </ul>
        </div>
        <div class="widget recent-post-widget">
           <div class="fb-page" data-href="https://web.facebook.com/agonarhemaenglishassembly/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/agonarhemaenglishassembly/" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/agonarhemaenglishassembly/">The CoP, Rhema Assembly - Agona Ashanti</a></blockquote></div>
           <h3>Recent News</h3>
           <div class="themeDesc">
               <div class="sidebar">
                  <div class="sidebar_announcement">
                    <?php
                    $event_sql = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
                    $event_query = mysqli_query($conn, $event_sql);
                    if (mysqli_num_rows($event_query) > 0) {
                        while ($row = mysqli_fetch_assoc($event_query)) {
                           $news_id = $row['id'];
                           $news_author = $row['news_author'];
                           $news_title = $row['news_title'];
                           $news_slug = $row['news_slug'];
                           $news_category = $row['news_category'];
                           $news_description = $row['news_description'];
                           $news_date = $row['news_date'];
                           $news_image = $row['news_image'];
                           $timestamp = strtotime($news_date);
                           $day = date("M d, Y", $timestamp);

                           ?>


                           <div class="card">
                            <div class="card_img">
                              <span><?= $news_category; ?></span>
                                <img src="<?php echo $news_image; ?>" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <div>
                                    <h5><a href=""><?php echo $news_title; ?></a></h5>
                                    
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div></div>
        </div></div>
        <div class="widget archive-widget">
            <h3>Archive</h3>
            <ul>
                    <?php
           $sql = "SELECT Month(date) as Month, Year(date) as Year FROM sermon GROUP BY Month(date), Year(date) ORDER BY date ASC";
           $query = mysqli_query($conn, $sql);
           if (mysqli_num_rows($query) > 0) {
    // $archive_counter = mysqli_num_rows($query);
            while ($row = mysqli_fetch_assoc($query)) {
                $monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
                $month = $row['Month'];
                $year = $row['Year'];

  // FETCH NUMBER OF POSTS UNDER ARCHIVE
                $from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
                $to = date('Y-m-31 23:59:59', strtotime("$year-$month"));
                $sqsl = "SELECT * FROM sermon WHERE date >= '$from' AND date <= '$to' ORDER BY id DESC";
                $shit = mysqli_query($conn, $sqsl);
                $archive_counter = mysqli_num_rows($shit);
                ?>
                <?php
                echo "<li><a id='archive' href='archive?month=$month&year=$year'>".$monthName." <span class='badge' id='archive_counter'>".$archive_counter."</span></a></li>";
                ?>
                <?php
            }
        }
      ?>
            </ul>
        </div>
        <div class="widget tag-widget" align="center">
            <h3>Popular Tags</h3>
            <div class="all-tags">
                <a href="news-and-events" class="btn">News</a>
                <a href="events" class="btn">Event</a>
                <a href="announcements" class="btn">Announcement</a>
                <a href="sermon" class="btn">Sermons</a>
            </div>
        </div>
    </div>