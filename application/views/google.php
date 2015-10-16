<html>
<head>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">
</head>
<body>
 <div class="container main-content login-content">
            <div class="block-section-login">
                <div class="col-md-12 col-sm-12 col-xs-12 login-section">
                    <!-- Login Header -->
                    <div class="login-header col-md-10">
                        
                            <h3 class="pull-left">Cuelogic</h3>
                            <h6 class="pull-left">LEAVE MANAGEMENT SYSTEM</h6>
                        
                    </div>
                    <!-- Login Header End-->
                    <div class="login-input-section col-md-12 pull-left">
                    	<?php if($this->session->flashdata('error')){?>
                    	<div class="alert alert-danger" role="alert">
						  Invalid Username and Password
						</div>
                    	<?}?>

                            <div class="col-md-12 col-sm-12 col-xs-12 pull-left text-center">
                            	<?php if (isset($authUrl)){ ?>
                                <a href="<?php echo $authUrl; ?>" class="btn btn-primary">Login</a>
                                <?}?>
                            </div>
                    </div>
                </div>
            </div>
       </div>
</body>
</html>