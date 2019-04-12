<div class="add-tab-row push-padding-bottom">

    <h5 class="title_form">Property Details</h5>

    <div class="row no-gutter">

        <div class="form-group">
            <div class="error_span">
                <label class="col-md-4 control-label" for="property-title">
                    House/Plot #
                </label>
                <div class="col-md-5">
                    <input autocomplete="off" class="form-control" id="house_no" name="house_number" value="<?=($listing->house_number) ? $listing->house_number : '';?>" placeholder="House/Plot Number">
                </div>

            </div>
        </div>


        <div class="form-group">
            <div class="error_span">
                <label class="col-md-4 control-label" for="property_street">
                    Street
                </label>
                <div class="col-md-5">
                    <input autocomplete="off" class="form-control" id="property_street" name="property_street" value="<?=($listing->property_street) ? $listing->property_street : '';?>" placeholder="Street Address" >
                </div>

            </div>
        </div>
        <?php

        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $unique_no =  $startDate + $rand

        ?>


        <div class="form-group">
            <div class="error_span">
                <label class="col-md-4 control-label" for="property-title">
                    <?=$this->lang->line('title');?> <span>*</span>
                </label>
                <div class="col-md-5">
                    <input autocomplete="off" readonly class="form-control" id="property_title" name="property_title" value="<?=($listing->title) ? $listing->title : '';?>" placeholder="<?=$this->lang->line('title');?>" required>
                </div>
                <input type="hidden"  id="unique_no" name="unique_no" value="<?=$unique_no;?>" >

            </div>
        </div>

        <div class="form-group">
            <div class="error_span">
                <label class="col-md-4 control-label" for="description">
                    <?=$this->lang->line('description');?> <span>*</span>
                </label>
                <div class="col-md-5">
                    <textarea class="form-control" id="" name="summary" value="<?=($listing->summary) ? $listing->summary : '';?>" rows="4" placeholder="<?=$this->lang->line('description');?>" required ><?=($listing->summary) ? $listing->summary : '';?></textarea>
                </div>

            </div>
        </div>

        <div class="form-group">

            <div class="error_span">
                <label class="control-label col-sm-4">
                    <?=$this->lang->line('unit');?> <span>*</span>
                </label>
                <div class="col-sm-2">
                    <select name="unit_id" id="unit_id" onchange="landArea()"  class="form-control basic-hide-search" data-show-subtext="false" data-live-search="false" required>
                        <option value="">Select</option>
                        <option <?=($listing->unit_id == 'Square Feet') ? 'selected' : '';?> value="Square Feet"><?=$this->lang->line('square_feet');?></option>
                        <option <?=($listing->unit_id == 'Square Yards') ? 'selected' : '';?> value="Square Yards"><?=$this->lang->line('square_yard');?></option>
                        <option <?=($listing->unit_id == 'Square Meters') ? 'selected' : '';?> value="Square Meters"><?=$this->lang->line('square_meter');?></option>
                        <option <?=($listing->unit_id == 'Marla') ? 'selected' : '';?> value="Marla"><?=$this->lang->line('marla');?></option>
                        <option <?=($listing->unit_id == 'Kanal') ? 'selected' : '';?> value="Kanal"><?=$this->lang->line('kanal');?></option>
                        <option <?=($listing->unit_id == 'Acre') ? 'selected' : '';?> value="Acre"><?=$this->lang->line('acre');?></option>
                    </select>
                </div>
            </div>


            <div class="error_span">
                <label class="col-sm-1 control-label" for="">
                    <?=$this->lang->line('landing_area');?> <span>*</span>
                </label>

                <div class="col-sm-2">
                    <input class="form-control count_nbr" onchange="landArea()" type="number" min="1" max="100" id="land_area" name="land_area" placeholder="<?=$this->lang->line('landing_area');?>" value="<?=($listing->land_area) ? $listing->land_area : '';?>">

                </div>
            </div>


        </div>



        <div id="rooms">
            <div class="form-group">
                <div class="error_span">
                    <label class="col-sm-4 control-label" for="">
                        <?=$this->lang->line('bedroom');?> <span>*</span>
                    </label>
                    <div class="col-sm-2">
                        <input type="number" name="bedrooms" class="form-control count_nbr" placeholder="<?=$this->lang->line('bedroom');?>"  min="1" max="10" value="<?=($listing->bedrooms) ? $listing->bedrooms : '';?>"  />
                    </div>
                </div>

                <div class="error_span">
                    <label class="control-label col-sm-1">
                        <?=$this->lang->line('bathrooms');?> <span>*</span>
                    </label>
                    <div class="col-sm-2">
                        <input type="number" name="bathrooms" class="form-control count_nbr" placeholder="<?=$this->lang->line('bathrooms');?>" required="" min="1" max="10" onKeyPress="if(this.value.length==2) return false;" value="<?=($listing->bathrooms) ? $listing->bathrooms : '';?>"  />
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group">
            <div class="error_span">
                <label class="col-sm-4 control-label" for=""><?=$this->lang->line('price');?> <span>*</span></label>
                <div class="col-sm-5">
                    <input autocomplete="off" class="form-control count_nbr" type="text" id="price" name="price" placeholder="Price"  value="<?=($listing->price) ? $listing->price : '';?>" >
                    <p class="price_text">
                        <br>
                        <span class="add_new_price"></span>
                    </p>
                </div>
            </div>

        </div>


        <?php $session_data = $this->session->userdata('logged_in'); ?>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="">Expires After:</label>
            <div class="col-sm-5">
                <select name="expires" id="expires"  class="form-control basic-hide-search">
                    <option></option>
                    <option <?=($listing->expires == 1) ? 'selected' : '';?> value="1">1 Month</option>
                    <option <?=($listing->expires == 3) ? 'selected' : '';?> value="3">3 Months</option>
                    <option <?=($listing->expires == 6) ? 'selected' : '';?> value="6">6 Months</option>
                </select>
            </div>
        </div>

        <div class="form-group">

            <div class="error_span">
                <label class="col-sm-4 control-label" for="">Contact Number:</label>
                <div class="col-sm-2">
                    <div class="">
                        <input type="tel" id="phone" name="contact_primary" class="form-control"  autocomplete="off" value="<?=($listing->contact_primary) ? $listing->contact_primary : '';?>" required />
                    </div>
                </div>
            </div>
            <label class="control-label col-sm-1">
                Contact #2:
            </label>
            <div class="col-sm-2">
                <div class="input-icon">
                    <input type="tel" id="phone2" name="contact_secondary" class="form-control phone_number"  autocomplete="off" value="<?=($listing->contact_secondary) ? $listing->contact_secondary : '';?>" />
                </div>
            </div>
        </div>



        <div class="form-group amenities_list">
            <label class="col-sm-4 control-label" for="">Amenities:</label>
            <div class="col-sm-5">
                <a href="#addAmenities" data-toggle="modal" class="btn btn-secondary add_amenities_btn">Add Features</a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="videoImageUrl">
                <?=$this->lang->line('video_url');?> <span title="" data-placement="right" data-toggle="tooltip" data-original-title="Only youtube Video link"><i class="fa fa-question"></i></span>
            </label>
            <div class="col-sm-5">
                <input type="url" class="form-control" id="videoUrl" autocomplete="off" name="video" value="<?=($listing->video) ? $listing->video : '';?>" placeholder="<?=$this->lang->line('vurl');?>">
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="files" name="listing_files">