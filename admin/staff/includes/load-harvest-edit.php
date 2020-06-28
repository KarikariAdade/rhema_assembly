<?php if(isset($_POST['harvest_id'])):?>
	<?php
	include 'connect.php';
	$harvest_id = $_POST['harvest_id'];
	$fetch_harvest = $conn->query("SELECT * FROM annual_harvest WHERE id = '$harvest_id'") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($fetch_harvest);
	?>
	<form method="POST" id="edit-harvest-form" class="row">
		<h3 align="center">Edit Annual Harvest</h3>
		<p id="formError"></p>
		<div class="col-md-6">
			<input class="form-control" type="hidden" id="edit_harvest_id" name="harvest_id" value="<?=$_POST['harvest_id'];?>">
			<label>Harvest Date</label>
			<div class="input-group credential_form">
				<div class="input-group-addon credential_form">
					<i class="fa fa-calendar-alt"></i>
				</div>
				<input class="form-control" type="date" id="edit_harvest_date" name="harvest_date" value="<?= $row['date']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<label>Harvest Time</label>
			<div class="input-group credential_form">
				<div class="input-group-addon credential_form">
					<i class="fa fa-clock"></i>
				</div>
				<input class="form-control" type="time" id="edit_harvest_time" name="harvest_time" value="<?= $row['time'];?>">
			</div>
		</div>
		<div class="col-md-6">
			<label>Harvest Venue</label>
			<div class="input-group credential_form">
				<div class="input-group-addon credential_form">
					<i class="fa fa-church"></i>
				</div>
				<input class="form-control" type="text" id="edit_harvest_venue" name="harvest_venue" value="<?= $row['venue'];?>">
			</div>
		</div>
		<div class="col-md-6 target_amount">
			<label>Amount Made</label>
			<div class="input-group credential_form">
				<div class="input-group-addon credential_form">
					Gh&cent
				</div>
				<input class="form-control" type="number" id="edit_target_amount" name="target_amount" value="<?= $row['target_amount'];?>">
			</div>
		</div>
		<input type="checkbox" name="amount_made" id="edit_amount_made" style="margin-top: 25px;" value="add amount made">Add Amount Made
		<div class="col-md-12">
			<p align="center"><button class="btn btn-sm" type="submit" id="edit_harvest_btn">Edit Harvest</button></p>
		</div>
	</form>
	<script type="text/javascript">
		$('.target_amount').hide();
		$('#edit_amount_made').click(function (){
			if($('#edit_amount_made :checked')){
				$('.target_amount').toggle(1000);
			}
		})
		$('#edit-harvest-form').submit(function(e){
			e.preventDefault();
			var edit_harvest_id = $('#edit_harvest_id').val();
			var edit_harvest_btn = $('#edit_harvest_btn').val();
			var edit_harvest_venue = $('#edit_harvest_venue').val();
			var edit_harvest_date = $('#edit_harvest_date').val();
			var edit_harvest_time = $('#edit_harvest_time').val();
			var edit_target_amount = $('#edit_target_amount').val();
			var edit_amount_made = $('#edit_amount_made:checked').val();
			$.ajax({
				url: 'includes/edit-harvest-val.php',
				method: 'POST',
				data:{
					edit_harvest_id: edit_harvest_id,
					edit_harvest_btn: edit_harvest_btn,
					edit_harvest_venue: edit_harvest_venue,
					edit_harvest_date: edit_harvest_date,
					edit_harvest_time: edit_harvest_time,
					edit_target_amount: edit_target_amount,
					edit_amount_made: edit_amount_made
				},
				success:function (data){
					$('#formError').html(data);
				}
			})
		})
	</script>
<?php endif;?>