<div class="profile-top text-center">
    <h1 class="page-title no-padding no-margin"><?=isset($title) ? $this->lang->line('al_modify_listing') : $this->lang->line('al_add_listing') ?></h1>

            <ol class="pay-step-bar" style="display:none;">
                <?php
                // pre(current_url);
                if( $step == 1 )
                {
                    ?>
                    <li class="pay-step-block active"><span>1. <?=$this->lang->line('al_announcement');?></span></li>
                    <li class="pay-step-block"><a href="<?=stristr(current_url, 'add-listing') ? 'javascript:void(0);' : '?step=2'?>"><span>2. <?=$this->lang->line('al_photos');?></a></span></li>
                    <li class="pay-step-block"><span>3. <?=$this->lang->line('al_publish_isting');?></span></li>
                    <?php
                }
                if( $step == 2 )
                {
                    ?>
                    <li class="pay-step-block"><a href="?step=1"><span>1. <?=$this->lang->line('al_announcement');?></span></a></li>
                    <li class="pay-step-block active"><span>2. <?=$this->lang->line('al_photos');?></span></li>
                    <li class="pay-step-block"><a href="<?=stristr(current_url, 'add-listing') ? 'javascript:void(0);' : '?step=3'?>">
                            <span>3.<?=$this->lang->line('al_publish_isting');?></span></a>
                    </li>
                    <?php
                }


                if( $step == 3 )
                {
                    ?>
                    <li class="pay-step-block"><a href="javascript:void(0)"><span>1. <?=$this->lang->line('al_announcement');?></span></a></li>
                    <li class="pay-step-block"><a href="javascript:void(0)"><span>2. <?=$this->lang->line('al_photos');?></span></a></li>
                    <li class="pay-step-block active"><span>3. <?=$this->lang->line('al_publish_isting');?></span></li>
                    <?php
                }
                ?>

            </ol>
            <?php
            if( isset($_GET['msg']) )
            {
                if( stristr($_GET['msg'], 'add') )
                    $msg = msg_success('Listing added successfully');

                if( stristr($_GET['msg'], 'update') )
                    $msg = msg_success('Listing updated successfully');
            }
            ?>


</div>