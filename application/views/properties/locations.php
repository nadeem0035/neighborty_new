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
                        <option value="<?=$city->id;?>"><?=$city->name;?></option>
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

    <div class="form-group no-margin-b pull-left">
        <label class="col-md-4 control-label property_area" for="city" style="display: none">Area <span>*</span></label>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 padding-b-15 property_area" style="display: none">
                    <select id="property_area" name="property_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true"  onchange="initializeMap()"></select>
                </div>

                <div class="col-md-3 padding-b-15 property_sub_area"  style="display: none">
                    <select id="property_sub_area" name="property_sub_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true"  onchange="initializeMap()"></select>
                </div>

                <div class="col-md-3 padding-b-15 property_sub_sub_area"  style="display: none">
                    <select id="property_sub_sub_area" name="property_sub_sub_area" class="form-control basic-single" data-show-subtext="true" data-live-search="true"></select>
                </div>

                <div class="col-md-1 ajax_loader" style="display: none">
                    <div id="page-loading"><div></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group no-margin-b pull-left">
        <div class="col-md-4" for="city"></div>
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
    <input type="hidden" id="area_location" name="area_location" >
    <input type="hidden" id="sub_area" name="sub_area" >
    <input type="hidden" id="sub_sub_area" name="sub_sub_area" >
    <input type="hidden" id="country" name="country" >
    <input type="hidden" id="state_province" name="state_province" >
    <input type="hidden" id="city" name="city" >
    <input type="hidden" id="latitude" name="lat" >
    <input type="hidden" id="longitude" name="lng" >


</div>