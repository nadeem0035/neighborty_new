<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
  <!-- BEGIN HEADER -->
  <?php $this->load->view('dashboard/dashboard-header'); ?>
  <!-- END HEADER -->
  <div class="clearfix"></div>
  <!-- BEGIN CONTENT -->
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
    <!-- END SIDEBAR -->
    <div class="page-content-wrapper">
      <div class="page-content" style="min-height:634px">           
        <div class="row">
          <div class="col-md-12">
           <!-- BEGIN VALIDATION STATES-->
           <div class="portlet light bordered">
            <div class="portlet-title">
             <div class="caption">
              <h3 class="form-section">  <?php
                $session_data = $this->session->userdata('logged_in');
                $uid = $session_data['id'];
                echo ucwords($session_data['full_name']).'\'s';
                ?> 
                Wishlists 
                  <button class="btn btn-default"  data-toggle="modal" href="#newWishlist" type="button">Create New Wishlist</button>
                </h3>
               <!--  <span>Wishlists:<?=count($wishlists);?></span> -->
              </div>
                 <div class="row" style="clear:both">
                 <div class="col-md-10 col-sm-10 col xl-10">
                     <div id="display_notices"></div>
                  </div>
                 </div>
            </div>
            <div class="portlet-body form" id="listings">
              <div class="row">
              <?php if(!empty($wishlists)) { ?>
                <?php foreach($wishlists as $lists):?>                                              
                  <div class="col-md-3 col-sm-4 col-xs-6" id="wishlists_category_<?=$lists->categoryid;?>" style=" ">
                    <div class="listing-image-box">
                      <?php if($lists->preview_image_url==''){ ?>
                      <img class="img-circle host-pic " width="225" height="125"  src="<?=base_url()?>assets/img/placeholder.png">
                      <?php }else{ ?>
                      <img class="img-circle host-pic" width="225" height="125" src="<?=base_url()?>assets/media/listings/listings/<?=$lists->preview_image_url;?>">
                      <?php } ?>
                      <div class="edit">
                         <a href="javascript:;" id="<?=$lists->categoryid;?>" onclick="deleteWishlistCategory(this.id)">
                             <i class="fa fa-times fa-lg"></i>
                          </a>
                      </div>
                      <a href="<?= site_url("user-wishlist"); ?>/<?=$lists->categoryid;?>">
                        <div class="listing-img-heading">
                          <h2 class="listing-img-subheading"><?=$lists->name;?> <br /></h2>
                        </div> 
                      </a>
                    </div>
                  </div>
                <?php endforeach;?>
                <?php  } else{ ?>
                     <h4> No Wishlist Found</h4>
                <?php } ?>
                <!-- Start Column Md -->
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END VALIDATION STATES-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add New Wishlist Modal -->
<div id="newWishlist" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
     <h4 class="modal-title">Create New Wishlist</h4>
   </div> 
   <form name="newWishList" id="newWishList">
     <div class="modal-body">
       <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
         <div class="row">
           <div class="col-md-12">
            <h4>Wishlist Name</h4>
            <p>
             <input type="text" id="name" name="name" class="col-md-12 form-control">
           </p>
           <p>&nbsp;</p>
           <h4>Who can see this ?</h4>
           <p>
            <select class="form-control" id="visibility" name="visibility">
              <option selected="" value="all">Public</option>
              <option value="me">Only Me</option>
            </select>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" onclick="addNewCategory()" class="btn btn-default">Save changes</button>
    <button type="button" data-dismiss="modal" class="btn default">Close</button>
  </div>
</form>
</div>
</div>
</div>
<!-- Add New Wishlist Modal -->   
</div>
    <!-- END CONTAINER -->