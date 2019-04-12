<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<body>
<section id="splash-section">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/splash_image.jpg)"></div>
    <div class="splash-inner-content">
        <div class="container-fluid">
            <!--start section header-->
            <header class="header-section-default header-main splash-header nav-left">
                <div class="header-logo text-center">
                    <a href="#"><img src="<?=base_url()?>assets/img/logo-header2.png" width="280" alt="logo"></a>
                </div>
            </header>
            <!--end section header-->
            <div class="splash-search">
                <div class="search-table fave-screen-fix-inner">
                    <div class="search-col splash-content text-uppercase">
                        <h1 class="bounceInLeft animated" style="visibility: visible; animation-delay:1s;">Welcome to <span>Neighborty</span></h1>
                        <hr>
                        <hr>
                        <h2 class="bounceInLeft animated banner-sub-title" style="visibility: visible; animation-delay:1.5s;">What are you searching for?</h2>
                        <ul>
                            <li><a href="<?=site_url('search?type=rent')?>" class="btn wow fadeIn animated" style="visibility: visible; animation-delay:2s;">Looking to Rent</a></li>
                            <li><a href="<?=site_url('search?type=sale')?>" class="btn wow fadeIn animated" style="visibility: visible; animation-delay:2.5s;">Looking to Buy</a></li>
                        </ul>
                        <p><a class="fadeIn animated" style="visibility: visible; animation-delay:3s;" href="<?=site_url()?>">Enter site</a></p>
                    </div>
                </div>
            </div>

            <div class="splash-footer">
                <div class="row">
                    <div class="col-sm-4 col-xs-4 splash-foot-left">
                        <p></p>
                    </div>
                    <div class="col-sm-4 col-xs-4 text-center splash-foot-center">
                        <p>
                            <a href="#" class="btn-facebook"><i class="fa fa-facebook-square"></i></a>
                            <a href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a>
                            <a href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a>
                            <a href="#" class="btn-pinterest"><i class="fa fa-pinterest-square"></i></a>
                            <a href="#" class="btn-google-plus"><i class="fa fa-google-plus-square"></i></a>
                        </p>
                    </div>
                    <div class="col-sm-4 col-xs-4 splash-foot-right">
                        <p>© Neighborty 2017</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/modernizr.custom.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/bootstrap-select.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="http://beta.neighborty.com/assets/js/custom.js"></script>
</body>
</html>