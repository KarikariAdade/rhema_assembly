<?php
include 'connect.php';
		$errorMsg = "";
		if (isset($_POST['add_profile_btn'])) {
			$position = mysqli_real_escape_string($conn, $_POST['position']);
			$status = mysqli_real_escape_string($conn, $_POST['status']);
			$gender = mysqli_real_escape_string($conn, $_POST['gender']);
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
			$admin_image = $_POST['admin_image'];
			$biograghy = mysqli_real_escape_string($conn, $_POST['biograghy']);

			if (!empty($position) && !empty($status) && !empty($gender) && !empty($address) && !empty($occupation) && !empty($admin_image) && !empty($biograghy)) {
				if (strlen($biograghy) < 40) {
					$errorMsg = "<strong>Biography field</strong> should contain more than 40 characters";
				}else{
					if(isset($_POST['admin_image'])){
					$file_name = $_FILES['admin_image']['name'];
				    $file_size = $_FILES['admin_image']['size'];
				    $file_tmp_name = $_FILES['admin_image']['tmp_name'];
				    $file_type = $_FILES['admin_image']['type'];
				    $target_dir = "../assets/uploads/profile";
                    $target_file = $target_dir.basename($file_name);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $errorMsg = $file_name;
				}
			}
			}else{
				$errorMsg = "Please fill all form fields before submitting";
			}
		}
		?>