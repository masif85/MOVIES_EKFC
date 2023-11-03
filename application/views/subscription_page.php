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
                                        <h1 class="post-title ">Subscription</h1>
                                    </div>
                                    <div class="subscribe_pan_summary">
                                        <img src="<?php echo base_url() ?>public/images/subs/KT28911510.gif" width="100%" height="auto">
                                        <p>Please fill in this form and enter your credit card details on the following page. Currently this facility is limited only to readers from the UAE.</p>
                                        <p><b>Note: After filling out your credit card details on the next page, please click only once on pay button to avoid repetition of transaction.</b></p>
                                        <p><i><span class="subsredstar">*</span> Terms and conditions apply</i></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 grayback">
                                            <div id="filedtopsubscription">
                         <form class="" id="submit-form-2" name="contact-information" action="<?php echo base_url("home/payment/$type"); ?>" method="post">
                                                  <div class="row">
													<div class="col-lg-12"> <h2>Khaleej Times</h2> (Select the amount)</div>
													<?php foreach($fee as $subfee): ?>
													<div class="col-lg-4 ">
                                                     <label class="form-check-label fs-5" for="amount"><?=$subfee->text?>:</label>
                                                        <div class="form-check">                                                           
															<input type="hidden" name="type" value="<?php echo md5($type); ?>">
                                                            <input class="form-check-input rounded-0 mt-2" aria-label="subscription_type" required type="radio" id="subscription_type" name="amount" value="<?=md5($subfee->mode)?>">
                                                            <label class="form-check-label fs-5" for="t4">
                                                            <b>Dhs. <?=$subfee->fee?></b>
                                                            </label>
                                                        </div>
                                                      </div>
													<?php endforeach; ?>																				 
                                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-12 ">
                                                        <div class="subs9">Fields marked <span class="subsredstar">*</span> are mandatory</div>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-12">
                                                        <div class="row grayback">
                                                            <div class="col-lg-3  col-md-3 col-6 subs10blu"> Subscription Mode* : </div>
                                                            <div class="col-lg-2  col-md-2 col-6 subs10black"> Yearly
                                                                <input type="radio" name="subscription_mode" value="yearly" checked=""></div>
                                                            <div class="col-lg-2  col-md-2 col-6 subs10blu"> Starting Date :</div>
                                                            <div class="col-lg-5  col-md-5 col-6">
                                                                <div class="row">
                                                                    <div class="col-lg-4  col-md-4 col-4">
                                                                        <div class="row">
                                                                            <select name="subs_1subscription_day">
                                                                                <option value="1">1
                                                                                </option>
                                                                                <option value="2">2
                                                                                </option>
                                                                                <option value="3">3
                                                                                </option>
                                                                                <option value="4">4
                                                                                </option>
                                                                                <option value="5">5
                                                                                </option>
                                                                                <option value="6">6
                                                                                </option>
                                                                                <option value="7">7
                                                                                </option>
                                                                                <option value="8">8
                                                                                </option>
                                                                                <option value="9" selected="">9
                                                                                </option>
                                                                                <option value="10">10
                                                                                </option>
                                                                                <option value="11">11
                                                                                </option>
                                                                                <option value="12">12
                                                                                </option>
                                                                                <option value="13">13
                                                                                </option>
                                                                                <option value="14">14
                                                                                </option>
                                                                                <option value="15">15
                                                                                </option>
                                                                                <option value="16">16
                                                                                </option>
                                                                                <option value="17">17
                                                                                </option>
                                                                                <option value="18">18
                                                                                </option>
                                                                                <option value="19">19
                                                                                </option>
                                                                                <option value="20">20
                                                                                </option>
                                                                                <option value="21">21
                                                                                </option>
                                                                                <option value="22">22
                                                                                </option>
                                                                                <option value="23">23
                                                                                </option>
                                                                                <option value="24">24
                                                                                </option>
                                                                                <option value="25">25
                                                                                </option>
                                                                                <option value="26">26
                                                                                </option>
                                                                                <option value="27">27
                                                                                </option>
                                                                                <option value="28">28
                                                                                </option>
                                                                                <option value="29">29
                                                                                </option>
                                                                                <option value="30">30
                                                                                </option>
                                                                                <option value="31">31
                                                                                </option>
                                                                            </select> </div>
                                                                    </div>
                                                                    <div class="col-lg-4  col-md-4 col-4">
                                                                    <div class="row"><select name="subs_1subscription_month">
                                                                                <option value="1">January
                                                                                </option>
                                                                                <option value="2">February
                                                                                </option>
                                                                                <option value="3">March
                                                                                </option>
                                                                                <option value="4">April
                                                                                </option>
                                                                                <option value="5">May
                                                                                </option>
                                                                                <option value="6" selected="">June
                                                                                </option>
                                                                                <option value="7">July
                                                                                </option>
                                                                                <option value="8">August
                                                                                </option>
                                                                                <option value="9">September
                                                                                </option>
                                                                                <option value="10">October
                                                                                </option>
                                                                                <option value="11">November
                                                                                </option>
                                                                                <option value="12">December
                                                                                </option>
                                                                            </select></div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-4">
                                                                        <div class="row"> <select name="subs_1subscription_year">
                                                                                <option value="2020">2020
                                                                                </option>
                                                                                <option value="2021" selected="">2021
                                                                                </option>
                                                                                <option value="2022">2022
                                                                                </option>
                                                                                <option value="2023">2023
                                                                                </option>
                                                                            </select></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
													<h2>Contact Information</h2>
													<div class="row">
														
                                                            <div class="col-lg-6  col-md-6">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-4">
                                                                                <label for="name" class="fs-5"> Name<span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-8 col-8">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 col-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="salutation" value="Mr.">
                                                                                            <label class="form-check-label fs-5" for="t2">
                                                                                                Mr.
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="salutation" value="Mrs.">
                                                                                            <label class="form-check-label fs-5" for="t2">
                                                                                                Mrs.
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-4">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="salutation" value="Ms.">
                                                                                            <label class="form-check-label fs-5" for="t2">
                                                                                                Ms.
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control rounded-0" aria-label="name" name="name" id="name" required>
                                                                <div class="form-notice name-notice"></div>
                                                            </div>
														<?php  if($type=='renew_subscription'): ?>
														  <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Subscription No<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="sub_no" name="sub_no" id="sub_no" required>
                                                                <div class="form-notice sub_no-notice"></div>
                                                            </div>
														<?php
														endif;
														if($type!='renew_subscription'): ?>														
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Emirates<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Emirates" name="emirates" id="emirates" required>
                                                                <div class="form-notice emirates-notice"></div>
                                                            </div>
                                                
                     									<?php  if($type=='new_subscription'): ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Nationality<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Nationality" name="nationality" id="nationality" required="">
                                                                <div class="form-notice nationality-notice"></div>
                                                            </div>
														<?php endif; ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Area<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Area" name="area" id="area" required="">
                                                                <div class="form-notice area-notice"></div>
                                                            </div>
                                              
                                         
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">P.O.Box No<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="PO-Box-no" name="po-box-no" id="po-box-no" required="">
                                                                <div class="form-notice po-box-no-notice"></div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Road<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Road" name="road" id="road" required="">
                                                                <div class="form-notice road-notice"></div>
                                                            </div>
                                              			<?php endif; ?>
                                                 
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Telephone (O)<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="Telephone-office" name="telephone-office" id="telephone-office" required="">
                                                                <div class="form-notice telephone-office-notice"></div>
                                                            </div>
														<?php  if($type!='renew_subscription'): ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Building<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Building" name="building" id="building" required="">
                                                                <div class="form-notice building-notice"></div>
                                                            </div>
                                                 		<?php endif; ?>
                                             
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Telephone (R)<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="Telephone-res" name="Telephone-res" id="Telephone-res" required="">
                                                                <div class="form-notice Telephone-res-notice"></div>
                                                            </div>
															<?php  if($type!='renew_subscription'): ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Landmark<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Landmark" name="landmark" id="landmark" required="">
                                                                <div class="form-notice landmark-notice"></div>
                                                            </div>
                                           
                                                 		<?php endif; ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Mobile<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="Mobile" name="mobile" id="mobile" required="">
                                                                <div class="form-notice mobile-notice"></div>
                                                            </div>
															<?php  if($type!='renew_subscription'): ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Floor<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="Floor" name="floor" id="floor" required="">
                                                                <div class="form-notice floor-notice"></div>
                                                            </div>
                                                		<?php endif; ?>
                                                   
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Email Address<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control rounded-0" aria-label="Email Address" name="email-address" id="email-address" required>
                                                                <div class="form-notice email-address-notice"></div>
                                                            </div>
														<?php  if($type!='renew_subscription'): ?>
                                                            <div class="col-lg-6 col-md-6">
                                                                <label for="fname" class="fs-5">Flat No<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control rounded-0" aria-label="Flat Number" name="flat-number" id="flat-number" required="">
                                                                <div class="form-notice flat-number-notice"></div>
                                                            </div>
                                            
                                           				<?php endif; ?>
														
                                                            <div class="col-lg-12">
                                                     	<?php  if($type=='new_subscription'): ?>
                                                                <h2>For new subscribers only <span class="text-danger">*</span></h2>
                                                                How did you get to know about KT?
                                                                <div class="row for-new-subscribers-check-box">
                                                                    <div class="col-lg-6 col-md-6 col-6">
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Internet" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Internet
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Newspaper" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Newspaper
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Outdoor" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Outdoor
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="TV" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        TV
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Sales Executive" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Sales Executive
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Radio" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Radio
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Friend">
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Friend
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Colleague" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Colleague
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Sampling" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Sampling
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="Flyer" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Flyer
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 mt-2" type="radio" id="t2" name="reference" value="SMS" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        SMS
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-5">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input rounded-0 otherstype" type="radio" id="t2" name="reference" value="" required>
                                                                                    <label class="form-check-label fs-5" for="t2">
                                                                                        Others, please specify
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="col-lg-6 col-12">
                                                        
                                                                            <div class="col-lg-8 col-md-8 col-12">
                                                                                <input type="text" class="form-control rounded-0 others" aria-label="Others" name="other" id="others" required="">
                                                                                <div class="form-notice otherss-notice"></div>
                                                                            </div>
                                                                  


                                                                    </div>
                                                                </div>
																 <?php endif; ?>
                                                            </div>
                                                    
                                               
                                                            <div class="col">
                                                                <button type="submit" id="registerform" class="btn mb-2 border-0 btn-lg rounded-0 btn-submit-form" novalidate="novalidate">Submit</button>
                                                            </div>
                                              


                                                </div>
                                               



                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Ad Unit -->
                            <div class="ad-unit tower-ad-unit">
                                <img src="<?php echo base_url() ?>public/images/half-page.jpg" alt="" />
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