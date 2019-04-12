<div class="property-description detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?=$this->lang->line('l_description');?></h2>
    </div>
    <p><?=nl2br(htmlentities($listing->summary, ENT_QUOTES, 'UTF-8'));?></p>
</div>

<div class="detail-address detail-block" style="display: none">
    <div class="detail-title">
        <h2 class="title-left"><?=$this->lang->line('l_address');?></h2>
    </div>
    <ul class="list-two-col">
        <li>
            <strong><?=$this->lang->line('l_address');?>:</strong> <?php echo $listing->address_line_1 . ' ' . $listing->address_line_2 ?>, <?php echo $listing->city_town ?>,
            <?php echo $listing->state_province ?>, <?php echo $listing->zip_postal_code ?>
        </li>
        <li><strong><?=$this->lang->line('l_neighborhood');?>:</strong> <?php echo $listing->typed_address ?></li>
    </ul>
</div>