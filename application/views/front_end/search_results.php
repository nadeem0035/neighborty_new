<div id="search_items">
    <div class="houzez-module padding-top-10">
        <script>var current_query = "<?php parse_str($_SERVER['QUERY_STRING']);?>";</script>
        <style>b-lazy{ min-height: 384px;}</style>
        <?php //echo '<pre>';print_r($listings);?>

        <?php
        if(!empty($listings)) { ?>
            <div class="page-title breadcrumb-top padding-top-none padding-b-10" style="display: none">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h1 class="title-head">
                                <?php if($this->input->get('country') != ''){
                                    echo $this->input->get('country') .',';
                                }
                                if($this->input->get('city') != ''){
                                    $city = trim($this->input->get('city'));
                                    echo getCityById($city);
                                }

                                ?><small>
                                    <?php if($this->input->get('sub_area') != ''){
                                        $area = trim($this->input->get('sub_area'));
                                        echo getAreaById($area);
                                    }
                                    ?>
                                </small>
                                <small style="font-size:1.2rem;padding-left:5px;">(<span id="total_count"><?=$total_listings;?></span> <?=plural(count($listings), 'Result', 'Results' );?>)</small>
                            </h1>
                        </div>
                        <div class="page-title-right">
                            <div class="view hidden-xs">
                                <div class="table-cell">
                                    <lable class="control-label pull-left">Show Map:</lable>
                                    <label class="bs-switch">
                                        <input type="checkbox" data-toggle="toggle" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="view-btn btn-map" style="display:none;" onclick="showMapview()"><i class="fa fa-map-marker"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="search_form">
                <?php
                $property_type = $this->input->get_post('property_type');

                if(in_array('sale',$property_type) && in_array('rent',$property_type)){
                    echo '<input type="hidden" id="ptype" name="property_type[]" value="rent" />';
                    echo '<input type="hidden" id="ptype" name="property_type[]" value="sale" />';
                }

                else if(in_array('sale',$property_type) && !in_array('rent',$property_type)){

                    echo '<input type="hidden" id="ptype" name="property_type[]" value="sale" />';
                }

                else if(!in_array('sale',$property_type) && in_array('rent',$property_type)){
                    echo '<input type="hidden" id="ptype" name="property_type[]" value="rent" />';
                }

                else{
                    echo '<input type="hidden" id="ptype" name="property_type[]" value="rent" />';
                    echo '<input type="hidden" id="ptype" name="property_type[]" value="sale" />';
                }

                ?>
                <input type="hidden" name="city" value="<?=urlencode($this->input->get('city'));?>" />
                <input type="hidden" name="sub_area" value="<?=urlencode($this->input->get('sub_area'));?>" />
                <input type="hidden" class="page_view" name="page_view" value="<?=$this->input->get('page_view');?>" />
                <input type="hidden" name="bedrooms" value="<?=$this->input->get('bedrooms');?>" />
                <input type="hidden" name="bathrooms" value="<?=$this->input->get('bathrooms');?>" />
                <input type="hidden" name="min_area" value="<?=$this->input->get('min_area');?>" />
                <input type="hidden" name="max_area" value="<?=$this->input->get('max_area');?>" />
                <input type="hidden" name="price_min" value="<?=$this->input->get('price_min');?>" />
                <input type="hidden" name="price_max" value="<?=$this->input->get('price_max');?>" />
            </form>
            <div class="list-grid-area">
                <div id="content-area">
                    <div id="filtered_search_results">
                        <div id="agent_properties">
                            <h2 class="padding-top-10">Properties</h2>
                            <div class="property-listing grid-view-4-col grid-view">
                                <div class="" id="rendered_resulsts">
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

                                    <?php

                                    if(count($premium_listings)){
                                    foreach($premium_listings as $list){?>

                                        <div class="item-wrap test hovered_<?=$list->listid?>" data_id="<?=$list->listid?>">
                                        <div class="property-item property-item-grid table-list">
                                            <div class="table-cell">
                                                <div class="figure-block">
                                                    <figure class="item-thumb">


                                                        <div class="label-wrap hide-on-list">
                                                            <span class="label label-danger">Premium</span>

                                                                    <span class="label label-default <?=($list->purpose == 'rent' ? 'is_rent' : 'is_sale');?>">
                                                                        <?=($list->purpose == 'rent' ? 'For Rent' : 'For Sale');?>
                                                                    </span>
                                                        </div>
                                                        <div class="price hide-on-list"><h3><?=pkrCurrencyFormat($list->price);?></h3></div>
                                                        <?php
                                                        if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){
                                                            if (file_exists($abs_path.'/assets/media/properties/small/'.$list->image)) {
                                                                $list_img=$search_img.'small/'.$list->image;
                                                            }else{
                                                                $list_img=base_url()."assets/img/placeholder.png";
                                                            }
                                                        }else{
                                                            $list_img=base_url()."assets/img/placeholder.png";
                                                        }
                                                        ?>
                                                        <a class="hover-effect" href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" style="background-image:url('<?=$list_img?>');" title="<?=ucwords($list->title)?>" alt="<?=ucwords($list->title)?>"></a>
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
                                                                        <span><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
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
                                                <div class="table-list full-width hide-on-list">
                                                    <h2 class="property-title" style="width: 100%"><a href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" class="listing-name-custom"><?=ucwords($list->title)?></a></h2>
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

                                        <?php $count++;
                                    } }?>



                                    <?php //echo '<pre>';print_r($js_array);?>
                                    <?php
                                    // echo '<pre>';print_r($listings);

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
                                                            <div class="label-wrap hide-on-list">
                                                                    <span class="label label-default <?=($list->purpose == 'rent' ? 'is_rent' : 'is_sale');?>">
                                                                        <?=($list->purpose == 'rent' ? 'For Rent' : 'For Sale');?>
                                                                    </span>
                                                            </div>
                                                            <div class="price hide-on-list"><h3><?=pkrCurrencyFormat($list->price);?></h3></div>
                                                            <?php
                                                            if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){
                                                                if (file_exists($abs_path.'/assets/media/properties/small/'.$list->image)) {
                                                                    $list_img=$search_img.'small/'.$list->image;
                                                                }else{
                                                                    $list_img=base_url()."assets/img/placeholder.png";
                                                                }
                                                            }else{
                                                                $list_img=base_url()."assets/img/placeholder.png";
                                                            }
                                                            ?>
                                                            <!--
                                                            <a class="hover-effect" href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" style="background-image:url('<?=$list_img?>');" title="<?=ucwords($list->title)?>" alt="<?=ucwords($list->title)?>"></a>
                                                            -->

                                                            <a class="progressive replace hover-effect" href="<?=$list_img?>"
                                                               title="<?=ucwords($list->title)?>" alt="<?=ucwords($list->title)?>">

                                                                <img class="preview" src="<?=display_listing_tiny_image($list_img);?>" alt="image" />

                                                            </a>

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
                                                                            <span><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
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
                                                    <div class="table-list full-width hide-on-list">
                                                        <h2 class="property-title" style="width: 100%"><a href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" class="listing-name-custom"><?=ucwords($list->title)?></a></h2>
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
                                        <?php $count++; } ?>

                                    <div id="ajaxFancyBox" style="display: none;"></div>
                                    <br/>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <!--start Pagination-->
                                    <div class="pagination-main page-navigation-cn ajax_pagingsearc no-padding" id="map-view">
                                        <center><?php echo $links;?></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {?>
            <section class="no_results" style="margin-top:50px;">
                <div class="page-main">
                    <div class="article-detail text-center">
                        <h1><?=$this->lang->line('l_no_listings');?></h1>
                        <p><?=$this->lang->line('l_update_criteria');?> </p>
                    </div>
                </div>
            </section>
        <?php }?>
    </div>
</div>