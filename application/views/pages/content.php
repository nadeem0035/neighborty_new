<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title"><?=$page->page_title;?></h2>
            <p class="txt-white">zoney.pk</p>
        </div>
    </div>
</section>

    <div id="search_results">
    <section id="section-body">
        <div class="container">

            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="/"><i class="fa fa-home"></i></a></li>
                            <li class="active"><?=$page->page_title;?></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="article-detail">

                            <div class="my-profile">
                                <?=$page->page_desc;?>
                            </div>

                    </div>
                </div> <!-- Right Column -->

            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    </div>