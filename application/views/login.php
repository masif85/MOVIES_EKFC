<?php $this->load->view('includes/header'); ?>        
<main>
            <div class="single">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-9 article-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
						<!--			<div class="login-form col-md-6" style="margin:0 auto 0">
                                  <div class="post-header-subscription">
                                        <h1 class="post-title ">Log in Form</h1>
                                    </div>
										  </div>-->
                                   <!-- <div class="subscribe_pan_summary">                                  
        							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    </div>-->
                                    <div class="subscribe_detail_left">
									<div class="login-form col-md-6" style="margin:0 auto 0">
											<?php if(@$this->session->flashdata('msg')):?>
											<span class="text-<?=$this->session->flashdata('type')?>"><?=@$this->session->flashdata('msg');?></span>
											<?php endif; ?>											
											<form action="<?php echo base_url("home/check_login"); ?>" method="post">
												<h2 class="text-center">Log in</h2>       
												<div class="form-group">
													<input type="text" class="form-control" name="username" placeholder="Username" required="required">
												</div>
												<div class="form-group">
													<input type="password" class="form-control" name="password" placeholder="Password" required="required">
												</div>
												<div class="form-group">
													<button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
												</div>
												<div class="clearfix">
													<!--<label class="float-left form-check-label"><input type="checkbox"> Remember me</label>-->
													<a href="<?php echo base_url("home/forgotpass"); ?>" class="float-right">Forgot Password?</a>
												</div>        
											</form>
											<p class="text-center"><a href="<?php echo base_url("home/registration"); ?>">Create an Account</a></p>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </main>
<?php $this->load->view('includes/footer'); ?>