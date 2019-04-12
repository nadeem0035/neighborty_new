<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    html{
        min-height:100%;
        position:relative;
    }
    body{height:100%;}
    #splash-section {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        overflow: hidden;
        z-index: -1;
        min-height:100%;
        max-height:100%;
    }
    @media (min-width:320px) and (max-width:966px) {
        #splash-section h4 {
            line-height:22px !important;
        }
        #splash-section {
            position:inherit !important;
        }
    }
</style>
<body>
<section id="splash-section">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url('<?=base_url()?>assets/img/03_splash_page.jpg')"></div>
    <div class="splash-inner-content">
        <div class="container-fluid">

            <div class="splash-search">
                <div class="search-table fave-screen-fix-inner">
                    <div class="search-col">
                        <div class="banner-search-main">

                            <div class="image-wrap"><img src="<?=base_url()?>assets/img/404.png" alt=""></div>

                            <h3 style="color:#fff;line-height:normal;">The day of glory has not arrived yet</h3>

                            <p>You will soon be able to find your future home, apartment, castle... </p>

                            <p>Everything is possible on Zoney.pk.</p>

                            <a href="javascript: history.go(-1)" class="btn btn-md btn-primary">Return</a>
                            <a href="<?=site_url()?>" class="btn btn-md btn-primary">Home</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php
put_js_footer();
?>