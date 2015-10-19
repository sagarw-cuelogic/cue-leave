<?php if($this->session->userdata('user_role')=='admin')
	$formaction=base_url().'admin/landing/edit_profile/'.$user_data->id;
	else
	$formaction=base_url().'user/landing/edit_profile';?>
<div class="col-md-11 col-sm-11 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Profile</div>
		<div class="panel-body">
		<?php if($this->session->flashdata('error')){?>
		<div class="alert alert-danger" role="alert"><?=$this->session->flashdata('error');?></div>
		<?}?>
		<?php if($this->session->flashdata('success')){?>
		<div class="alert alert-success" role="alert"><?=$this->session->flashdata('success')?></div>
		<?}?>
		<form class="profile_form form-horizontal" data-toggle="validator" role="form" method="POST" action="<?=$formaction?>">
		<div class="form-group padding-10 input-login">
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">First Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="first" name="first" value="<?=($user_data->first)?$user_data->first:''?>" required/>
				<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Last Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="last" name="last" value="<?=($user_data->last)?$user_data->last:''?>" required/>
				<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Employee Id</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="employee_id" name="employee_id" value="<?=($user_data->employee_id)?$user_data->employee_id:''?>" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Email</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" id="email" name="email" value="<?=($user_data->email)?$user_data->email:''?>" required/>
				<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Designation</label>
			<div class="col-sm-9">
				<select class="form-control designation-menu" name="designation" required>
				<option value="">Select</option>
				<?php foreach ($designations as $key => $value) {
					if($user_data->designation==$value->designation_id)
						$select ='selected';
					else
						$select = '';?>
				<option value="<?=$value->designation_id?>" <?=$select?>><?=$value->designation_name?></option>
				<?}?>
			</select>
			<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Phone Number</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="phone" name="phone" value="<?=($user_data->phone)?$user_data->phone:''?>" data-minlength="10" ="10" maxlength="10" data-error="Phone number must be 10 digit" required/>
				<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label text-left">Address</label>
			<div class="col-sm-9">
				<textarea class="form-control" id="address" name="address" required><?=($user_data->address)?$user_data->address:''?></textarea>
				<div class="help-block with-errors text-left"></div>
			</div>
		</div>
		<div class="form-group text-center">
			<button class="btn btn-primary edit" type="submit">Update</button>
			<button class="btn btn-primary cancel" type="reset">Cancel</button>
		</div>
</div>
</form>
</div>
</div>
</div>