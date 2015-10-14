<div class="cms-left-section col-md-2 col-sm-2">
<ul class="nav nav-pills nav-stacked">
  <?php if($this->session->userdata('user_role')=='user'){?>
  <li role="presentation" class="<?=($navigation=='profile')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/profile">Profile</a></li>
  <li role="presentation" class="<?=($navigation=='add_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/add_leaves">Add Leaves</a></li>
  <li role="presentation" class="<?=($navigation=='view_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_leaves">View Leaves</a></li>
  <?php }?>
  <?php if($this->session->userdata('user_role')=='admin'){?>
  <li role="presentation" class="<?=($navigation=='view_leaves')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_leaves">View Leaves</a></li>
   <li role="presentation" class="<?=($navigation=='manage_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/manage_employees">Manage Employees</a></li>
   <li role="presentation" class="<?=($navigation=='view_employees')?'active':''?>"><a href="<?=base_url();?><?=$controller?>/landing/view_employees">View Employees</a></li>
  <?php }?>
</ul>
</div>