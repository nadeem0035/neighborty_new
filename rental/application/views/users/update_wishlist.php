<div class="row" id="wishlistrow">
  <div class="col-md-3">
    <div class="col-md-2 wishlist-item">
      <div class="listing-image-box ListingImg">
      <img width="225" height="125" src="http://localhost/luxus/assets/media/listings/listings/4cca22648141fc16258b200f3018a2d3.jpg" class="img-circle">
          <div class="listing-img-heading">
            <h2 class="listing-img-subheading"><span class="ListName"><?php echo ucfirst($Wishcat[0]->name);?></span> <br><?php echo ucfirst($Wishcat[0]->total);?> Listings </h2>
          </div>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <form id="updateCat" name="updateCat" method="POST">
     <div class="modal-body">
       <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
       <div data-rail-visible1="1" data-always-visible="1" style="height: 200px; overflow: hidden; width: auto;" class="scroller" data-initialized="1">

         <div class="row">
           <div class="col-md-12">
            <h4>Wishlist Name</h4>
            <p>
             <input type="text" class="col-md-12 form-control" name="name" id="name" value="<?php echo ucfirst($Wishcat[0]->name);?>">
           </p>
           <p>&nbsp;</p>
           <h4>Who can see this ?</h4>
  
           <p>
           <input type="hidden" name="cat_id" value="<?php echo ($Wishcat[0]->categoryid);?>">

            <select name="visibality" id="visibality" class="form-control">

              <option value="all" <?php ($Wishcat[0]->visibality =='all' ? 'selected' :'');?>>Public</option>
              <option value="me"  <?php ($Wishcat[0]->visibality =='me' ? 'selected' :'');?>>Private</option>
            </select>
          </p>
        </div>
      </div>
    </div><div class="slimScrollBar" style="background: rgb(187, 187, 187) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 200px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-default" type="button" onclick="updateWishlistCat()">Save changes</button>
    <button class="btn default" data-dismiss="modal" type="button">Cancel</button>
  </div>
</form>
</div>
</div>