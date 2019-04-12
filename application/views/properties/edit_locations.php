<?php if($listing->property_location){ ?>
<div class="form-group">
    <div class="error_span">
        <label class="col-md-4 control-label" for="property-title">
            location <span>*</span>
        </label>
        <div class="col-md-5">
            <input autocomplete="off" disabled class="form-control" value="<?=($listing->property_location) ? $listing->property_location : '';?>" placeholder="<?=$this->lang->line('title');?>" required>
        </div>

    </div>
</div>
<?php } ?>

<div id="map_section">

    <div class="form-group">
        <div class="error_span">
            <label class="col-md-4 control-label" for="city">
                <?=$this->lang->line('city');?> <span>*</span>
            </label>


            <div class="col-md-4">

                <select id="property_city" name="property_city" class="form-control basic-single" data-show-subtext="true" data-live-search="true" required="" onchange="initializeMap()">
                    <option value=""></option>
                    <?php foreach($cities as $city):?>
                        <option <?=($listing->city == $city->id ) ? 'selected' : '';?> value="<?=$city->id;?>"><?=$city->name;?></option>
                    <?php endforeach;?>
                </select>

            </div>
            <div class="col-md-1">
                <div id="page-loading" style="display: none">
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label property_area" for="city" style="display: none">
            Area <span>*</span>
        </label>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 property_area" style="display: none">
                    <select id="property_area" name="property_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true" required="" onchange="initializeMap()"></select>
                </div>

                <div class="col-md-3 property_sub_area"  style="display: none">
                    <select id="property_sub_area" name="property_sub_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true" required onchange="initializeMap()"></select>
                </div>

                <div class="col-md-3 property_sub_sub_area"  style="display: none">
                    <select id="property_sub_sub_area" name="property_sub_sub_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true" required></select>
                </div>

                <div class="col-md-1 ajax_loader" style="display: none">
                    <div id="page-loading"><div></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label" for="city"></label>
        <div class="col-md-5">
            <div class="locatoin location_breadcrump padding-b-15" style="display: none">
                <ol class="breadcrumb">
                    <li><strong>Selected Location:</strong></li>
                    <li class="pcountry"></li>
                    <li class="pstate"></li>
                    <li class="pcity"></li>
                    <!--<li class=""></li>-->
                    <li class="active"></li>
                </ol>
            </div>
            <div style="width:100%;height: 250px; display: none" class="map_canvas" id="map_canvas"></div>
        </div>
    </div>
    <input type="hidden" id="area_location" name="area_location" value="<?=($listing->property_location) ?  $listing->property_location : '';?>" >
    <input type="hidden" id="sub_area" name="sub_area" value="">
    <input type="hidden" id="sub_sub_area" name="sub_sub_area" value="" >
    <input type="hidden" id="country" name="country" value="<?=($listing->country) ? $listing->country : '';?>">
    <input type="hidden" id="state_province" name="state_province" value="<?=($listing->state_province) ? $listing->state_province : '';?>" >
    <input type="hidden" id="city" name="city" value="<?=($listing->city) ? $listing->city : '';?>" >
    <input type="hidden" id="latitude" name="lat" value="<?=($listing->latitude) ? $listing->latitude : '';?>" >
    <input type="hidden" id="longitude" name="lng"value="<?=($listing->longitude) ? $listing->longitude : '';?>" >


</div>
<script>

    window.onload = initializlocations;

    function initializlocations() {
        console.log('dfjdfjh');
        var val = $("#property_city option:selected").text();
        console.log(val);
        if (val != 'select') {

            var id = $("#property_city option:selected").val();
            console.log(id);
            if (id) {
                getCitiesArea(id);
            } else {
                $('select[name="property_area"]').empty();
                $('.property_area').hide();
                $('select[name="property_sub_area"]').empty();
                $('.property_sub_area').hide();
            }
        }

        composeTitleForProperty();
        initializeMap();




            var cat_type = $(".property_sub_type").val();
            var list_id = $("#listing_id").val();
            var parent_id = $(".property_sub_type").attr("data-parent");
        

            var formUrl = site_url + 'listings/selectEditAmenities';
            if(cat_type){
                $.ajax(
                    {
                        url: formUrl,
                        type: 'POST',
                        data: {'cat_type':cat_type,parent_id:parent_id, list_id:list_id},
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