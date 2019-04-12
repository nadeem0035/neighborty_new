<?php
$image =$list_img;
$description = $description;
$address = $address;
$url = site_url('agent/profile/'.$agent->id);
$encoded_url = urlencode($url);
?>
<div class="share_tooltip tooltip_top fade">
    <!-- <a href="#"><i class="fa fa-envelope icon-space-right"></i> Share on Email</a>-->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$encoded_url;?>" target="_blank"><i class="fa fa-facebook-square icon-space-right"></i> Share on Facebook </a>
    <a href="https://twitter.com/intent/tweet?url=<?=$encoded_url;?>" target="_blank"><i class="fa fa-twitter-square icon-space-right"></i> Share on Twitter </a>
    <a href="https://plus.google.com/share?url=<?=$encoded_url;?>" target="_blank"><i class="fa fa-google-plus-square icon-space-right"></i> Share on Google </a>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$encoded_url;?>" target="_blank"><i class="fa fa-linkedin-square icon-space-right"></i> Share on Linkedin</a>


</div>