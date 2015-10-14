<div class="pull-left col-md-2 col-sm-2">
<img src="<?=base_url();?>assets/images/download.jpeg" class="img-responsive">
</div>
<div class="col-md-10 col-sm-10 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Profile</div>
		<div class="panel-body">
			<form class="profile_form form-horizontal">
			<div class="form-group padding-10 input-login">
			<div class="form-group">
				<label class="col-sm-3 control-label text-left">First Name</label>
				<div class="col-sm-9">
				<input type="text" class="form-control" id="first" name="first" value="<?=$user_data->first?>" readonly/>
				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label text-left">Last Name</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="last" name="last" value="<?=$user_data->last?>" readonly/>
		</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label text-left">Employee Id</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="employee_id" name="employee_id" value="<?=$user_data->employee_id?>" readonly/>
		</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label text-left">Email</label>
			<div class="col-sm-9">
			<input type="email" class="form-control" id="email" name="email" value="<?=$user_data->email?>" readonly/>
		</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label text-left">Phone Number</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="phone" name="phone" value="<?=$user_data->phone?>" readonly/>
		</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label text-left">Address</label>
			<div class="col-sm-9">
			<textarea class="form-control" id="address" name="address" readonly><?=$user_data->address?></textarea>
		</div>
			</div>
			<div class="form-group text-center">
			<button class="btn btn-primary edit" type="button">Edit</button>
			<button class="btn btn-primary cancel" type="button">Cancel</button>
			</div>
			</div>
			</form>
		</div>
	</div>
</div>