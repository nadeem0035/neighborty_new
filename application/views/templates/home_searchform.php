<div class="splash-search">
    <div class="search-table fave-screen-fix-inner">
        <div class="search-col">
            <h1><?=$this->lang->line('c_home_title');?></h1>
<!--
            <div class="banner-search-main">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a href="<?/*=site_url('/')*/?>" class="btn btn-lg btn-primary">Rechercher par agent</a>
                        <p class="">un agent immobilier professionnel à votre service</p>
                    </div>
                    <div class="col-md-4">
                        <a href="<?/*=site_url('rent')*/?>" class="btn btn-lg btn-primary">Rechercher par liste</a>
                        <p>Un listing complet de bien immobilier à travers le monde</p>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>-->

            <h2 class="banner-sub-title"><?=$this->lang->line('c_search_ads');?>   |   <?=$this->lang->line('c_rental_file');?>  |  <?=$this->lang->line('c_find_home');?>  </h2>
            <form class="form-inline banner-search-main search_form"  method="get" role="form"  name="search_form" action="<?=site_url("search")?>" autocomplete="off">
               <ul class="zsg-radio-tabs">

                <li class="som tab_swtich <?=($this->uri->segment(1) == 'rent' ? 'za-track-event' :'');?>" id="rent">
                    <a>
                        <input name="" id="for_rent" type="radio" value="rent">
                        <label for="rent"><?=$this->lang->line('c_torent');?></label>
                    </a>
                </li>
                <li class="som tab_swtich <?=($this->uri->segment(1) == 'buy' ? 'za-track-event' :'');?>" id="sale">
                    <a>
                        <input  name="" id="for_sale" type="radio" value="sale">
                        <label for="sale" class="search-tab"> <?=$this->lang->line('c_buy');?> </label>
                    </a>
                </li>
                <!--<li class="som" id="any">
                    <a>
                        <input  name="" type="radio" value="any">
                        <label for="any" class="search-tab">Vendre </label>
                    </a>
                </li>-->

                </ul>

                <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                <input type="hidden" id="street" name="street" value="<?=urlencode($this->input->get('street'))?>" />
                <input type="hidden" id="city" name="city" value="<?=urlencode($this->input->get('city'))?>" />
                <!--<input type="hidden" id="state" name="state" value="<?=urlencode($this->input->get('state'));?>" />-->
                <input type="hidden" id="country" name="country" value="<?=urlencode($this->input->get('country'))?>" />
                <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                <input type="hidden" id="type" name="type" value="<?=($this->uri->segment(1) == 'buy' ? 'sale' :'rent');?>">
                <div class="form-group">
                    <div class="search input-location input-icon">
                        <input class="form-control inpheight" name="location" id="location" type="text" placeholder="<?=$this->lang->line('search_city');?>" onkeyup="if_value_is_changed()">
                    </div>
                    <div class="search-btn">
                        <button onClick="return validate_search_form();" class="btn btn-secondary search_submit" disabled><i class="fa fa-search"></i><?=$this->lang->line('find');?></button>
                    </div>
                    <div id="notice" class="agent-ser"></div>
                    <!--<a href="<?=site_url()?>agent-finder" class="agent-ser"> <?=$this->lang->line('c_state_near_you');?></a>-->
                </div>
            </form>
        </div>
    </div>
</div>
