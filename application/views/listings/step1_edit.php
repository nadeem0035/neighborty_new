<?php if( $this->session->flashdata('listError') )
{ ?>
    <div class="alert alert-danger">
        <?php  echo $this->session->flashdata('listError'); ?>
    </div>
<?php  } ?>

    <form id="addListing" method="post" action="">
        <input type="hidden" name="id" value="<?= @$listing->id; ?>">
        <input type="hidden" id="listing_id" value="<?= @$listing->id; ?>">
        <div class="account-block">
            <div class="add-title-tab">
                <h3><?=$this->lang->line('my_properties');?></h3>
                <div class="add-expand"></div>
            </div>
            <div class="add-tab-content">
                <div class="add-tab-row  push-padding-bottom">

                    <div class="row">

                        <div class="col-sm-12 form-group" id="warning"></div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input required id="geocomplete" type="text" onfocusout="validatelatlon()" name="geocomplete" value="<?=@$listing->typed_address;?>" class="form-control pull-left"/>
                            </div>
                        </div>
                        <div id="map_section">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <div style="width:100%;height: 250px;margin-top: 15px;" class="map_canvas" id="map_canvas"></div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address"><?=$this->lang->line('type_address');?></label>
                                        <input class="form-control" id="route" name="route" placeholder="<?=$this->lang->line('type_address');?>" required value="<?= @$listing->address_line_2; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="neighborhood"><?=$this->lang->line('location');?></label>
                                        <input class="form-control" id="street_address" name="street_address" placeholder="<?=$this->lang->line('location');?>"  value="<?= @$listing->address_line_1; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city"><?=$this->lang->line('city');?></label>
                                        <input class="form-control" id="locality" name="locality" placeholder="<?=$this->lang->line('city');?>" required="" value="<?= @$listing->city_town; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="countryState"><?=$this->lang->line('province');?></label>
                                        <input class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" placeholder="<?=$this->lang->line('province');?>" required="" type="text" value="<?= str_replace("\'","'",@$listing->state_province); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="zip"><?=$this->lang->line('zipcode');?></label>
                                        <input class="form-control" id="postal_code" name="postal_code"  type="text" value="<?= @$listing->zip_postal_code; ?>" placeholder="<?=$this->lang->line('zipcode');?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="country"><?=$this->lang->line('country');?></label>
                                        <input name="country" id="country" class="form-control" type="text" required="" value="<?= @$listing->country; ?>" placeholder="<?=$this->lang->line('country');?>">
                                    </div>
                                </div>
                                <input type="hidden" name="lat" id="lat" value="<?= @$listing->latitude; ?>">
                                <input type="hidden" name="lng" id="lng" value="<?= @$listing->longitude; ?>">
                                <input type="hidden" name="active" value="Pending">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-block">
            <div class="add-title-tab">
                <h3>Property description</h3>
                <div class="add-expand"></div>
            </div>
            <div class="add-tab-content">
                <div class="add-tab-row push-padding-bottom">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="property-title"><?=$this->lang->line('title');?></label>
                                <input class="form-control" id="property-title" name="listing_name" value="<?= @$listing->listing_name; ?>" placeholder="<?=$this->lang->line('title');?>" required>
                                <input type="hidden" value="<?= @$listing->id; ?>"  name="listing_id"  id="listing_id"/>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description"><?=$this->lang->line('description');?></label>
                                <textarea class="form-control" id="txt-content" name="summary" rows="6" placeholder="<?=$this->lang->line('description');?>" required ><?= @strip_tags($listing->summary) ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-type"><?=$this->lang->line('status');?></label>
                                <select name="status" class="form-control">
                                    <option <?=@$listing->status == 'available' ? "selected" : "" ?> value="available"><?=$this->lang->line('available');?></option>
                                    <option <?=@$listing->status == 'sold' ? "selected" : "" ?> value="sold"><?=$this->lang->line('sold');?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-type"><?=$this->lang->line('listing_owner');?></label>
                                <select name="listing_owner" class="form-control">
                                    <option <?=@$listing->listing_owner == 'self' ? "selected" : "" ?> value="self"><?=$this->lang->line('myself');?></option>
                                    <option <?=@$listing->listing_owner == 'agent' ? "selected" : "" ?> value="agent"><?=$this->lang->line('agent');?></option>
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-4">
                        </div>

                        <?php if(!empty($package_stats)):?>

                            <?php if($package_stats[0]->featured == 0){ ?>
                                <div class="col-sm-4 fea-err" style="display: none;">
                                    <input type="checkbox" name="is_featured" value="" id="is_featured">
                                    <label for="is_featured">Is Featured</label>
                                </div>
                            <?php  }else { ?>
                                <div class="col-sm-4 fea-err">
                                    <input type="checkbox" name="is_featured" value="featured" id="is_featured">
                                    <label for="is_featured">Is Featured</label>
                                </div>
                            <?php } ?>
                        <?php endif;?>


                    </div>
                </div>
                <div class="add-tab-row push-padding-bottom">
                    <div class="row">
                        <div class="col-sm-4">
                            <?php if(empty($listing)){ ?>
                                <div class="form-group">
                                    <label for="property-type"><?=$this->lang->line('home_type');?> </label>
                                    <select class="form-control" id="type" data-live-search="false" title="Home Type" name="home_type">
                                        <option value="">Select</option>
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

                            <?php } else { ?>

                                <div class="form-group">
                                    <label for="property-type"><?=$this->lang->line('home_type');?> </label>
                                    <select class="form-control" id="type" data-live-search="false" title="Home Type" name="home_type">
                                        <option value="">Select</option>
                                        <option value="Home" <?=@$listing->home_type == 'Home' ? "selected" : "" ?>>Houses</option>
                                        <option value="Plots" <?=@$listing->home_type == 'Plots' ? "selected" : "" ?>>Plots</option>
                                        <option value="Commercial" <?=@$listing->home_type == 'Commercial' ? "selected" : "" ?>>Commercial Plots</option>
                                    </select>

                                </div>

                            <?php } ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-status"><?=$this->lang->line('bedroom');?></label>
                                <input type="number" name="bedrooms" class="form-control" placeholder="<?=$this->lang->line('bedroom');?>" required="" min="1" max="20" value="<?= @$listing->bedrooms; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-status"><?=$this->lang->line('bathrooms');?></label>
                                <input type="number" name="bathrooms" class="form-control" placeholder="<?=$this->lang->line('bathrooms');?>" required="" min="1" max="15" value="<?= @$listing->bathrooms; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-status"><?=$this->lang->line('rooms');?></label>
                                <input type="number" name="pieces" class="form-control" placeholder="<?=$this->lang->line('rooms');?>" required="" min="1" max="20" value="<?= @$listing->pieces; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-status"><?=$this->lang->line('kitchen');?></label>
                                <input type="number" name="toilets" class="form-control" placeholder="<?=$this->lang->line('kitchen');?>"  min="1" max="15" value="<?= @$listing->kitchen; ?>" />
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-type"><?=$this->lang->line('property_type');?></label>
                                <select name="property_type" class="form-control">
                                    <option <?=@$listing->property_type == 'rent' ? "selected" : "" ?> value="rent"><?=$this->lang->line('rent');?></option>
                                    <option <?=@$listing->property_type == 'sale' ? "selected" : "" ?> value="sale"><?=$this->lang->line('sale');?></option>
                                    <!-- <option <?=@$listing->property_type == 'any' ? "selected" : "" ?> value="any">Any</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-price"><?=$this->lang->line('price');?></label>
                                <input class="form-control" type="number" min="1" id="priced" name="price" placeholder="Price" value="<?= @$listing->price; ?>">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-price"><?=$this->lang->line('landing_area');?></label>
                                <input class="form-control" type="number" min="1" id="area" name="area" placeholder="<?=$this->lang->line('landing_area');?>" value="<?= @$listing->area; ?>">
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="property-price"><?=$this->lang->line('unit');?></label>
                                <select name="unit" id="unit"  class="form-control">
                                    <option <?=@$listing->unit == 'Square Feet' ? "selected" : "" ?> value="Square Feet"><?=$this->lang->line('square_feet');?></option>
                                    <option <?=@$listing->unit == 'Square Yards' ? "selected" : "" ?> value="Square Yards"><?=$this->lang->line('square_yard');?></option>
                                    <option <?=@$listing->unit == 'Square Meters' ? "selected" : "" ?> value="Square Meters"><?=$this->lang->line('square_meter');?></option>
                                    <option <?=@$listing->unit == 'Marla' ? "selected" : "" ?> value="Marla"><?=$this->lang->line('marla');?></option>
                                    <option <?=@$listing->unit == 'Kanal' ? "selected" : "" ?> value="Kanal"><?=$this->lang->line('kanal');?></option>
                                    <option <?=@$listing->unit == 'Acre' ? "selected" : "" ?> value="Acre"><?=$this->lang->line('acre');?></option>
                                </select>

                            </div>
                        </div>


                        <input type="hidden" name="price_type" id="currency_type" value="">
                        <input type="hidden" name="measurement_type" id="measurement_type" value="">

                        <!--
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="property-status"><?=$this->lang->line('refrence_link');?></label>
                            <input type="text" name="reference" class="form-control" placeholder="<?=$this->lang->line('refrence_link');?>" value="<?= @$listing->reference; ?>" />
                        </div>
                    </div>
                    -->

                    </div>
                </div>
            </div>
        </div>

        <div class="account-block">
            <div class="add-title-tab">
                <h3><?=$this->lang->line('select_amenities');?></h3>
                <div class="add-expand"></div>
            </div>
            <div class="add-tab-content">
                <div class="add-tab-row push-padding-bottom">
                    <div class="row" id="amenities_box">
                        <!-- <?php
                        /*                   foreach( $amenities as $amenitie) {
                                               */?>
                       <div class="col-sm-4">
                           <div class="checkbox">
                               <?php
                        /*                               if (isset($old_amenities) && $old_amenities != NULL) {
                                                           if (in_array($amenitie->id, @$old_amenities)) {
                                                               $check = True;
                                                           } else {
                                                               $check = False;
                                                           }
                                                       } else {
                                                           $check = False;
                                                       }
                                                       echo form_checkbox('amenities[]', $amenitie->id, $check, "id ='" . $amenitie->id . "'");
                                                       echo "<label for ='" . $amenitie->id . "'>" . $amenitie->name . "</label>";
                                                       */?>

                               <label for="<?/*= $amenitie->id; */?>">
                                   <?/*= form_checkbox('amenities[]', $amenitie->id, $check, "id ='" . $amenitie->id . "'"); */?>
                                   <?/*= $amenitie->name; */?>
                               </label>
                           </div>
                       </div>
                       --><?php
                        /*                   }

                                            */?>

                    </div>
                </div>
            </div>
        </div>

        <!--
    <div class="account-block">
        <div class="add-title-tab">
            <h3><?=$this->lang->line('req_qualifications');?></h3>
            <div class="add-expand"></div>
        </div>
        <div class="add-tab-content">
            <div class="add-tab-row push-padding-bottom">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="req_qualify"><?=$this->lang->line('requirements');?></label>
                            <textarea class="form-control" id="req_qualify" name="req_qua" rows="6" placeholder="<?=$this->lang->line('requirements');?>"><?= @strip_tags($listing->req_qualify) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->

        <div class="account-block">
            <div class="add-title-tab">
                <h3><?=$this->lang->line('property_video');?></h3>
                <div class="add-expand"></div>
            </div>
            <div class="add-tab-content">
                <div class="add-tab-row push-padding-bottom">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="table-list">
                                <div class="form-group table-cell full-width" style="padding-right: 8px;">
                                    <label for="videoImageUrl"><?=$this->lang->line('video_url');?><span title="" data-placement="right" data-toggle="tooltip" data-original-title="Only youtube Video link"><i class="fa fa-question"></i></span></label>
                                    <input type="url" class="form-control" id="videoUrl" name="video" value="<?=@$listing->video;?>" placeholder="<?=$this->lang->line('vurl');?>">
                                </div>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="account-block text-right">
            <button type="submit" class="btn btn-primary submit">Continue</button>
        </div>

    </form>

<?php if ($this->uri->segment(2) == 'edit') { ?>
    <script>

        window.onload = GetAllProperties;
        function GetAllProperties() {

            var cat_type = $("#type").val();
            var list_id = $('#listing_id').val();
            var formUrl = site_url + 'listings/selectEditAmenities';
            if(cat_type){
                $.ajax(
                    {
                        url: formUrl,
                        type: 'POST',
                        data: {'cat_type':cat_type,'list_id':list_id},
                        beforeSend: function(){
                            $('#amenities_box').html('');
                        },
                        success: function (data, textSatus, jqXHR)
                        {
                            $('#amenities_box').html(data);

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log('Fileupload error');
                        }
                    });
            }

        }


    </script>
<?php } ?>