<!--start advanced search section-->
<section class="advanced-search advance-search-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form method="GET" class="search_form" action="<?=site_url("search")?>" id="search_form" name="search_form">
                    <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                    <input type="hidden" class="street" id="street" name="street" value="<?=urlencode($this->input->get('street'))?>" />
                    <input type="hidden" class="city" id="city" name="city" value="<?=urlencode($this->input->get('city'))?>" />
                    <input type="hidden" class="state" id="state" name="state" value="<?=urlencode($this->input->get('state'))?>" />
                    <input type="hidden" class="country" id="country" name="country" value="<?=urlencode($this->input->get('country'))?>" />
                    <input type="hidden" class="zipcode" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                    <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
                    <input type="hidden" id="search_by_map" name="search_by_map" value="false" />
                    <input type="hidden" id="listing_type" name="listing_type" value="<?=$this->input->get('type')?>" />
                    <input type="hidden" id="list_type" name="list_type" value="<?=$this->input->get('type')?>" />
                    <input type="hidden" id="sw_lat"  name="sw_lat"  />
                    <input type="hidden" id="sw_lng"  name="sw_lng"  />
                    <input type="hidden" id="ne_lat"  name="ne_lat"  />
                    <input type="hidden" id="ne_lng"  name="ne_lng"  />
                    <div class="form-group search-long" style="margin-bottom:0 !important;">
                        <div class="search">
                            <div class="input-search input-icon">
                                <input class="form-control" name="location" id="location" type="text" value="<?=$this->input->get('location')?>" placeholder="Search City & Location" onkeyup="if_value_is_changed()">
                            </div>
                            <select name="type" title="category" class="selectpicker bs-select-hidden" data-live-search="false">
                                <option value="">All type</option>
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                            <div class="advance-btn-holder">
                                <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> <span class="hidden-xs">Options</span></button>
                            </div>
                        </div>


                        <div class="search-btn">
                            <button type="submit" class="btn btn-secondary search_submit" disabled><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                        </div>
                    </div>
                    <div class="advance-fields">
                        <div class="row">

                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker" data-live-search="true" title="Bedrooms" name="beds" id="beds"  class="tbc-bedrooms-field" data-size="5">
                                        <?php for($i = 1; $i <= 5; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if($this->input->get('beds') == $i){ echo "selected"; }?>><?php echo $i; ?> Bedroom<?php if($i > 1) echo 's'; ?></option>
                                        <?php } ?>
                                        <option value="">Show All</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <select name="bathrooms" id="bathrooms" class="selectpicker" data-live-search="true" data-size="5" >
                                        <option value="">Bathroom </option>
                                        <?php for($i = 1; $i <= 5; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if($this->input->get('bathrooms') == $i){ echo "selected"; }?>><?php echo $i; ?> Bathroom</option>
                                        <?php } ?>
                                        <option value="">Show All</option>


                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" value="" min="1" name="min_area" placeholder="Min area">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" value="" min="1" name="max_area" placeholder="Max area ">
                                </div>
                            </div>

                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" value="" min="1" name="price_min" placeholder="Min Price" id="price_min" >
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" value="" min="1" name="price_max" placeholder="Max Price " id="price_max" >
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12 features-list">
                                <label class="advance-trigger text-uppercase title"><i class="fa fa-plus-square"></i> HOUSING TYPE </label>
                                <div class="clearfix"></div>
                                <div class="field-expand">
                                    <?php
                                    $home_types = $this->crud_model->get(
                                        array(
                                            //'debug'=>'',
                                            'fields'=>'id, name, active',
                                            'table'=>'home_type',
                                            'where'=>'active = 1 ',
                                        )
                                    );
                                    // pre($home_types);
                                    if( is_array($home_types) )
                                    {
                                        foreach( $home_types as $home_type )
                                        {
                                            // pre($home_type);
                                            ?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="<?=$home_type->name?>" id="home_type_<?=$home_type->id; ?>"  name="home_types[]" /> <?= $home_type->name; ?>
                                            </label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12 features-list">
                                <label class="advance-amenities text-uppercase title"><i class="fa fa-plus-square"></i> NEED EQUIPMENT?</label>
                                <div class="clearfix"></div>
                                <div class="field-expands">
                                    <?php
                                    $amenities = $this->crud_model->get(
                                        array(
                                            //'debug'=>'',
                                            'fields'=>'id,name,type',
                                            'table'=>'amenities',
                                            'where'=>'active = 1 ',
                                        )
                                    );
                                    // pre($amenities);
                                    if( is_array($amenities) )
                                    {
                                        foreach ($amenities as $amenity)
                                        {
                                            // pre($amenity);
                                            ?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="<?=$amenity->id;?>" id="amenity_<?=$amenity->id; ?>"  name="amenities[]" /> <?= $amenity->name; ?>
                                            </label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>

                <form id="form_for_ajax">
                    <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
                </form>
                <div class="clearfix"></div>
                <div id="notice" class="agent-ser"></div>
            </div>
        </div>
    </div>
</section>

