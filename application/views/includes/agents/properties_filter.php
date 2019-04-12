<script type="text/javascript">
    <?php
    if(isset($listings)) {
        $js_array = json_encode($positions);
        echo "var locations = ". $js_array . ";\n";
    }//if end ?>
</script>
<?=count($positions);?>
<div class="property-listing grid-view grid-view-3-col">


    <div class="row">
        <ul id="">
            <?php foreach($listings as $list){ ?>

                <li class="list item-wrap" id="all">


                    <div class="property-item-grid">
                        <figure class="item-thumb">
                            <?php
                            if(is_file($abs_path.'/assets/media/properties/small/'.$list->preview_image_url)){
                                if (file_exists($abs_path.'/assets/media/properties/small/'.$list->preview_image_url)) {
                                    $list_img=$search_img.'small/'.$list->preview_image_url;
                                }else{
                                    $list_img=base_url()."assets/img/placeholder.png";
                                }
                            }else{
                                $list_img=base_url()."assets/img/placeholder.png";
                            }
                            ?>
                            <a href="<?=site_url("property/".$list->slug)?>" class="hover-effect">
                                <img src="<?=$list_img?>" alt="thumb">
                            </a>

                            <div class="label-wrap label-left">
                                <?php if ($list->is_featured){?>
                                    <span class="label label-success">Featured</span>
                                <?php } ?>
                                <!--<span class="label label-danger">Open House</span>-->
                            </div>
                            <div class="price">
                                <?php if($list->property_type == 'sale'){ ?>
                                    <span class="item-price">$<?=$list->price;?></span>
                                <?php } else if ($list->property_type == 'rent'){ ?>
                                    <span class="item-sub-price">$<?=$list->price;?>/mo</span>
                                <?php } ?>
                            </div>
                            <ul class="actions">
                                <li class="fa-heart-white">
                                    <?php if ($this->session->userdata('logged_in')) { ?>

                                        <?php

                                        $list->wUserId;$list->wishlistId;
                                        $session_data = $this->session->userdata('logged_in');
                                        $uid = $session_data['id'];
                                        $listing_user =  $list->user_id;

                                        if($uid != $listing_user){

                                            if ($list->wUserId == $uid && $list->wishlistId == $list->id) { ?>

                                                <span class="active" title="" data-placement="top" id="<?= $list->id ?>" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                            <?php } else { ?>

                                                <span title="" data-placement="top" id="<?= $list->id;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                            <?php } ?>

                                        <?php } else{ ?>

                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>

                                        <?php } ?>


                                    <?php } else { ?>

                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>

                                    <?php } ?>
                                </li>
                                <li class="share-btn">
                                    <?php
                                    $data= array('list_img'=>base_url() . "assets/media/listings/listings/".$list->preview_image_url,'slug'=>$list->slug.'-'.$list->id,'description'=>$list->summary);
                                    $this->load->view('includes/share',$data);
                                    ?>
                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                </li>
                                <!--
                                    <li>
                                <span data-toggle="tooltip" data-placement="top" title="Photos (<?=$list->photos;?>)">
                                    <i class="fa fa-camera"></i>
                                </span>
                                    </li>
                                    -->
                            </ul>
                            <div class="item-caption">
                                <div class="label-wrap">
                                    <span class="label label-primary">Fore <?=$list->property_type?></span>
                                    <?php if($list->active == 'sold'){ ?>
                                        <span class="label label-danger">Sold</span>
                                    <?php } ?>
                                </div>
                                <h4 class="item-caption-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h4>
                                <ul class="item-caption-list">
                                    <li><?php echo $list->beds;?> bd</li>
                                    <li><?php echo $list->bedrooms;?> ba</li>
                                    <li><?php echo $list->sqft;?> sqft</li>
                                </ul>
                            </div>
                        </figure>
                    </div>



                    <script type="text/javascript">

                        <?php
                        $title_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->listing_name))))));
                        $summary_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->summary))))));
                        if($list->property_type == 'sale'){

                            $price = $list->price;
                        }else{

                            $price = $list->price;
                        }


                        if(is_file($abs_path.'/assets/media/properties/small/'.$list->preview_image_url)){
                            if (file_exists($abs_path.'/assets/media/properties/small/'.$list->preview_image_url)) {
                                $list_img=$search_img.'small/'.$list->preview_image_url;
                            }else{
                                $list_img=base_url()."assets/img/placeholder.png";
                            }
                        }else{
                            $list_img=base_url()."assets/img/placeholder.png";
                        }

                        ?>

                        arr_info[<?=$list->id?>] = '<div class="infoBox sale" style="visibility: visible; width: 275px; left: 277.519px; bottom: -410.938px; cursor: default;"><img src="images/map/close.png" align="right" style=" position: relative; cursor: pointer; margin: 0 0 -16px -16px;"><div class="property-item item-grid map-info-box"><div class="figure-block"><figure class="item-thumb"><div class="price hide-on-list"><span class="item-prices" >$<?=$price;?></span></div><a href="<?=site_url('booking/detail/'.$list->slug)?>" tabindex="0"><img src="<?=$list_img;?>" alt="thumb"></a><figcaption class="thumb-caption cap-actions clearfix"><div class="pull-right"><span title="" data-placement="top" data-toggle="tooltip" data-original-title="Photos"><i class="fa fa-camera"></i> <span class="count">(7)</span></span></div></figcaption></figure></div><div class="item-body"><div class="body-left"><div class="info-row"><h2 class="property-title"><a href="<?=site_url('booking/detail/'.$list->slug)?>"><?=$title_clear;?></a></h2><h4 class="property-location"><?=$list->typed_address?></h4></div><div class="table-list full-width info-row"><div class="cell"><div class="info-row amenities"><p><span>Bed: <?=$list->beds?></span><span>Baths: <?=$list->bathrooms?></span><span>Sq Ft: <?=$list->sqrft?></span></p></div></div></div></div></div></div></div>';

                    </script>



                </li>
            <?php } ?>
        </ul>
    </div>
</div>