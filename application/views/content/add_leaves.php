<div class="col-md-11 col-sm-11 pull-left profile">
	<div class="panel panel-primary">
		<div class="panel-heading">Add New Leave</div>
		<div class="panel-body">
			<?php if($this->session->flashdata('error')){?>
                    	<div class="alert alert-danger" role="alert"><?=$this->session->flashdata('error');?></div>
            <?}?>
            <?php if($this->session->flashdata('success')){?>
                    	<div class="alert alert-success" role="alert"><?=$this->session->flashdata('success')?></div>
            <?}?>
			<form class="add_leave_form form-horizontal" data-toggle="validator" role="form" method="POST" action="<?=base_url()?>leave/add_leave">
			<div class="form-group padding-10 input-login">
			<div class="form-group">
				<label class="col-sm-3 control-label text-left">Leave Subject</label>
				<div class="form-group col-sm-9">
				<input type="text" class="form-control" id="leave_subject" name="leave_subject" data-error="Please enter valid subject" required/>
				 <div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="leave_description" class="col-sm-3 control-label">Leave Description</label>
				<div class="form-group col-sm-9">
				<textarea type="text" class="form-control" id="leave_description" name="leave_description" data-error="Please enter description" required></textarea>
				<div class="help-block with-errors text-left"></div>
				</div>
			</div>
			<div class="form-group">
			<label for="leave_pan" class="col-sm-3 control-label">Leave Type</label>
			 <div class="radio col-sm-9" >
		        <label>
		          <input type="radio" id="leave_type" name="leave_type" class="leave_type" value="sick" checked>Sick leave
		        </label>
		         <label>
		          <input type="radio" id="leave_type" name="leave_type" class="leave_type" value="preparation"required>Preparation leave
		        </label>
      		 </div>
			</div>
			<div class="form-group">
			<label for="leave_pan" class="col-sm-3 control-label">Leave Plan</label>
			 <div class="radio col-sm-9" >
		        <label>
		          <input type="radio" id="leave_plan" name="leave_plan" class="leaves" value="one_day" checked>One Day
		        </label>
		         <label>
		          <input type="radio" id="leave_plan" name="leave_plan" class="leaves" value="half_day"required>Half day
		        </label>
		         <label>
		          <input type="radio" id="leave_plan" name="leave_plan" class="leaves" value="more_then_day"required>More Than One Day
		        </label>
		        <label>
		          <a href="#" data-toggle="modal" data-target="#holiday_list"> <span class="glyphicon glyphicon-list"></span> Cuelogic Holiday List </a>
		        </label>
      		 </div>
			</div>
			<div class="form-group one_day_leave">
				<label for="leave_pan_half_day" class="col-sm-3 control-label">Date</label>
				<div class="form-group col-sm-9">
                <div class='input-group col-md-5' id='datetimepicker'>
                    <input type='text' class="form-control date datepicker" id="date" name="date" data-error="Please select date" required/>
                    
                    <span class="input-group-addon calendar_icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> 
                <div class="help-block with-errors text-left"></div> 
            </div>
            </div>
            <div class="form-group more_then_day_leave">
				<label for="leave_pan_half_day" class="col-sm-3 control-label">Start Date</label>
				<div class="form-group col-sm-9 ">
                <div class='input-group col-md-5'>
                    <input type='text' class="form-control start_date datepicker" id="start_date" name="leave_start_date" data-error="Please select start date" required/>
                    <span class="input-group-addon calendar_icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    
                </div>
                <div class="help-block with-errors date-errors text-left"></div>
            	</div>
            </div>
            <div class="form-group more_then_day_leave">
            	<label for="leave_pan_half_day" class="col-sm-3 control-label">End Date</label>
            	<div class="form-group col-sm-9 ">
            	 <div class='input-group col-md-5'>
                    <input type='text' class="form-control end_date datepicker" id="end_date" name="leave_end_date" data-error="Please select end date" required/>
                   
                    <span class="input-group-addon calendar_icon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                     
                </div> 
                <div class="help-block with-errors date-errors text-left"></div>
            	</div>
            </div>
			<div class="form-group text-center">
			<button class="btn btn-primary" type="submit">Apply </button>
			<button class="btn btn-primary cancel" type="reset">Cancel</button>
			</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="holiday_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Holiday List</h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
		  <?php foreach ($holiday_list as $key => $value) {?>
		  		<li class="list-group-item" style="width:250px;">

		  			<span class=""><?=date('jS M Y',strtotime($value->date))?></span>
		  			<span class="pull-right"><?=$value->event?></span>
		  		</li>
		  <?}?>
		</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>