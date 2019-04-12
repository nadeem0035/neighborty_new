<div class="widget widget-calculate" id="getFixed">
    <div class="widget-body">
        <div class="media agent-media">
            <div class="media-left">
                <a href="<?= site_url() ?><?=($userdetail->user_type == 'Agent' ? 'agent/profile/' : 'user/profile/' );?><?= $userdetail->id ?>">
                    <img src="<?=display_user_avatar($userdetail->picture);?>"
                         class="media-object" alt="<?=$userdetail->first_name . " " . $userdetail->last_name?>" width="100" height="100">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <?=($listing->listing_owner == 'agent' ? 'Agent' : 'Owner');?>
                    <?=$this->lang->line('l_agent_contact');?></h4>
                <ul>
                    <li>
                        <i class="fa fa-user"></i> <?php echo $userdetail->first_name . " " . $userdetail->last_name ?>
                    </li>
                    <li class="phoneno"></li>
                </ul>

                <?php if($userdetail->phone != ''):?>
                <?php if($session_data['id'] != ''){ ?>

                    <button onclick="$('.phoneno').show();$(this).hide();" type="button" class="btn btn-primary btn-sm" id="load" ><?=$this->lang->line('l_see_number');?></button>
                    <span class="phoneno" style="display: none"><i class="fa fa-phone" aria-hidden="true"></i>
                    <a style="color: #000" href="tel:<?=$userdetail->phone;?>"><?=$userdetail->phone;?></a>
                    </span>

                <?php } else { ?>

                        <button onclick="$('.phoneno').show();$(this).hide();" type="button" class="btn btn-primary btn-sm" id="load" ><?=$this->lang->line('l_see_number');?></button>
                        <span class="phoneno" style="display: none"><i class="fa fa-phone" aria-hidden="true"></i>
                    <a style="color: #000" href="#">Please login first</a>
                    </span>

                <?php } ?>
                <?php endif;?>
            </div>

        </div>

        <p>&nbsp;</p>
        <?php  if($listing->user_id != $session_data['id']){ ?>

        <form id="contacthostform">

            <div class="text_fields">
                <div class="form-group">
                    <input class="form-control" required  name="fullname" value="<?= $session_data['first_name']; ?>" type="text"  tabindex="-1" id="fullname" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <input class="form-control" required name="email"
                           value="<?= $session_data['email'] ?>" type="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="form-control" required name="phone" value="<?= $session_data['phone'] ?>" type="text" placeholder="Phone">
                </div>

                <div class="form-group">
                    <textarea class="form-control" required name="message" rows="7" placeholder=""><?=$this->lang->line('agent_msg_note');?></textarea>
                </div>
                <input type="hidden" name="receiver_id" value="<?= $listing->user_id ?>"/>
                <input type="hidden" name="listing_id" value="<?= $listing->id ?>"/>
                <input type="hidden" name="lname" value="<?= $listing->listing_name ?>"/>
                <?php if ($session_data['active']){ ?>
                    <a  onclick="validateHostForm()"  class="btn btn-secondary btn-block"><?=$this->lang->line('l_sent_message');?> </a>

                <?php } else { ?>
                    <a  onclick="IfQuickContactForm()"  class="btn btn-secondary btn-block"><?=$this->lang->line('l_sent_message');?></a>

                <?php } ?>

            </div>
            <div class="form-group">
                <div id="contact_response"></div>
                <div id="msg_responce"></div>
            </div>
        </form>

        <?php } ?>
    </div>
</div>