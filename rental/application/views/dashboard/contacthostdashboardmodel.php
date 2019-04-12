<!-- Modal for Upcoming Trips -->
<div id="ContactHostDashboard<?= $booking->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <a data-dismiss="modal"><img class="pull-right" src="<?= base_url() ?>assets/img/close.png"></a>
                <h4 class="modal-title">Contact Host</h4>
            </div>
            <div class="modal-body host-modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 host_img_section">
                            <img class="img-circle host-pic" src="<?= base_url() . users_avatar() . "small/" . $userdetail->picture; ?>">
                            <p class="host-message"><?= ucfirst($userdetail->first_name) . " " . $userdetail->last_name ?></p>
                            <hr>
                            <ul class="nav-sidebar-blog host-bullets">
                                <li>Tell <?= $userdetail->first_name ?> a little about yourself</li>
                                <li>What brings you here ?</li>
                                <li>Who's joining you ?</li>
                                <li>What do you love most about this listing?</li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <span class="host-body-title">when are you traveling?</span>
                            <div id="contact_response"></div>
                            <form class="tbc-margins-adjust" id="contacthostform">
                                <div class="form-field field-input field-select col-md-4">
                                    <label class="home-labels host-labels-adjust">CHECK IN</label>
                                    <div class="host-contact-adjust">
                                        <input type="text" class="field-input customized-field" required value="<?= $booking->check_in ?>" placeholder="mm/dd/yyyy" name="checkin2" id="checkin2">
                                    </div>
                                </div>
                                <div class="form-field field-input field-select col-md-4">
                                    <label class="home-labels host-labels-adjust">CHECK OUT</label>
                                    <div class="host-contact-adjust">
                                        <input type="text" class="field-input customized-field" required value="<?= $booking->check_out ?>" placeholder="mm/dd/yyyy" name="checkout2" id="checkout2">
                                    </div>
                                </div>
                                <div class="form-field field-select col-md-4">
                                    <label class="home-labels host-labels-adjust">GUESTS</label>
                                    <input type="number" class="field-input custom-host-input" min="1" value="<?= $booking->total_guest ?>" max="20" required name="noofguest">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-field form-field-host-area col-md-12">
                                    <label class="home-labels host-labels-adjust">DESCRIPTION</label>
                                    <textarea name="message" id="message" required class="field-input submit-host-textbar" placeholder="Write Your Thoughts"></textarea>
                                    <input type="hidden" name="receiver_id" value="<?= $listing->user_id ?>" />
                                    <input type="hidden" name="listing_id" value="<?= $listing->id ?>" />
                                    <div class="field-input host-submit">
                                        <button type="submit" id="contacthost" class="btn btn-default btn-sm">SUBMIT</button>
                                    </div>
                                </div>   
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer host-modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>