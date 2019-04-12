<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>


<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i></a></li>
                        <li class="active">Communiqués de presse</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-main">
                    <?php if (isset($press_detail)) {?>

                    <div class="article-detail">
                        <div class="pr_detail">
                            <h3><?= $press_detail[0]->title; ?></h3>
                            <ul class="list-inline">
                                <li><i class="fa fa-calendar"></i><?= date("M d, Y", strtotime($press_detail[0]->created_at)) ?></li>
                                <li><i class="fa fa-bookmark-o"></i> <a href="#"> <?= $press_detail[0]->press_category; ?></a> </li>
                            </ul>


                        <div class="row">
                            <div class="col-md-8 pr_release_info">
                                <!--<strong>Press Release</strong>
                                <br/>
                                <p>FOR IMMEDIATE RELEASE</p>
                                <strong>Media Contact:</strong>-->
                                <!--<p>
                                    Traci Johnson
                                    <br/>
                                    626.792.8247 ext. 250
                                    <a href="#">traci@stbaldricks.org</a>
                                </p>-->
                            </div>
                            <div class="col-md-4">
                                <img src="<?=base_url()?>assets/img/<?= $press_detail[0]->pr_img; ?>">
                            </div>
                        </div>

                        <br/>

                        <h4 style="font-weight: bold;"><?= $press_detail[0]->short_description; ?></h4>
                        <p><?= $press_detail[0]->description; ?></p>
                        </div>

                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                <aside id="sidebar">
                    <div class="widget widget_recent_comments">
                        <div class="widget-top">
                            <h3 class="widget-title">Recent Press Releases</h3>
                        </div>
                        <?php /*if (isset($press_rel)) { */?>
                        <ul>
                            <?php /*foreach ($press_rel as $cat){ */?>

                            <?php /*} */?>
                            <li class="recentcomments"><span class="">admin</span> on <a href="<?/*= site_url('press/detail/'.$cat->id) */?>"><?/*= $cat->title*/?></a></li>
                        </ul>
                        <?php /*} */?>
                    </div>
                    <div class="widget widget-categories">
                        <div class="widget-top">
                            <h3 class="widget-title">Press Releases Categories</h3>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href="">Apartment</a> <span class="cat-count">(30)</span></li>
                                <li><a href="">Condo</a> <span class="cat-count">(30)</span></li>
                                <li><a href="">Single Family Home</a> <span class="cat-count">(30)</span></li>
                                <li><a href="">Villa</a> <span class="cat-count">(30)</span></li>
                                <li><a href="">Studio</a> <span class="cat-count">(30)</span></li>
                            </ul>
                        </div>
                    </div>



                </aside>
            </div>-->
        </div>

    </div>
</section>