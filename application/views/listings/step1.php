<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/intlTelInput.css" />
<style>
    .price_text{
        font-size:13px; font-weight:500; margin-bottom:0; padding:0 10px;
        margin-top:5px;
        background:rgba(0,0,0,.05);
        border-radius:4px;
    }
    .price_text .add_new_price{
        width:100%;
        border-top: rgba(0, 0, 0, 0.15) dashed 1px;
    }
    .select2-container{width:100% !important;}
</style>
<?php if( $this->session->flashdata('listError') )
{ ?>
    <div class="alert alert-danger">
   <?php  echo $this->session->flashdata('listError'); ?>
    </div>
<?php  } ?>
<form id="addListing" method="post" novalidate>
    <input type="hidden" name="id" value="<?= @$listing->id; ?>">
    <input type="hidden" id="listing_id" value="<?= @$listing->id; ?>">

    <div class="account-block">
        <div class="add-tab-content">
            <div class="add-tab-row push-padding-bottom">

                <h5 class="title_form"><?=$this->lang->line('my_properties');?></h5>

                <div class="row no-gutter">
                    <?php $this->load->view('properties/amenities_btns');?>
                    <?php $this->load->view('properties/locations');?>
                </div>
            </div>

            <?php $this->load->view('properties/description');?>
            <?php $this->load->view('properties/dropzone');?>

        </div>
        </div>

    <div id="addAmenities" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                    <h4 class="modal-title"><?=$this->lang->line('select_amenities');?></h4>
                </div>
                <div class="modal-body">
                    <div id="amenities_box" class="no-margin-b"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <div class="account-block text-right" style="margin-top:20px;">
        <button type="submit" class="btn btn-primary submit_property">Submit Property</button>
    </div>

</form>