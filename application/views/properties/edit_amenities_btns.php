<div class="col-sm-12 form-group" id="warning"></div>
<div class="form-group">
    <div class="error_span">
        <label class="col-md-4 control-label" for="property-type">
            <?=$this->lang->line('property_type');?> <span>*</span>
        </label>
        <div class="col-md-6">
            <div class="property_type_radio btn-group" data-toggle="buttons">
                <label class="btn <?=($listing->purpose == 'sale') ? 'active' : '';?>"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="sale" name="purpose" <?=($listing->purpose == 'sale') ? 'checked' : '';?> />Sale</label>
                <label class="btn <?=($listing->purpose == 'rent') ? 'active' : '';?>"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="rent" name="purpose" <?=($listing->purpose == 'rent') ? 'checked' : '';?> />Rent</label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="error_span">
        <label class="col-md-4 control-label" for="property-type">
            <?=$this->lang->line('home_type');?> <span>*</span>
        </label>
        <div class="col-md-6">

            <div class="property_type_radio btn-group" data-toggle="buttons">
                <label class="btn <?=($listing->property_type == 'homes') ? 'active' : '';?>"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="homes" name="property_type" id="houses" <?=($listing->property_type == 'homes') ? 'checked' : '';?> />Homes</label>
                <label class="btn <?=($listing->property_type == 'plots') ? 'active' : '';?>"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="plots" name="property_type" id="plots" <?=($listing->property_type == 'plots') ? 'checked' : '';?> />Plots</label>
                <label class="btn <?=($listing->property_type == 'commercial') ? 'active' : '';?>"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="commercial" name="property_type" id="commercial" <?=($listing->property_type == 'commercial') ? 'checked' : '';?>/>Commercial</label>
            </div>

            <div class="property_type_radio sub_property_type padding-t-b-10 btn-group" data-toggle="buttons">
                <div class="home" id="house_details" style="display: none">
                    <label class="btn <?=($listing->property_sub_type == 'house') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','house')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="house" <?=($listing->property_sub_type == 'house') ? 'checked' : '';?>  />House</label>
                    <label class="btn <?=($listing->property_sub_type == 'Flat') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Flat')" type="radio" data-parent="homes" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Flat" <?=($listing->property_sub_type == 'Flat') ? 'checked' : '';?> />Flat</label>
                    <label class="btn <?=($listing->property_sub_type == 'Upper Portion') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Upper Portion')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Upper Portion" <?=($listing->property_sub_type == 'Upper Portion') ? 'checked' : '';?> />Upper Portion</label>
                    <label class="btn <?=($listing->property_sub_type == 'Lower Portion') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Lower Portion')"data-parent="homes"  type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Lower Portion" <?=($listing->property_sub_type == 'Lower Portion') ? 'checked' : '';?> />Lower Portion</label>
                    <label class="btn <?=($listing->property_sub_type == 'Farm House') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Farm House')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Farm House" <?=($listing->property_sub_type == 'Farm House') ? 'checked' : '';?> />Farm House</label>
                    <label class="btn <?=($listing->property_sub_type == 'Room') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Room')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Room" <?=($listing->property_sub_type == 'Room') ? 'checked' : '';?> />Room</label>
                    <label class="btn <?=($listing->property_sub_type == 'Penthouse') ? 'active' : '';?>"><input onchange="toggleAmenities('homes','Penthouse')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Penthouse" <?=($listing->property_sub_type == 'Penthouse') ? 'checked' : '';?> />Penthouse</label>
                </div>


                <div class="clearfix"></div>
                <div class="home" id="plot_details" style="display: none">

                    <label class="btn <?=($listing->property_sub_type == 'Residential Plot') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Residential Plot')" data-parent="plots"  type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Residential Plot" <?=($listing->property_sub_type == 'Residential Plot') ? 'checked' : '';?> />Residential Plot</label>
                    <label class="btn <?=($listing->property_sub_type == 'Commercial Plot') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Commercial Plot')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Commercial Plot" <?=($listing->property_sub_type == 'Commercial Plot') ? 'checked' : '';?> />Commercial Plot</label>
                    <label class="btn <?=($listing->property_sub_type == 'Agricultural Land') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Agricultural Land')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Agricultural Land" <?=($listing->property_sub_type == 'Agricultural Land') ? 'checked' : '';?> />Agricultural Land</label>
                    <label class="btn <?=($listing->property_sub_type == 'Industrial Land') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Industrial Land')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Industrial Land" <?=($listing->property_sub_type == 'Industrial Land') ? 'checked' : '';?> />Industrial Land</label>
                    <label class="btn <?=($listing->property_sub_type == 'Plot File') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Plot File')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Plot File" <?=($listing->property_sub_type == 'Plot File') ? 'checked' : '';?> />Plot File</label>
                    <label class="btn <?=($listing->property_sub_type == 'Plot Form') ? 'active' : '';?>"><input onchange="toggleAmenities('plots','Plot Form')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Plot Form" <?=($listing->property_sub_type == 'Plot Form') ? 'checked' : '';?> />Plot Form</label>
                </div>

                    <div class="clearfix"></div>

                <div class="home" id="commercial_details" style="display: none">

                    <label class="btn <?=($listing->property_sub_type == 'Office') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Office')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Office" <?=($listing->property_sub_type == 'Office') ? 'checked' : '';?> />Office</label>
                    <label class="btn <?=($listing->property_sub_type == 'Shop') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Shop')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Shop" <?=($listing->property_sub_type == 'Shop') ? 'checked' : '';?> />Shop</label>
                    <label class="btn <?=($listing->property_sub_type == 'Warehouse') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Warehouse')" type="radio" data-parent="commercial"  class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Warehouse" <?=($listing->property_sub_type == 'Warehouse') ? 'checked' : '';?> />Warehouse</label>
                    <label class="btn <?=($listing->property_sub_type == 'Factory') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Factory')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Factory" <?=($listing->property_sub_type == 'Factory') ? 'checked' : '';?> />Factory</label>
                    <label class="btn <?=($listing->property_sub_type == 'Building') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Building')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Building" <?=($listing->property_sub_type == 'Building') ? 'checked' : '';?> />Building</label>
                    <label class="btn <?=($listing->property_sub_type == 'Other') ? 'active' : '';?>"><input onchange="toggleAmenities('commercial','Other')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Other" <?=($listing->property_sub_type == 'Other') ? 'checked' : '';?> />Other</label>
                </div>
            </div>
        </div>
    </div>
</div>
