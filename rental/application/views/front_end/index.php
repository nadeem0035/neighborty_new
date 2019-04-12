<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
   <?php $this->load->view('templates/preloader'); ?>
   <div id="wrap">
 	<?php  $this->load->view('templates/'.$topmenu); ?>
       <section class="banner">
         <div class="container">
            <div class="logo-banner text-center">
               <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-banner.png" alt="">
               </a>
            </div>
            <div class="banner-cn">
               <div class="tab-content">
                <h3 class="intro-heading safari-intro-custom">Luxury bookings for all your vacation needs. Cleaning to car rentals to tourism packages, it's all here.</h3>
                <?php $this->load->view('templates/home_searchform'); ?>
                <div class="tbc-space"></div>
                
            </div>
         </div>
      </div>
   </section>

  
   <?php if(isset($top_deals) && $top_deals != NULL ){ ?>
   <section class="sales tbc-sales-custom">
      <div class="container">
      		<div class="title-wrap">
                  <div class="container">
                     <div class="travel-title tbc-main-first-heading">
                        <h2 class="tbc-main-head-inner">TOP VACATION PACKAGE DEALS</h2>
                       <hr align="left" width="10%">
                     </div>
                  </div>
               </div>
            <div class="sales-cn">
               <div class="row">
                   <?php if(isset($top_deals) && $top_deals != NULL ){ ?>
                       <div class="grid">
                      <?php foreach ($top_deals as $top_deal){?>
                     <figure class="effect-goliath">
                        <img src="<?=$preview_img?>listings/<?=$top_deal->preview_image_url?>" alt="img23"/>
                        <figcaption data-href="<?=site_url('booking/detail/'.$top_deal->slug)?>">
                           <h2 class="grid-custom-headings"><?=$top_deal->city_town?>, <?=$top_deal->state_province?>
                               <span style="padding-left:10px; font-size:30px; font-weight:300;">
                                 <?=PkrFormat($top_deal->price)?>
                              </span>
                          </h2>
                        </figcaption>
                           <p><a href="<?=site_url('booking/detail/'.$top_deal->slug)?>" class="awe-btn awe-btn-1 awe-btn-small grid-custom-paragraph">Book Now</a>
                           <?php if ($this->session->userdata('logged_in')) { ?>
                             <a  class="awe-btn awe-btn-1 awe-btn-small grid-custom-wishlist" id="<?=$top_deal->id?>" onClick="loadWishtlistModel(this.id)" data-toggle="modal">Wishlist</a>
                          <?php } else{ ?>
                              <a  href="<?= site_url("users/login_status/")?>" class="awe-btn awe-btn-1 awe-btn-small grid-custom-wishlist"> Wishlist</a>
                              <?php } ?>

                           </p>
                     </figure>
                     <?php } ?> </div> <?php } else { echo '<h5 class="tbc-magazine-custom-subheading">No deals avaibale yet</h5>';} ?>  
               </div>

         <!-- Row 2 Begins -->
         <div class="row tbc-custom-space">
         </div>
         <!-- Row 2 Ends -->      
      </div>
   </div>
</section>
<?php } ?>
<section class="magazine tbc-magazine-custom">
   <div class="title-wrap">
      <div class="container">
         <div class="travel-title float-left">
            <h2 class="tbc-magazine-custom-heading">TOP TRAVEL INSPIRATION</h2>
            <hr align="left" width="10%">
            <h4 class="tbc-magazine-custom-subheading">Spark a new interest</h4>
            <p class="tbc-magazine-custom-paragraph">& travel to one of our favorite destinations</p>
         </div>
      </div>
   </div>
   <?php  if(isset($top_inspirations) && $top_inspirations != NULL){ ?>
   <div class="container">
      <div class="magazine-cn">
         <div class="row">
            <div class="col-lg-6">
               <div class="magazine-ds">
                  <div id="owl-magazine-ds">
                    <?php foreach ($top_inspirations as $top_ins){?>
                           <div class="magazine-item">
                           <img class="custom-one-margin" src="<?=$ins_img.$top_ins->large_img?>" alt="<?=$top_ins->location?>"/>
                               <div class="magazine-footer clearfix"></div>
                           </div>
                           <?php } ?>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="magazine-thum" id="magazine-thum">
                     <?php foreach ($top_inspirations as $top_ins){?>
                        <div class="thumnail-item active clearfix">
                           <figure class="float-left"><img src="<?=$ins_img.'thumbs/'.$top_ins->thumb_img?>" alt="">
                           </figure>
                           <div class="thumnail-text">
                              <h4 class="tbc-gallery-item-head"><?=$top_ins->location?></h4>
                              <label class="tbc-gallery-item-price"><?=$top_ins->country?></label>
                               <hr class="tbc-gallery-item-hr">
                               <p><a href="<?=site_url('search?location='.$top_ins->location.', '.$top_ins->country)?>" class="awe-btn awe-btn-1 awe-btn-small grid-custom-paragraph">View Listings</a>
                                  
                     </p>
                  </div>
               </div>
               <?php } ?>   
            </div>
         </div>
      </div>
   </div>
</div>
</section>
<?php }?>
<div class="destinations-cn">
   <div class="bg-parallax bg-2 testimonial-hp" style="background-position: 50% 16px;"></div>
   <div class="container">
      <div class="row">
      <div class="container" style="overflow: hidden;margin-left:-5%;>
         <div class="col-md-12">
            <div id="testimonials" style="margin-top:5%; height:auto; margin-bottom:10%">
               <div id="test_container">
                  <?php  if(isset($testimonials)){foreach ($testimonials as $testimonial){?>
                  <div class="testimonial">
                     <div class="testimonial_text testimonials_content"><?=$testimonial->message?></div>
                     <h3 class="testimonial_name">-<?=$testimonial->guest_name?> - <label class="testimonial_designation testimonials_desig"><?=$testimonial->guest_title?></label></h3>
                  </div>
                  <?php } } ?>
               </div>
            </div>
         </div>
         </div>
      </div>
   </div>
