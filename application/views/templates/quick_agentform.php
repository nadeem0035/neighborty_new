
    <!--start advanced search section-->

    <section class="advanced-search advance-search-header hidden-xs hidden-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form method="GET" action="<?=site_url('agents/searchByFilters');?>" id="search_form" name="search_form">
                        <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                        <input type="hidden" class="street" id="street" name="street" value="<?=$this->input->get('street')?>" />
                        <input type="hidden" class="city" id="city" name="city" value="<?=$this->input->get('city')?>" />
                        <input type="hidden" class="state" id="state" name="state" value="<?=$this->input->get('state')?>" />
                        <input type="hidden" class="state_code" id="state_code" name="state_code" value="<?=$this->input->get('state_code')?>" />
                        <input type="hidden" class="country" id="country" name="country" value="<?=$this->input->get('country')?>" />
                        <input type="hidden" class="zipcode" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                        <input type="hidden" id="page_view" name="page_view" value="list" />
                        <input type="hidden" id="looking_for" name="looking_for" value="rent">
                        <div class="form-group search-long">
                            <div class="search">
                                <div class="search-location input-location input-icon">
                                    <input class="form-control" onkeyup="is_location_valid(this.value)" name="agent_location" id="location" value="<?=$this->input->get('agent_location')?>" placeholder="City / Location" required>
                                </div>
                                <div class="search-location">
                                    <i class="location-trigger fa fa-user"></i>
                                    <input style="padding-left: 35px;" class="form-control" value="<?=$this->input->get('name')?>" name="name" placeholder="Agent name">

                                </div>

                                <select name="languages"  class="selectpicker" data-live-search="false" title="Languages">
                                    <option value="english" <?=($this->input->get('languages') == 'english' ? 'selected' : '');?>>English</option>
                                    <option value="arabic" <?=($this->input->get('arabic') == 'rent' ? 'selected' : '');?>>Arabic</option>
                                    <option value="french" <?=($this->input->get('french') == 'rent' ? 'selected' : '');?>>French</option>
                                </select>

                                <select name="looking_for"  class="selectpicker" data-live-search="false" title="Service Needed">
                                    <option value="rent" <?=($this->input->get('looking_for') == 'rent' ? 'selected' : '');?>>I want to rent</option>
                                    <option value="all" <?=($this->input->get('looking_for') == 'all' ? 'selected' : '');?>>I would like to buy</option>
                                    <option value="sell" <?=($this->input->get('looking_for') == 'sell' ? 'selected' : '');?>>I want to sell</option>
                                </select>



                            </div>
                            <div class="search-btn">
                                <button class="btn btn-secondary search_submit">Go</button>
                            </div>

                        </div>

                    </form>
                    <div class="clearfix"></div>
                    <div id="notice" class="agent-ser"></div>
                </div>
            </div>
        </div>
    </section>


