<?php
$leave_status_array =array('approved'=>'Approve','disapproved'=>'Disapprove');

?>
<div class="col-md-11 col-sm-11 pull-left profile">
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
						<th class="text-center">Action</th>
					</thead>
				
					<tbody>
					<?php foreach ($user_data as $key => $value) {

						$noOfLeaves = businessWorkingDays($value->leave_start_date,$value->leave_end_date);
						$start_date = convertDbDate($value->leave_start_date);
						$end_date   = convertDbDate($value->leave_end_date);
						?>
						<tr>
							<td class="text-center"><?=$value->first.' '.$value->last?></td>
							<td class="text-center view_leave_calendar" data-leave-id="<?=$value->leave_id?>" data-user-id="<?=$value->user_id?>"><?=$start_date?> To <?=$end_date?><div class="clearfix"></div><span>click here for more</span></td>
							<td class="text-center"><?=ucfirst($value->leave_type);?></td>
							<td class="text-center"><?=$noOfLeaves?></td>
							<td class="text-center status"><?=($value->leave_status)?ucfirst($value->leave_status):'Pending'?></td>
							<td class="text-center">
							<?php if($controller=='admin'){?>
							<select class="form-control select-menu" data-leave-id="<?=$value->leave_id?>">
							<option value="">Select</option>
							<?foreach ($leave_status_array as $key => $option) {
								if($key!=$value->leave_status){
								?>
									<option value="<?=$key?>"><?=$option?></option>
								<?}}?>
							</select>
							<?} else {?>
							<a href="<?=base_url();?>user/landing/edit_leave/<?=$value->leave_id?>" class="btn btn-info">Edit <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<?}?>
							</td>
							
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
<?php if($controller=='admin'){?>
<div id="leave_action_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Manager Leave Comments</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal leave_action_form" data-toggle="validator" role="form">
       	<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Leave Comments</label>
				<div class="form-group col-sm-9">
				<textarea type="text" class="form-control" id="leave_comments" name="leave_comments" data-error="Please enter leave comments" required></textarea>
				<div class="help-block with-errors text-left"></div>
				</div>
		</div>
		<div class="form-group text-center">
			<button class="btn btn-primary" type="submit">Submit</button>
			<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
		</div>
       </form>
      </div>
    </div>

  </div>
</div>
<?}?>
<div id="calendar" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Manager Leave Comments</h4>
      </div>
      <div class="modal-body calendar_content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>