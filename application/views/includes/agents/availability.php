<div class="tab-pane fade in active">
    <div class="property-description detail-block">
        <div class="detail-title">
            <h2 class="title-left"><?=$this->lang->line('availability');?></h2>
        </div>
        <?php if(count($availablity) >= 0){ ?>
        <div id='calendar'></div>
        <?php } else{ ?>
            <p><?=$this->lang->line('availbility_found');?></p>
        <?php } ?>
    </div>
    <?=$this->load->view('calendar/index.php'); ?>
</div>