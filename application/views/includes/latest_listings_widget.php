<div class="widget widget-agent-recommend">
    <div class="widget-top">
        <h3 class="widget-title"><?=$this->lang->line('l_letest_listings');?></h3>
    </div>
    <div class="widget-body">
        <?php //pr($listings);?>
        <?php foreach($listings as $listing):?>
        <div class="media">
            <div class="media-left">
                <figure class="item-thumb">
                    <a class="hover-effect" href="<?=site_url("listing/detail/".$listing->slug.'-'.$listing->id)?>">
                        <img src="<?=display_listing_preview('search_thumbs',$listing->preview_image_url);?>" width="100" height="75" alt="thumb">
                    </a>
                </figure>
            </div>
            <div class="media-body">
                <h3 class="media-heading"><a href="<?=site_url("listing/detail/".$listing->slug.'-'.$listing->id)?>"><?=$listing->listing_name;?></a></h3>
                <h4><?=pkrCurrencyFormat($listing->price);?></h4>
                <div class="amenities">
                    <p><?=$listing->sqrft;?></p>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>