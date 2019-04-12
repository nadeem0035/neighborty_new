<div class="detail-list detail-block">
    <div class="detail-title"><h2 class="title-left"><?=$this->lang->line('l_details');?></h2></div>


        <ul class="row">
            <li class="col-md-4"><strong><?=$this->lang->line('property_id');?>:</strong> Z-<?= $listing->id ?></li>

            <?php if($listing->property_type != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('property_type');?> :</strong> <?= ucwords($listing->property_type) ?></li>
            <?php endif;?>

            <?php if($listing->purpose != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('property_purpose');?> :</strong> <?= ucwords($listing->purpose) ?></li>
            <?php endif;?>

            <?php if($listing->price != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('l_price');?>:</strong> <?=pkrCurrencyFormat($listing->price);?></li>

            <?php endif;?>


            <?php if($listing->area != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('property_area');?>:</strong>

                    <?php
                    if($listing->unit_id == 'Acre') { echo $listing->area_kanal .'-';};
                    if($listing->unit_id == 'Kanal') { echo $listing->area_kanal.'-';};
                    if($listing->unit_id == 'Marla') { echo $listing->area_marla.'-';};
                    if($listing->unit_id == 'Square Meters') { echo $listing->area_sqmeter.'-'; };
                    if($listing->unit_id == 'Square Yards') { echo $listing->area_sqyard.'-';};
                    if($listing->unit_id == 'Square Feet') { echo $listing->area_sqrft.'-';};
                    ?>
                    <?=$listing->unit_id;?>
                </li>
            <?php endif;?>


            <?php if($listing->bedrooms != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('bedrooms');?>:</strong> <?= $listing->bedrooms ?></li>
            <?php endif;?>

            <?php if($listing->bathrooms != '') :?>
                <li class="col-md-4"><strong><?=$this->lang->line('bathrooms');?>:</strong> <?= $listing->bathrooms ?></li>
            <?php endif;?>

            <li class="col-md-4"><strong><?=$this->lang->line('added_by');?> :</strong> <?= time_ago_in_php($listing->date_created) ?></li>

            <?php if($listing->property_location != '') :?>
                <li class="col-md-12"><strong><?=$this->lang->line('property_location');?>:</strong> <?= $listing->property_location ?></li>
            <?php endif;?>

        </ul>
    

    <?php if ($listing->additional_note != '') { ?>
        <div class="detail-title-inner"><h4 class="title-inner"><?=$this->lang->line('l_note');?></h4></div>
        <ul class="">
            <li><?= $listing->additional_note ?></li>
        </ul>
    <?php } ?>
</div>