<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
    <?php $this->load->view('templates/preloader'); ?>
    <div id="wrap">
        <?php $this->load->view('templates/' . $topmenu); ?>     
        <section class="sub-banner">
            <div class="bg-parallax bg-6 par-fit-size"></div>
        </section>
        <div class="main">
            <div class="title-wrap">
                <section class="destinations destination-form">
                    <?php $this->load->view('templates/sub_searchform'); ?>
                </section>
                <section class="blog-content" id="topgallery-area">
                    <div class="row">
                        <div class="col-md-11 col-md-offset-1">
                            <div class="post post-single custom-one-margin">
                                <div>
                                    <a href="javascript:ScrollMe('overview-area')">
                                        <div class="col-md-1 overview-area">Overview</div>
                                    </a>
                                    <a href="javascript:ScrollMe('amenties-area')">
                                        <div class="col-md-1 amenties-area">Amenities</div>
                                    </a>
                                    <a href="javascript:ScrollMe('maps-area')">
                                        <div class="col-md-1 maps-area">Locations</div>
                                    </a>
                                    <a href="javascript:ScrollMe('rates-area')">
                                        <div class="col-md-1 longMenuItem rates-area">Availability</div>
                                    </a>
                                    <a href="javascript:ScrollMe('reviews-area')">
                                        <div class="col-md-1 reviews-area">Reviews</div>
                                    </a>
                                    <a href="javascript:ScrollMe('belowgallery-area')">
                                        <div class="col-md-1 reviews-area">Gallery</div>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row booking-detail-sidebar data-sticky_column data-sticky_parent">
                    <!-- Left Panel starts --> 
                    <div class="col-md-8"> 
                        <section class="blog-content" id="belowgallery-area">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post post-single ">
                                        <h1 class="post title-post-head"><?= ucwords($listing->listing_name) ?></h1>
                                        <div class="start-address col-xs-8">
                                            <address class="address address-custom-style"><?= $listing->typed_address; ?></address>
                                        </div>
                                        <div class="col-xs-4">
                                            <div><div class="star-ratings-sprite"><span style="width:<?= $reviews['rating'] ?>%" class="rating"></span></div>
                              <span class="package-rating star-no-color"></span><ins class="package-rating-mini-customs"><?php if($reviews['total'] > 0 ) { echo $reviews['total']." - Reviews"; } else { echo "No Reviews"; }?></ins> 
                              
                              </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Gallery Section Starts -->
                            <?php if (isset($pictures)) { ?>
                                <div class="pikachoose-whiteout">
                                    <ul id="pikame">
                                        <?php
                                        foreach ($pictures as $pic) {
                                            ?>     
                                            <li><a  rel="gallery1" class="fancybox" href="<?= base_url() ?>assets/media/listings/<?= $pic->picture ?>"><img src="<?= base_url() ?>assets/media/listings/listings/<?= $pic->picture ?>"/></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- Gallery Section Ends -->  
                            <?php } else { ?>
                                <div >
                                    <ul >
                                        <li><a href="#"><img src="<?= base_url() ?>assets/media/listings/listings/<?= $listing->preview_image_url ?>"/></a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div class="clearfix"></div>                             
                            <section class="team">
                                <div class="team-group row">
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_Apparment.png" alt="">
                                        </figure>
                                        <h3><?= $listing->home_type ?></h3>
                                    </div>
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_House.png" alt="">
                                        </figure>
                                        <h3><?= $listing->room_type ?></h3>
                                    </div>
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_People.png" alt="">
                                        </figure>
                                        <h3><?= $listing->accommodates ?> People</h3>
                                    </div>
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_Bedroom.png" alt="">
                                        </figure>
                                        <h3><?= $listing->bedrooms ?> Bedroom</h3>
                                    </div>
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_Bed.png" alt="">
                                        </figure>
                                        <h3><?= $listing->beds ?> Beds</h3>
                                    </div>
                                    <div class="team-item col-xs-2 col-md-2">
                                        <figure><img src="<?= base_url() ?>assets/img/icn_Bathroom.png" alt="">
                                        </figure>
                                        <h3><?= $listing->bathrooms ?> Bathroom</h3>
                                    </div>
                                </div>
                            </section>
                            <!-- Overview Section Ends -->
                        </section>
                        
                        <section id="overview-area" class="blog-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post post-single">
                                        <h1 class="title-post-head">Overview</h1>
                                        <div class="post-content"><p><? echo $listing->summary;?></p></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php if (isset($amenities)) { ?>
                            
                            <section id="amenties-area" class="blog-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="post post-single">
                                            <h1 class="title-post-head">Amenities</h1>
                                            <div class="post-content">

                                                <ul class="filter">
                                                    <?php
                                                    foreach ($amenities as $aminity) {
                                                        ?>
                                                        <li class="tbc-lists"><img src="<?= base_url() ?>assets/img/icon-tick.png"> <span class="tbc-lists-inner"><?= $aminity->name ?></span></li>
                                                    <?php } ?>
                                                </ul>

                                                <p>&nbsp;</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php } ?>
                        
                        <section id="maps-area" class="blog-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post post-single custom-one-margin">
                                        <h1 class="title-post-head">Location</h1>
                                        <div class="post-content">

                                            <div class="maps-csettings">
                                                <div id="map"></div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <section id="rates-area" class="blog-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post post-single custom-two-margin">
                                        <h1 class="title-post-head">Rates &amp; Availability</h1>
                                        <div id="frontend"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        
                        <section id="reviews-area" class="blog-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post post-single custom-one-margin">
                                        <h1 class="title-post-head">Reviews</h1>
                                        <div class="post-content">
                                         
                                            <div class="col-md-10 totalreview">
                                                <div class="col-md-3">
                                                    <h2 class="custom-msg-rating"><?= $reviews['total'] ?> Reviews</h2>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= $reviews['rating'] ?>%" class="rating"></span></div>
                                                    </div>   </div>
                                            </div>
                                            <?php if($reviews['total']>0){ ?>
                                            <div class="col-md-12 reviewsection">
                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Accuracy</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->acc*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Communication</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->comm*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-12 reviewsection">
                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Cleanliness</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->cle*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Location</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->loc*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-md-12 reviewsection">

                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Check-in</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->che*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-5">
                                                        <label>Value</label>
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="feedback-str">
                                                            <div class="star-ratings-sprite"><span style="width:<?= $detail_review->val*20 ?>%" class="rating"></span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
											<?php } ?>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                          <?php
										  
										  if (isset($reviews_all)) {  
                                                    foreach ($reviews_all as $review) { 
													 //print_r($review);
													?>
                                                        
                                                    <div class="col-xs-6" id="review-section-mobile">
                                                        <div class="col-xs-4 col-md-pull-1">
                                                            <img class="img-circle " src="<?= base_url() . $users_avatar . "medium/" . $review->picture; ?>">
                                                            <small class="below-img-text"><?=$review->first_name." ".$review->last_name?> <br /> Stayed: <?=date("M Y",strtotime($review->date_time))?> </small>

                                                        </div>
                                                        <div class="col-xs-8 col-md-pull-1">
                                                            <div class="subreview-title"><?=$review->title?></div>
                                                            <div class="star-ratings-sprite"><span style="width:<?= (($review->accuracy+$review->communication+$review->cleanliness+$review->location+$review->check_in+$review->value)/6)*20 ?>%" class="rating"></span></div>
                                                            <div class="clearfix"></div>
                                                            <p><?=$review->review?></p>
                                                        </div>
                                                    </div>
                                                    <?php 
												} 
											} 
											
											?>
                                            
                                            <div class="clearfix"></div>
                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div> <!-- End Left Panel -->
                    <!-- Right Panel Starts -->
                    <div class="col-md-4 data-sticky_column">
                    <div id="bookingRightFixed">
                    
                        <h1><?= PkrFormat($listing->price);?></h1>
                        <span class="price-note">average price per night</span>
                        <hr class="tbc-line" align="left" width="10%">
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger" style="width: 75%">
                                <button class="close" data-close="alert"></button>
                                <span><?= $this->session->flashdata('error') ?> </span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $lid = $listing->id;
                        $attributes = array('class' => 'tbc-for', 'id' => 'DOPBCPCalendar-form' . $lid, 'name' => 'DOPBCPCalendar-form' . $lid);
                        echo form_open('booking/confirm-booking', $attributes);
                        ?>

                        <table class="dopbcp-sidebar-content">
                            <colgroup>
                                <col class="dopbcp-column1">
                                <col class="dopbcp-column-separator-style dopbcp-column2">
                                <col class="dopbcp-column3">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="dopbcp-column1">
                                        <table class="dopbcp-sidebar-content">
                                            <colgroup>
                                                <col class="dopbcp-column4"> 
                                                <col class="dopbcp-column-separator-style dopbcp-column5">
                                                <col class="dopbcp-column6">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td id="DOPBCPCalendar-sidebar-column-wrapper-1-<?= $lid ?>" class="dopbcp-column4">
                                                        <div class="dopbcp-row1"></div>
                                                        <div class="form-field field-input field-select col-md-1 guestWrapper">
                                                            <label class="home-labels tbc-barlabels">Guests</label>
                                                            <div>
                                                                <input type="number" class="field-input guestElem" id="no_of_guests" min="1" max="<?= $listing->accommodates; ?>" value="1" required name="totalguests">
                                                            </div>
                                                        </div>         
                                                        <div class="DOPBCPCalendar-clear"></div>
                                                        <div class="dopbcp-row2"></div>
                                                        <div class="dopbcp-row3"></div>
                                                        <div class="dopbcp-row4 checkin-field-tbc"></div>
                                                        <div class="DOPBCPCalendar-info-message dopbcp-error" id="DOPBCPCalendar-info-message<?= $lid ?>"> 
                                                            <div class="dopbcp-text alert alert-danger"></div>
                                                        </div>
                                                        <div class="dopbcp-row5"></div>
                                                        <div class="dopbcp-row6"></div>
                                                        <div class="dopbcp-row7"></div>
                                                    </td>                             
                                                    <td class="dopbcp-column-separator dopbcp-column5"></td>
                                                    <td id="DOPBCPCalendar-sidebar-column-wrapper-2-<?= $lid ?>" class="dopbcp-column6">
                                                        <div class="dopbcp-row1"></div>
                                                        <div class="dopbcp-row2"></div>
                                                        <div class="dopbcp-row3"></div>
                                                        <div class="dopbcp-row4"></div>
                                                        <div class="dopbcp-row5"></div>
                                                        <div class="dopbcp-row6"></div>
                                                        <div class="dopbcp-row7"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="dopbcp-column-separator dopbcp-column2"></td>
                                    <td class="dopbcp-column3">
                                        <table class="dopbcp-sidebar-content level2">
                                            <colgroup>
                                                <col class="dopbcp-column7">
                                                <col class="dopbcp-column-separator-style dopbcp-column8">
                                                <col class="dopbcp-column9">
                                            </colgroup> 
                                            <tbody>
                                                <tr>
                                                    <td id="DOPBCPCalendar-sidebar-column-wrapper-3-<?= $lid ?>" class="dopbcp-column7">
                                                        <div class="dopbcp-row1"></div>
                                                        <div class="dopbcp-row2"></div>
                                                        <div class="dopbcp-row3"></div>
                                                        <div class="dopbcp-row4"></div>
                                                        <div class="dopbcp-row5"></div> 
                                                        <div class="dopbcp-row6"></div>
                                                        <div class="dopbcp-row7"></div> 
                                                    </td>                             
                                                    <td class="dopbcp-column-separator dopbcp-column8"></td>
                                                    <td id="DOPBCPCalendar-sidebar-column-wrapper-4-<?= $lid ?>" class="dopbcp-column9">
                                                        <div class="dopbcp-row1"></div>
                                                        <div class="dopbcp-row2"></div> 
                                                        <div class="dopbcp-row3"></div>
                                                        <div class="dopbcp-row4"></div> 
                                                        <div class="dopbcp-row5"></div> 
                                                        <div class="dopbcp-row6"></div>
                                                        <div class="dopbcp-row7"></div>
                                                    </td>                         
                                                </tr>                     
                                            </tbody>                 
                                        </table>             
                                    </td>         
                                </tr>     
                            </tbody>
                            <tbody> 
                            </tbody>
                        </table>
                        <input type="hidden" name="slug" value="<?= $listing->slug; ?>" />
                        <input type="hidden" name="lid" value="<?= $listing->id; ?>" />
                         
                        <div class="clearfix"></div>
                        <!-- Form Ends -->
                        <div class="optional-list">
                            <?php if ($this->session->userdata('logged_in')) { ?>
                                <button type="submit" id="booknow"  class="awe-btn awe-btn-1 awe-btn-small book-now-tbc">Book Now</button>
                                <button type="button" class="awe-btn btn-danger awe-btn-small book-now-tbc" id="<?=$listing->id?>" onClick="loadWishtlistModel(this.id)" data-toggle="modal">Add to Wishlist</button>
                            <?php } else { ?>
                             <a href="<?= site_url("users/login_status/")?>" class="awe-btn awe-btn-1 awe-btn-small book-now-tbc">Book Now</a>
                                <a href="<?= site_url("users/login_status/")?>" class="awe-btn btn-danger awe-btn-small book-now-tbc">Add to Wishlist</a> 
                             <?php } ?>
                            <p><span>Response Rate</span> 100%</p>
                            <p><span>Response Time</span> a few hours</p>
                            
                            <?php if ($this->session->userdata('logged_in')) { ?>
                                <a class="awe-btn awe-btn-1 awe-btn-small book-now-tbc" data-toggle="modal" data-target="#myModal">Contact Host</a>
                            <?php } else { ?>
                                <a href="<?= site_url("users/login_status/")?>" class="awe-btn awe-btn-1 awe-btn-small book-now-tbc">Contact Host</a>
                            <?php } ?>

                        </div>
                        </form>
                     </div>
                   </div> 
                    <!-- Right Panel Ends -->
                </div> <!-- End Main Row -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content host-modal">
                <div class="modal-header host-modal-header">
                    <a data-dismiss="modal"><img class="pull-right" src="<?= base_url() ?>assets/img/close.png"></a>
                    <h4 class="modal-title">Contact Host</h4>
                </div>
                <div class="modal-body host-modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 host_img_section">
                                <img class="img-circle host-pic" src="<?= base_url() . users_avatar() . "small/" . $userdetail->picture; ?>">
                                <p class="host-message"><?= ucfirst($userdetail->first_name) . " " . $userdetail->last_name ?></p>
                                <hr>
                                <ul class="nav-sidebar-blog host-bullets">
                                    <li>Tell <?= $userdetail->first_name ?> a little about yourself</li>
                                    <li>What brings you here ?</li>
                                    <li>Who's joining you ?</li>
                                    <li>What do you love most about this listing?</li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <span class="host-body-title">when are you traveling?</span>
                                <div id="contact_response"></div>
                                <form class="tbc-margins-adjust" id="contacthostform">
                                    <div class="form-field field-input field-select col-md-4">
                                        <label class="home-labels host-labels-adjust">CHECK IN</label>
                                        <div class="host-contact-adjust">
                                            <input type="text" class="field-input customized-field" required placeholder="mm/dd/yyyy" name="checkin2" id="checkin2">
                                        </div>
                                    </div>
                                    <div class="form-field field-input field-select col-md-4">
                                        <label class="home-labels host-labels-adjust">CHECK OUT</label>
                                        <div class="host-contact-adjust">
                                            <input type="text" class="field-input customized-field" required placeholder="mm/dd/yyyy" name="checkout2" id="checkout2">
                                        </div>
                                    </div>
                                    <div class="form-field field-select col-md-4">
                                        <label class="home-labels host-labels-adjust">GUESTS</label>
                                        <input type="number" class="field-input custom-host-input" min="1" max="20" required name="noofguest">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-field form-field-host-area col-md-12">
                                        <label class="home-labels host-labels-adjust">DESCRIPTION</label>
                                        <textarea name="message" id="message" required class="field-input submit-host-textbar" placeholder="Write Your Thoughts"></textarea>
                                        <input type="hidden" name="receiver_id" value="<?= $listing->user_id ?>" />
                                        <input type="hidden" name="listing_id" value="<?= $listing->id ?>" />
                                        <div class="field-input host-submit">
                                            <button type="submit" id="contacthost" class="awe-btn awe-btn-1 awe-btn-medium">SUBMIT</button>
                                        </div>
                                    </div>   
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer host-modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->