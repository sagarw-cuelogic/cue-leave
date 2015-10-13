<html>
<head>
<title>Cue-leave</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/validator.js"></script>
 <?php foreach($scripts as $script) {?>
            <script type="text/javascript" src="<?=base_url();?>assets/js/<?=$script?>.js"></script>
 <?php } ?>
<head>
<body>
	<header>

	<span class="pull-left">Cuelogic</span>
	<div>
		<a href="" class="btn btn-default pull-right text-left">Logout</a>
	</div>
	</header>
