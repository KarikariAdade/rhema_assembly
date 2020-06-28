<?php
$current_date = date('Y');
$fetch_pending = $conn->query("SELECT * FROM finance WHERE status = 0 AND date LIKE '%$current_date%' ORDER BY id DESC");
$fetch_approved = $conn->query("SELECT * FROM finance WHERE status = 1 AND date LIKE '%$current_date%' ORDER BY id DESC");
$fetch_tithe = $conn->query("SELECT * FROM finance WHERE type = 'Tithe' AND status = 1 AND date LIKE '%$current_date%' ORDER BY id DESC");
$fetch_donation = $conn->query("SELECT * FROM finance WHERE type = 'Donation' AND status = 1 AND date LIKE '%$current_date%' ORDER BY id DESC");
$fetch_welfare = $conn->query("SELECT * FROM finance WHERE type = 'Welfare' AND status = 1 AND date LIKE '%$current_date%' ORDER BY id DESC");
$fetch_offering = $conn->query("SELECT * FROM finance WHERE type = 'Offering' AND status = 1 AND date LIKE '%$current_date%' ORDER BY id DESC");

?>
<div class="tab-pane active" id="pending_transaction">
	<small>NB: Please make sure money as been received with transaction ID clearly indicated before approving</small>
	<div class="row">
		<?php
		if (mysqli_num_rows($fetch_pending) > 0) {
			?>
			<div class="col-lg-12">
				<div class="card">
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover datatable" style="margin-top: 2%!important;">
								<thead>
									<tr>
										<th>Full Name</th>
										<th>Email Address</th>
										<th>Phone Number</th>
										<th>Amount</th>
										<th>Type</th>
										<th>Date</th>
										<th>Time</th>
										<th id="no-print">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($row = mysqli_fetch_assoc($fetch_pending)) {
										$timestamp = strtotime($row['date']);
										$day = date('M d, Y', $timestamp);
										$time = date('h:ia', $timestamp);
										$transaction_id = $row['transaction_id'];
										?>
										<tr>
											<td><?= $row['full_name']; ?></td>
											<td><?= $row['email']; ?></td>
											<td><?= $row['phone']; ?></td>
											<td><?= money($row['amount']); ?></td>
											<td><?= $row['type']; ?></td>
											<td><?= $day; ?></td>
											<td><?= $time; ?></td>
											<td id="no-print">
												<button class="btn btn-primary btn-sm approve" title="Approve Transaction" onclick="return transaction_approval('<?= $transaction_id;?>')"><span class="fa fa-stamp"></span></button>
												<button class="btn btn-danger btn-sm" title="Delete Transaction"><span class="fa fa-trash"  onclick="return delete_transaction('<?= $transaction_id; ?>')"></span></button>
											</td>
											<tr>
												<?php
											}
											?>
										</tbody>

									</table>
								</div>
							</div>
							<button class="btn pull-right btn-info" id="print"><span class="fa fa-print"></span> Print</button>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no pending transactions yet</h3>";
				}
				?>
			</div>
		</div>

		<!-- APPROVED TRANSACTIONS  -->


		<div class="tab-pane" id="approved_transaction">
			<div class="row">
				<?php if (mysqli_num_rows($fetch_approved) > 0) {
					?>
					<div class="col-lg-12">
						<div class="card">
							<div class="body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
										<thead>
											<tr>
												<th>Full Name</th>
												<th>Email Address</th>
												<th>Phone Number</th>
												<th>Amount</th>
												<th>Type</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Transaction ID</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = mysqli_fetch_assoc($fetch_approved)) {
												$timestamp = strtotime($row['date']);
												$day = date('M d, Y', $timestamp);
												$time = date('h:ia', $timestamp);
												$transaction_id = $row['transaction_id'];
												if ($row['status'] = 1) {
													$status = "Approved";
												}
												?>
												<tr>
													<td><?= $row['full_name']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['phone']; ?></td>
													<td><?= money($row['amount']); ?></td>
													<td><?= $row['type']; ?></td>
													<td><?= $day; ?></td>
													<td><?= $time; ?></td>
													<td><?= $status;?></td>
													<td><?= $transaction_id; ?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no approved transactions yet</h3>";
				}
				?>
			</div>
		</div>
		<div class="tab-pane" id="tithes">
			<div class="row">
				<?php if (mysqli_num_rows($fetch_tithe) > 0) {
					?>
					<div class="col-lg-12">
						<div class="card">
							<div class="body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
										<thead>
											<tr>
												<th>Full Name</th>
												<th>Email Address</th>
												<th>Phone Number</th>
												<th>Amount</th>
												<th>Type</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Transaction ID</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = mysqli_fetch_assoc($fetch_tithe)) {
												$timestamp = strtotime($row['date']);
												$day = date('M d, Y', $timestamp);
												$time = date('h:ia', $timestamp);
												$transaction_id = $row['transaction_id'];
												if ($row['status'] = 1) {
													$status = "Approved";
												}
												?>
												<tr>
													<td><?= $row['full_name']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['phone']; ?></td>
													<td><?= money($row['amount']); ?></td>
													<td><?= $row['type']; ?></td>
													<td><?= $day; ?></td>
													<td><?= $time; ?></td>
													<td><?= $status;?></td>
													<td><?= $transaction_id; ?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no approved tithes yet</h3>";
				}
				?>
			</div>
		</div>
		<div class="tab-pane" id="donations">
			<div class="row">
				<?php if (mysqli_num_rows($fetch_donation) > 0) {
					?>
					<div class="col-lg-12">
						<div class="card">
							<div class="body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
										<thead>
											<tr>
												<th>Full Name</th>
												<th>Email Address</th>
												<th>Phone Number</th>
												<th>Amount</th>
												<th>Type</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Transaction ID</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = mysqli_fetch_assoc($fetch_donation)) {
												$timestamp = strtotime($row['date']);
												$day = date('M d, Y', $timestamp);
												$time = date('h:ia', $timestamp);
												$transaction_id = $row['transaction_id'];
												if ($row['status'] = 1) {
													$status = "Approved";
												}
												?>
												<tr>
													<td><?= $row['full_name']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['phone']; ?></td>
													<td><?= money($row['amount']); ?></td>
													<td><?= $row['type']; ?></td>
													<td><?= $day; ?></td>
													<td><?= $time; ?></td>
													<td><?= $status;?></td>
													<td><?= $transaction_id; ?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no approved donations yet</h3>";
				}
				?>
			</div>
		</div>
		<div class="tab-pane" id="offering">
			<div class="row">
				<?php if (mysqli_num_rows($fetch_offering) > 0) {
					?>
					<div class="col-lg-12">
						<div class="card">
							<div class="body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
										<thead>
											<tr>
												<th>Full Name</th>
												<th>Email Address</th>
												<th>Phone Number</th>
												<th>Amount</th>
												<th>Type</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Transaction ID</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = mysqli_fetch_assoc($fetch_offering)) {
												$timestamp = strtotime($row['date']);
												$day = date('M d, Y', $timestamp);
												$time = date('h:ia', $timestamp);
												$transaction_id = $row['transaction_id'];
												if ($row['status'] = 1) {
													$status = "Approved";
												}
												?>
												<tr>
													<td><?= $row['full_name']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['phone']; ?></td>
													<td><?= money($row['amount']); ?></td>
													<td><?= $row['type']; ?></td>
													<td><?= $day; ?></td>
													<td><?= $time; ?></td>
													<td><?= $status;?></td>
													<td><?= $transaction_id; ?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no offerings yet</h3>";
				}
				?>
			</div>
		</div>
		<div class="tab-pane" id="welfare">
			<div class="row">
				<?php if (mysqli_num_rows($fetch_welfare) > 0) {
					?>
					<div class="col-lg-12">
						<div class="card">
							<div class="body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
										<thead>
											<tr>
												<th>Full Name</th>
												<th>Email Address</th>
												<th>Phone Number</th>
												<th>Amount</th>
												<th>Type</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Transaction ID</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = mysqli_fetch_assoc($fetch_welfare)) {
												$timestamp = strtotime($row['date']);
												$day = date('M d, Y', $timestamp);
												$time = date('h:ia', $timestamp);
												$transaction_id = $row['transaction_id'];
												if ($row['status'] = 1) {
													$status = "Approved";
												}
												?>
												<tr>
													<td><?= $row['full_name']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['phone']; ?></td>
													<td><?= money($row['amount']); ?></td>
													<td><?= $row['type']; ?></td>
													<td><?= $day; ?></td>
													<td><?= $time; ?></td>
													<td><?= $status;?></td>
													<td><?= $transaction_id; ?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					echo "<h3 align='center'>There are no welfare donations yet</h3>";
				}
				?>
			</div>
		</div>
		