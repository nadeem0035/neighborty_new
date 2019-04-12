<?php if(!empty($listings)) { ?>
    <!--start list tabs-->
    <div class="list-tabs table-list full-width no-padding">
        <div class="tabs table-cell">
            <?=$this->load->view('properties/search_hidden_form');?>
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
            <ul class="property_tabs">
                <li><a onclick="filterProperties(this,'any')" href="javascript:void(0)" class="all <?=$all;?>" id="all"><?=$this->lang->line('sr_tb_all');?></a></li>
                <li><a onclick="filterProperties(this,'sale')" href="javascript:void(0)" class="sale <?=$sale;?>" id="sale"><?=$this->lang->line('cw_sale');?></a></li>
                <li><a onclick="filterProperties(this,'rent')" href="javascript:void(0)" class="rent <?=$rent;?>" id="rent"><?=$this->lang->line('cw_rent');?></a></li>
            </ul>
        </div>
        <div class="sort-tab table-cell text-right">
            <div class="row">
                <label class="col-sm-8 padding-top-10"><?=$this->lang->line('sr_sort_by');?>:</label>
                <div class="col-sm-4">
                    <select class="form-control" name="sort_type" id="sort_properties" title="Select Sort By">
                        <option value="date-posted"><?=$this->lang->line('sr_bydate');?></option>
                        <option value="low-to-high"><?=$this->lang->line('sr_byprice');?></option>
                        <option value="high-to-low"><?=$this->lang->line('sr_byprice_d');?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
<?php } ?>