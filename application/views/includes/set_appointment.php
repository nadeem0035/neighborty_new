<div class="modal fade" id="set-appointment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title">Make an appointment for "<?=ucfirst($listing->title);?>"</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div id="responsemessage"></div>
                        <div class="col-md-12" id="calender_div" style="padding:0px;">
                            <div id="my-calendar"></div>
                        </div>

                        <div id="form-div" style="display:none;">
                            <form id="set_appointment" class="tbc-margins-adjust col-md-6" method="post" name="" style="position:relative;">
                                <div class="ajax-loader_icon" id="loading" style="display:;padding:43px 20px;" style="display: none">
                                    <img src="<?=base_url('assets/img/loading-spinner-default.gif');?>" />
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div id="waqas"></div>
                                    </div>


                                </div>

                            <?php
                                $session_data = $this->session->userdata('logged_in');
                                $uid = $session_data['id'];
                                $usertype = $session_data['user_type'];
                                $fullname = $session_data['first_name'].' '. $session_data['last_name'];
                            ?>

                            <div class="clearfix"></div>
                            <div class="form-group">
                                <span class="home-labels host-labels-adjust">Note</span>
                                <textarea  id="note_text" rows="6" required class="form-control" name="note_text" placeholder="Anything to Note? Features you're looking for? Who's moving? etc."></textarea>
                                <input type="hidden" name="listing_id" value="<?=$listing->id;?>">
                                <input type="hidden" name="applicant_id" value="<?=$uid;?>">
                                <input type="hidden" name="applicant_type" value="<?=$usertype;?>">
                                <input type="hidden" name="agent_id" value="<?=$listing->user_id;?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm pull-right">Set an Appointment</button>
                            <!--<button onclick="" class="btn btn-primary pull-right" style="padding:7px 10px;">SUBMIT</button>-->
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
