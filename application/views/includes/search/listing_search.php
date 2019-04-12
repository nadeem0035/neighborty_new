<div class="listing_search">

    <form method="GET" class="search_form" action="<?=site_url("search")?>" id="search_listing_form" name="search_form" novalidate>
        <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>

        <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
        <input type="hidden" id="" name="listing_type" class="listing_type" value="<?=$this->input->get('type')?>" />
        <input type="hidden" id="list_type" name="list_type" value="<?=$this->input->get('type')?>" />
        <input type="hidden" name="ajax" value="1" />
        <input type="hidden" name="ajax_value" value="1" />

        <div class="list_search">
           <div class="li">
                <?php
                if($this->input->get('city') != ''){
                    $city_id = trim($this->input->get('city'));
                    //echo getCityById($city_id);
                }

                if($this->input->get('sub_area') != '') {
                    $area = trim($this->input->get('sub_area'));
                    $areaName=  getAreaById($area);
                }

                ?>
                <select class="basic-single" name="city" id="search_city" onchange="if_value_is_changed();">
                    <!--
                    <option value="3">Lahore</option>
                    <option value="2">Karachi</option>
                    <option value="1">Islamabad</option>
                    <option value="4">Rawalpindi</option>
                    <option value="136">Peshawar</option>
                    <option value="114">Multan</option>
                    <option value="51">Gujranwala</option>
                    -->


                    <?= ($city_id == '' ? '<option value=""></option>' : '');?>
                    <?php foreach($cities as $city ): ?>

                        <option <?= ($city->id == $city_id ? 'Selected' : '');?>  value="<?=$city->id;?>"><?=$city->name;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="li">
                <div class="search text-left" id="city_areas">
                    <input class="form-control area_by_city areas" type="text"  placeholder="Enter Location" value="<?=$areaName?>" id="areass" >
                </div>

                <input type="hidden" name="sub_area" id="area-id">
                <input type="hidden" name="page_view" value="grid">
            </div>
            <?php
            $property_type = $this->input->get_post('property_type');
            $ptype = $this->input->get_post('type');
            $hometypes = $this->input->get_post('home_types');
            ?>
            <div class="li">
                <select id="property_type" name="property_type[]" title="Property Type" id="" class="basic-single" data-live-search="false" data-minimum-results-for-search="Infinity">
                    <option value="all" <?=(in_array('',$property_type) ?'Selected':'');?>>All</option>
                    <option value="sale" <?=(in_array('sale',$property_type) ?'Selected':'' || ($ptype == 'sale') ?'Selected':'' );?>>Sale</option>
                    <option value="rent" <?=(in_array('rent',$property_type) ?'Selected':'' || ($ptype == 'rent') ?'Selected':'' );?>>Rent</option>
                </select>
            </div>
            <div class="li">
                <select class="basic-single" id="type" data-live-search="false" title="Home Type" name="home_types[]" onchange="if_home_type_is_changed();" data-minimum-results-for-search="Infinity">
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

                                <option value="<?=$home_type->slug?>"  <?=(in_array($home_type->slug,$hometypes) ?'Selected':'');?>><?= $home_type->name; ?></option>

                                <?php
                            }
                        }
                        ?>
                </select>
            </div>
            <div class="li">
                <div class="dropdown keep-inside-clicks-open span2 investRange">
                    <a href="javascript:void(0)" id="min-max-price-range" class="selectpicker select-btn  dropdown-toggle searchParams"  data-toggle="dropdown" tabindex="6">
                        <div class="filter-option pull-left span_price">
                            <span id="price_range1"> 0 </span> <strong>To</strong> <span id="price_range2">Any</span>
                        </div>
                        <span class="caret" style="margin-left:5px;"></span>
                    </a>
                    <div class="dropdown-menu ddRange" role="menu" style="width:240px;">
                        <div class="rangemenu">
                            <div class="freeformPrice">
                                <div class="col-md-6">
                                    <input name="min_price" onkeypress="return event.charCode >= 48" min="0" type="number" class="min_input form-control" placeholder="Min Price" value="<?=$this->input->get_post('price_min');?>">
                                </div>
                                <div class="col-md-6">
                                    <input name="max_price" onkeypress="return event.charCode >= 48" min="0" type="number" class="max_input form-control" placeholder="Max Price" value="<?=$this->input->get_post('price_max');?>">
                                </div>
                            </div>

                            <div class="price_Ranges rangesMin">
                                <div class="scrollbar" id="style-3">
                                    <div class="force-overflow" id="f1"></div>
                                </div>

                            </div>

                            <div class="price_Ranges rangesMax">
                                <div class="scrollbar" id="style-3">
                                    <div class="force-overflow" id="f2"></div>
                                </div>
                            </div>


                        </div>
                        <div class="btnClear">
                            <a href="javascript:void(0)" class="btn btn-dark btn-sm">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="li">
                <div class="dropdown keep-inside-clicks-open">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></a>
                    <div class="dropdown-menu morefilters">
                        <div class="beds" style="<?=(in_array('commercial',$hometypes) ? 'display: none;':'' || in_array('plots',$hometypes) ? 'display: none;':'') ;?>" >

                        <div class="form-group">
                            <label class="col-md-4">Min Baths</label>
                            <div class="col-md-8">
                                <input type="number" onkeypress="return event.charCode > 48" min="1" max="20" class="form-control searchfilter" name="bathrooms" id="bathrooms"  placeholder="Min Baths" value="<?=$this->input->get_post('bathrooms');?>" />
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">

                            <label class="col-md-4">Min Beds</label>
                            <div class="col-md-8">
                                <input type="number" onkeypress="return event.charCode > 48" min="1" max="20" class="form-control searchfilter" name="bedrooms" id="bedrooms"  placeholder="Min Beds" value="<?=$this->input->get_post('bedrooms');?>" />

                            </div>

                        </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label class="col-md-4">Land Area</label>
                            <div class="col-md-8">
                                <select class="form-control searchfilter" data-live-search="false" title="Land Area" name="area" id="select_area">
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

                                            <option value="<?=$row->name?>" <?=($this->input->get_post('area') == $row->name ? 'selected' : '');?>><?= $row->name; ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="area_selection" style="display: none">
                                <label class="col-md-4">Area</label>

                                <div class="col-md-4">

                                    <input  onkeypress="return event.charCode > 48" min="1" max="20" class="min_area form-control searchfilter" name="min_area" type="number" placeholder="Min" value="<?=$this->input->get_post('min_area');?>">
                                </div>

                                <div class="col-md-4">
                                    <input onkeypress="return event.charCode > 48" min="1" max="20" class="max_area form-control searchfilter" name="max_area" type="number" placeholder="Max" value="<?=$this->input->get_post('max_area');?>">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="li">
                <?php if (isset($_GET['agent_location']) || isset($_GET['location'])) {?>
                        <button  class="btn btn-primary search_submit"><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                <?php } else {?>
                        <button class="btn btn-primary search_submit" disabled><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                <?php } ?>
            </div>
        </div>

        <div class="listing_search_filter" style="display:none;">
            <div class="dropdown keep-inside-clicks-open">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">By Owner <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><label class="checkbox-inline mr_check"><input class="searchfilter" name="user_type[]" type="checkbox" value="self"> <span class="checkmark"></span>  <?=$this->lang->line('byowner');?></label></li>
                    <li><label class="checkbox-inline mr_check"><input class="searchfilter" name="user_type[]" type="checkbox" value="agent"> <span class="checkmark"></span> <?=$this->lang->line('byagent');?></label></li>
                </ul>
            </div>
        </div>

    </form>
    <form id="form_for_ajax">
        <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
    </form>
    <div id="notice" class="agent-ser" style="display:none;"></div>
</div>
