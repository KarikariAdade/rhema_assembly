<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="body">
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover dataTable js-exportable" style="margin-top: 2%!important;">
<thead>
<tr>
<th>Made By:</th>
<th>Week Number</th>
<th>Date</th>
<th>Time</th>
<th>Expense Purpose</th>
<th>Amount Used</th>
<th id="no-print">Action</th>
</tr>
</thead>
<tbody id="daily_expense_field">
<?php
$fetch_daily = $conn->query("SELECT * FROM church_expenses WHERE year = '$current_year' ORDER BY id DESC");
if (mysqli_num_rows($fetch_daily) > 0) {
while ($row = mysqli_fetch_assoc($fetch_daily)) {
$day = date('l F d, Y', strtotime($row['date']));
$time = date('h:i a', strtotime($row['date']));
$expense_id = $row['id'];
?>
<tr>
<td><?= $row['user']; ?></td>
<td><?= $row['week_number'];?></td>
<td><?= $day; ?></td>
<td><?= $time; ?></td>
<td><?= $row['purpose']; ?></td>
<td><?= money($row['amount_used']); ?></td>
<td id="no-print">
<button class="btn btn-danger btn-sm" onclick="return delete_expense('<?= $expense_id; ?>')"><span class="fa fa-trash"></span></button>
</td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>