<?php
$this->load->view('includes/header');
?>
        <main>
            <div class="single">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-12 article-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--<div class="post-header">
                                <h1 class="post-title ">Subscribe to KT </h1>
                            </div>-->
                                    <div class="row">
                                        <div class="col-lg-6 subs_newsletter_pan_nf-main">
                                            <div class="subs_newsletter_pan_nf">
                                                <form name="myform" id="form_id" method="post" onsubmit="return MainFunction();">
                                                    <h1 class="subs_newsletter_head">Subscribe to our newsletters</h1>
                                                    <p class="subs_newsletter_para">Get the latest news from the UAE and
                                                        the world in your inbox.</p>
                                                    <input type="email" id="email" name="email" class="subscribe_email_nf" placeholder="Enter Your Email Id...">
                                                    <input type="checkbox" name="checkbox" value="check">
                                                    <a href="/privacy-policy" target="_blank" class="agree_txt_subs">Accept Terms &amp; Conditions</a><br>
                                                    <input type="submit" value="Subscribe Now" class="btn-black margin_tp_25" data-loading-text="Loading..." style="display: none;">
                                                </form><button class="ins-submit-button-c158">Subscribe Now</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 subs_newsletter_pan_nf-main2">
                                            <div class="subs_print_pan_nf">
                                                <a href="<?php echo base_url("home/subscription"); ?>" target="_blank">
                                                    <span class="linkspanner"></span>
                                                    <h1 class="subs_newsletter_head max_width_53_per">subscribe to The
                                                        Print Edition</h1>
                                                    <input type="submit" value="Subscribe Now" class="btn-black margin_tp_25" data-loading-text="Loading...">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-3 col-md-6 subs_middle_pan_nf">
                                                <div class="epaper_pan_nf epaper_bg_nf">
                                                    <a href="https://epaper.khaleejtimes.com/" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/kt-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_23 text_center">Subscribe to <br>
                                                            Our e-paper</h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 subs_middle_pan_nf">
                                                <div class="epaper_pan_nf android_bg_nf">
                                                    <a href="https://play.google.com/store/apps/details?id=com.khaleejtimes&amp;hl=en" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/andriod-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_23 text_center">Download Our Mobile App</h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 subs_middle_pan_nf">
                                                <div class="epaper_pan_nf ios_bg_nf">
                                                    <a href="https://apps.apple.com/ae/app/khaleej-times/id909275381" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/ios-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_23 text_center">Download Our Mobile App</h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6  subs_middle_pan_nf">
                                                <div class="epaper_pan_nf huaw_bg_nf">
                                                    <a href="https://appgallery5.huawei.com/#/app/C101150783" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/huawei-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_23 text_center">Download Our Mobile App</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-3 col-md-6 subs_middle_pan_nf">
                                                <div class="epaper_pan_nf fb_bg_nf">
                                                    <a href="https://www.facebook.com/khaleejtimes" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/fb-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_33 text_center">Like us on <br>
                                                            Facebook</h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6  subs_middle_pan_nf">
                                                <div class="epaper_pan_nf twitter_bg_nf">
                                                    <a href="https://twitter.com/khaleejtimes" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/tw-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_33 text_center">Follow us <br>
                                                            on Twitter
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6  subs_middle_pan_nf">
                                                <div class="epaper_pan_nf youtube_bg_nf">
                                                    <a href="https://www.youtube.com/khaleejtimes" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/youtube-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_12 text_center">Subscribe to <br>
                                                            Our YouTube Feed
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6  subs_middle_pan_nf">
                                                <div class="epaper_pan_nf insta_bg_nf">
                                                    <a href="https://www.instagram.com/khaleejtimes/" target="_blank">
                                                        <span class="linkspanner"></span>
                                                        <div class="epaper_icon_pan">
                                                            <div class="epaper_icon_nf">
                                                                <img src="<?php echo base_url(); ?>public/images/subs/insta-icon-nf.png">
                                                            </div>
                                                        </div>
                                                        <h2 class="subs_newsletter_head margin_tp_33 text_center">Follow Us <br>
                                                            on Instagram
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-3">

            
                    <div class="ad-unit tower-ad-unit">
                        <img src="images/half-page.jpg" alt="" />
                    </div>
        

                    

                </div>-->
                    </div>
                </div>
            </div>
        </main>
       <?php $this->load->view('includes/footer'); ?>