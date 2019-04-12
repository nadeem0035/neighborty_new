<section class="destinations" style="">
         <div class="container" style="">
            <div class="row">
               <div class="col-md-12">
                  <section class="breakcrumb-sc" id="mobile-tbc-height">
                      <div class="col-md-4 col-md-offset-1">
                        <span class="home-labels main-search-labels">Search By Country, City</span>
                        <div  id="shakemediv" style="background: rgba(2, 3, 4, 0.61);border: 1px solid #D6D6D6; padding:10px 10px 10px 10px;border-radius:4px;">
                           <input type="text"  class="main-searchby-field" name="location"  value="<?=$this->input->get('location')?>" id="location" placeholder="Where do you want to go?">
                        </div>
                        <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>
                        <input type="hidden" id="street" name="street" value="<?=$this->input->get('street')?>" />
                        <input type="hidden" id="city" name="city" value="<?=$this->input->get('city')?>" />
                        <input type="hidden" id="state" name="state" value="<?=$this->input->get('state')?>" />
                        <input type="hidden" id="state_code" name="state_code" value="<?=$this->input->get('state_code')?>" />
                        <input type="hidden" id="country" name="country" value="<?=$this->input->get('country')?>" />
                        <input type="hidden" id="zipcode" name="zipcode" value="<?=$this->input->get('zipcode')?>" />
                     </div>
                        <div class="form-field field-input field-select col-md-2">
                           <span class="home-labels main-search-labels" >Check In...</span>
                           <div style="background: rgba(2, 3, 4, 0.61);border: 1px solid #D6D6D6; padding:10px 10px 10px 10px; border-radius:4px;">
                              <input type="text" class="field-input main-checkin-field" value="<?=$this->input->get('checkin')?>" placeholder="mm/dd/yyyy" name="checkin" id="checkin" /> 
                              <i class="fa fa-calendar float-right white-color-review custom-two-margin"></i>
                           </div>
                        </div>
                        <div class="form-field field-input field-select col-md-2">
                           <span class="home-labels main-search-labels">Check Out...</span>
                           <div style="background: rgba(2, 3, 4, 0.61);border: 1px solid #D6D6D6; padding:10px 10px 10px 10px; border-radius:4px;">
                              <input type="text" class="field-input field-input main-checkout-field" value="<?=$this->input->get('checkout')?>" placeholder="mm/dd/yyyy" name="checkout" id="checkout" /> 
                              <i class="fa fa-calendar float-right white-color-review custom-two-margin"></i>  
                           </div>
                        </div>
                     <div class="form-field  col-md-1">
                        <span  class="home-labels main-search-labels">Guests...</span>
                        <div id="home_guests_sub"  >
                        <input type="number"  class="field-input " value="<?=$this->input->get('no_of_guests')?>"  min="1" max="100" id="no_of_guests" name="no_of_guests" />
                        </div>               
                     </div>
                     <div class="form-field field-select col-md-1">
                        <div class="form-submit">
                           <button type="submit" class="awe-btn awe-btn-1 awe-btn-small main-search-submit">Search</button>
                        </div>
                     </div>
                   </section>
               </div>
            </div>
         </div>
      </section>