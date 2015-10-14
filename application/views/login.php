 <div class="container main-content login-content">
            <div class="block-section-login">
                <div class="col-md-12 col-sm-12 col-xs-12 login-section">
                    <!-- Login Header -->
                    <div class="login-header col-md-12">
                        <div class="block-login-header col-md-4 col-sm-4 col-xs-5">
                           
                            <span class="col-md-2 col-sm-2 col-xs-2 login-img"></span>
                            <h3 class="col-md-5 col-sm-6 col-xs-4">LOGIN</h3>
                        </div>
                    </div>
                    <!-- Login Header End-->
                    <div class="login-input-section col-md-12">
                    	<?php if($this->session->flashdata('error')){?>
                    	<div class="alert alert-danger" role="alert">
						  Invalid Username and Password
						</div>
                    	<?}?>
                        <form id="login-form" class="login-form form-horizontal" data-toggle="validator" role="form" method="POST" action="<?=base_url();?>login/validateLogin"> 

                            <div class="form-group col-md-12 input-login">
                                <div class="input-wrap">
                                    <input type="username" class="form-control" id="username" name="username" data-error="Please enter valid email address" class="col-md-10 col-sm-10 col-xs-10 pull-left login-input" placeholder="username" required/>
                                </div>
                                <div class="help-block with-errors text-left"></div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 pull-left input-login">
                                <div class="input-wrap">
                                    <input type="password" class="form-control" id="password" name="password" data-error="Please enter password" class="col-md-10 col-sm-10 col-xs-10 pull-left login-input" placeholder="Password" required/>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 pull-left text-center">
                                <button type="submit" class="btn btn-primary ">Log In</button>
                                <a href="<?=base_url();?>user/sign_up" class="btn btn-primary">Sign Up</a>
                            </div>
                           
                            
                        </form>
                    </div>
                </div>
            </div>
       </div>