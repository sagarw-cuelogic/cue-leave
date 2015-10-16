<div class="container main-content page-content">
<div class="pull-left col-md-2 col-sm-2">
<?php if(isset($user_data->profile_picture) && $user_data->profile_picture){?>
<img src="<?=$user_data->profile_picture?>" class="img-responsive" style="width:158px;height:158px;">
<?}else{?>
	<img src="<?=base_url();?>assets/images/download.jpeg" class="img-responsive">
	<?}?>
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