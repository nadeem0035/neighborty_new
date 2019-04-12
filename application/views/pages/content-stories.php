<h4 class="my-profile__title">Stories</h4>
<?php foreach($stories as $story):?>
<div class="row">
  <div class="col-md-6">
    <p><?=$story->description;?></p>
  </div>
  <div class="col-md-6 storyBanner">
   <img src="<?=$story->image;?>">
 </div>        
</div>
<?php endforeach;?>
</div>
</div>
</div>
</section>      
</div>
</div>
</div>
