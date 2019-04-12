<aside id="sidebar" class="sidebar-white">

     <?php $this->load->view('includes/listing_actions');?>
     <?php $this->load->view('includes/listing_contact');?>

    <div class="widget widget-poster-post">
        <div class="poster poster_300x90"><a href="#"><img src="<?=base_url()?>assets/img/poster/300x90.jpg" class="img-responsive"></a></div>
        <div class="poster poster_300x90"><a href="#"><img src="<?=base_url()?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
        <div class="poster poster_300x300"><a href="#"><img src="<?=base_url()?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
        <div class="poster poster_300x300"><a href="#"><img src="<?=base_url()?>assets/img/poster/336x280.png" class="img-responsive"></a></div>
    </div>

    <?php /*if(count($related)):*/?><!--
        <div class="widget widget-recommend">
            <div class="widget-top">
                <h3 class="widget-title"><?/*=$this->lang->line('l_last_properties');*/?></h3>
            </div>
            <div class="widget-body">

                <?php /*foreach ($related as $rel):*/?>


                    <div class="media">
                        <div class="media-left">
                            <figure class="item-thumb">
                                <a class="hover-effect" href="<?/*=site_url("property/".$rel->slug.'-'.$rel->id)*/?>">
                                    <img src="<?/*=display_listing_preview('small',$rel->preview_image_url);*/?>" width="100" height="75" alt="<?/*=$rel->title;*/?>">
                                </a>
                            </figure>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="<?/*=site_url("property/".$rel->slug.'-'.$rel->id)*/?>"><?/*=$rel->title;*/?></a></h3>

                            <h4 class="price_org">
                                <?/*=pkrCurrencyFormat($rel->price);*/?>
                            </h4>

                        </div>
                    </div>
                <?php /*endforeach;*/?>
            </div>
        </div>
    <?php /*endif;*/?>

    <?php /*if(count($featured)):*/?>
        <div class="widget widget-recommend">
            <div class="widget-top">
                <h3 class="widget-title"><?/*=$this->lang->line('l_announcement_f');*/?></h3>
            </div>
            <div class="widget-body">

                <?php /*foreach(array_slice($featured, 0, 3) as $top ):*/?>

                    <div class="media">
                        <div class="media-left">
                            <figure class="item-thumb">
                                <a class="hover-effect" href="<?/*=site_url("property/".$top->slug.'-'.$top->id)*/?>">
                                    <img src="<?/*=display_listing_preview('small',$top->preview_image_url);*/?>"  width="100" height="75" alt="<?/*=$top->title;*/?>">

                                </a>
                            </figure>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="<?/*=site_url("property/".$top->slug.'-'.$top->id)*/?>"><?/*=$top->title;*/?></a></h3>
                            <h4 class="price_org"><?/*=pkrCurrencyFormat($top->price);*/?><?php /*if($top->purpose == 'rent') { */?>
                                    <span style="font-weight: 200 !important;font-size: 13px;">Per Month</span>
                                <?php /*} */?></h4>

                        </div>
                    </div>
                <?php /*endforeach;*/?>
            </div>
        </div>
    <?php /*endif;*/?>

    <?php /*if(!empty($featured_agents_by_location)):*/?>
        <div class="widget widget-slider">
            <div class="widget-top">
                <h3 class="widget-title">Agent mis en avant</h3>
            </div>
            <div class="widget-body">
                <div class="property-widget-slider">
                    <?php /*foreach($featured_agents_by_location as $agnt):*/?>

                        <?php
/*
                        if (file_exists('assets/media/users_avatar/' . $agnt->picture) == FALSE || $agnt->picture == null) {
                            $folder = "";
                            $pic = 'placerholder.png';
                        } else {

                            $folder = "medium/";
                            $pic = $agnt->picture;
                        }
                        */?>


                        <div class="item">
                            <div class="figure-block">
                                <figure class="item-thumb">
                                    <span class="label-featured label label-success">En vedette</span>

                                    <a class="hover-effect" href="<?/*= site_url() */?>agent/profile/<?/*= $agnt->id */?>">
                                        <img src="<?/*=display_user_avatar($agnt->picture);*/?>" alt="<?/*=$agnt->first_name . ' ' .$agnt->last_name;*/?>" width="370" height="202">
                                    </a>
                                    <div class="price">
                                        <span class="item-price"><?/*=$agnt->first_name . ' ' .$agnt->last_name;*/?></span>
                                    </div>

                                </figure>
                            </div>
                        </div>
                    <?php /*endforeach;*/?>
                </div>
            </div>
        </div>
    --><?php /*endif;*/?>

</aside>