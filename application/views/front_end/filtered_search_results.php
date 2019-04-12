<?php
if($listings) { ?>
    <?php if($listings) { ?>
        <script type="text/javascript">
            var arr_info = [];
            <?php
            if(isset($listings)) {
                $js_array = json_encode($positions);
                echo "var locations = ". $js_array . ";\n";
            }//if end ?>
        </script>
    <?php } ?>

    <?php if(!empty($listings)) { ?>

        <h3>Filter</h3>
<div class="list-tabs table-list full-width" style="padding:0px;">
    <div class="tabs table-cell">
        <ul class="property_tabs">
            <li>
                <form id="all_properties">
                    <input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
                    <input type="hidden" name="state" value="<?=$this->input->get('state');?>" />
                    <input type="hidden" name="state_code" value="<?=$this->input->get('state_code');?>" />
                    <input type="hidden" name="country" value="<?=$this->input->get('country');?>" />
                    <input type="hidden" name="zipcode" value="<?=$this->input->get('zipcode');?>" />
                    <input type="hidden" name="location" value="<?=$this->input->get('location');?>" />
                    <input type="hidden" name="ptype" value="all" />
                    <a onclick="getSearchProperty(this,'all')" href="javascript:void(0)" class="all <?php if($type != 'sale' && $type != 'rent') { echo 'active';} ;?>" id="all">Tout</a>
                </form>
            </li>
            <li>
                <form id="sale_properties">
                    <input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
                    <input type="hidden" name="state" value="<?=$this->input->get('state');?>" />
                    <input type="hidden" name="state_code" value="<?=$this->input->get('state_code');?>" />
                    <input type="hidden" name="country" value="<?=$this->input->get('country');?>" />
                    <input type="hidden" name="zipcode" value="<?=$this->input->get('zipcode');?>" />
                    <input type="hidden" name="location" value="<?=$this->input->get('location');?>" />
                    <input type="hidden" name="ptype" value="sale" />
                    <a onclick="getSearchProperty(this,'sale')" href="javascript:void(0)" class="sale <?=($type == 'sale' ? 'active' : '');?>" id="sale">À Vendre</a>
                </form>
            </li>
            <li>
                <form id="rent_properties">
                    <input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
                    <input type="hidden" name="state" value="<?=$this->input->get('state');?>" />
                    <input type="hidden" name="state_code" value="<?=$this->input->get('state_code');?>" />
                    <input type="hidden" name="country" value="<?=$this->input->get('country');?>" />
                    <input type="hidden" name="zipcode" value="<?=$this->input->get('zipcode');?>" />
                    <input type="hidden" name="location" value="<?=$this->input->get('location');?>" />
                    <input type="hidden" name="ptype" value="rent" />
                    <a onclick="getSearchProperty(this,'rent')" href="javascript:void(0)" class="rent <?=($type == 'rent' ? 'active' : '');?>" id="rent">À Louer</a>
                </form>
            </li>
        </ul>
    </div>
    <div class="table-cell hidden-sm hidden-xs">
        <form method="get" action="" id="sortForm">
            <div class="sort-tab row text-right">
                <label class="label-control col-sm-5">Sort by:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="sort_type" id="sort_properties" title="Please select" data-live-search="false">
                        <option value="date-posted">Date Posted</option>
                        <option value="low-to-high">Price (Low to High)</option>
                        <option value="high-to-low">Price (High to Low)</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

</div>
<?php } ?>
<div id="agent_properties">
    <div class="property-listing <?=($page_view == 'grid' ? 'grid-view' : 'list-view');?>">
        <div class="row" id="sorted_listings">
            <?php
            foreach($listings as $list)

                { ?>

                    <div class="item-wrap"  data_id="<?=$list->listid?>">
                        <div class="property-item property-item-grid table-list">
                            <div class="table-cell">
                                <div class="figure-block">
                                    <figure class="item-thumb">
                                        <?php if ($list->is_featured){?>
                                        <span class="label-featured label label-success is_featured">Featured</span>
                                        <?php } ?>
                                        <div class="price hide-on-list">
                                            <h3><?=pkrCurrencyFormat($list->price)?></h3>

                                        </div>
                                        <?php
                                        if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){
                                            if (file_exists($abs_path.'/assets/media/properties/small/'.$list->image)) {
                                                $list_img=$search_img.$list->image;
                                            }else{
                                                $list_img=base_url()."assets/img/placeholder.png";
                                            }
                                        }else{
                                            $list_img=base_url()."assets/img/placeholder.png";
                                        }
                                        ?>
                                        <a class="hover-effect" href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>"><img class="lozad" data-src="<?=$list_img?>" src="<?=$list_img?>" alt=""></a>
                                        <ul class="actions">
                                            <li class="fa-heart-white">
                                                <?php if ($this->session->userdata('logged_in')) { ?>
                                                <?php
                                                $list->wUserId;$list->wishlistId;
                                                $session_data = $this->session->userdata('logged_in');
                                                $uid = $session_data['id'];
                                                $listing_user =  $list->user_id;
                                                if($uid != $listing_user){
                                                    if ($list->wUserId == $uid && $list->wishlistId == $list->listid) { ?>
                                                    <span class="active" title="" data-placement="top" id="<?= $list->listid ?>" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
                                                    <?php } else { ?>
                                                    <span title="" data-placement="top" id="<?= $list->listid;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
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
                                                    $data= array('list_img'=>base_url() . "assets/media/properties/thumbs/".$list->preview_image_url,'slug'=>$list->slug.'-'.$list->listid,'description'=>$list->summary);
                                                    $this->load->view('includes/share',$data);
                                                    ?>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                </li>
                                                <li class="popup-trigger">
                                                    <span id="<?=$list->listid;?>" class="fancybox" data-placement="bottom" data-toggle="tooltip" data-original-title="Photos (<?=$list->photos;?>)"> <i class="fa fa-camera" style="margin-right:0px;"></i></span>
                                                </li>

                                                </ul>
                                                <div class="item-caption">
                                                    <div class="label-wrap hide-on-list">
                                                        <span class="label label-default <?=($list->property_type == 'rent' ? 'is_rent' : 'is_sale');?>"><?=($list->property_type == 'rent' ? 'A Louer' : 'À Vendre');?></span>
                                                    </div>
                                                    <h4 class="item-caption-title hide-on-list"><?=ucwords($list->listing_name)?></h4>
                                                    <ul class="item-caption-list hide-on-list">
                                                        <?php if($list->beds != ''):?>
                                                        <li><?php echo $list->beds;?> bd</li>
                                                        <?php endif;?>
                                                        <?php if($list->bedrooms != ''):?>
                                                        <li><?php echo $list->bedrooms;?> ba</li>
                                                        <?php endif;?>
                                                    </ul>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="item-body table-cell hidden-gird-cell">
                                        <div class="body-left table-cell">
                                            <div class="info-row">
                                                <div class="label-wrap hide-on-grid">
                                                    <div class="label-status label label-default <?=($list->property_type == 'rent' ? 'is_rent' : 'is_sale');?>"><?=($list->property_type == 'rent' ? 'A Louer' : 'À Vendre');?></div>
                                                </div>
                                                <div class="info-row price"><h3 class="text-left"><?= pkrCurrencyFormat($list->price)?></h3></div>
                                                <h2 class="property-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h2>
                                                <h4 class="property-location"><?php echo $list->address_line_1.' '.$list->address_line_2.', '.$list->city_town.', '.$list->state_province.' '.$list->zip_postal_code?></h4>
                                            </div>
                                            <div class="info-row amenities hide-on-grid">
                                                <p>
                                                    <?php if($list->home_type != ''):?>
                                                    <span>Type de maison: <?php echo $list->home_type;?></span>
                                                    <?php endif;?>
                                                    <?php if($list->bedrooms != ''):?>
                                                    <span>chambres : <?php echo $list->bedrooms;?></span>
                                                    <?php endif;?>
                                                    <?php if($list->beds != ''):?>
                                                    <span style="display: none">Beds: <?php echo $list->beds;?></span>
                                                    <?php endif;?>
                                                </p>
                                            </div>
                                            <div class="info-row date hide-on-grid">
                                                <p><i class="fa fa-user"></i> <a href="<?=site_url("agent/profile/".$agents[$list->listid][0]->id)?>"><?=$agents[$list->listid][0]->first_name." ".$agents[$list->listid][0]->last_name ?>   </a></p>
                                                <p><i class="fa fa-calendar"></i> <?= relative_time($list->date_created); ?> </p>
                                            </div>
                                        </div>
                                        <div class="body-right pull-right">
                                            <div class="info-row phone text-right">
                                                <?php $this->load->view('includes/listing_contact_buttons',array('list' => $list)); ?>
                                                <p><a href="#"><?=$list->phone;?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                <?php
                                $title_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->listing_name))))));
                                $summary_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->summary))))));
                                $property_type = $list->property_type;
                                $slug = $list->slug;
                                $id = $list->listid;

                                if($list->property_type == 'sale'){
                                    $price = number_format($list->price);
                                }else{
                                    $price = number_format($list->price);
                                }
                                if(is_file($abs_path.'/assets/media/properties/small/'.$list->image)){
                                    if (file_exists($abs_path.'/assets/media/properties/small/'.$list->image)) {
                                        $list_img=$search_img.$list->image;
                                    }else{
                                        $list_img=base_url()."assets/img/placeholder.png";
                                    }
                                }else{
                                    $list_img=base_url()."assets/img/placeholder.png";
                                }
                                $data = array(
                                    'list_img' => $list_img,
                                    'price' => $price,
                                    'title_clear'=>$title_clear,
                                    'property_type'=>$property_type,
                                    'slug'=>$slug,
                                    'listid'=>$id
                                );

                                ?>
                                arr_info[<?=$list->listid?>]=<?=$this->load->view('includes/info_window',$data);?>
                            </script>
                            <?php } ?>
                            <div id="ajaxFancyBox" style="display: none;"></div>
                        </div>
                    </div>
                </div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="pagination-main page-navigation-cn ajax_pagingsearc" >
        <center><?php echo $links;?></center>
    </div>
    <?php
} else {?>
<section class="no_results" style="margin-top:50px;">
    <div class="page-main">
        <div class="article-detail text-center">
            <h1>Votre recherche ne correspond à aucun agent</h1>
            <p>Veuillez modifier vos critères de recherche et essayer de rechercher </p>
        </div>
    </div>
</section>
<?php }?>

<script type="text/javascript">
     function application_count(){
         var url = site_url + 'Apply/update_count/';
         var count = $('#total_count').text();

         $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: {count:count},
            async: false,
            success: function (result) {
                if (result) {
                    $("#AddReviews").html('Reviews Added successfully');
                } else {
                    $("#AddReviews").html('<h3>Some thing wrong! Please try again</h3>');
                }
            },
        });
     }
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/lozad.min.js"></script>
    <script type="text/javascript">
        lozad('.lozad', {
            load: function(el) {
                el.src = el.dataset.src;
                el.onload = function() {
                    el.classList.add('fade')
                }
            }
        }).observe()
    </script>

<?php
if ($this->session->userdata('logged_in'))
{
            $session_data_user = $this->session->userdata('logged_in');
            $uid = $session_data_user['id'];
            $count = $this->input->get_post('data');

}
?>