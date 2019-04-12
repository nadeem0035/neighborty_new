
<div class="modal fade" id="companyInfo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title">Company Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

                                <div class="form-small">
                                    <div class="alert alert-success" style="display:none;"></div>


                                    <form id="contact_agent" class="form" novalidate="novalidate">
                                        <div class="form-group">
                                            <label class="form-contral">Full Name *</label>
                                            <input type="text" class="form-control" name="poster_name" value="" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-contral">Email *</label>
                                            <input type="email" class="form-control" name="poster_email" value="" required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-contral">Phone *</label>
                                            <input type="text" class="form-control" name="poster_phone" value="" required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-contral">Reason *</label>
                                            <select class="form-control" name="reason_to_contact">
                                                <option value="general">General Inquiry</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-contral">Message *</label>
                                            <textarea required="" name="message" rows="3" class="form-control"></textarea>
                                        </div>


                                        <input type="hidden" name="agent_id" value="<?=$agent->id;?>">
                                        <input type="hidden" name="email" value="<?=$agent->email;?>">
                                        <input type="hidden" name="agent_name" value="<?=$agent->first_name.' ' .$agent->last_name;?>">
                                        <button onclick="contactAgent();" class="btn btn-secondary  apply_property_class" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Send</button>
                                        <button type="button" class="btn_cancel btn btn-secondary" data-dismiss="modal">Close</button>

                                        <div class="form-group"><div id="recm_response"></div></div>
                                    </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>