<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Change your Profile Picture <small>browse and upload new picture</small></h1>
                    </div>
                    <!-- END PAGE TITLE -->
                    <!-- BEGIN PAGE TOOLBAR -->
                    <!-- END PAGE HEAD -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                             <div class="alert_msg alert alert-danger" style="display:none">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong>Sorry! </strong> &nbsp;Your image can't be processed,Image size can not be greater then 600*600 px.
                                </div>
                                <div class="caption">
                                    <h3 class="form-section">Upload a Picture</h3>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <?php
                                $attributes = array('class' => 'form-horizontal');
                                echo form_open_multipart('users/avatar', $attributes);
                                ?>
                                <div class="form-body">
                                    <?php if (validation_errors()) : ?>
                                        <div class="alert alert-danger">
                                            <button class="close" data-close="alert"></button>
                                            <span>
                                                <?= validation_errors() ?> </span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($error)) : ?>
                                            <div class="alert alert-danger">
                                                <button class="close" data-close="alert"></button>
                                                <span>
                                                    <?= $error ?> </span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($success)) : ?>
                                                <div class="alert alert-success">
                                                    <button class="close" data-close="alert"></button>
                                                    <span>
                                                        <?= $success; ?> </span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group">                                                      
                                                    <!-- Start Column Md -->
                                                    <div class="col-md-3 align-center">
                                                    <div class="" id="image_preview">
                                                        <span class="img-circle" ></span>
                                                        <div class="outer_img">
                                                        <?php if(file_exists(FCPATH.$profile_medium_thumbnail)){ ?>
                                                        <img id="previewing" class="img-circle first_preview" width="150px" height="150px" src="<?= base_url() . $profile_medium_thumbnail; ?>">
                                                        <?php } elseif(file_exists(FCPATH.$profile_picture)){ ?>
                                                        <img id="previewing" class="img-circle first_preview"  width="150px" height="150px" src="<?= base_url() . $profile_picture; ?>">
                                                        <?php } else{ ?>
                                                        <img id="previewing" class="img-circle first_preview" width="150px" height="150px" src="<?= base_url()?>assets/media/users_avatar/default.png">
                                                        <?php } ?>
                                                    </div></div>
                                                    <div  class="imageP">
                                                   </div>
                                                   </div>
                                                    <input type="text" class="data form-control" name="image_info" style="display:none">
                                                    <!-- End Column Md -->
                                                    <!-- Start Column Md -->
                                                    <div class="col-md-8">
                                                        <h4>Clear frontal face photos are an important way for hosts and guests to learn about each other. It's not much fun to host a landscape! Please upload a photo that clearly shows your face.</h4>
                                                        <hr>
                                                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                        <div class="row fileupload-buttonbar">
                                                            <div id="plugin" class="cropbox">
                                                                <div class="workarea-cropbox">
                                                                    <div class="bg-cropbox">
                                                                        <img class="image-cropbox">
                                                                        <div class="membrane-cropbox"></div>
                                                                    </div>
                                                                    <div class="frame-cropbox">
                                                                        <div class="resize-cropbox"></div>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                                <span class="btn green fileinput-button">
                                                                    <i class="fa fa-plus"></i>
                                                                    <span>
                                                                        Browse Picture... </span>
                                                                        <input type="file" required="" id="file" name="userfile">
                                                                    </span>
                                                                    <button type="submit" class="btn btn-default start">
                                                                        <i class="fa fa-upload"></i>
                                                                        <span>
                                                                            Upload & Save </span>
                                                                        </button>
                                                                        <button type="button" class="btn green btn-crop" style="display:none">
                                                                            <i class="glyphicon glyphicon-scissors"></i>
                                                                            <span>
                                                                                Crop </span>
                                                                            </button>
                                                                            <!-- The global file processing state -->
                                                                            <span class="fileupload-process">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Column Md -->
                                                                    <div class="col-md-1"></div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>
                                            <!-- END VALIDATION STATES-->
                                        </div>
                                    </div>
                                </div>
                                <!-- END CONTAINER -->
                            </div>