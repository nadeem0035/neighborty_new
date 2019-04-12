<?php defined('BASEPATH') OR exit('No direct script access allowed'); //pre($_SESSION); ?>
   <?php $this->load->view('templates/header'); ?>
    <style>
        .form-horizontal .form-group
        {
            margin: 5px 0 !important;
        }
        .space10
        {
            margin: 15px 0 !important;
        }
        .text-left input
        {
            text-align: left !important;
        }

        #editListing label.control-label {
            font-size: 13px;
            font-weight: 500;
            text-align: right;
            padding-top: 6px;
        }

        #editListing .form-control {
            height: 30px;
            font-size: 13px;
        }
    </style>
    <body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<section id="section-body">
        <div class="container">

            <div class="user-dashboard-full">
                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
                <div class="profile-area-content">

                    <?php// $this->load->view('listings/steps_header'); ?>
                    <div class="profile-top text-center">
                        <h1 class="page-title no-padding no-margin"><?= $this->lang->line('al_edit_new_listing'); ?></h1>
                    </div>



                    <div class="membership-content-area">
                        <?=isset($msg) ? $msg : '';?>
                        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/select2.min.css" />
                        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/intlTelInput.css" />
                        <style>
                            .price_text{
                                font-size:13px; font-weight:500; margin-bottom:0; padding:0 10px;
                                margin-top:5px;
                                background:rgba(0,0,0,.05);
                                border-radius:4px;
                            }
                            .price_text .add_new_price{
                                width:100%;
                                border-top: rgba(0, 0, 0, 0.15) dashed 1px;
                            }

                            .dz-preview .dz-image img {
                                display: block;
                                height: 120px !important;
                            }
                        </style>
                        <?php if( $this->session->flashdata('listError') )
                        { ?>
                            <div class="alert alert-danger">
                                <?php  echo $this->session->flashdata('listError'); ?>
                            </div>
                        <?php  } ?>
                        <form id="editListing" method="post">
                            <input type="hidden" name="id" value="<?= @$listing->id; ?>">
                            <input type="hidden" id="listing_id" value="<?= @$listing->id; ?>">
                            <input type="hidden" id="property_loc" name="property_loc" value="<?= @$listing->property_location; ?>">

                            <div class="account-block">
                                <div class="add-tab-content">
                                    <div class="add-tab-row push-padding-bottom">

                                        <h5 class="title_form"><?=$this->lang->line('my_properties');?></h5>

                                        <div class="row no-gutter">
                                            <?php $this->load->view('properties/edit_amenities_btns');?>
                                            <?php $this->load->view('properties/edit_locations');?>
                                        </div>
                                    </div>

                                    <?php $this->load->view('properties/edit_description');?>
                                    <?php $this->load->view('properties/edit_dropzone');?>

                                </div>
                            </div>

                            <div id="addAmenities" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            <h4 class="modal-title"><?=$this->lang->line('select_amenities');?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div id="amenities_box"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <div class="account-block text-right" style="margin-top:20px;">
                                <button type="submit" class="btn btn-primary edit_property">Update Property</button>
                            </div>

                        </form>

                    </div>


                </div>
            </div>

    </section>
<?php $this->load->view('templates/dashboard_footer'); ?>
<?php
//$footer_data = isset($footer_data) ? $footer_data : '';
//$this->load->view('templates/dashboard_footer', $footer_data);
?>