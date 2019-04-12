<div class="modal fade" id="apply" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title"><?=$this->lang->line('c_make_app');?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="label appication_lable text-center">
                            <a href="#" class="popapply" data-toggle="modal" data-target="#pop-apply"><?=$this->lang->line('c_see_app');?></a>
                        </label>
                    </div>

                    <div class="col-md-12">
                        <h3><?=ucfirst($listing->listing_name);?></h3>
                    </div>

                    <form id="apply_property" class="" method="post" name="">
                        <div class="alert alert-success" style="display:none;"></div>
                        <?php
                        $session_data = $this->session->userdata('logged_in');
                        $uid = $session_data['id'];
                        $usertype = $session_data['user_type'];
                        $fullname = $session_data['first_name'].' '. $session_data['last_name'];
                        ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-lable">Note</label>
                                <textarea  id="note_text" class="form-control field-input submit-host-textbar" name="note_text" required=""></textarea>
                                <div class="help-block"></div>
                                <input type="hidden" name="listing_id" value="<?=$listing->id;?>">
                                <input type="hidden" name="applicant_id" value="<?=$uid;?>">
                                <input type="hidden" name="applicant_type" value="<?=$usertype;?>">
                                <input type="hidden" name="agent_id" value="<?=$listing->user_id;?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">
                                    <input id="is_check" name="is_check" type="checkbox" class="pull-left" style="margin:4px 8px 0 0;">Make sure you have completed your application
                                    <!--<div class="help-block"></div>-->
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <!--  --><?php /*if($application[0]->iscomplete == '100'){ */?>
                                <button onclick="applyProperty();" class="btn btn-md btn-primary pull-right" style="padding:7px 10px;"><?=$this->lang->line('c_sent');?></button>
                            <?php /*}else {*/?><!--
                                <button onClick="apply_before();"  class="btn btn-md btn-primary pull-right" style="padding:7px 10px;"><?/*=$this->lang->line('c_sent');*/?></button>
                            --><?php /*} */?>
                        </div>
                    </form>

                </div>
                <!--<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3" style="padding:0px;">
                            <?php /*if($listing->preview_image_url==''){ */?>
                                <img class="host-pic" src="<?/*=base_url()*/?>assets/img/placeholder.png">
                            <?php /*}else{ */?>
                                <img class="host-pic" src="<?/*=base_url()*/?>assets/media/listings/listings/<?/*=$listing->preview_image_url;*/?>">
                            <?php /*} */?>
                            <p class="host-message"><?/*=$this->lang->line('c_list_detail');*/?></p>
                            <hr align="left" width="39%">
                        </div>
                        <a id="open_modelbox" href="javascript:void(0);"  data-href="<?/*//=site_url('apply/view/'.$uid);*/?>" class="btn btn-sm btn-primary pull-right" style="padding:7px 10px; margin-right:5px;">View Application</a>
                        <div class="clearfix"></div>
                        <ul class="list-four-col pull-left" style="list-style:none; width:100%;">
                            <li><strong><?/*=$this->lang->line('c_property_name');*/?>:</strong> <?/*= $listing->id */?></li>
                            <li><strong><?/*=$this->lang->line('c_price');*/?>:</strong> <?/*=pkrCurrencyFormat($listing->price);*/?></li>
                            <li><strong><?/*=$this->lang->line('c_bedroom');*/?>:</strong> <?/*= $listing->bedrooms */?></li>
                            <li><strong><?/*=$this->lang->line('c_bath');*/?>:</strong> <?/*= $listing->bathrooms */?></li>
                            <li><strong>Home Type :</strong> <?/*= $listing->home_type */?></li>
                            <li><strong><?/*=$this->lang->line('c_property_type');*/?>:</strong> <?/*= $listing->property_type */?></li>
                             <li><strong><?/*=$this->lang->line('c_property_address');*/?>:</strong> <?php /*echo $listing->address_line_1.' '.$listing->address_line_2 */?></li>
                        </ul>
                        <ul class="list-four-col pull-left" style="list-style:none; width:100%;"></ul>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>

 <?php $this->load->view('includes/apply_model'); ?>