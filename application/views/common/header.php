<html>
<head>
<title>Cue-leave</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.datetimepicker.js"></script>
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
		<img src="<?=base_url();?>assets/images/cuelogic_logo.png" class="img-responsive logo">
	</span>
	<?php if($this->session->userdata('user_id')){?>
	<div class="btn-group pull-right padding-12">
	  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Welcome <?=ucfirst($this->session->userdata('first'));?> <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="#">Account Settings</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">Change Password</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?=base_url()?>login/logout">Logout</a></li>
	  </ul>
	</div>
	<?}?>
</header>