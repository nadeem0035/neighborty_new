<div class="property-item">
<div class="row" id="wishlistrow">
  <div class="col-md-3">
    <div class="wishlist-item">
        <?php if($Wishcat[0]->preview_image_url==''){ ?>
            <img class="" src="<?=base_url()?>assets/img/placeholder.png" alt="thumb">
        <?php }else{ ?>
            <img class="" src="<?=base_url()?>assets/media/listings/listings/<?=$Wishcat[0]->preview_image_url;?>" alt="thumb">
        <?php } ?>

        <h3 class="title" style="margin-top:15px;"><span class="ListName"><?php echo ucfirst($Wishcat[0]->name);?></span> <small>(<?php echo ucfirst($Wishcat[0]->total);?> Listings)</small></h3>
    </div>
  </div>

    <div class="col-md-9">
        <form id="updateCat" name="updateCat" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Wishlist Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo ucfirst($Wishcat[0]->name);?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Who can see this ?</label>
                    <input type="hidden" name="cat_id" value="<?php echo ($Wishcat[0]->categoryid);?>">
                    <select class="form-control" data-live-search="false" name="visibality" id="visibality">
                        <option value="all" <?php ($Wishcat[0]->visibality =='all' ? 'selected' :'');?>>Public</option>
                        <option value="me"  <?php ($Wishcat[0]->visibality =='me' ? 'selected' :'');?>>Private</option>
                    </select>
                </div>
            </div>

        </div>
         <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="updateWishlistCat()">Save changes</button>
            <button class="btn default" data-dismiss="modal" type="button">Cancel</button>
          </div>
    </form>
    </div>
</div>
</div>