<div class="form-cn form-hotel tab-pane active in" id="form-hotel">
                             <form method="get" role="form" id="search_form" name="search_form" action="<?=site_url("search")?>">
                            <div class="form-search clearfix">                           
                            
               
<div class="form-field field-input">

<span class="home-labels home-form-defaults">SEARCH BY COUNTRY, CITY HERE</span>

<div id="shakemediv" class="home-form-defaults-inner">

<input class="field-input " type="text" name="location"   data-required="1"   id="location" placeholder="Where do you want to go?" />
</div>
 <span class="help-block"></span>
</div>
<div id="map_canvas" style="width:100%; display:none; height:250px;"></div>  
                        <input type="hidden" id="street" name="street" value="" />
                        <input type="hidden" id="city" name="city" value="" />
                        <input type="hidden" id="state" name="state" value="" />
                        <input type="hidden" id="state_code" name="state_code" value="" />
                        <input type="hidden" id="country" name="country" value="" />
                        <input type="hidden" id="zipcode" name="zipcode" value="" />
                              
       <div>                          
<div class="form-field field-date">

<span class="home-labels home-form-defaults">CHECK IN</span>

<div class="home-form-defaults-inner">
    <input type="text" class="field-input" id="checkin" name="checkin" placeholder="mm/dd/yyyy" >
               </div>
            </div>
            <div class="form-field field-date">
<span class="home-labels home-form-defaults">CHECK OUT</span>

<div class="home-form-defaults-inner">
    <input type="text" name="checkout" id="checkout" class="field-input " placeholder="mm/dd/yyyy" >
               </div>
            </div>
         </div>
         <div class="form-field">
<span class="home-labels home-form-defaults">GUESTS</span>
            <div id="home_guests" >
            <input type="number"  class="field-input"   min="1" max="100" value="1" id="no_of_guests" name="no_of_guests" />
            </div>
         </div>
         <div class="form-submit">
            <button type="submit" class="awe-btn awe-btn-1 awe-btn-small searchMainBtn">Search</button>
         </div>
      </div>
   </form>
</div>