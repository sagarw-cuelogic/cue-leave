<div class="pull-left col-md-2 col-sm-2">
<img src="<?=base_url();?>assets/images/download.jpeg" class="img-responsive">
</div>
<div class="col-md-10 col-sm-10 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Leave Details..</div>
		<div class="panel-body">
			<?php if(!empty($user_data)){?>
			<div class="form-group">
			<table class="table table-bordered table-striped leave_table">
				
					<thead>
						<th class="text-center">Employee Name</th>
						<th class="text-center">Date</th>
						<th class="text-center">Leave Type</th>
						<th class="text-center">Number of Days</th>
						<th class="text-center">Status</th>
					</thead>
				
					<tbody>
					<?php foreach ($user_data as $key => $value) {

						$noOfLeaves = businessWorkingDays($value->leave_start_date,$value->leave_end_date);
						$start_date = convertDbDate($value->leave_start_date);
						$end_date   = convertDbDate($value->leave_end_date);
						?>
						<tr>
							<td class="text-center"><?=$value->first.' '.$value->last?></td>
							<td class="text-center"><?=$start_date?> To <?=$end_date?></td>
							<td class="text-center"><?=ucfirst($value->leave_type);?></td>
							<td class="text-center"><?=$noOfLeaves?></td>
							<td class="text-center">Pending</td>
						</tr>
					<?}?>
					</tbody>
				
			</table>
		</div>
			<?} else{?>
			<div class="alert alert-warning" role="alert">There are no leaves applied by you!</div>
			<?}?>
		</div>
	</div>
</div>