<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<section id="section-body">

    <div class="container">


        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div class="profile-top-left">
                        <h2 class="title">
                            <?php
                            $session_data = $this->session->userdata('logged_in');
                            $uid = $session_data['id'];
                            echo ucwords($session_data['full_name']).'\'s';
                            ?> <?=$this->lang->line('wish_list');?>
                        </h2>
                    </div>
                    <div class="profile-top-right">
                        <div class="my-property-search text-right">
                            <button class="btn btn-secondary" data-toggle="modal" href="#newWishlist" type="button"><?=$this->lang->line('new_wishlist');?></button>
                        </div>
                    </div>
                </div>
                <div class="account-block">
                    <div id="display_notices"></div>
                    <div class="property-listing list-view" id="listings">
                        <div class="row">
                            <?php
                            if(!empty($wishlists) )
                            {
                                foreach($wishlists as $lists):
                                    ?>
                                    <div class="col-sm-4 col-xs-12" id="wishlists_category_<?=$lists->categoryid;?>">
                                        <div class="property-item location-block" style="height:auto;">
                                            <figure>
                                                <a href="<?= site_url("user-wishlist"); ?>/<?=$lists->categoryid;?>" class="">
                                                    <figcaption class="location-fig-caption">
                                                        <h3 class="heading"><?=$lists->name;?></h3>
                                                        <!--<p class="sub-heading">30 Properties</p>-->
                                                    </figcaption>
                                                    <?php if($lists->preview_image_url==''){ ?>
                                                        <img class="" src="<?=base_url()?>assets/img/placeholder.png" alt="thumb">
                                                    <?php }else{ ?>
                                                        <img class="" src="<?=base_url()?>assets/media/properties/thumbs/<?=$lists->preview_image_url;?>" alt="thumb">
                                                    <?php } ?>
                                                </a>

                                            </figure>
                                        </div>
                                    </div>

                                <?php endforeach;?>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                    <div class="article-detail text-center"><h1><?=$this->lang->line('your_wishlist_not');?></h1><p><?=$this->lang->line('add_your_wishlist');?> <a href="<?= site_url('buy') ?>">Search Properties</a></p></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

</section>


<!--<a href="javascript:;" id="<?/*=$lists->categoryid;*/?>" onclick="deleteWishlistCategory(this.id)"><i class="fa fa-times fa-lg"></i></a>-->


<div id="newWishlist" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title"><?=$this->lang->line('new_wishlist');?></h4>
            </div>
            <form name="newWishList" id="newWishList">
                <div class="modal-body">
                    <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
                        <div class="form-group">
                            <label><?=$this->lang->line('name_wishlist');?></label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?=$this->lang->line('who_can_see');?></label>
                            <select class="form-control" id="visibility" name="visibility">
                                <option selected="" value="all">Public</option>
                                <option value="me">Private</option>
                                <option value="">Only</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="addNewCategory()" class="btn btn-secondary"><?=$this->lang->line('save_list');?></button>
                    <button type="button" data-dismiss="modal" class="btn default"><?=$this->lang->line('to_close');?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add New Wishlist Modal -->
