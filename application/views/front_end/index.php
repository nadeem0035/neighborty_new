<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/select2.min.css" />
<body>
<div id="preloader">
    <div class="tb-cell">
        <div id="page-loading">
            <div></div>
            <p>Loading</p>
        </div>
    </div>
</div>

<section id="splash-section">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>

        <?php $this->load->view('includes/search/home'); ?>
    </div>
</section>
<!--end section top-->

<section id="section-body" class="mayraghar no-padding-b">
    <div class="houzez-module-main" style="background-color:#FFF;">
        <div class="houzez-module module-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <h2><?=$this->lang->line('choosing_us');?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="houzez-module">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <img src="<?=base_url()?>assets/img/icon_1.png" width="145px" height="145px">
                        <h3><?=$this->lang->line('countries');?></h3>
                        <p><?=$this->lang->line('countries_content');?></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <img src="<?=base_url()?>assets/img/icon_2.png" width="145px" height="145px">
                        <h3><?=$this->lang->line('rate_agents');?></h3>
                        <p><?=$this->lang->line('rate_agents_content');?></p>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <img src="<?=base_url()?>assets/img/icon_3.png" width="145px" height="145px">
                        <h3><?=$this->lang->line('rent_instantly');?></h3>
                        <p><?=$this->lang->line('rent_instantly_content');?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php $this->load->view('includes/premium_listings');?>

    <?php $this->load->view('includes/home_featured');?>
    <?php if(getDomain() == 'beta.zoney.pk'):?>
        <?php //$this->load->view('includes/corporate');?>
    <?php endif;?>
    <?php $this->load->view('includes/blog');?>
    <?php //$this->load->view('includes/site_locations');?>
    <?php $this->load->view('includes/site_seo_text');?>
</section>