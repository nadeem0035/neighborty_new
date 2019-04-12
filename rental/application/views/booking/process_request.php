<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
    <?php $this->load->view('templates/preloader'); ?>
    <div id="wrap">
        <?php $this->load->view('templates/' . $topmenu); ?>
        <section class="sub-banner">
            <div class="bg-parallax bg-6" style="height:420px !important;"></div>
        </section>
        <div class="main">
            <div class="title-wrap">
                <section class="blog-content">
                    <div class="row">
                    <div class="container">
                        <div class="col-md-12">
                            <div class="post post-single">
                                <h1 class="title-post-head col-md-12">Payments</h1>
                               
                                <div class="col-md-12 payment-response-section"><?=$respnsemessage?></div>                                
                            </div>
                            <div class="clearfix"></div>
                                                    
                        </div>
                    </div>
                    </div>
                </section>      
            </div>
        </div>
    </div>