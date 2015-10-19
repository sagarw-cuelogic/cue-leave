<div class="col-md-11 col-sm-11 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Assign Employee</div>
		<div class="panel-body">
			<?php if(!empty($user_data)){?>
			<div class="form-group">
				<table class="table table-bordered table-striped leave_table">
					<thead>
						<th class="text-center">Employee Name</th>
						<th class="text-center">Email</th>
						<th class="text-center">Designation</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</thead>

					<tbody>
						<?php foreach ($user_data as $key => $value) {
						if($this->session->userdata('user_email')!=$value->email){
						?>
						<tr>
						<td class="text-center"><?=$value->first.' '.$value->last?></td>
						<td class="text-center"><?=$value->email?></td>
						<td class="text-center"><?=$value->designation_name?></td>
						<td class="text-center status"><?=($value->manager_id)?'Assigned':'Pending'?></td>
						<td class="text-center"><button class="btn btn-info <?=($value->manager_id)?'unassigned':'assign'?>" 
							data-emp-id="<?=$value->id?>"  <?=($value->manager_id)?'':'data-toggle="modal" data-target="#manager"'?> ><?=($value->manager_id)?'De-assign':'Assign Manager'?></button>&nbsp;<a class="btn btn-info " href="<?=base_url();?>admin/landing/profile/<?=$value->id?>" data-emp-id="<?=$value->id?>">Edit Profile</a></td>
						</tr>
						<?}}?>
					</tbody>
				</table>
			</div>
			<?} else {?>
			<div class="alert alert-warning" role="alert">There are no employee associated with you!</div>
			<?}?>
		</div>
	</div>
</div>
<div id="manager" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Managers List</h4>
      </div>
      <div class="modal-body manager_list">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>