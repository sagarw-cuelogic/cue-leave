<div class="container main-content page-content">
<div class="pull-left col-md-2 col-sm-2">
<a href="#" data-toggle="modal" data-target="#upload_photo">
<?php if(isset($user_data->profile_picture) && $user_data->profile_picture){?>
<img src="<?=base_url();?>uploads/<?=$user_data->profile_picture?>" class="img-responsive" style="width:158px;height:158px;">
<?}else{?>
	<img src="<?=base_url();?>assets/images/download.jpeg" class="img-responsive">
	<?}?>
</a>
<?php 
	$this->load->view('common/nav_menu');
?>
</div>
<div class="cms-right-section col-md-10 col-sm-9">
	<?php if($navigation){
		$this->load->view('content/'.$navigation);
	}else {
		$this->load->view('content/profile');
	}?>
</div>
</div>
<div id="upload_photo" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Upload Profile Picture</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal leave_action_form" data-toggle="validator" role="form" method="POST" action="<?=base_url();?>user/upload_picture" enctype="multipart/form-data">
       	<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Image</label>
				<div class="form-group col-sm-9">
				<input type="file" class="form-control" id="user_file" name="user_file" data-error="Please enter leave comments" required/>
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