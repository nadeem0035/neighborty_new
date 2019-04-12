<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .form-horizontal .form-group {
        margin: 5px 0px !important;
    }
    .space10 {
        margin: 15px 0px !important;
    }
    .text-left input {
        text-align: left !important;
    }
</style>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!-- END HEADER -->
    <div class="clearfix"></div>
    <!-- BEGIN CONTENT -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
        <!-- END SIDEBAR -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                Widget settings form goes here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE HEAD -->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Add New Listing <small>You are steps away to add your listing</small></h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD -->
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue" id="form_wizard_1">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> <?= $title; ?> - <span class="step-title">
                                        Step 1 of 4  </span> <div id="stepid"></div>
                                </div>
                            </div>
                            <div class="portlet-body form" id="fileupload">
                                <?php
                                $attributes = array('class' => 'form-horizontal', 'id' => 'submit_form');
                                echo form_open_multipart('listings/listing_images_upload', $attributes);
                                ?>

                                <div class="form-wizard form-body">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                    <span class="number">
                                                        1 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i> Basic</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number">
                                                        2 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i> Images </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step">
                                                    <span class="number">
                                                        3 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i>Availability</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab" class="step">
                                                    <span class="number">
                                                        4 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i> Confirm </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success">
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div id="listing_response"></div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                Your form validation is successful!
                                            </div>
                                            <div class="tab-pane active" id="tab1">
                                                <h3 class="block">Provide your Listing details</h3>

                                                <div class="row">													
                                                    <div class="col-md-1"></div>
                                                    <!-- Start Column Md -->
                                                    <div class="col-md-4">
                                                        <label class="control-label">Room type
                                                            <span class="required">* </span>
                                                        </label>
                                                        <?php echo form_dropdown('room_type', $room_types, @$listing->room_type, 'class="form-control"'); ?>
                                                    </div>
                                                    <!-- End Column Md -->

                                                    <!-- Start Column Md -->
                                                    <div class="col-md-3">
                                                        <label class="control-label">Home type
                                                            <span class="required">* </span>
                                                        </label>
                                                        <?php echo form_dropdown('home_type', $home_types, @$listing->home_type, 'class="form-control"'); ?>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">Accommodates
                                                            <span class="required">* </span>
                                                        </label>
                                                        <input type="number" name="accommodates" class="form-control" min="1" max="20" required="" value="<?= @$listing->accommodates; ?>" /> 
                                                    </div>
                                                    <!-- End Column Md -->
                                                    <div class="col-md-1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div  class="row">													
                                                    <div class="col-md-1"></div>
                                                    <!-- Start Column Md -->
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Bedrooms
                                                            <span class="required">* </span>
                                                        </label>
                                                        <input type="number" name="bedrooms" class="form-control" required="" min="1" max="20" value="<?= @$listing->bedrooms; ?>" /> 
                                                    </div>
                                                    <!-- End Column Md -->
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">Beds
                                                            <span class="required">* </span>
                                                        </label>
                                                        <input type="number" name="beds" class="form-control" min="1" required="" max="20" value="<?= @$listing->beds; ?>" /> 
                                                    </div>
                                                    <!-- End Column Md -->

                                                    <!-- Start Column Md -->
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">Bathrooms
                                                            <span class="required">* </span>
                                                        </label>
                                                        <input type="number" name="bathrooms" class="form-control" required="" min="1" max="15" value="<?= @$listing->bathrooms; ?>" /> 
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row">													
                                                    <div class="col-md-1"></div>
                                                    <!-- Start Column Md -->
                                                    <div class="form-group col-md-5">
                                                        <label class="control-label">Listing name
                                                            <span class="required">* </span>
                                                        </label>
                                                        <input type="text" class="form-control" required="" name="listing_name"  value="<?= @$listing->listing_name; ?>" />
                                                    </div>
                                                    <!-- End Column Md -->
                                                    <!-- Start Column Md -->
                                                    <div class="form-group col-md-5">
                                                        <label class="control-label">Summary about your listing
                                                            <span class="required">* </span>
                                                        </label>
                                                        <textarea name="summary" class="form-control" required="" ><?= @strip_tags($listing->summary) ?></textarea>
                                                    </div>
                                                    <!-- End Column Md -->
                                                    <div class="col-md-1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row">													
                                                    <div class="col-md-1"></div>
                                                    <!-- Start Column Md -->
                                                    <div class="col-md-10">
                                                        <label class="control-label">Type address
                                                            <span class="required">* </span>
                                                        </label>
                                                    </div> 
                                                    <div class="col-md-offset-1 col-md-4">
                                                        <div class="col-md-1"></div>

                                                        <input id="geocomplete" type="text" name="geocomplete"  class="form-control pull-left"  value="<?php
                                                        if (isset($listing->typed_address)) {
                                                            echo $listing->typed_address;
                                                        } else {
                                                            echo "134 East 27th Street, New York, NY 10016, United States";
                                                        }
                                                        ?>" />
                                                    </div> 
                                                    <div class="col-md-1">
                                                        <input id="find" type="button" class="btn default" value="find" />

                                                    </div>
                                                    <!-- End Column Md -->
                                                    <div class="col-md-1"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="row" id="map_section">

                                                    <div class="col-md-1"></div>
                                                    <!-- Start Column Md -->
                                                    <div  class="col-md-4">
                                                        <div style="height: 250px;margin-top: 15px;" class="map_canvas"></div>
                                                    </div>
                                                    <!-- End Column Md -->

                                                    <!-- Start Column Md -->
                                                    <div class="col-md-6" >
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Address Line 1
                                                                <span class="required">* </span>
                                                            </label>
                                                            <input name="route" class="form-control" type="text" required="" value="<?= @$listing->address_line_1; ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Address Line 2

                                                            </label>
                                                            <input name="street_address" class="form-control" type="text" value="<?= @$listing->address_line_2; ?>">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">City/Town
                                                                <span class="required">* </span>
                                                            </label>
                                                            <input name="locality" class="form-control" type="text" required="" value="<?= @$listing->city_town; ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">State/Province
                                                                <span class="required">* </span>
                                                            </label>
                                                            <input name="administrative_area_level_1" class="form-control" required="" type="text" value="<?= @$listing->state_province; ?>">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Zip/Postal code
                                                                <span class="required">* </span>
                                                            </label>
                                                            <input name="postal_code" class="form-control" required="" type="text" value="<?= @$listing->zip_postal_code; ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Country
                                                                <span class="required">* </span>
                                                            </label>
                                                            <input name="country" class="form-control" type="text" required="" value="<?= @$listing->country; ?>">
                                                        </div> 
                                                        <div class="clearfix"></div>
                                                        <input type="hidden" name="lat" value="<?= @$listing->latitude; ?>">

                                                        <input type="hidden" name="lng" value="<?= @$listing->longitude; ?>">
                                                    </div>


                                                    <!-- End Column Md -->

                                                    <div class="col-md-1"></div>

                                                    <div class="clearfix"></div>

                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">Upload front photo for the listing</h3>

                                                <div class="form-group">													

                                                    <!-- Start Column Md -->
                                                    <?php
                                                    if (isset($listing->preview_image_url) && $listing->preview_image_url != NULL) {
                                                        $pimage = base_url() . "assets/media/listings/search_thumbs/" . $listing->preview_image_url;
                                                        $required = '';
                                                    } else {
                                                        $pimage = base_url() . 'assets/img/listing.jpg';
                                                        $required = 'required';
                                                    }
                                                    ?>
                                                    <div class="col-md-3" id="image_preview">
                                                        <img id="previewing" width="220px" height="200px" src="<?= $pimage; ?>">
                                                    </div>


                                                    <!-- End Column Md -->
                                                    <!-- Start Column Md -->
                                                    <div class="col-md-7">
                                                        <h4>Clear photos are an important way for hosts and guests to learn about listing. It's not much fun to host a landscape! Please upload a photo that clearly shows your listing.</h4>
                                                        <hr>
                                                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                        <div class="row fileupload-buttonbar">
                                                            <div class="col-lg-7">
                                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                                <span class="btn green fileinput-button">
                                                                    <i class="fa fa-plus"></i>
                                                                    <span>
                                                                        Browse Picture... </span>
                                                                    <input type="file"  id="listing_file" name="listingfile" <?= $required ?> >
                                                                </span>
                                                                <button type="button" onclick="submitFile()" class="btn blue start">
                                                                    <i class="fa fa-upload"></i>
                                                                    <span>
                                                                        Upload & Save </span>
                                                                </button> 
                                                                <!-- The global file processing state -->
                                                                <span class="fileupload-process">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!-- End Column Md -->
                                                        <div class="col-md-1"></div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <br><hr>
                                                </div>



                                                <h3 class="block">Upload More Images&nbsp;<span> (Needs to add 4 more photos,minimum requied size 720 x 480px)</span></h3>

                                                <div class="row fileupload-buttonbar">
                                                    <div class="col-lg-7">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                                        <span class="btn green fileinput-button">
                                                            <i class="fa fa-plus"></i>
                                                            <span>
                                                                Add files... </span>
                                                            <input type="file" name="userfile" id="userfile"  multiple="">
                                                        </span>
                                                        <button type="submit" class="btn blue start">
                                                            <i class="fa fa-upload"></i>
                                                            <span>
                                                                Start upload </span>
                                                        </button>
                                                        <button type="reset" class="btn warning cancel">
                                                            <i class="fa fa-ban-circle"></i>
                                                            <span>
                                                                Cancel upload </span>
                                                        </button>
                                                        <button type="button" class="btn red delete">
                                                            <i class="fa fa-trash"></i>
                                                            <span>
                                                                Delete </span>
                                                        </button>
                                                        <input type="checkbox" class="toggle">
                                                        <!-- The global file processing state -->
                                                        <span class="fileupload-process">
                                                        </span>
                                                    </div>
                                                    <!-- The global progress information -->
                                                    <div class="col-lg-5 fileupload-progress fade">
                                                        <!-- The global progress bar -->
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;">
                                                            </div>
                                                        </div>
                                                        <!-- The extended global progress information -->
                                                        <div class="progress-extended">
                                                            &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                                <table role="presentation" class="table table-striped clearfix">
                                                    <tbody class="files">
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <h3 class="block">Provide listing availability calendar details</h3>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Choose listing availability option: <span class="required" >*</span></label>
                                                    <div class="col-md-4">
                                                        <select name="availability_through" id="availability_through" required="" class="form-control">
                                                            <option value="">Select... </option>
                                                            <option value="Calendar">Select from Calendar </option>
                                                            <option value="Manual">Select Manual</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="Manual" class="space10">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Choose number of month availability: <span class="required" >*</span></label>
                                                        <div class="col-md-4">
                                                            <select name="availability_month" class="form-control">
                                                                <option value="1">One Month</option>
                                                                <option value="2">Two Month</option>
                                                                <option value="3">Three Month</option>
                                                                <option value="4">Four Month</option>
                                                                <option value="5">Five Month</option>
                                                                <option value="6">Six Month</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <div class="space10">
                                                            <label class="control-label col-md-4" for="price">Price per night ($):<span class="required" >*</span></label> 
                                                            <div class="col-md-4">
                                                                <input type="number" class="form-control" value="" name="listing_price" required=""/>                           
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="clear"></div>
                                                <div id="Calendar" class="space10">
                                                    <div class="form-group">
                                                        <div id="backend"></div>  
                                                    </div>
                                                </div>
                                                <div class="clear"></div>

                                                <!--<div class="form-group date-picker input-daterange" data-date-start-date="+0d" data-date-format="yyyy-mm-dd">
                                                    <label class="control-label col-md-1" for="from">From <span class="required">
                                                            * </span></label> 

                                                    <div class="col-md-4 text-left">
                                                        <input type="text" class="form-control" name="from" value="<?= @$listing->available_from; ?>" required=""/>                           
                                                    </div>

                                                    <label class="control-label col-md-2" for="to">To<span class="required">
                                                            * </span></label> 

                                                    <div class="col-md-4 text-left">
                                                        <input type="text" class="form-control" name="to" value="<?= @$listing->available_to; ?>" required=""/>                           
                                                    </div>
                                                </div> -->

                                                <div class="form-group">
                                                    <div class="space10">
