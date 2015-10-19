<div class="col-md-11 col-sm-11 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Associated Employee Details.</div>
		<div class="panel-body">
			<?php if(!empty($user_data)){?>
			<div class="form-group">
			<table class="table table-bordered table-striped leave_table">
					<thead>
						<th class="text-center">Employee Name</th>
						<th class="text-center">Email</th>
					</thead>
					<tbody>
					<?php foreach ($user_data as $key => $value) {
						?>
						<tr>
							<td class="text-center"><?=$value->first.' '.$value->last?></td>
							<td class="text-center"><?=$value->email?></td>
						</tr>
					<?}?>
					</tbody>
			</table>
		</div>
			<?} else{?>
			<div class="alert alert-warning" role="alert">There are no employees associated to you!</div>
			<?}?>
		</div>
	</div>
</div>