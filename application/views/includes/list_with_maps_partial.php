<?php if($listings) { ?>
    <script type="text/javascript">
        var arr_info = [];
        <?php
        if(isset($listings)) {
            $js_array = json_encode($positions);
            echo "var locations = ". $js_array . ";\n";
        }//if end ?>
    </script>
    <?php $count=1;?>
    <?php foreach($listings as $list){ ?>
        <script type="text/javascript">
            <?php
            $title_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->title))))));
            $summary_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->summary))))));
            $property_type = $list->purpose;
            $slug = $list->slug;
            $id = $list->listid;


            if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){

                $list_img=base_url().'/assets/media/properties/small/'.$list->image;

            }else{

                $list_img=base_url()."assets/img/placeholder.png";
            }

            $data = array(
                'list_img' => $list_img,
                'price' => $list->price,
                'title_clear'=>$title_clear,
                'property_type'=>$property_type,
                'slug'=>$slug,
                'bedrooms'=>$list->bedrooms,
                'sqrft'=>$list->area_sqrft,
                'unit'=>$list->unit_id,
                'area'=>$list->land_area,
                'listid'=>$id
            );

            ?>
            arr_info[<?=$list->listid?>]=<?=$this->load->view('includes/info_window',$data);
            ?>
        </script>
        <?php $count++;?>
    <?php } ?>

<?php } ?>




<?php if(!empty($listings)):?>

    <?php

    foreach($listings as $list)
    {
        ?>

        <div class="item-wrap hovered_<?=$list->listid?>" data_id="<?=$list->listid?>">
            <div class="property-item property-item-grid table-list">
                <div class="table-cell">
                    <div class="figure-block">
                        <figure class="item-thumb">
                            <?php if (@$list->is_featured){?>
                                <span class="label-featured label label-success is_featured">Featured</span>
                            <?php } ?>
                            <div class="label-wrap">
                               <span class="label label-default <?=($list->purpose == 'rent' ? 'is_rent' : 'is_sale');?>">
                                   <?=($list->purpose == 'rent' ? 'For Rent' : 'For Sale');?>
                               </span>
                            </div>
                            <div class="price hide-on-list"><h3><?=pkrCurrencyFormat($list->price);?></h3></div>
                            <?php

                            if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){

                                $list_img=base_url().'/assets/media/properties/small/'.$list->image;

                            }else{

                                $list_img=base_url()."assets/img/placeholder.png";
                            }

                            ?>

                            <a class="progressive replace hover-effect" href="<?=$list_img?>"
                               title="<?=ucwords($list->title)?>" alt="<?=ucwords($list->title)?>">

                                <img class="preview" src="<?=display_listing_tiny_image($list_img);?>" alt="image" />

                            </a>

                            <!--
                            <a class="hover-effect" href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" style="background-image:url('<?=$list_img?>');" title="<?=ucwords($list->title)?>" alt="<?=ucwords($list->title)?>"></a>
                            -->
                            <ul class="actions">
                                <li class="fa-heart-white">
                                    <?php if ($this->session->userdata('logged_in')) {
                                        $list->wUserId;$list->wishlistId;
                                        $session_data = $this->session->userdata('logged_in');
                                        $uid = $session_data['id'];
                                        $listing_user =  $list->user_id;
                                        $wishlist = user_have_wishlist($uid,$list->listid);
                                        if($uid != $listing_user){
                                            if(count($wishlist) > 0){ ?>
                                                <span class="active" id="<?= $list->listid ?>" data-toggle="modal"><i class="fa fa-heart"></i></span>
                                            <?php } else { ?>
                                                <span id="<?= $list->listid;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal"><i class="fa fa-heart"></i></span>
                                            <?php } ?>
                                        <?php } else{ ?>
                                            <span ><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <span><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>
                                    <?php } ?>
                                </li>
                            </ul>
                        </figure>
                    </div>
                </div>
                <div class="item-body table-cell">
                    <div class="body-left table-cell">
                        <h2 class="property-title" style="max-width:100%"><a href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" class="listing-name-custom"><?=ucwords($list->title)?></a></h2>
                        <div class="cell no-padding-b">
                            <div class="info-row amenities">
                                <p class="no-margin-b">
                                    <span><i class="flaticon flaticon-bed"></i><?=($list->bedrooms == null ? 0 : $list->bedrooms)?></span>
                                    <span><i class="flaticon flaticon-bathtub"></i><?=($list->bathrooms == null ? 0 : $list->bathrooms)?></span>
                                    <span><i class="fa fa-object-group"></i>
                                        <?php if($list->unit_id =='Square Feet'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_sqrft;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqft');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_sqrft;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                        <?php if($list->unit_id =='Square Yards'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_sqyard;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqyd');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_sqyard;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                        <?php if($list->unit_id =='Square Meters'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_sqmeter;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqm');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_sqmeter;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                        <?php if($list->unit_id =='Marla'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_marla;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('marla');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_marla;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                        <?php if($list->unit_id =='Kanal'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_kanal;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('kanal');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_kanal;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                        <?php if($list->unit_id =='acre'){?>
                                            <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$list->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$list->area_acre;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('acre');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$list->area_acre;?> - <?=$list->unit_id;?>
                                                                        </a>
                                        <?php } ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php else:?>
    <section class="no_results">
        <div class="page-main">
            <div class="article-detail text-center">
                <h1><?=$this->lang->line('l_no_listings');?></h1>
                <p><?=$this->lang->line('l_update_criteria');?> </p>
            </div>
        </div>
    </section>
<?php endif;?>


<?php //if(count($mlistings) > 20){ ?>
<div class="clearfix"></div>
<div class="pagination-main page-navigation-cn ajax_pagingsearc no-padding list-with-maps-partial" id="map-view">
    <center><?php echo $links;?></center>
</div>
<?php //} ?>


<script type="text/javascript">
    <?php
    if(isset($listings)) {
        $js_array = json_encode($positions);
        echo "var locations = ". $js_array . ";\n";
    }//if end ?>
</script>



<div id="ajaxFancyBox" style="display: none;"></div><div id="count_records" style="display: none"><?=$total_listings;?></div>
