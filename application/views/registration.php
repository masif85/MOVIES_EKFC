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
                                        <h1 class="post-title ">Registration Form</h1>
                                    </div>
                                    <div class="subscribe_pan_summary">
                                  
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    </div>
                                    <div class="subscribe_detail_left">



<div class="login-form col-md-6"  style="
    margin:0 auto 0;">
	<?php if(@$msg):?>
			<span class="text-danger"><?=@$msg;?></span>
			<?php endif; ?>
    <form  id="loginForm" action="<?=base_url("Home/register");?>" name="loginForm" method="post">
        <h2 class="text-center">Register</h2>  
		 <div class="form-group">
            <input type="text" class="form-control" name="fname" value="<?=@$fname;?>" placeholder="First Name" required="required">
        </div>
		 <div class="form-group">
            <input type="text" class="form-control" name="lname" value="<?=@$lname;?>" placeholder="Last Name" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" value="<?=@$username;?>" placeholder="Username" required="required">
        </div>
          <div class="form-group">
            <input type="email" class="form-control"  name="email" value="<?=@$email;?>" placeholder="Email" required="required">
        </div>
         <div class="form-group">
            <input type="number" class="form-control" name="phone" value="<?=@$phone;?>" placeholder="Phone" required="required">
        </div>
        <div class="form-group">
			<?php if(@$perror):?>
			<span class="text-danger"><?=@$perror;?></span>
			<?php endif; ?>
            <input type="password" class="form-control" name="password"  placeholder="Password" required="required">
        </div>
           <div class="form-group">
            <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required="required">
        </div>
       
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox" required> I Agree to the Terms & Conditions</label>
            <!--<a href="#" class="float-right">Forgot Password?</a>-->
        </div>  
		 <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
    <p class="text-center">Already have an Account ? <a href="<?php echo base_url("home"); ?>">Log in Now!</a></p>
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
      <?php
$this->load->view('includes/footer');
?>
<script>
 function validatePassword() {
        var validator = $("#loginForm").validate({
            rules: {
                password: "required",
                confirmpassword: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: " Enter Password",
                confirmpassword: " Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            alert('Sucess');
        }
    }
</script>