<?php
@$image =$list_img;
@$description = stripHTMLtags($description);
@$title = $listname;
@$url ="https://zoney.pk/property/".$slug;
@$encoded_url = urlencode($url);
?>
<div class="share_tooltip fade">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$encoded_url;?>" target="_blank">
        <i class="fa fa-facebook"></i>
    </a>

    <a href="https://twitter.com/intent/tweet?url=<?=$encoded_url;?>" target="_blank">
        <i class="fa fa-twitter"></i>
    </a>

    <a href="https://plus.google.com/share?url=<?=$encoded_url;?>"
       target="_blank">
        <i class="fa fa-google-plus"></i>
    </a>
    <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $url; ?>&media=<? echo $image;?>&description=<?php echo $description; ?>" data-pin-shape="round">
        <i class="fa fa-pinterest"></i>
    </a>
    
</div>

