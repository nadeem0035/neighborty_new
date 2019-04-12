<div class="widget widget-slider">
    <div class="widget-top">
        <h3 class="widget-title">Featured Properties Slider</h3>
    </div>
    <div class="widget-body">
        <?php if(count($featured)){ ?>
        <div class="property-widget-slider">
            <?php foreach($featured as $top){ ?>
                  <div class="item">
                <div class="figure-block">
                    <figure class="item-thumb">
                            <span class="label-featured label label-success is_featured">Featured</span>
                        <div class="label-wrap label-right">
                            <span class="label-status label label-default <?=($top->property_type == 'rent' ? 'is_rent' : 'is_sale');?>">For <?=$top->property_type?></span>
                        </div>
                        <?php
                        if(is_file($abs_path.'/assets/media/listings/search_thumbs/'.$top->preview_image_url)){
                            if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$top->preview_image_url)) {
                                $list_img=$search_img.$top->preview_image_url;
                            }else{
                                $list_img=base_url()."assets/img/placeholder.png";
                            }
                        }else{
                            $list_img=base_url()."assets/img/placeholder.png";
                        }
                        ?>

                        <!--<a href="<?/*=site_url("property/".$listing->slug)*/?>">
                            <img src="<?/*=$list_img*/?>" style="height: 170px; width: 254px"  alt="">
                        </a>-->


                        <a href="<?=site_url("property/".$top->slug)?>" class="hover-effect">
                            <img src="<?=$list_img?>" width="370" height="202" alt="thumb">
                        </a>

                        <div class="price">

                            <?php if($top->property_type == 'sale'){ ?>

                                <span class="item-price"><?=pkrCurrencyFormat($top->price);?></span>

                            <?php } else if ($top->property_type == 'rent'){ ?>

                                <span class="item-price"><?=pkrCurrencyFormat($top->price);?></span>

                            <?php } ?>
                        </div>
                        <ul class="actions">
                            <li>
                                <?php if ($this->session->userdata('logged_in')) { ?>

                                    <span title="" data-placement="top"  id="<?=$top->listid?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                <?php } else{ ?>

                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a  href="<?= site_url("users/login_status/")?>" ><i class="fa fa-heart"></i></a></span>
                                <?php } ?>
                            </li>
                            <li class="share-btn">
                                <div class="share_tooltip fade">
                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                            </li>
                        </ul>
                    </figure>
                </div>
            </div>

            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>