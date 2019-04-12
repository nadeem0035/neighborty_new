<?php defined('BASEPATH') OR exit ('No direct script access allowed'); ?>
<body>
<?php $this->load->view('inclues/menu/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>
    <section id="section-body">
        <div class="container">

            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="/"><i class="fa fa-home"></i></a></li>
                            <li class="active">Press</li>
                        </ol>
                        <div class="page-title-left">
                            <h2>Press</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <div class="my-property-menu">
                        <ul>
                            <li class="<?= ($this->uri->segment(2) == "about") ? 'active' : '' ?>" ><a href="<?= site_url('page/about')?>">About Us</a></li>
                            <li class="<?= ($this->uri->segment(2) == "mission") ? 'active' : '' ?>"><a href="<?= site_url('page/mission')?>">Our Mission</a></li>
                            <li class="<?= ($this->uri->segment(2) == "press") ? 'active' : '' ?>"><a href="<?= site_url('page/press')?>">Press</a></li>
                            <li class="<?= ($this->uri->segment(2) == "career") ? 'active' : '' ?>"><a href="<?= site_url('page/career')?>">Careers</a></li>
                            <li class="<?= ($this->uri->segment(2) == "privacy") ? 'active' : '' ?>"><a href="<?= site_url('page/privacy')?>">Privacy Policy</a></li>
                            <li class="<?= ($this->uri->segment(2) == "terms") ? 'active' : '' ?>"><a href="<?= site_url('page/terms')?>">Terms & Conditions</a></li>
                            <li class="<?= ($this->uri->segment(2) == "contact") ? 'active' : '' ?>"><a href="<?= site_url('contact')?>">Contact</a></li>
                        </ul>
                    </div>
                </div> <!-- Left Column -->

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="article-detail">
                        <div class="row">
                            <div class="my-profile">
                                <h1>Press</h1>
                                <?php foreach($press as $row):?>
                                    <div class="col-md-2 pressDates">
                                        <p><?=$row->created_at;?></p>
                                    </div>
                                    <div class="col-md-10 pressDesc">
                                        <p class="more"><?=$row->description;?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr/>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div> <!-- Right Column -->

            </div> <!-- row -->
        </div> <!-- container -->
    </section> <!-- section -->