<!--                                                    <label class="control-label col-md-1" for="price">Price<span class="required" >
                                                            * </span></label> 

                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" value="5" name="price" id="price" value="<?= @$listing->price; ?>" required=""/>                           
                                                    </div>-->

                                                        <label class="col-md-10" for="additional_note">Additional Note </label> 

                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="additional_note" rows="5" name="additional_note" ><?= @strip_tags($listing->additional_note) ?></textarea>                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3 class="block">Select Amenities</h3>
                                                <div class="form-group">
                                                    <div class="col-md-12">   
                                                        <?php foreach ($amenities as $amenitie) { ?>

                                                            <div class="col-md-3">
                                                                <?php
                                                                if (isset($old_amenities) && $old_amenities != NULL) {
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
                                                                ?>
                                                            </div>         
                                                        <?php } ?>

                                                    </div>
                                                </div>   

                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">Confirm your listings</h3>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Listing Preview</label>
                                                    <div class="col-md-4">
                                                        <div class="form-control-static" id="listing_preview"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Listing name:</label>
                                                    <div class="col-md-4">
                                                        <p class="form-control-static" data-display="listing_name">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Location:</label>
                                                    <div class="col-md-4">
                                                        <p class="form-control-static" data-display="geocomplete">
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Listing Status:</label>
                                                    <div class="col-md-4">
                                                        <?php echo form_dropdown('active', array('Pending' => 'Pending', 'Publish' => 'Publish'), @$listing->active, 'class="form-control" id="l_active"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="m-icon-swapleft"></i> Back </a>

                                                <a href="javascript:;" class="btn blue button-next">
                                                    Continue <i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                                <a href="javascript:;" class="btn green button-submit">
                                                    Submit <i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
        </div>
    </div>

    <!-- END CONTAINER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
        <td>
        <span class="preview"></span>
        </td>
        <td>
        <p class="name">{%=file.name%}</p>
        <span class="error text-danger label label-danger"></span>
        </td>
        <td>
        <p class="size">Processing...</p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
        </div>
        </td>
        <td>
        {% if (!i && !o.options.autoUpload) { %}
        <button class="btn blue start" disabled>
        <i class="fa fa-upload"></i>
        <span>Start</span>
        </button>
        {% } %}
        {% if (!i) { %}
        <button class="btn red cancel">
        <i class="fa fa-ban"></i>
        <span>Cancel</span>
        </button>
        {% } %}
        </td>
        </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
        <td>
        <span class="preview">
        {% if (file.thumbnailUrl) { %}
        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
        {% } %}
        </span>
        </td>
        <td>
        <p class="name">
        {% if (file.url) { %}
        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
        {% } else { %}
        <span>{%=file.name%}</span>
        {% } %}
        </p>
        {% if (file.error) { %}
        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
        {% } %}
        </td>
        <td>
        <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
        {% if (file.deleteUrl) { %}
        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
        <i class="fa fa-trash-o"></i>
        <span>Delete</span>
        </button>
        <input type="checkbox" name="delete" value="1" class="toggle">
        {% } else { %}
        <button class="btn yellow cancel btn-sm">
        <i class="fa fa-ban"></i>
        <span>Cancel</span>
        </button>
        {% } %}
        </td>
        </tr>
        {% } %}
    </script>
    <!-- BEGIN CORE PLUGINS -->

