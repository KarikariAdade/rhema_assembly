<?php
include 'connect.php';
if (isset($_POST['id'])) {
	$output = '';
	$fetch_feature = $conn->query("SELECT * FROM featured ORDER BY id DESC");
	if (mysqli_num_rows($fetch_feature) > 0) {
		while ($row = mysqli_fetch_assoc($fetch_feature)) {
			$feature_id = $row['id'];
			$output .= '<div class="row">';
			
			if ($row['status'] == 0) {
				$status = "Unmarked";
			}else{
				$status = "Marked";
			}
			if (!empty($row['featured_image'])) {
				$featured_image = explode('/', $row['featured_image']);
			$featured_image = '../'.$featured_image[2].'/'.$featured_image[3].'/'.$featured_image[4].'/'.$featured_image[5];
			$output .='<div class="col-md-6">
			<img class="file_drag_area_img" src="'.$featured_image.'">
			</div>';
			}
			$output .='
			<div class="col-md-6" style="margin-top: 2%;">
			<p><strong>Featured Text: </strong> <br>'.$row['featured_text'].'</p>
			<p><strong>Marked Status: </strong><span id="marked_status'.$feature_id.'"> '.$status.'</span></p>
			<div class="col-md-12">
			<div class="row" id="featured_item_buttons">
			';
			$output .= '<button title="Mark" onclick="return mark_function('.$feature_id.')" class="btn btn-sm btn-info mark-btn'.$feature_id.'"><span class="fa '.(($status == 'Marked')?'fa-times':'fa-check ').' fa-lg"></span></button>';
			$output .= '
			<button title="Edit" class="btn btn-sm btn-primary"><a style="color:#fff;" href="edit-featured-item.php?item='.urlencode($feature_id).'"><span class="fa fa-edit" fa-lg></span></a></button>
			<button title="Delete" class="btn btn-sm btn-danger" onclick="return delete_featured_item('.$feature_id.')"><span class="fa fa-trash fa-lg"></span></button>
			</div>
			</div>
			</div>
			</div>';
		}
		echo $output;
	}
}
?>
<script type="text/javascript">
	var status = '<?= $row["status"];?>';
	if (status == 0) {
		$('.mark-btn'+feature_id).html('<span class="fa fa-check fa-lg"></span>');
		$('.mark-btn').attr('title','Mark');
	}
	if (status == 1) {
		$('.mark-btn'+feature_id).html('<span class="fa fa-times fa-lg"></span>');
	}
</script>