<?php foreach($feeds as $feed):?>
    <div class="detail-block posted">
        <div class="table">
            <div class="table-cell">
                <a href="<?= site_url() ?>agent/profile/<?= $feed->id ?>">
                    <img src="<?=display_user_avatar($feed->picture);?>" class="img-circle" alt="Agent Thumb" width="45" height="45">
                </a>
            </div>
            <div class="table-cell">
                <strong><?=$feed->first_name . ' ' .$feed->last_name;?>  <?//=$feed->feed_id;?></strong>
                <p>
                    <?=$feed->agent_type;?>
                    <br/>
                    <?=time_ago_in_php($feed->created_at);?>
                </p>
            </div>
        </div>
        <div class="post_detail">
            <div class="text-seeMore article">
                <p><?=$feed->description;?></p>
            </div>
        </div>
        <?php if($feed->image != '') :?>
               <img src="<?=display_feed_preview($feed->image);?>" >
        <?php endif;?>
    </div>
<?php endforeach; ?>




