<div class="widget widget-follow">
    <div class="widget-top">
        <a href="#" class="fa fa-question-circle pull-right" data-container="body" data-toggle="popover" data-placement="left" data-content="Follow things that interest you to personalize your feed."></a>
        <h3 class="widget-title">Publier</h3>
    </div>
    <div class="widget-body">
        <ul>
            <?php foreach($follow as $user)  {?>
                <li class="table">
                    <div class="table-cell">
                        <a href="<?= site_url() ?>agent/profile/<?= $user->id ?>">
                            <img src="<?=display_user_avatar($user->picture);?>" class="img-circle" alt="<?=$user->first_name;?>" width="40" height="40">
                        </a>
                    </div>
                    <div class="table-cell">
                        <strong><a href="<?= site_url() ?>agent/profile/<?= $user->id ?>"> <?=$user->first_name .' '.$user->last_name;?></a></strong>
                        <p><?=$user->agent_type;?></p>
                    </div>
                    <div class="table-cell">
                        <a href="javascript:void(0)" id="<?=$user->id;?>" class="btn btn-sm follow"> + Follow</a>
                    </div>
                </li>
            <?php }?>
        </ul>
    </div>
</div>