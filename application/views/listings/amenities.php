<ul class="add_amenitiesListing">
<?php foreach ($amenities as $category) {?>
        <li>
            <div class="min_heading"><span><?php echo $category->name; ?></span></div>
            <ul class="subListing">
            <?php
            if(!empty($category->subs)) {?>
                <?php foreach ($category->subs as $sub)  {?>
                    <li class="list_name">
                        <div id="amenities_list">
                                <?php if($sub->field_type == 'string'){
                                    echo '<input  autocomplete="off" type="text" name="listing_value[]" class="form-control boxtext" placeholder="'.$sub->name.'"   id="'.$sub->id.'">';
                                    echo '<input style="display:none" type="checkbox" class="boxcheck chckd_'.$sub->id.'"  name="amenities[]" value='.$sub->id.'>';
                                }
                                elseif ($sub->field_type == 'tinyint'){
                                    echo '<label><input type="checkbox" class="option-input checkbox chckd_'.$sub->id.'"  name="amenities[]" value='.$sub->id.'> '.$sub->name.' </label>';

                                }else{
                                    $field_values = explode(',',$sub->field_values);
                                    foreach ($field_values as $value)
                                    {
                                        if (!in_array($value, $field_values))
                                            $field_values[] = $value;
                                    }
                                    echo '<input style="display: none;" type="checkbox" class="option-input checkbox chckd_'.$sub->id.'"  name="amenities[]" value='.$sub->id.'>';
                                    echo '<select  name="listing_value[]" class="form-control" id="'.$sub->id.'">';
                                    echo '<option value="" selected>'.$sub->name.'</option>';

                                    foreach ($field_values as $val){

                                        echo '<option value="'.$val.'">'.ucwords($val).'</option>';

                                    }
                                    echo '<select>';
                                }
                                ?>
                            </div>
                        </li>

                <?php } ?>

            <?php } ?>
            </ul>
        </li>
<?php } ?>
</ul>
<script type="text/javascript">
    $(document).ready(function() {
        $("input.boxtext").on("keyup blur", function() {

            var id = $(this).attr('id');
            var txt =  $(this).val();

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

