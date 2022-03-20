<?php
include 'connect.php';
if (isset($_POST['proceed_reset_btn'])) {
	$account_last_name = $_POST['account_last_name'];
	$account_email = $_POST['account_email'];
	$account_last_name_md = md5($account_last_name);
	$fetch_profile_sql = "SELECT * FROM admin_profile WHERE last_name = '$account_last_name' AND email = '$account_email'";
	$fetch_profile_query = mysqli_query($conn, $fetch_profile_sql);
	if (mysqli_num_rows($fetch_profile_query) > 0) {
		while ($row = mysqli_fetch_assoc($fetch_profile_query)) {
			session_start();
			$_SESSION['account_last_name'] = $account_last_name;
		$_SESSION['account_reset_id'] = $row['id'];
		$_SESSION['account_email'] = $account_email;
		echo "<script>window.location = 'reset-password.php'</script>";
	}
}else{
		echo "There is no account with the entered credentials";
	}
}
?>