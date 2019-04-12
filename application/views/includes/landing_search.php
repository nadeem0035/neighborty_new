<div class="splash-search">
    <div class="search-table fave-screen-fix-inner" style="height:100% !important; ">
        <div class="search-col">

            <h1><?=$this->lang->line('home_search_heading');?></h1>
            <p><?=$this->lang->line('home_search_sub_heading');?></p>
            <form class="form-inline banner-search-main search_form"  method="get" id="search_form" action="" autocomplete="off">
                <!--<ul class="zsg-radio-tabs">
                    <li class="som tab_swticher som-cl" id="any">
                        <a>
                            <input name="" id="rent" type="radio" value="any">
                            <label for="rent">Rechercher par agent</label>
                        </a>
                    </li>
                    <li class="som tab_swticher" id="property">
                        <a>
                            <input  name="" id="property" type="radio" value="property">
                            <label for="property" class="search-tab">Rechercher par liste</label>
                        </a>
                    </li>
                </ul>-->
                <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                <input type="hidden" id="page_view" name="page_view" value="grid" />
                <input type="hidden" id="street" name="street" value="<?=urlencode($this->input->get('street'))?>" />
                <input type="hidden" id="city" name="city" value="<?=urlencode($this->input->get('city'))?>" />
                <input type="hidden" id="state" name="state" value="<?=urlencode($this->input->get('state'))?>" />
                <input type="hidden" id="country" name="country" value="<?=urlencode($this->input->get('country'))?>" />
                <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />

                <div class="form-group">
                    <div class="search input-location input-icon">
                        <input class="form-control inpheight" name="agent_location" id="location" type="text" placeholder="City & Location" onkeyup="if_value_is_changed()">
                    </div>

                    <select name="type" title="Home Type"  id="type" class="tab_swticher selectpicker bs-select-hidden">
                        <option value="">Par Agents</option>
                        <option value="any">Par Annonces</option>
                    </select>
                    <div class="search-btn">
                        <button onClick="return validate_search_form();" class="btn btn-secondary search_submit" disabled><i class="fa fa-search"></i> Find</button>
                    </div>
                </div>
                <div id="notice" class="agent-ser"></div>
            </form>
        </div>
    </div>
</div>