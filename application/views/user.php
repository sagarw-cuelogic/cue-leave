 <div class="container main-content">
 	<div class="col-md-10 col-sm-10 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Sign Up..</div>
		<div class="panel-body">
			<form class="add_leave_form form-horizontal" data-toggle="validator" role="form" method="POST" action="<?=base_url()?>user/add_user">
			<div class="form-group padding-10 input-login">
			<div class="form-group">
				<label class="col-sm-3 control-label text-left">First Name</label>
				<div class="form-group col-sm-5">
				<input type="text" class="form-control" id="first" name="first" data-error="Please enter first name" required/>
				 <div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Last Name</label>
				<div class="form-group col-sm-5">
				<input type="text" class="form-control" id="last" name="last" data-error="Please enter last name" required/>
				<div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Email</label>
				<div class="form-group col-sm-5">
				<input type="email" class="form-control" id="email" name="email" data-error="Please enter valid email address" required/>
				<div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">User Name</label>
				<div class="form-group col-sm-5">
				<input type="text" class="form-control" id="username" name="username" data-error="Please enter user name" required/>
				<div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Password</label>
				<div class="form-group col-sm-4 pull-left margin-right10">
				<input type="password" class="form-control" id="password" name="password" data-error="Please enter password" required/>
				<div class="help-block with-errors text-left"></div>
				</div>
				<div class="form-group col-sm-4">
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" data-match="#password" data-error="Please enter confirm password" required/>
				<div class="help-block with-errors text-left"></div>
				</div>
			</div>
			
			<div class="form-group text-center">
			<button class="btn btn-primary" type="submit">Apply</button>
			<button class="btn btn-primary cancel" type="button">Cancel</button>

			</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>