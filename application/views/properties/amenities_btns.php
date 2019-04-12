<div class="col-sm-12 form-group" id="warning"></div>
<div class="form-group">
    <div class="error_span">
        <label class="col-md-4 control-label" for="property-type">
            <?=$this->lang->line('property_type');?> <span>*</span>
        </label>
        <div class="col-md-6">
            <div class="property_type_radio btn-group" data-toggle="buttons">
                <label class="btn"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="sale" name="purpose" />Sale</label>
                <label class="btn"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="rent" name="purpose" />Rent</label>
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
                <label class="btn"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="homes" name="property_type" id="houses" />Homes</label>
                <label class="btn"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="plots" name="property_type" id="plots" />Plots</label>
                <label class="btn"><input onchange="toggleVisibalities()" type="radio" class="option-input radio create_property_title" value="commercial" name="property_type" id="commercial"/>Commercial</label>
            </div>

            <div class="property_type_radio sub_property_type btn-group" data-toggle="buttons">
                <div class="home padding-top-10" id="house_details" style="display: none">
                    <label class="btn"><input onchange="toggleAmenities('homes','house')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="house"  />House</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Flat')" type="radio" data-parent="homes" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Flat" />Flat</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Upper Portion')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Upper Portion" />Upper Portion</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Lower Portion')"data-parent="homes"  type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Lower Portion" />Lower Portion</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Farm House')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Farm House" />Farm House</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Room')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Room" />Room</label>
                    <label class="btn"><input onchange="toggleAmenities('homes','Penthouse')" data-parent="homes" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Penthouse" />Penthouse</label>
                </div>

                <div class="clearfix"></div>

                <div class="home padding-top-10" id="plot_details" style="display: none">

                    <label class="btn"><input onchange="toggleAmenities('plots','Residential Plot')" data-parent="plots"  type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Residential Plot" />Residential Plot</label>
                    <label class="btn"><input onchange="toggleAmenities('plots','Commercial Plot')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Commercial Plot" />Commercial Plot</label>
                    <label class="btn"><input onchange="toggleAmenities('plots','Agricultural Land')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Agricultural Land" />Agricultural Land</label>
                    <label class="btn"><input onchange="toggleAmenities('plots','Industrial Land')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Industrial Land" />Industrial Land</label>
                    <label class="btn"><input onchange="toggleAmenities('plots','Plot File')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Plot File" />Plot File</label>
                    <label class="btn"><input onchange="toggleAmenities('plots','Plot Form')" data-parent="plots" type="radio" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Plot Form" />Plot Form</label>

                </div>
                <div class="clearfix"></div>
                <div class="home padding-top-10" id="commercial_details" style="display: none">

                    <label class="btn"><input onchange="toggleAmenities('commercial','Office')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Office" />Office</label>
                    <label class="btn"><input onchange="toggleAmenities('commercial','Shop')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Shop" />Shop</label>
                    <label class="btn"><input onchange="toggleAmenities('commercial','Warehouse')" type="radio" data-parent="commercial"  class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Warehouse" />Warehouse</label>
                    <label class="btn"><input onchange="toggleAmenities('commercial','Factory')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Factory" />Factory</label>
                    <label class="btn"><input onchange="toggleAmenities('commercial','Building')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Building" />Building</label>
                    <label class="btn"><input onchange="toggleAmenities('commercial','Other')" type="radio" data-parent="commercial" class="option-input radio create_property_title property_sub_type" name="property_sub_type" value="Other" />Other</label>
                </div>
            </div>
        </div>
    </div>
</div>