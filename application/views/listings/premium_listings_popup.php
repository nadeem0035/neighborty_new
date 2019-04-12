<div class="modal fade" id="requestModel" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contact Us For Premium Listings</h4>
            </div>
            <div class="modal-body" style="overflow: unset;width: 100%;float: left;">

                <form class="<?=site_url('premium-listing-request');?>" action="" id="listing_request_form" method="post">

                    <input type="hidden" value="" name="listing_id" id="listing_id">


                    <div class="form-group">
                        <label class="control-label">Package</label>
                        <select class="form-control" name="package">
                            <option value="">Choose...</option>
                            <?php foreach($packages as $package):?>

                                <option value="<?=$package->id;?>"><?=$package->name.'-'.$package->duration;?> </option>

                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Message:</label>
                        <textarea class="form-control" required="required" name="message"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary advertise_btn" onclick="premiumListingRequest()">Submit</button>


                </form>
            </div>

        </div>

    </div>
</div>