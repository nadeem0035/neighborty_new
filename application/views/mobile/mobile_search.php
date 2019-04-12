<!--Mobile View-->
<section class="advanced-search-mobile showen listing_search">
    <div class="container-fluid">
        <form method="GET" class="search_form text-left" action="<?=site_url("search")?>" id="search_listing_form" name="search_form" novalidate>
            <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
            <input type="hidden" id="page_view" class="page_view" name="page_view" value="grid" />
            <input type="hidden" id="" name="listing_type" class="listing_type" value="<?=$this->input->get('type')?>" />
            <input type="hidden" id="list_type" name="list_type" value="<?=$this->input->get('type')?>" />
            <input type="hidden" name="ajax" value="1" />
            <input type="hidden" name="ajax_value" value="1" />

            <div class="single-search-wrap">
                <div class="single-search-inner advance-btn">
                    <button class="table-cell text-left" type="button"><i class="fa fa-gear"></i></button>
                </div>
                <div class="single-search-inner single-search">

                    <div class="search text-left" id="city_areas">
                        <input class="form-control area_by_city areas" type="text"  placeholder="Enter Location" value="<?=$areaName?>" id="areas">
                    </div>


                    <input type="hidden" name="sub_area" id="area-id">
                    <input type="hidden" name="page_view" value="grid">
                </div>
                <div class="single-search-inner single-seach-btn">
                    <button type="submit" onClick="return validate_search_form();" class="table-cell text-right" disabled><i class="fa fa-search"></i></button>
                </div>
            </div>

            <div class="advance-fields">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
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
                            <?= ($city_id == '' ? '<option value=""></option>' : '');?>
                            <?php foreach($cities as $city ): ?>

                                <option <?= ($city->id == $city_id ? 'Selected' : '');?>  value="<?=$city->id;?>"><?=$city->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <?php
                $property_type = $this->input->get_post('property_type');
                $ptype = $this->input->get_post('type');
                $hometypes = $this->input->get_post('home_types');
                ?>

                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
                        <select id="property_type" name="property_type[]" title="Property Type" class="basic-single" data-live-search="false" data-minimum-results-for-search="Infinity">
                            <option value="all" <?=(in_array('',$property_type) ?'Selected':'');?>>All</option>
                            <option value="sale" <?=(in_array('sale',$property_type) ?'Selected':'' || ($ptype == 'sale') ?'Selected':'' );?>>Sale</option>
                            <option value="rent" <?=(in_array('rent',$property_type) ?'Selected':'' || ($ptype == 'rent') ?'Selected':'' );?>>Rent</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
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
                </div>

                <div class="col-sm-3 col-xs-12">
                    <div class="form-group">
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
                                            <div class="force-overflow">

                                                <a class="min_value value_0" value="0" href="javascript:void(0)">0</a>
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
                                        </div>
                                    </div>

                                    <div class="price_Ranges rangesMax">
                                        <div class="scrollbar" id="style-3">
                                            <div class="force-overflow">

                                                <a class="max_value value_0" value="0" href="javascript:void(0)">0</a>
                                                <a class="max_value" value="500000" href="javascript:void(0)">500,000</a>
                                                <a class="max_value" value="1000000" href="javascript:void(0)">1,000,000</a>
                                                <a class="max_value" value="2000000" href="javascript:void(0)">2,000,000</a>
                                                <a class="max_value" value="3500000" href="javascript:void(0)">3,500,000</a>
                                                <a class="max_value" value="5000000" href="javascript:void(0)">5,000,000</a>
                                                <a class="max_value" value="6500000" href="javascript:void(0)">6,500,000</a>
                                                <a class="max_value" value="8000000" href="javascript:void(0)">8,000,000</a>
                                                <a class="max_value" value="10000000" href="javascript:void(0)">10,000,000</a>
                                                <a class="max_value" value="12500000" href="javascript:void(0)">12,500,000</a>
                                                <a class="max_value" value="15000000" href="javascript:void(0)">15,000,000</a>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="btnClear">
                                    <a href="javascript:void(0)" class="btn btn-dark btn-sm">Clear</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="beds" style="<?=(in_array('commercial',$hometypes) ? 'display: none;':'' || in_array('plots',$hometypes) ? 'display: none;':'') ;?>" >
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input type="number" onkeypress="return event.charCode > 48" min="1" max="20" class="form-control searchfilter" name="bathrooms" id="bathrooms"  placeholder="Min Baths" value="<?=$this->input->get_post('bathrooms');?>" />
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input type="number" onkeypress="return event.charCode > 48" min="1" max="20" class="form-control searchfilter" name="bedrooms" id="bedrooms"  placeholder="Min Beds" value="<?=$this->input->get_post('bedrooms');?>" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
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
                </div>

                <div class="area_selection" style="display: none">
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input  onkeypress="return event.charCode > 48" min="1" max="20" class="min_area form-control searchfilter" name="min_area" type="number" placeholder="Min" value="<?=$this->input->get_post('min_area');?>">
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input onkeypress="return event.charCode > 48" min="1" max="20" class="max_area form-control searchfilter" name="max_area" type="number" placeholder="Max" value="<?=$this->input->get_post('max_area');?>">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <?php if (isset($_GET['agent_location']) || isset($_GET['location'])) {?>
                        <button  class="btn btn-primary search_submit"><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                    <?php } else {?>
                        <button class="btn btn-primary search_submit" disabled><i class="fa fa-search visible-xs"></i> <span class="hidden-xs">Search</span></button>
                    <?php } ?>
                </div>
            </div>
        </form>

        <div class="page-title">
            <div class="view_left">
                <button type="button" class="btn pull-left btn-link all <?=( (in_array('sale',$property_type) && in_array('rent',$property_type) || empty($property_type) && empty($p_type) ) ? 'active': '');?>" id="all" onclick="filterProperties(this,'any')" href="javascript:void(0)"><?=$this->lang->line('sr_tb_all');?></button>
                <button type="button" class="btn pull-left btn-link sale <?=(in_array('sale',$property_type) && !in_array('rent',$property_type) || $p_type == 'sale' && $p_type !== 'rent'   ?'active':'');?>" id="sale" onclick="filterProperties(this,'sale')" href="javascript:void(0)"><?=$this->lang->line('cw_sale');?></button>
                <button type="button" class="btn pull-left btn-link rent <?=(in_array('rent',$property_type) && !in_array('sale',$property_type) || $p_type == 'rent' && $p_type !== 'sale' ?'active':'');?>" id="rent" onclick="filterProperties(this,'rent')" href="javascript:void(0)"><?=$this->lang->line('cw_rent');?></button>
            </div>
            <div class="view">
                <div class="table-cell">
                    <lable class="pull-left">Show Map:</lable>
                    <label class="bs-switch">
                        <input type="checkbox" data-toggle="toggle" class="togglebtn" name="togglebtn">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</section>