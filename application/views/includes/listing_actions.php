

        <?php if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $uid = $session_data['id'];

            if($listing->user_id == $session_data['id']){ ?>
        <div class="widget">
            <div class="widget-body">
                <a  href="<?= site_url("listings/edit_property/".$listing->id); ?>"  class="btn btn-secondary btn-block"><?=$this->lang->line('l_make_edit');?> </a>
            </div>
        </div>
            <?php }else { ?>

                <?php if ($applied[0]->applicant_id != $session_data['id']) { ?>

                    <?php if($listing->purpose !='sale'):?>
        <div class="widget">
            <div class="widget-body">
                    <a href="javascript:;" data-toggle="modal" data-target="#apply" class="btn btn-primary btn-block">
                        <i class="fa fa-check"></i>
                        <?= $this->lang->line('send_application'); ?>
                    </a>
            </div>
        </div>
                    <?php endif;?>

                    <!--<a href="#" id="<?/*=$listing->user_id;*/?>" onclick="setapp(this.id)" data-toggle="modal" data-target="#set-appointment"
                       class="btn btn-primary btn-block">
                        <i class="fa fa-calendar"></i> <?/*= $this->lang->line('l_make_appointment'); */?>

                    </a>-->
                <?php } else { ?>
        <div class="widget">
            <div class="widget-body">

                    <a href="javascript:void(0)" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Applied</a>
            </div>
        </div>

                <?php }
            } ?>

        <?php } else { ?>


            <?php if($listing->purpose !='sale'):?>
        <div class="widget">
            <div class="widget-body">

                <a href="<?= site_url("users/login_status/") ?>" class="btn btn-primary btn-block"><i class="fa fa-check"></i> <?=$this->lang->line('send_application');?></a>

            </div>
        </div>
            <?php endif;?>

            <!--<a href="<?/*= site_url("users/login_status/") */?>" class="btn btn-primary btn-block"><i class="fa fa-calendar"></i> <?/*=$this->lang->line('l_make_appointment');*/?></a>-->

        <?php } ?>

