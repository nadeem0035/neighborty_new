<div class="title-wrap mobile-title-wrap">
<!--   <form method="GET" action="--><?//=site_url("search")?><!--" id="search_form" name="search_form">-->
<!--       <input type="hidden" id="sw_lat"  name="sw_lat"  />-->
<!--       <input type="hidden" id="sw_lng"  name="sw_lng"  />-->
<!--       <input type="hidden" id="ne_lat"  name="ne_lat"  />-->
<!--       <input type="hidden" id="ne_lng"  name="ne_lng"  />-->
<!--       <input type="hidden" id="search_by_map"  name="search_by_map"  />-->
<!--       <input type="hidden" id="search_by_map"  name="property_type" value="--><?//=$_GET['type'];?><!--"  />-->
      <?php $this->load->view('templates/quick_searchform');  ?>
      <section  class="destinations tbc-custom-desig">
         <div class="container" >
            <div class="row">
               <div class="col-md-12">
                  <section class="search_form_attr">
                     <!-- Checkboxes -->
                      <div class="col-md-6 col-md-offset-1">
                        <div class="portlet-body">
                           <div class="row">

                     <div class="col-md-3">
                        <div>
                           <div class="select">
                              <!--<select name="bedrooms" id="bedrooms" class="tbc-bedrooms-field">
                                 <option value="">BEDROOMS</option>
                                 <?php /*for($i = 1; $i <= 16; $i++) { */?>
                                 <option value="<?php /*echo $i; */?>" <?php /*if($this->input->get('bedrooms') == $i){ echo "selected"; }*/?>><?php /*echo $i; */?> Bedroom<?php /*if($i > 1) echo 's'; */?></option>
                                 <?php /*} */?>
                              </select>-->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div>
                           <div class="select">
                              <!--<select name="bathrooms" id="bathrooms" class="tbc-bedrooms-field">
                                 <option value="">BATHROOMS</option>
                                 <option value="0" <?php /*if($this->input->get('bathrooms') == 0){ echo "selected"; }*/?>>0 Bathrooms</option>
                                 <option value="0.5" <?php /*if($this->input->get('bathrooms') == 0.5){ echo "selected"; }*/?>>0.5 Bathrooms</option>
                                 <option value="1" <?php /*if($this->input->get('bathrooms') == 1){ echo "selected"; }*/?>>1 Bathroom</option>
                                 <option value="1.5" <?php /*if($this->input->get('bathrooms') == 1.5){ echo "selected"; }*/?>>1.5 Bathrooms</option>
                                 <option value="2" <?php /*if($this->input->get('bathrooms') == 2){ echo "selected"; }*/?>>2 Bathrooms</option>
                                 <option value="2.5" <?php /*if($this->input->get('bathrooms') == 2.5){ echo "selected"; }*/?>>2.5 Bathrooms</option>
                                 <option value="3" <?php /*if($this->input->get('bathrooms') == 3){ echo "selected"; }*/?>>3 Bathrooms</option>
                                 <option value="3.5" <?php /*if($this->input->get('bathrooms') == 3.5){ echo "selected"; }*/?>>3.5 Bathrooms</option>
                                 <option value="4" <?php /*if($this->input->get('bathrooms') == 4){ echo "selected"; }*/?>>4 Bathrooms</option>
                                 <option value="4.5" <?php /*if($this->input->get('bathrooms') == 4.5){ echo "selected"; }*/?>>4.5 Bathrooms</option>
                                 <option value="5" <?php /*if($this->input->get('bathrooms') == 5){ echo "selected"; }*/?>>5 Bathrooms</option>
                                 <option value="5.5" <?php /*if($this->input->get('bathrooms') == 5.5){ echo "selected"; }*/?>>5.5 Bathrooms</option>
                                 <option value="6" <?php /*if($this->input->get('bathrooms') == 6){ echo "selected"; }*/?>>6 Bathrooms</option>
                                 <option value="6.5" <?php /*if($this->input->get('bathrooms') == 6.5){ echo "selected"; }*/?>>6.5 Bathrooms</option>
                                 <option value="7" <?php /*if($this->input->get('bathrooms') == 7){ echo "selected"; }*/?>>7 Bathrooms</option>
                                 <option value="7.5" <?php /*if($this->input->get('bathrooms') == 7.5){ echo "selected"; }*/?>>7.5 Bathrooms</option>
                                 <option value="8" <?php /*if($this->input->get('bathrooms') == 8){ echo "selected"; }*/?>>8+ Bathrooms</option>
                              </select>-->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div>
                           <div class="select">
                              <!--<select name="beds" id="beds"  class="tbc-bedrooms-field">
                                 <option value="">BEDS</option>
                                 <?php /*for($i = 1; $i <= 16; $i++) { */?>
                                 <option value="<?php /*echo $i; */?>" <?php /*if($this->input->get('beds') == $i){ echo "selected"; }*/?>><?php /*echo $i; */?> Bed<?php /*if($i > 1) echo 's'; */?></option>
                                 <?php /*} */?>
                              </select>-->
                           </div>
                        </div>
                     </div>
                            </div>
                        </div>
                     </div>
                     <!-- CHeckboxes -->
                     <div class="col-md-3">
                        <div class="tbc-price-slide">
                           <div id="slider-range" class="slider bg-blue">
                           </div>
                           <div>
                             <!-- Price Range between: <span id="slider-range-amount"></span>
                              <input type="hidden" name="price_min" id="price_min" value="5" />
                              <input type="hidden" name="price_max" id="price_max" value="1500" />-->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1">
                        <div class="tbc-more-filters">
                           <div><!--<span><a id="more_link" href="javascript:">MORE FILTERS</a></span>-->
                           </div>
                        </div>
                     </div>
                   </section> 
               </div>
            </div>
            <div class="row notshown" id="more_filters">
               <div class="col-md-12">
                   

                  <!-- Home Type Checkboxes -->



               </div>
            </div>
         </div>
      </section>

<!--   </form>-->
</div>