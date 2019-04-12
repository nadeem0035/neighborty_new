<section class="banner-search-main">
    <form  class="form-inline banner-search-main search_form"  method="get" id="search_form" action="<?=site_url('agents/searchByFilters');?>" autocomplete="off">
        <ul class="zsg-radio-tabs">

            <li class="agent_tab_swticher som <?=($_GET['type'] == 'rent' ? 'za-track-event' :'');?>" id="rent" style="width: 33%">
                <a>
                    <input name="" id="rent" type="radio" value="rent">
                    <label for="rent">Louer</label>
                </a>
            </li>
            <li class="agent_tab_swticher som <?=($_GET['type'] == 'sale' ? 'za-track-event' :'');?>" id="sale"  style="width: 33%">
                <a>
                    <input  name="" id="sell" type="radio" value="sell">
                    <label for="sell" class="search-tab"> Acheter </label>
                </a>
            </li>
            <li class="agent_tab_swticher som <?=($_GET['type'] == 'any' || $_GET['type'] == '' ? 'za-track-event' :'');?>" id="any"  style="width: 32.9%">
                <a>
                    <input  name="" type="radio" value="any">
                    <label for="all" class="search-tab">Tout Type</label>
                </a>
            </li>

        </ul>

        <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
        <input type="hidden" id="street" name="street" value="<?=urlencode($this->input->get('street'))?>" />
        <input type="hidden" id="city" name="city" value="<?=urlencode($this->input->get('city'))?>" />
        <input type="hidden" id="state" name="state" value="<?=urlencode($this->input->get('state'))?>" />
        <input type="hidden" id="country" name="country" value="<?=urlencode($this->input->get('country'))?>" />
        <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
        <?php  if($_GET['type'] == 'rent') { ?>
             <input type="hidden" id="looking_for" name="type" value="rent">
        <?php } elseif($_GET['type'] == 'rent') { ?>
            <input type="hidden" id="looking_for" name="type" value="sale">
        <?php } else{ ?>
            <input type="hidden" id="looking_for" name="type" value="any">
        <?php } ?>
        <div class="form-group" style="width: 100%">
            <div class="search input-location input-icon">
                <input class="form-control inpheight" name="location" id="location" type="text" placeholder="Localisation" value="" onkeyup="if_value_is_changed()">
            </div>
            <div class="search-btn">
                <button onClick="return validate_search_form();" class="btn btn-secondary search_submit" disabled><i class="fa fa-search"></i> Recherche</button>
            </div>
            <div class="clearfix"></div>
            <div id="notice" class="agent-ser"></div>
        </div>
    </form>
</section>

