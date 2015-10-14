<html>
<head>
<title>Cue-leave</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/validator.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/spin.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.spin.js"></script>
 <?php if(!empty($scripts)) {
 		foreach($scripts as $script) {?>
            <script type="text/javascript" src="<?=base_url();?>assets/js/<?=$script?>.js"></script>
 <?php }
 } ?>
 <script type="text/javascript">
	var base_url="<?=base_url();?>";
 </script>
<head>
<body>
	<header>
	<span class="pull-left">
		<img src="<?=base_url();?>assets/images/cuelogic_logo.png" class="img-responsive">
	</span>
	<?php if($this->session->userdata('user_id')){?>
	<div class="btn-group pull-right padding-12">
	  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Menu <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="#">Account Settings</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">Change Password</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="<?=base_url()?>login/logout">Logout</a></li>
	  </ul>
	</div>
	<?}?>
</header>