<div class="pull-left col-md-2 col-sm-2">
<img src="<?=base_url();?>assets/images/download.jpeg" class="img-responsive">
</div>
<div class="col-md-10 col-sm-10 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Assign Employee</div>
		<div class="panel-body">
			<?php if(!empty($user_data)){?>
			<div class="form-group">
			<table class="table table-bordered table-striped leave_table">
				
					<thead>
						<th class="text-center">Employee Name</th>
						<th class="text-center">Email</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</thead>
				
					<tbody>
					<?php foreach ($user_data as $key => $value) {

						?>
						<tr>
							<td class="text-center"><?=$value->first.' '.$value->last?></td>
							<td class="text-center"><?=$value->email?></td>
							<td class="text-center status"><?=($value->manager_id)?'Assigned':'Pending'?></td>
							<td class="text-center"><button class="btn btn-info <?=($value->manager_id)?'unassigned':'assign'?>" data-emp-id="<?=$value->user_id?>"><?=($value->manager_id)?'De-assign':'Assign'?></button></td>
						</tr>
					<?}?>
					</tbody>
				
			</table>
		</div>
		<?}?>
		</div>
	</div>
</div>