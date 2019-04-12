<div class="houzez-module-main module-white-bg">
    <div id="location-modul" class="houzez-module location-module grid">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=1">
                        <figure>
                                <figcaption class="location-fig-caption">
                                    <h3 class="heading" style="color: #FFF">Islamabad</h3>
                                    <!--<p class="sub-heading">30 Propriétés</p>-->
                                </figcaption>
                        </figure>
                        <img src="<?=base_url()?>assets/img/cities/Islamabad.jpg" width="370" height="370" alt="Islamabad">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=3">
                            <figure>
                                <figcaption class="location-fig-caption"  style="color: #FFF">
                                    <h3 class="heading">Lahore</h3>
                                    <!--<p class="sub-heading">30 Propriétés</p>-->
                                </figcaption>
                            </figure>
                            <img src="<?=base_url()?>assets/img/cities/lahore.jpg" width="370" height="370" alt="Lahore">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=2">
                            <figure>
                                <figcaption class="location-fig-caption"  style="color: #FFF">
                                    <h3 class="heading">Karachi</h3>
                                    <!--<p class="sub-heading">30 Propriétés</p>-->
                                </figcaption>
                            </figure>
                            <img src="<?=base_url()?>assets/img/cities/karachi.jpg" width="370" height="370" alt="Karachi">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=4">
                            <figure>
                                <div class="location-fig-caption"  style="color: #FFF">
                                    <h3 class="heading">Rawalpindi</h3>
                                    <!--<p class="sub-heading">1 propriété</p>-->
                                </div>
                            </figure>
                            <img src="<?=base_url()?>assets/img/cities/rawalpindi.jpg" width="370" height="370" alt="Rawalpindi">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=136">
                            <figure>
                                <div class="location-fig-caption" style="color: #FFF">
                                    <h3 class="heading">Peshawar</h3>
                                    <!--<p class="sub-heading">11 Propriétés</p>-->
                                </div>
                            </figure>
                            <img src="<?=base_url()?>assets/img/cities/peshawar.jpg" width="370" height="370" alt="Peshawar">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="location-block location-area">
                        <a href="<?=site_url();?>search?page_view=grid&city=41">
                            <figure>
                                <div class="location-fig-caption" style="color: #FFF">
                                    <h3 class="heading">Faisalabad</h3>
                                    <!-- <p class="sub-heading">10 Propriétés</p>-->
                                </div>
                            </figure>
                            <img src="<?=base_url()?>assets/img/cities/faisalabad.jpg" width="370" height="370" alt="Faisalabad">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="houzez-module cities-tabs" style="/*background-image:url('<?=base_url()?>assets/img/pak-cities.png');*/">
    <div class="module-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h2><?=$this->lang->line('listed_cities');?></h2>
                    <h3 class="sub-heading"><?=$this->lang->line('discover_incredible');?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <ul  class="nav nav-pills">
            <li class="active"><a  href="#sale" data-toggle="tab">Properties For Sale</a></li>
            <li><a href="#rent" data-toggle="tab">Properties For Rent</a></li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="sale">
                <div class="row">
                    <ul>
                        <?php foreach($sales_stats as $sale):?>
                           <?php if($sale->sale > 0):?>
                                 <li class="col-md-3 col-sm-6 col-xs-6"><a href="<?=site_url();?>search?type=sale&city=<?=$sale->city_id;?>"><?=$sale->city;?> (<span><?=$sale->sale;?></span>)</a></li>
                           <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="rent">
                <div class="row">
                    <ul>
                        <?php foreach($rent_stats as $rent):?>
                            <?php if($rent->rent > 0):?>
                                <li class="col-md-3 col-sm-6 col-xs-6"><a href="<?=site_url();?>search?type=rent&city=<?=$rent->city_id;?>"><?=$rent->city;?> (<span><?=$rent->rent;?></span>)</a></li>
                            <?php endif;?>
                        <?php endforeach;?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>