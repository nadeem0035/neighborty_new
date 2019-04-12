<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
<div id="wrap">
        <section class="page-not-found">
            <div class="bg-parallax bg-404"></div>
            <div class="container">
                <div class="logo-page text-center">
                    <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/404-logo.png" alt="">
                    </a>
                </div>
                <div class="page-body text-center">
                    <div class="item-content">
                        <div class="image-wrap"><img src="<?=base_url()?>assets/img/404.png" alt="">
                        </div>
                        <h4>WE'RE REALLY SORRY!</h4>
                        
                        <p>Something went wrong trying to display the page,</p>
                        <p>Please try one of these instead</p>
                    </div>
                    <div class="item-footer">
                    
                        <a href="<?=site_url()?>" class="awe-btn awe-btn-1 awe-btn-small next-btn-error">Home Page</a>
                    
                    <a href="javascript: history.go(-1)" class="awe-btn awe-btn-1 awe-btn-small prev-btn-error">Previous Page</a>
                    
                    </div>
                </div>
            </div>
        </section>
        
    </div>