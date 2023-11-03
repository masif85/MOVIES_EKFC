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
                                  
                                        
                                    </div>
                                    <div class="subscribe_detail_left">
									<div class="login-form" style="width: 500px;margin: 70px auto;">
											<form action="<?php echo base_url("home/send_password"); ?>" method="post">
												<h2 class="text-center">Forgot Password</h2>       
												<div class="form-group">
													<input type="text" class="form-control" name="email" placeholder="Enter Email" required="required">
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
                          
                            <!-- Ad Unit -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
<?php $this->load->view('includes/footer'); ?>