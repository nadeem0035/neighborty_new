
<div id="location-modul" class="houzez-module location-module grid">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="location-block location-area corporate_rental" style="background-image:url('<?=base_url()?>assets/img/landing-bedroom.jpg');">
                    <a href="<?=site_url();?>search?home_types=corporate">
                        <figure>
                            <figcaption class="location-fig-caption">
                                <h3 class="heading"><?=$this->lang->line('corporate_rental');?></h3>
                                <!--<p class="sub-heading">30 Propriétés</p>-->
                            </figcaption>
                        </figure>
                        <!--<img src="<?/*=base_url()*/?>assets/img/landing-bedroom.jpg" alt="Apartment">-->
                    </a>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="location-block location-area guesthouse_rental" style="background-image:url('<?=base_url()?>assets/img/guesthouse_rental.jpg');">
                    <a href="<?=site_url();?>search?home_types=guesthouse">
                        <figure>
                            <figcaption class="location-fig-caption">
                                <h3 class="heading"><?=$this->lang->line('guesthouse_rental');?></h3>
                            </figcaption>
                        </figure>
                        <!--<img src="<?/*=base_url()*/?>assets/img/guesthouse_rental.jpg" alt="Loft">-->
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>