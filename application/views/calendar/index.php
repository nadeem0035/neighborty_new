<?php
include('includes/loader.php');
$_SESSION['token'] = time();
$_SESSION['uid'] = $_SESSION['logged_in']['id'];
?>

    <!-- Calendar Modal -->
    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="details-body-title"></h4>
            </div>

            <div class="modal-body">

                <div class="loadingDiv"></div>

                <!-- QuickSave/Edit FORM -->
                <form id="modal-form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Title:</label>
                                <input class="form-control" name="title" value="" type="text">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" rows="4" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Category:</label>
                                <input type="text" class="form-control input-sm" value="" name="" id="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Event Color:</label>
                                <input type="text" class="form-control input-sm" value="#587ca3" name="color" id="colorp">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-6">
                            <div class="form-group" id="repeat-type-select">
                                <label class="control-label">Repeat:</label>
                                <select id="repeat_select" name="repeat_method" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="every_day">Every Day</option>
                                    <option value="every_week">Every Week</option>
                                    <option value="every_month">Every Month</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="repeat-type-selected">
                                <label class="control-label">Times:</label>
                                <select id="repeat_times" name="repeat_times" class="form-control">
                                    <option value="1" selected>1</option>
                                    <?php
                                    for($i = 2; $i <= 30; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        $session_data = $this->session->userdata('logged_in');
                        $uid = $session_data['id']

                        ?>
                        <input type="hidden" class="form-control input-sm" value="<?=$uid;?>" name="user_id" id="user_id">

                        <div class="col-md-6">
                            <div class="form-group" id="event-type-select">
                                <label class="control-label">Type:</label>
                                <select id="event-type" name="all-day" class="form-control">
                                    <option value="true">Make event 24H (all day)</option>
                                    <option value="false">Make event as I wish</option>

                                </select>
                            </div>
                        </div>

                        <div id="event-type-selected">
                            <div class="col-md-3">
                                <div class="form-group" id="event-type-select">
                                    <label class="control-label">Start Date:</label>
                                    <input type="text" name="start_date" class="form-control input-sm" placeholder="Y-M-D" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="event-type-select">
                                    <label class="control-label">Start Time:</label>
                                    <input type="text" class="form-control input-sm" name="start_time" placeholder="HH:MM" id="startTime">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="event-type-select">
                                    <label class="control-label">End Date:</label>
                                    <input type="text" class="form-control input-sm" name="end_date" placeholder="Y-M-D" id="endDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="event-type-select">
                                    <label class="control-label">End Time:</label>
                                    <input type="text" class="form-control input-sm" name="end_time" placeholder="HH:MM" id="endTime">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="custom-fields">
                        <?php
                        //  $form->generate();
                        ?>
                    </div>
                </form>

                <!-- Modal Details -->
                <div id="details-body">
                    <div id="details-body-content"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="export-event" class="btn btn-warning">Export</button>
                <button type="button" id="delete-event" class="btn btn-danger">Delete</button>
                <button type="button" id="edit-event" class="btn btn-info">Edit</button>
                <button type="button" id="add-event" class="btn btn-primary">Add</button>
                <button type="button" id="save-changes" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


    <!-- Modal Delete Prompt -->
    <div id="cal_prompt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-option="remove-this">Delete this</a>
                <a href="#" class="btn btn-danger" data-option="remove-repetitives">Delete all</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Prompt -->
<div id="cal_edit_prompt_save" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body-custom"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-info" data-option="save-this">Save this</a>
                <a href="#" class="btn btn-info" data-option="save-repetitives">Save all</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="cal_import" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body-import" style="white-space: normal;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Import Event</h4>

                <p class="help-block">Copy & Paste the event code from your .ics file, open it using an text editor</p>
                <textarea class="form-control" rows="10" id="import_content" style="margin-bottom: 10px;"></textarea>
                <input type="button" class="pull-right btn btn-info" onClick="calendar.calendarImport()" value="Import" />
            </div>
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>

    <!-- Modal Edit Prompt -->
    <div id="cal_edit_prompt_save" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body-custom modal-body"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-info" data-option="save-this">Save this</a>
                <a href="#" class="btn btn-info" data-option="save-repetitives">Save all</a>
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Import Modal -->
    <div id="cal_import" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Event</h4>
            </div>
            <div class="modal-body-import modal-body" style="white-space: normal;">
        	    <p class="help-block">Copy & Paste the event code from your .ics file, open it using an text editor</p>
                <textarea class="form-control" rows="10" id="import_content" style="margin-bottom: 10px;"></textarea>
                <input type="button" class="pull-right btn btn-info" onClick="calendar.calendarImport()" value="Import" />
            </div>
        </div>

        </div>
    </div>


<input type="hidden" name="cal_token" id="cal_token" value="<?php echo $_SESSION['token']; ?>" />
<input type="hidden" name="agent_id" id="agent_id" value="<?php echo $_SESSION['uid']; ?>" />