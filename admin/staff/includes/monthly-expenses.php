<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
						<thead>
							<tr>
								<th>Month Number</th>
								<th>Month Name & Year</th>
								<th>Number of Expenses</th>
								<th>Total Amount Used</th>
							</tr>
						</thead>
						<tbody id="daily_expense_field">
							<?php
							$fetch_weekly = $conn->query("SELECT date,SUM(amount_used) AS total_amount_used,month_number, COUNT(purpose) AS total_expenses FROM church_expenses WHERE year = '$current_year' GROUP BY month_number ORDER BY id DESC");
							if (mysqli_num_rows($fetch_weekly) > 0) {
								while ($row = mysqli_fetch_assoc($fetch_weekly)) {
									$month_number = date('F', strtotime($row['date']));
									?>
									<tr>
										<td><?= $row['month_number']; ?></td>
										<td><?= $month_number .' '.$current_year; ?></td>
										<td><?= $row['total_expenses']; ?></td>
										<td><?= money($row['total_amount_used']); ?></td>
									</tr>
									<?php
								}
							}else{
								echo "No Information yet";
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>