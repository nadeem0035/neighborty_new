<form id="search_listings">

    <input type="hidden" id="view_property"  name="type" value="all"  />
    <?php
    $home_types = $this->input->get('home_types');
    if( is_array($home_types) ){foreach( $home_types as $key => $val ) {  ?> <input type="hidden" value="<?=$val?>"  name="home_types[]" /> <?php } };
    $amenities = $this->input->get('amenities');
    if( is_array($amenities) ){foreach( $amenities as $key => $val ) {  ?> <input type="hidden" value="<?=$val?>"  name="amenities[]" /><?php } };
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
    <input type="hidden" id="search_by_map" name="search_by_map" value="false" />
    <input type="hidden" id="sw_lat"  name="sw_lat"  />
    <input type="hidden" id="sw_lng"  name="sw_lng"  />
    <input type="hidden" id="ne_lat"  name="ne_lat"  />
    <input type="hidden" id="ne_lng"  name="ne_lng"  />

    <input type="hidden" id="status_ajax"  name="status_ajax" value="publish" />

    <?php
    if (!empty($_GET['property_type'])) {
        $property_type = $this->input->get('property_type');
        if (in_array("rent", $property_type) || in_array("sale", $property_type))
        {
            if (is_array($property_type)) {
                foreach ($property_type as $key => $val) { ?>
                    <input class="listing_type" type="hidden" value="<?= $val ?>" name="listing_type"/>
                <?php }
            }
        }
        else
        {
            echo ' <input type="hidden" class="listing_type" name="listing_type" value="all" />';
        }
        
    }
    else if(!empty($_GET['type'])){ echo ' <input type="hidden" class="listing_type" name="listing_type" value="'.$this->input->get('type').'" />';}
    else{ echo ' <input type="hidden" class="listing_type" name="listing_type" value="all" />';}

    ?>

    <input type="hidden" class="sort_type"   name="sort_type" value="" />


    <?php

    $p_type = $this->input->get_post('property_type');
    $pro_type[] = $this->input->get_post('type');
    if(!empty($p_type)){
        $property_type = $p_type;
    } else {
        $property_type = $pro_type;
    }



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


</form>


<?php
$purpose = $this->input->get_post('type');
$property_type = $this->input->get_post('property_type');
if($purpose != '' || $property_type != ''){
    $all ='';$rent ='';$sale ='';
    if($purpose){

        if($purpose == 'sale') { $sale ='active';}
        if($purpose == 'rent') { $rent ='active';}
        if($purpose == '') { $all ='active';}

    }else{

        if(in_array('sale',$property_type) && in_array('rent',$property_type)){
            $all ='active';
        }

        else if(in_array('sale',$property_type) && !in_array('rent',$property_type)){
            $sale ='active';
        }

        else if(!in_array('sale',$property_type) && in_array('rent',$property_type)){
            $rent ='active';
        }

        else{
            $all ='';$rent ='';$sale ='';
        }

    }
}else{
    $all ='active';
}
//pr($property_type);
?>
