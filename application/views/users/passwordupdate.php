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
            <div class="page-content">
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Security Settings<small> Settings can be done here</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <h3 class="form-section">Change Your Password</h3>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-group">													
                                    <div class="col-md-12">
                                        <p><span class="trips-bold">Tips:</span> Use at least 8 characters. Don't re-use passwords from other websites or include obvious words like your name or email.</p>
                                    </div>
                                    <hr>

                                    <?php
                                    $attributes = array('class' => 'form-horizontal');
                                    echo form_open('users/password-update', $attributes);
                                    ?>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
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
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Old Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="oldpassword" required class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="password" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Repeat New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="rpassword" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <div class="clearfix"></div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->