  <!-- Modal -->
    <div class="modal fade" id="pop-viewApp" tabindex="-1" role="dialog" style="z-index: 1000000;">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content host-modal">
                <div class="modal-header host-modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="model_title" class="modal-title">Bootstrap Modal with Dynamic Content</h4>
                </div>
                <div class="modal-body host-modal-body">

                    <div class="container-fluid">
                        <div class="row">
                            <ul class="login-tabs apply-tabs col-sm-3">
                                <li class="link" href="#" data-rel="about_me" class="active" ><?=$this->lang->line('c_about_me');?></li>
                                <li class="link" href="#" data-rel="residences" ><?=$this->lang->line('c_residences');?></li>
                                <li class="link" href="#" data-rel="occupation"><?=$this->lang->line('c_occupation');?></li>
                                <li class="link" href="#" data-rel="references"><?=$this->lang->line('c_references');?></li>
                                <li class="link" href="#" data-rel="financial"><?=$this->lang->line('c_financial');?></li>
                                <li class="link" href="#" data-rel="misc"><?=$this->lang->line('c_misc');?></li>
                            </ul>
                            <div id="loaded_data" class="tab-content col-sm-9" style="padding:0">
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer host-modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?=$this->lang->line('c_close');?></button>
                </div>
            </div>

        </div>
    </div>
