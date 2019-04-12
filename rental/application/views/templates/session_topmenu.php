<header id="header" class="header" style="background-color: transparent;">
<div class="page-header navbar navbar-fixed-top">
            <div class="container">
           <div class="page-header-inner">
           
                 <div class="logo float-left">
                    <a href="<?=base_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-header.png" alt="">
                    </a>
            <div style="display:none;" class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
                    
                </div>
                <?php if(strpos(current_url(),"booking/detail")) {?>
                
                <div class="mob-top-right" style="float:left; margin-top:2%; width:50%; margin-left:4%;">

<div id="single-fix-menu-mobile">
    <a class="top-hover" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('overview-area')">Overview</a>
    <a class="top-hover" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('amenties-area')">Amenties</a>
    <a class="top-hover" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('maps-area')">Locations</a>
    <a class="top-hover longMenuItem" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('rates-area')">Availibility</a>
    <a class="top-hover" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('reviews-area')">Reviews</a>
    <a class="top-hover" style="color:#f7c871; font-size:12px;" href="javascript:ScrollMe('belowgallery-area')">Gallery</a>
    
</div>

<div id="single-fix-menu-desktop" class="sessionTopMenu">  
    <a href="javascript:ScrollMe('overview-area')"><div class="col-md-1 menuitem top-hover-items">Overview</div></a>
    <a href="javascript:ScrollMe('amenties-area')"><div class="col-md-1 menuitem top-hover-items">Amenities</div></a>
    <a href="javascript:ScrollMe('maps-area')"><div class="col-md-1 menuitem top-hover-items">Locations</div></a>
    <a href="javascript:ScrollMe('rates-area')"><div class="col-md-1 menuitem longMenuItem top-hover-items">Availability</div></a>
    <a href="javascript:ScrollMe('reviews-area')"><div class="col-md-1 menuitem top-hover-items">Reviews</div></a>
    
    <a href="javascript:ScrollMe('belowgallery-area')"><div class="col-md-1 menuitem top-hover-items">Gallery</div></a>
</div>

<div class="clearfix"></div>          

</div>
<?php } ?>
                
                
         <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

<?php $this->load->view('templates/common_topmenu'); ?>
 
                </div>
                 <nav class="navigation nav-r nav" id="navigation" data-menu-type="4000">
                    <div class="nav-inner">
                        <div class="tb">
                             
                        </div>
                    </div>
                </nav>
            </div>
            </div>
        </header>