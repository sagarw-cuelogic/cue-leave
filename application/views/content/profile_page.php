<div class="pull-left">
<img src="<?=base_url();?>assets/images/download.jpeg">
</div>
<div class="clear"></div>
<div class="col-md-9 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Panel heading without title</div>
		<div class="panel-body">
			<form class="profile_form">
			<div class="form-group col-md-8 input-login">
			<div class="form-group">
			<label>First Name</label>
			<input type="name" class="form-control" id="first" name="first" value="<?=$user_data->first?>" readonly/>
			</div>
			<div class="form-group">
			<label>Last Name</label>
			<input type="name" class="form-control" id="last" name="last" value="<?=$user_data->last?>" readonly/>
			</div>
			<div class="form-group">
			<label>Employee Id</label>
			<input type="name" class="form-control" id="employee_id" name="employee_id" value="<?=$user_data->employee_id?>" readonly/>
			</div>
			<div class="form-group">
			<label>Email</label>
			<input type="name" class="form-control" id="email" name="email" value="<?=$user_data->email?>" readonly/>
			</div>
			<div class="form-group">
			<label>Phone Number</label>
			<input type="name" class="form-control" id="phone" name="phone" value="<?=$user_data->phone?>" readonly/>
			</div>
			<div class="form-group">
			<label>Address</label>
			<textarea type="name" class="form-control" id="address" name="address" readonly><?=$user_data->address?></textarea>
			</div>
			<div class="form-group">
			<button class="btn btn-primary edit" type="button">Edit</button>
			<button class="btn btn-primary cancel" type="button">Cancel</button>
			</div>
			</div>
			</form>
		</div>
	</div>
</div>