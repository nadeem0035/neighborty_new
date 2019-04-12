<ul class="add_amenitiesListing">
<?php foreach ($amenities as $index => $category) { ?>

    <li>

    <div class="min_heading">
        <?php echo $category->name; ?></div>

        <ul class="subListing">
        <?php
        if(!empty($category->subs)) {?>

            <?php foreach ($category->subs as $key => $sub)  {?>



                <?php //echo $lisitng_amenities[$key]->amenities_id;?>
                <div class="col-md-4">
                    <div class="form-group row">
                        <span class="col-sm-6 col-xs-6"><?php echo $sub->name; ?> </span>

                        <div class="col-sm-6 col-xs-6" id="amenities_list">

                            <?php if($sub->field_type == 'string'){


                                if(isAmenityExists($sub->id,$list_id)->id && isAmenityExists($sub->id,$list_id)->listing_value){

                                    echo '<input id="'.$sub->id.'"  autocomplete="off" type="text"  name="listing_value[]" class="form-control boxtext" value="'.(isAmenityExists($sub->id,$list_id)->listing_value).'">';

                                }else{

                                    echo '<input id="'.$sub->id.'"  autocomplete="off" type="text"  name="listing_value[]" class="form-control boxtext" value="'.($sub->listing_value != ''  ? $sub->listing_value : '').'">';
                                }


                                if($sub->listing_value){

                                    echo '<input style="display: none;" type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" '.($sub->listing_value != '' ? "checked" : "").' value="'.$sub->id.'_-'.$sub->listing_value.'">';
                                } else {
                                    echo '<input style="display: none;" type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" '.($sub->listing_value != '' ? "checked" : "").' value="'.$sub->id.'">';
                                }


                            }
                            elseif ($sub->field_type == 'tinyint'){


                                 if(isAmenityExists($sub->id,$list_id)->id){

                                        echo '<input checked type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" value="'.$sub->id .'" >';

                                    }
                                else{
                                    echo '<input type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" value="'.$sub->id .'" >';
                                }


                            }else{

                                $field_values = explode(',',$sub->field_values);
                                foreach ($field_values as $value)
                                {
                                    if (!in_array($value, $field_values))
                                        $field_values[] = $value;
                                }
                                if($sub->listing_value){
                                    echo '<input style="display: none;" type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" '.($sub->listing_value != '' ? "checked" : "").' value="'.$sub->id.'_-'.$sub->listing_value.'">';
                                } else {
                                    echo '<input style="display: none;" type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" '.($sub->listing_value != '' ? "checked" : "").' value="'.$sub->id.'">';
                                }
                                echo '<select name="listing_value[]" class="form-control"  id="'.$sub->id.'">';

                                if(!isAmenityExists($sub->id,$list_id)->id && !isAmenityExists($sub->id,$list_id)->listing_value) {
                                    echo '<option value="" selected>Select</option>';
                                }

                                foreach ($field_values as $val){
                                    if(isAmenityExists($sub->id,$list_id)->id && isAmenityExists($sub->id,$list_id)->listing_value) {

                                        echo '<option '.((isAmenityExists($sub->id,$list_id)->listing_value == $val) ? 'Selected' : '').' value="'.$val.'">'.ucwords($val).'</option>';

                                    } else {

                                        echo '<option value="'.$val.'">' . ucwords($val) . '</option>';


                                    }

                                }


                                echo '<select>';


                            }
                           ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php } ?>

        </ul>
    </li>

<?php } ?>
</ul>
<script type="text/javascript">
    $(document).ready(function() {
        $("input.boxtext").on("keyup blur", function() {

            console.log('dd');

            var id = $(this).attr('id');
            var txt =  $(this).val();

            console.log(id + '>' +txt);

            $(".chckd_"+id).prop("checked", this.value != "");
            if(txt != '')
                $(".chckd_"+id).prop("value", id +'_-'+txt);
            else
                $(".chckd_"+id).prop("value", id);
        });

        $('#amenities_list select').on('change', function() {

            var a_val = $(this).val();
            var id = $(this).attr('id');
            if(a_val){

                $(".chckd_"+id).prop("checked", this.value != "");
                $(".chckd_"+id).prop("value", id +'_-'+a_val);
            }
            else{
                $(".chckd_"+id).prop("checked", this.value != "");
                $(".chckd_"+id).prop("value", id);
            }

        });
    });
</script>


