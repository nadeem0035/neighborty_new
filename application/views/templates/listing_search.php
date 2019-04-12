<!--start advanced search section-->
<div class="row">
<section class="listing_search">
    <form method="GET" class="search_form" action="<?=site_url("search")?>" id="search_listing_form" name="search_form">
        <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>


        <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
        <input type="hidden" id="listing_type" name="listing_type" value="<?=$this->input->get('type')?>" />
        <input type="hidden" id="list_type" name="list_type" value="<?=$this->input->get('type')?>" />
        <input type="hidden" name="ajax" value="1" />
        <input type="hidden" id="street" name="street" value="<?=urlencode($this->input->get('street'))?>" />
        <input type="hidden" id="city" name="city" value="<?=urlencode($this->input->get('city'))?>" />
        <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
        <input type="hidden" id="state" name="state" value="<?=$this->input->get('state')?>" />
        <input type="hidden" id="country" name="country" value="<?=$this->input->get('country')?>" />


        <div class="input-search input-icon">
            <input class="form-control searchfilter" name="location" id="location" type="text" value="<?=(isset($_GET['agent_location']) ? $_GET['agent_location'] : $this->input->get('location'));?>" placeholder="Look for your future home">
        </div>

        <div class="listing_search_filter">
            <div class="dropdown keep-inside-clicks-open">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Property Type <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><label class="checkbox-inline mr_check"><input id="proptype" class="chk searchfilter" name="property_type[]" type="checkbox" value="sale"><span class="checkmark"></span> <?=$this->lang->line('cw_sale');?></label></li>
                    <li><label class="checkbox-inline mr_check"><input id="proptype" class="chk searchfilter" name="property_type[]" type="checkbox" value="rent"><span class="checkmark"></span> <?=$this->lang->line('cw_rent');?></label></li>
                </ul>
            </div>


            <input type="hidden" name="flag" id="flag">


            <div class="dropdown keep-inside-clicks-open">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">By Owner <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><label class="checkbox-inline mr_check"><input class="searchfilter" name="user_type[]" type="checkbox" value="self"> <span class="checkmark"></span>  <?=$this->lang->line('byowner');?></label></li>
                    <li><label class="checkbox-inline mr_check"><input class="searchfilter" name="user_type[]" type="checkbox" value="agent"> <span class="checkmark"></span>  <?=$this->lang->line('byagent');?></label></li>
                </ul>
            </div>

            <div class="dropdown keep-inside-clicks-open hometype_d">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Home Type <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                    $home_types = $this->crud_model->get(
                        array(
                            'fields'=>'id, name,slug, active',
                            'table'=>'home_type',
                            'where'=>'active = 1 ',
                        )
                    );
                    if( is_array($home_types) )
                    {
                        foreach( $home_types as $home_type )
                        {
                            ?>
                            <li><label class="checkbox-inline mr_check"><input class="searchfilter" name="home_types[]" type="checkbox" value="<?=$home_type->slug?>"> <span class="checkmark"></span> <?= $home_type->name; ?></label></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="dropdown keep-inside-clicks-open span2 investRange">
                <a href="javascript:void(0)" id="min-max-price-range" class="selectpicker select-btn  dropdown-toggle searchParams"  data-toggle="dropdown" tabindex="6">
                    <div class="filter-option pull-left span_price">
                        <span id="price_range1"> 0 </span> <strong>To</strong> <span id="price_range2">Any</span>
                    </div>
                    <span class="caret" style="margin-left:5px;"></span>
                </a>
                <div class="dropdown-menu ddRange" role="menu" style="width:230px;">
                        <div class="rangemenu">
                            <div class="freeformPrice">
                                    <div class="col-md-6">
                                        <input name="min_price" type="text" class="min_input form-control" placeholder="Min Price">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="max_price" type="text" class="max_input form-control" placeholder="Max Price">
                                    </div>
                                </div>

                                <div class="price_Ranges rangesMin">
                                    <a class="min_value" value="0" href="javascript:void(0)">0</a>
                                    <a class="min_value" value="500000" href="javascript:void(0)">500,000</a>
                                    <a class="min_value" value="1000000" href="javascript:void(0)">1,000,000</a>
                                    <a class="min_value" value="2000000" href="javascript:void(0)">2,000,000</a>
                                    <a class="min_value" value="3500000" href="javascript:void(0)">3,500,000</a>
                                    <a class="min_value" value="5000000" href="javascript:void(0)">5,000,000</a>
                                    <a class="min_value" value="6500000" href="javascript:void(0)">6,500,000</a>
                                    <a class="min_value" value="8000000" href="javascript:void(0)">8,000,000</a>
                                    <a class="min_value" value="10000000" href="javascript:void(0)">10,000,000</a>
                                    <a class="min_value" value="12500000" href="javascript:void(0)">12,500,000</a>
                                    <a class="min_value" value="15000000" href="javascript:void(0)">15,000,000</a>
                                </div>

                                <div class="price_Ranges rangesMax">
                                    <a class="max_value" value="0" href="javascript:void(0)">0</a>
                                    <a class="max_value" value="500000" href="javascript:void(0)">500,000</a>
                                    <a class="max_value" value="1000000" href="javascript:void(0)">1,000,000</a>
                                    <a class="max_value" value="2000000" href="javascript:void(0)">2,000,000</a>
                                    <a class="max_value" value="10000000" href="javascript:void(0)">3,500,000</a>
                                    <a class="max_value" value="3500000" href="javascript:void(0)">5,000,000</a>
                                    <a class="max_value" value="5000000" href="javascript:void(0)">6,500,000</a>
                                    <a class="max_value" value="8000000" href="javascript:void(0)">8,000,000</a>
                                    <a class="max_value" value="10000000" href="javascript:void(0)">10,000,000</a>
                                    <a class="max_value" value="12500000" href="javascript:void(0)">12,500,000</a>
                                    <a class="max_value" value="15000000" href="javascript:void(0)">15,000,000</a>
                                </div>


                            </div>
                    <div class="btnClear">
                        <a href="javascript:void(0)" class="btn btn-link">Clear</a>
                    </div>
                </div>
            </div>

            <div class="dropdown keep-inside-clicks-open">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></a>
                <div class="dropdown-menu morefilters">

                    <div class="form-group">

                        <label class="col-md-4">Min Baths</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control searchfilter" name="bathrooms" id="bathrooms"  placeholder="Min Baths" />
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">

                        <label class="col-md-4">Min Beds</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control searchfilter" name="bedrooms" id="bedrooms"  placeholder="Min Beds" />

                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-md-4">Land Area</label>
                        <div class="col-md-8">
                                <select class="form-control searchfilter" data-live-search="false" title="Land Area" name="area">
                                    <option value="">Select</option>
                                    <?php
                                    $measurements = $this->crud_model->get(
                                        array(
                                            'fields'=>'id, name',
                                            'table'=>'measurements',

                                        )
                                    );
                                    if( is_array($measurements) )
                                    {
                                        foreach( $measurements as $row )
                                        {
                                            ?>

                                            <option value="<?=$row->name?>"><?= $row->name; ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        <div class="clearfix"></div>
                        <label class="col-md-4">Area</label>
                        <div class="col-md-4"><input class="form-control searchfilter" name="min_area" type="number" placeholder="Min"></div>
                        <div class="col-md-4"><input class="form-control searchfilter" name="max_area" type="number" placeholder="Max"></div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <?php if (isset($_GET['agent_location']) || isset($_GET['location'])) {?>
                    <div class="search-btn">
                        <button  class="btn btn-primary search_submit"><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                    </div>
                <?php } else {?>
                    <div class="search-btn">
                        <button class="btn btn-primary search_submit" disabled><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                    </div>
                <?php } ?>
            </div>

            <div class="dropdown keep-inside-clicks-open"></div>
        </div>



    </form>
    <!--Listing Search Form End-->
    <form id="form_for_ajax">
        <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
    </form>
    <div class="clearfix"></div>
    <div id="notice" class="agent-ser"></div>
</section>
</div>