</div>
<section class="confidence-subscribe">
   <div class="bg-parallax tbc-subscribe-custom"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-9">
            <div class="user-form">
               <div class="row">
                  <h2 class="tbc-intouch">GET IN TOUCH</h2>
                  <hr align="left" width="10%">
                  <div class="col-md-5">
                     <form id="inquiry_form" name="inquiry_form" method="post" action="<?=site_url('contact')?>">
                        <h4 class="tbc-intouch-sub">Inquiries</h4>
                           <div class="field-input">
                              <input type="text" class="input-text" id="fullname" required data-errormessage-value-missing="Please Enter Fullname .. " name="fullname" placeholder="Full Name">
                           </div>
                           <div class="field-input">
                              <input type="email" class="input-text  " id="email" required data-errormessage-value-missing="Please Enter Email .. " data-errormessage-type-mismatch="Invalid Email!" name="email" placeholder="Email Address">
                           </div>
                           <div class="field-input">
                              <select  class="custom-intouch-select" id="reason_of_inq" required  data-errormessage-value-missing="Please Enter Reason .. " name="reason_of_inq">
                                 <option value="">Reason for Inquiry</option>
                                 <option value="Listing Space">Listing Space</option>
                                 <option value="Already Listed Space">Already Listed Space</option>
                                 <option value="Future Booking">Future Booking</option>
                                 <option value="Past Booking">Past Booking</option>
                                 <option value="Membership">Membership</option>
                                 <option value="Past Booking">Past Booking</option>
                                 <option value="Payment">Payment</option>
                              </select>
                           </div>
                           <div class="field-input">
                              <button class="awe-btn awe-btn-1 awe-btn-medium">Proceed to Full Inquiry Form</button>
                           </div>
                     </form>
                  </div>
                  <div class="col-md-7">
                     <h4 class="feed-insta" style="margin-bottom: 35px;">Instagram Feed</h4>
                     <div class="col-md-12" style="border:1px solid;">
                        <div id="scrollfeeds">
                           <?php 
                           $display_size = "thumbnail";                 
                           foreach ($instagram_feeds->data as $photo) {
                            $img = $photo->images->{$display_size};
                            echo "<img  id='{$photo->link}'onClick='navigateLink(this.id)' class='sizepost' src='{$img->url}' />";  
                         }
                         ?>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col-md-3" style="margin-top:1.8%">
         <div class="follow-us twent-margin">
            <h4 class="social-with-us">GET SOCIAL WITH US</h4>
            <div class="follow-group tbc-follow-links">
               <a href="" target="_blank" title=""><i class="fa fa-facebook"></i></a> 
               <a href=""  target="_blank" title=""><i class="fa fa-twitter"></i></a> 
               <a href=""  target="_blank" title=""><i class="fa fa-instagram"></i></a> 
               <a href=""  target="_blank" title=""><i class="fa fa-pinterest"></i></a>                                 
            </div>
         </div>
      </div>
   </section>
</div>
