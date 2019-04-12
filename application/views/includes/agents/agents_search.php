<form  typeof="post" id="agent_search_form">
<div class="range-block rang-form-block">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="form-group input-location input-icon">
                <input type="text" class="form-control" name="agent_location" id="agent_location" placeholder="Location" required>
            </div>
            <input type="hidden"  id="agent_street" name="street" value="" />
            <input type="hidden"  id="agent_city" name="city" value="" />
            <input type="hidden"  id="agent_state" name="state" value="" />
            <input type="hidden"  id="agent_state_code" name="state_code" value="" />
            <input type="hidden"  id="agent_country" name="country" value="" />
            <input type="hidden"  id="agent_zipcode" name="zipcode" value="" />
            <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group input-user input-icon">
                <input type="text" class="form-control" name="name" id="" placeholder="Name" >
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group input-font input-icon">
                <input type="text" class="form-control" name="languages" id="" placeholder="Languages" >
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group input-building input-icon">
                <select class="contact_select form-control" data-live-search="false" title="Home Type" name="home_type">
                    <option value=""> Select Home Type </option>
                    <option value="show all">Any</option>
                    <option value="houses">Houses</option>
                    <option value=apartments">Apartments</option>
                    <option value="condo/co-ops">Condo/co-ops</option>
                    <option value="townhomes">Townhomes</option>
                    <option value="manufactured">Manufactured</option>
                    <option value="lots/land">Lots/Land</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <input type="number" class="form-control" value="" min="1" name="price_min" placeholder="Min Price ($)" id="price_min" >
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <input type="number" class="form-control" value="" min="1" name="price_max" placeholder="Max Price ($)" id="price_max" >
            </div>
        </div>

        <div class="col-sm-12 col-xs-12">
            <button  class="btn btn-secondary btn-block" id="agent_search"> Search</button>
        </div>
    </div>
</div>
</form>