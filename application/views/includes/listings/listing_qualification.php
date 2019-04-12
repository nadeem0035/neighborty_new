

<?php if ($listing->property_type == 'rent' && $listing->req_qualify !='') { ?>

    <div class="property-description detail-block">
        <div class="detail-title">
            <h2 class="title-left"><?=$this->lang->line('l_qualified');?></h2>
        </div>
        <p><?php echo $listing->req_qualify; ?></p>
    </div>
<?php } ?>