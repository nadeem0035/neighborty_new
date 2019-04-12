<?php if ($listing->video != '') { ?>
    <div class="property-video detail-block">
        <div class="detail-title"><h2 class="title-left"><?=$this->lang->line('l_video');?></h2></div>
        <?php
        $url = $listing->video;
        $regex = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
        $id = preg_replace($regex, '$1', $url);
        ?>

        <div class="video-block">
            <a href="<?= $url; ?>" data-fancy="property_video" title="">
                                            <span class="play-icon"><img
                                                    src="<?= base_url() ?>assets/img/video-play-icon.png"
                                                    alt="Property Video" width="70" height="50"></span>
                <img src="http://img.youtube.com/vi/<?= $id; ?>/0.jpg" alt="thumb"
                     class="video-thumb">
            </a>
        </div>

    </div>
<?php } ?>