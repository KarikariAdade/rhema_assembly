<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
						<thead>
							<tr>
								<th>Year</th>
								<th>Number of Expenses</th>
								<th>Total Amount Used</th>
							</tr>
						</thead>
						<tbody id="daily_expense_field">
							<?php
							$fetch_weekly = $conn->query("SELECT SUM(amount_used) AS total_amount_used,year, COUNT(purpose) AS total_expenses FROM church_expenses GROUP BY year ORDER BY id DESC");
							if (mysqli_num_rows($fetch_weekly) > 0) {
								while ($row = mysqli_fetch_assoc($fetch_weekly)) {
									?>
									<tr>
										<td><?= $row['year']; ?></td>
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