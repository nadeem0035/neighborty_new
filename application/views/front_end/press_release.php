<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php /*$this->load->view('includes/menu/topbar'); */?>
<?php /*$this->load->view('includes/menu/'.$topmenu); */?>
<?php /*$this->load->view('templates/quick_searchform'); */?>

<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title"><?=$this->lang->line('c_releases');?> <?=$this->lang->line('c_press');?></h2>
            <p class="txt-white"><?=$this->lang->line('c_follow_steps_to_discover');?></p>
        </div>
    </div>
</section>


<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                <div class="page-main">
                    <?php if (isset($press_release)) { ?>
                    <div class="article-detail">
                        <?php foreach ($press_release as $release) { ?>
                        <div class="press_news">
                            <h3><a href="<?= site_url('press/detail/'.$release->id) ?>"><?= $release->title; ?></a></h3>
                            <ul class="list-inline">
                                <li><i class="fa fa-calendar"></i><?= date("M d, Y", strtotime($release->created_at)) ?></li>
                                <li><i class="fa fa-bookmark-o"></i> <a href="#"><?= $release->press_category; ?></a> </li>
                            </ul>
                        </div>
                        <?php } ?>

                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                <aside id="sidebar">
                    <div class="widget widget-categories">
                        <div class="widget-top">
                            <h3 class="widget-title"><?=$this->lang->line('c_press_cat');?></h3>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href=""><?=$this->lang->line('c_apartment');?></a> <span class="cat-count">(30)</span></li>
                               <!-- <li><a href="">Condo</a> <span class="cat-count">(30)</span></li>-->
                                <li><a href=""><?=$this->lang->line('c_faimly');?></a> <span class="cat-count">(30)</span></li>
                                <li><a href=""><?=$this->lang->line('c_city');?></a> <span class="cat-count">(30)</span></li>
                                <li><a href=""><?=$this->lang->line('c_studio');?></a> <span class="cat-count">(30)</span></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

    </div>
</section>