<div class="cms-left-section col-md-12 col-sm-12 margin-left-20 margin-top20">
<ul class="nav nav-pills nav-stacked">
  <?php if($this->session->userdata('user_role')=='user'){?>
  <li role="presentation" class="<?=($navigation=='profile')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/profile">Profile <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a></li>
  <li role="presentation" class="<?=($navigation=='add_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/add_leaves">Add Leaves <span class="glyphicon glyphicon-plus pull-right" aria-hidden="true"></span></a></li>
  <li role="presentation" class="<?=($navigation=='view_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_leaves">View Leaves <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
  <?php if($navigation=='edit_leave'){?>
   <li role="presentation" class="<?=($navigation=='edit_leave')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/edit_leave/<?=$user_data->leave_id?>">Edit Leaves <span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span></a></li>
  <?php }}?>
  <?php if($this->session->userdata('user_role')=='admin'){?>
  <li role="presentation" class="<?=($navigation=='view_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_leaves">View Leaves <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
   <li role="presentation" class="<?=($navigation=='manage_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/manage_employees">Manage Employees <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a></li>
   <li role="presentation" class="<?=($navigation=='view_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_employees">View Employees <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
   <li role="presentation" class="<?=($navigation=='profile')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/profile/<?=$employee_id?>">Profile <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a></li>
  <?php }?>
  <?php if($this->session->userdata('user_role')=='manager'){?>
  <li role="presentation" class="<?=($navigation=='profile')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/profile">Profile <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a></li>
  <li role="presentation" class="<?=($navigation=='view_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_leaves">View Leaves <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
  <li role="presentation" class="<?=($navigation=='employee_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/employee_leaves">Employee Leaves <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
   <li role="presentation" class="<?=($navigation=='manage_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/manage_employees">Manage Employees <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span></a></li>
   <li role="presentation" class="<?=($navigation=='view_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_employees">View Employees <span class="glyphicon glyphicon-th-list pull-right" aria-hidden="true"></span></a></li>
  <?php }?>
</ul>
</div>