      <?php
      date_default_timezone_set("Africa/Accra");
function time_ago ($timestamp){
  $time_ago = strtotime($timestamp);
  $current_time = time();
  $time_difference = $current_time - $time_ago;
  $seconds = $time_difference;
  $minutes = round($seconds / 60); // value 60 seconds
  $hours = round($seconds / 3600); // value 3600 is 60 minutes * 60 seconds
  $days = round($seconds / 86400); // 86400 = 24 * 60 *60
  $weeks = round($seconds / 604800); // 7 * 24* 60 * 60
  $months = round($seconds / 2629440); // ((365 + 365 + 365 + 365 + 366) / 5 /12) *24 * 60 * 60
  $years = round($seconds / 31553280); // (365 + 365 + 365 + 365 + 366)/5 * 24 * 60 * 60

  if ($seconds <= 60) {
    return "Just Now";
  }elseif ($minutes <= 60) {
    if ($minutes == 1) {
      return "one minute ago";
    }else{
      return "$minutes minutes ago";
    }
  }elseif ($hours <= 24) {
    if ($hours == 1) {
      return "an hour ago";
    }else{
      return "$hours hrs ago";
    }
  }elseif ($days <= 7) {
    if ($days == 1) {
      return "yesterday";
    }else{
      return "$days days ago";
    }
  }elseif ($weeks <= 4.3) /*4.3 == 52/12*/ {
    if ($weeks == 1) {
      return "a week ago";
    }else{
      return "$weeks weeks ago";
    }
  }elseif ($months <= 12) {
    if ($months == 1) {
      return "a month ago";
    }else{
      return "$months months ago";
    }
  }else{
    if ($years == 1) {
      return "one year ago";
    }else{
      return "$years years ago";
    }
  }
}
?>