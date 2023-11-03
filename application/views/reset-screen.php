<?php
$this->load->view('includes/header');
?>
        <main>
            <div class="single">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-9 article-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="post-header-subscription">
                                        <h1 class="post-title ">Forgot Password</h1>
                                    </div>
                                    <div class="subscribe_pan_summary">
                                  
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    </div>
                                    <div class="subscribe_detail_left">
									<div class="login-form" style="width: 500px;margin: 70px auto;">
								
										
										
										
										<form action="<?php echo base_url("home/change_password"); ?>" method="post">
												<h2 class="text-center">Reset Password</h2>       
												<div class="form-group">
													<input type="password" class="form-control" name="password" placeholder="Enter New Password" required="required">
													  <input type="hidden" name="email" value="<?php echo $email ?>" style="width: 490px;">
													 <input type="hidden" name="encid" value="<?php echo $encid ?>" style="width: 490px;">
									  <input type="hidden" name="token" value="<?php echo $id ?>" style="width: 490px;">
												</div>												
												<div class="form-group">
													<button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
												</div>											      
											</form>
										
										
										
										
										
										
										
										
										
										
										
										
											  <div class="row">
											  <div class="col-lg-6">
											<p class="text-center"><a href="<?php echo base_url("home/registration"); ?>">Create an Account</a></p>
											</div>
											  <div class="col-lg-6">
											<p class="text-center"><a href="<?php echo base_url("home"); ?>">Back to Login</a></p>
											</div>
											</div>
											
									</div>
										
										
										
										
										
										
										
										
										
										
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Ad Unit -->
                            <div class="ad-unit tower-ad-unit">
                                <?php $this->load->view('includes/rightpanel');?>
                            </div>
                            <!-- Ad Unit -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
<?php $this->load->view('includes/footer'); ?>