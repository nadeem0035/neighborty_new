<?php //echo '<pre>';print_r($amenities);?>
<?php if($amenities):?>
    <div class="detail-features detail-block">
        <div class="detail-title"><h2 class="title-left"><?=$this->lang->line('l_amenities');?> +</h2></div>

        <?php //echo '<pre>';print_r($amenities);?>
        <?php //echo '<pre>';print_r($categories);?>
        <ul class="add_amenitiesListing">
            <?php

            foreach($categories as $cat) {
                $like = $cat->id;
                $resultss = array_filter($amenities, function ($item) use ($like) {  if (stripos($item['category'], $like) !== false) { return true;}});



                if(count($resultss)){
                    echo '<li><div class="min_heading"><span>'.$cat->name.'</span></div>';
                }



                echo '<ul class="subListing">';

                $like = $cat->id;

                $result = array_filter($amenities, function ($item) use ($like) {

                    if (stripos($item['category'], $like) !== false) {

                        $icon = '<svg><use data xlink:href="#'.$item['icon'].'"></use></svg>';

                       // $icon = '#'.$item['icon'];

                        //  '.$item['name'].' : '.($item['listing_value'] != '' ? $item['listing_value']: 'Yes').'
                            echo '<li class="list_name"><i class="icons_am">'.$icon.'</i>
                                   
                                     '.$item['name'].'
                                 </li>';
                    }


                });
                echo '</ul>';
                echo '</li>';
            }

            ?>
        </ul>


<?php //var_export(array_intersect($amenities, [2]));?>


        <?php $this->load->view('includes/listings/amenities_icon'); ?>

    </div>
<?php endif;?>