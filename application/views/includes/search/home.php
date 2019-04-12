<div class="container">
<div class="splash-search">
    <div class="search-col">
        <h1><?=$this->lang->line('home_search_heading');?></h1>
        <h2 class="banner-sub-title"><?=$this->lang->line('home_search_sub_heading');?></h2>
            <section class="advanced-search advance-search-header" style="background-color:transparent !important;box-shadow:none !important;">
                    <form method="get" class="search_form" action="<?=site_url("search")?>" id="" name="search_form">

                    <div class="form-group search-long">
                        <div class="search">
                           <!-- <select class="form-control basic-single" data-minimum-results-for-search="Infinity" name="city" id="search_city" onchange="if_value_is_changed();">
                                <option value="3">Los Angeles</option>
                                <option value="2">Santa Monica</option>
                                <option value="1">Anaheim</option>
                                <option value="4">Newport Beach</option>
                                <option value="5">San Diego</option>
                                <option value="6">San Jose</option>
                                <option value="7">San Francisco</option>

                            </select>-->

                            <div class="search input-search input-icon text-left" id="city_areas">
                                <input class="form-control area_by_city areas" type="text"  placeholder="Enter Location" id="areas">
                            </div>

                            <input type="hidden" name="sub_area" id="area-id">
                            <input type="hidden" name="page_view" value="grid">

                            <select id="property_type" name="property_type[]" title="Property Type(any)" id="" class="selectpicker bs-select-hidden" data-live-search="false">
                                <option value="sale">Sale</option>
                                <option value="rent">Rent</option>
                            </select>

                            <div class="advance-btn-holder">
                                <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> Advanced</button>
                            </div>
                        </div>
                        <div class="search-btn">
                            <button type="submit" onClick="return validate_search_form();" class="btn btn-secondary search_submit" disabled>
                               <?=$this->lang->line('find');?>
                            </button>
                        </div>
                    </div>

                    <div class="advance-fields">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6" style="display: none">
                                <div class="form-group">
                                    <!--
                                    <select class="selectpicker" data-live-search="false" title="By Owner" name="user_type[]" multiple>
                                        <option value="owner"><?=$this->lang->line('byowner');?> </option>
                                        <option value="agent"><?=$this->lang->line('byagent');?> </option>
                                    </select>
                                    -->
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker" id="type" data-live-search="false" title="Home Type" name="home_types[]" onchange="if_home_type_is_changed();">

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

                                                <option value="<?=$home_type->slug?>"><?= $home_type->name; ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6 bathrooms">
                                <div class="form-group">
                                    <select class="selectpicker home_dropdown" data-live-search="false" title="Bathrooms" name="bathrooms">
                                        <?php for($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if($this->input->get('bathrooms') == $i){ echo "selected"; }?>><?php echo $i; ?><?php if($i > 1) echo '+'; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6 bedrooms">
                                <div class="form-group">
                                    <select class="selectpicker home_dropdown" data-live-search="false" title="Bedrooms" name="bedrooms">
                                        <?php for($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if($this->input->get('bedrooms') == $i){ echo "selected"; }?>><?php echo $i; ?><?php if($i > 1) echo '+'; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group text-left">
                                    <input class="form-control" min="1" name="price_min" type="number" placeholder="Min Price">
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group text-left">
                                    <input class="form-control"  min="1" name="price_max" type="number" placeholder="Max Price">
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker" data-live-search="false" title="Land Area" name="area">
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
                            </div>

                            <div class="col-sm-2 col-xs-3">
                                <div class="form-group text-left">
                                    <input class="form-control" name="min_area" type="text" placeholder="Min Area">
                                </div>
                            </div>

                            <div class="col-sm-2 col-xs-3">
                                <div class="form-group text-left">
                                    <input class="form-control" name="max_area" type="text" placeholder="Max Area">
                                </div>
                            </div>


                            <?php if($this->router->fetch_class() != 'index'  && $this->router->fetch_method() != 'index') {?>

                                <div class="col-sm-12 col-xs-12 features-list text-left">

                                <label class="text-uppercase title">Other Amenities </label>
                                <div class="clearfix"></div>

                                <?php
                                $amenities = $this->crud_model->get(
                                    array(
                                        'fields'=>'id,name,type',
                                        'table'=>'amenities',
                                        'where'=>'active = 1 ',
                                    )
                                );
                                if( is_array($amenities) )
                                {
                                    foreach ($amenities as $amenity)
                                    {
                                        ?>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="<?=$amenity->id;?>" id="amenity_<?=$amenity->id; ?>"  name="amenities[]" /> <?= $amenity->name; ?>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>

                            </div>

                            <?php } ?>

                        </div>
                    </div>
                    <div id="notice" class="agent-ser"></div>
                </form>
            </section>
            <!--Mobile Version -->
            <section class="advanced-search-mobile visible-xs visible-sm" style="background-color:transparent !important;box-shadow:none !important; border-bottom:#FFF solid 1px;">

                    <div class="row">
                        <div class="col-sm-12">
                            <form method="GET" class="search_form text-left" action="<?=site_url("search")?>" id="" name="search_form">
                                <div id="mobile_canvas" style="width:100%; display:none; height:250px;"></div>
                                <div class="single-search-wrap">
                                    <div class="single-search-inner advance-btn">
                                        <button class="table-cell text-left" type="button"><i class="fa fa-gear"></i></button>
                                    </div>

                                    <input type="hidden" id="street" name="street" value="<?=$this->input->get('street');?>" />
                                    <input type="hidden" id="city" name="city" value="<?=$this->input->get('city');?>" />
                                    <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                                    <input type="hidden" id="state" name="state" value="<?=$this->input->get('state')?>" />
                                    <input type="hidden" id="country" name="country" value="<?=$this->input->get('country')?>" />




                                    <div class="single-search-inner single-search">
                                        <input class="form-control table-cell" name="location" id="mobile_location" type="text" placeholder="<?=$this->lang->line('search_city');?>" onkeyup="if_value_is_changed()">
                                    </div>
                                    <div class="single-search-inner single-seach-btn">
                                        <button type="submit" onClick="return validate_search_form();" class="table-cell text-right search_submit" disabled><i class="fa fa-search"></i></button>


                                    </div>
                                </div>

                                <div class="advance-fields">
                                    <div class="row">



                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <select name="property_type[]" title="For Sale" id="" class="selectpicker bs-select-hidden" data-live-search="false">
                                                    <option value="sale"><?=$this->lang->line('forsale');?></option>
                                                    <option value="rent"><?=$this->lang->line('forrent');?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <select class="selectpicker bs-select-hidden" data-live-search="false" title="By Owner" name="user_type[]" multiple>
                                                    <option value="owner"><?=$this->lang->line('byowner');?> </option>
                                                    <option value="agent"><?=$this->lang->line('byagent');?> </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <select class="selectpicker" id="type" data-live-search="false" title="Home Type" name="home_types[]">
                                                    <?php
                                                    $home_types = $this->crud_model->get(
                                                        array(
                                                            'fields'=>'id, name, active',
                                                            'table'=>'home_type',
                                                            'where'=>'active = 1 ',
                                                        )
                                                    );
                                                    if( is_array($home_types) )
                                                    {
                                                        foreach( $home_types as $home_type )
                                                        {
                                                            ?>

                                                            <option value="<?=$home_type->name?>"><?= $home_type->name; ?></option>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <select class="selectpicker" data-live-search="false" title="Bathrooms" name="bathrooms">
                                                    <?php for($i = 1; $i <= 12; $i++) { ?>
                                                        <option value="<?php echo $i; ?>" <?php if($this->input->get('bathrooms') == $i){ echo "selected"; }?>><?php echo $i; ?><?php if($i > 1) echo '+'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <select class="selectpicker" data-live-search="false" title="Bedrooms" name="bedrooms">
                                                    <?php for($i = 1; $i <= 10; $i++) { ?>
                                                        <option value="<?php echo $i; ?>" <?php if($this->input->get('bedrooms') == $i){ echo "selected"; }?>><?php echo $i; ?><?php if($i > 1) echo '+'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input class="form-control" min="1" name="price_min" type="number" placeholder="Min Price">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input class="form-control"  min="1" name="price_max" type="number" placeholder="Max Price">
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <select class="selectpicker" data-live-search="false" title="Land Area" name="area">
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
                                        </div>

                                        <div class="col-sm-3 col-xs-6">
                                            <div class="form-group text-left">
                                                <input class="form-control" name="price_minx" type="text" placeholder="Min Area">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="form-group text-left">
                                                <input class="form-control" name="price_max" type="text" placeholder="Max Area">
                                            </div>
                                        </div>


                                        <?php if($this->router->fetch_class() != 'index'  && $this->router->fetch_method() != 'index') {?>

                                            <div class="col-sm-12 col-xs-12 features-list text-left">

                                                <label class="text-uppercase title">Other Amenities </label>
                                                <div class="clearfix"></div>

                                                <?php
                                                $amenities = $this->crud_model->get(
                                                    array(
                                                        'fields'=>'id,name,type',
                                                        'table'=>'amenities',
                                                        'where'=>'active = 1 ',
                                                    )
                                                );
                                                if( is_array($amenities) )
                                                {
                                                    foreach ($amenities as $amenity)
                                                    {
                                                        ?>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value="<?=$amenity->id;?>" id="amenity_<?=$amenity->id; ?>"  name="amenities[]" /> <?= $amenity->name; ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>

                                        <?php } ?>


                                        <div class="col-sm-12 col-xs-12">
                                            <button type="submit" onClick="return validate_search_form();" class="btn btn-secondary btn-block" disabled>
                                                <i class="fa fa-search pull-left"></i> Search
                                            </button>
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

            </section>
    </div>
</div>
</div>