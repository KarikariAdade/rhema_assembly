  <div class="pogoSlider">
    <?php

    //FETCH FEATURED PICTURES

    $fetch_featured = $conn->query("SELECT * FROM featured WHERE status = 1 ORDER BY id DESC");
    if (mysqli_num_rows($fetch_featured) > 0) {
      while ($row = mysqli_fetch_assoc($fetch_featured)) {
        $featured_image = explode('/', $row['featured_image']);
      $featured_image = $featured_image[1].'/'.$featured_image[2].'/'.$featured_image[3].'/'.$featured_image[4].'/'.$featured_image[5];
    ?>
    <div class="pogoSlider-slide" data-transition="blocksReveal" data-duration="1000"  style="background-image:url(<?= $featured_image; ?>); width: 100%;background-position: top;background-size: contain;">
      <div class="slider_element">
      <p class="pogoSlider-slide-element" data-in="sideFall" data-out="3DPivot" data-duration="350" id="pogoelement"><?= $row['featured_text']; ?></p>
      <button class="pogoSlider-slide-element btn" data-in="sideFall" data-out="3DPivot" data-duration="350"><a href="new-members #service_times">Visit a Service</a></button>
    </div>
    </div>
    <?php 
  }
}else{
  echo '
  <div class="pogoSlider-slide " data-transition="barRevealDown" data-duration="1000"  style="background-image:url(img/service/prayer.jpg);background-position: top;background-size: contain;">
      <div class="slider_element">
      <p class="pogoSlider-slide-element" data-in="sideFall" data-out="3DPivot" data-duration="350" id="pogoelement">Anyone can be Transformed <br />by the Story of Jesus at <br />Rhema Assembly.</p>
      <button class="pogoSlider-slide-element btn" data-in="sideFall" data-out="3DPivot" data-duration="350"><a href="new-members #service_times">Visit a Service</a></button>
    </div>
    </div>
     <div class="pogoSlider-slide " data-transition="barRevealDown" data-duration="1000"  style="background-image:url(img/service/sark_pray.jpg);background-position: top;background-size: contain;">
      <div class="slider_element">
      <p class="pogoSlider-slide-element" data-in="sideFall" data-out="3DPivot" data-duration="350" id="pogoelement">Anyone can be Transformed <br />by the Story of Jesus at <br />Rhema Assembly.</p>
      <button class="pogoSlider-slide-element btn" data-in="sideFall" data-out="3DPivot" data-duration="350"><a href="new-members #service_times">Visit a Service</a></button>
    </div>
    </div>
  ';
}
    ?>
    

  </div>