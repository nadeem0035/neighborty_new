<div class="splash-search">
    <div class="search-table fave-screen-fix-inner">
        <div class="search-col">
            <h1 style="font-size: 36px;">Trouver votre agent immobilier près de chez vous</h1>
            <form class="form-inline banner-search-main"  method="get" id="" action="<?=site_url('agents/searchByFilters');?>" autocomplete="off">
                <ul class="zsg-radio-tabs">
                    <li class="som som-cl" id="rent">
                        <a>
                            <input name="" id="rent" type="radio" value="rent">
                            <label for="rent">Louer</label>
                        </a>
                    </li>
                    <li class="som" id="sale">
                        <a>
                            <input  name="" id="sell" type="radio" value="sell">
                            <label for="sell" class="search-tab"> Acheter </label>
                        </a>
                    </li>
                    <li class="som" id="sell">
                        <a>
                            <input  name="" type="radio" value="sell">
                            <label for="sell" class="search-tab">Sell </label>
                        </a>
                    </li>

                </ul>

                <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                <input type="hidden" id="street" name="street" value="<?=$this->input->get('street')?>" />
                <input type="hidden" id="city" name="city" value="<?=$this->input->get('city')?>" />
                <input type="hidden" id="state" name="state" value="<?=$this->input->get('state')?>" />
                <input type="hidden" id="state_code" name="state_code" value="<?=$this->input->get('state_code')?>" />
                <input type="hidden" id="country" name="country" value="<?=$this->input->get('country')?>" />
                <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                <input type="hidden" id="looking_for" name="looking_for" value="">


                <div class="form-group">
                    <div class="location2 input-location input-icon">
                        <input class="form-control inpheight" name="location" id="location" type="text" placeholder="Localisation">
                        <div class="search-btn">
                            <button onClick="return validate_search_form();" class="btn btn-secondary"><i class="fa fa-search"></i> Search</button>
                            <a href="<?=site_url()?>agent-finder" class="agent-ser">Find Agents</a>
                        </div>
                    </div>

                </div>
            </form>


        </div>
    </div>
</div>