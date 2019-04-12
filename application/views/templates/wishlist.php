<div class="modal-body host-modal-body">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-3" style="padding:0px;">
                <?php if (isset($pictures)) { ?>
                <div class="carousel slide" id="MyCarousel">
                    <div class="carousel-inner">
                    <?php
                    foreach ($pictures as $pic) {
                        if ($pic === reset($pictures)){
                    ?>
                        <div class="item active">
                           <div>
                                <img class="host-pic" src="<?= base_url() ?>assets/media/properties/small/<?= $pic->picture ?>" alt="<?= $pic->picture ?>">
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="item">
                            <div>
                                <img class="host-pic" src="<?= base_url() ?>assets/media/properties/small/<?= $pic->picture ?>" alt="<?= $pic->picture ?>">
                            </div>
                        </div>
                    <?php  }
                    } ?>
                    <a href="#MyCarousel" class="left carousel-control" data-slide="prev"><span class="icon-prev"></span></a>
                    <a href="#MyCarousel" class="right carousel-control" data-slide="next"><span class="icon-next"></span></a>
                </div>
            </div>
                <?php } else { ?>
                    <div>
                       <img class="host-pic" src="<?= base_url() ?>assets/media/properties/thumbs/<?= $deal->preview_image_url ?>" alt="<?= $deal->preview_image_url ?>">
                    </div>
                <?php } ?>
                <div class="new_wishlist">
                    <span class="wishlist-body-title"><?=ucfirst($deal->listing_name);?></span>
                    <span class="wishlist-body-subtitle"><?=$deal->typed_address;?></span>
                </div>
            </div>

			<div class="col-md-9">
                <div class="row">
				    <form id="wishlistForm" class="tbc-margins-adjust" method="post" name="wishlistForm">
					<input type="hidden" name="listing_id" id="listing_id" value="<?=$deal->id;?>">
					<div id="wishlist_dropdown">


                        <?php //echo '<pre>';print_r($wishlist_categoris);?>

                        <?php if(!empty($wishlist_categoris)){?>

						      <?php foreach($wishlist_categoris as $category):?>
							    <div class="form-field field-input col-md-12">
                                    <span class="host-labels-adjust"><?=$this->lang->line('c_favrt_category');?></span>
                                    <div class="clearfix"></div>
                                    <div class="" style="margin-top:5px;">
                                        <input type="checkbox" style="margin-left:0px;" class="checkbox" name="wishlist_category[]" value="<?=$category->id;?>" />
                                        <span><?php echo ucwords($category->name);?>
                                    </div>
								</div>
							 <?php endforeach;?>

                        <?php } else{ ?>

                                 <input type="text" name="create" placeholder="Create" id="create" required style="visibility:hidden;">

                        <?php } ?>

						</div>
						<span class="error_msg alert alert-danger" style="display:inline-block;display:none; font-size:14px; margin:10px 15px 0px;">Please select a Category</span>
                        <span class="error_msgs alert alert-danger" style="display:inline-block;display:none; font-size:14px; margin:10px 15px 0px;">Please Create a Category First</span>
						<div class="new_wishlist">
                            <?php if(empty($wishlist_categoris)){?>
							<div class="form-field field-input col-md-12">
<!--								<a href="#" class="modalNewBtn create_new btn btn-primary" onclick="showfields()">Create New</a>-->
                                <a href="<?=site_url('user-wishlists');?>" class="btn-sm btn-primary"><?=$this->lang->line('c_creat_wishlist');?></a>
							</div>
                            <?php } ?>
							<!--<div class="form" style="display:none; margin-top:10px; ">
								<form id="category" name="category" method="post">
									<div class="wishlistNewCategory">
										<div class="form-field field-input col-md-6">
											<input required="" type="text" id="wishlist_name" class="form-control custom-host-input" placeholder="Make a new wish list">
										</div>
										<div class="form-field field-input col-md-6">
											<select class="form-control custom-host-select" id="visibility">
												<option value="all">Public </option>
												<option value="me">Privé</option>
											</select>
										</div>
									</div>
									<div class="form-field field-input col-md-12">
										<div class="field-input host-submit">
											<a href="javascript:;" class="createWishlist modalNewBtn btn btn-primary" onclick="addWishlistCategory()">Create</a>
										</div>
									</div>
								</form>
							</div>-->
						</div>
						<div class="clearfix"></div>
						<div class="form-field form-field-host-area col-md-12">
							<span class="home-labels host-labels-adjust"><?=$this->lang->line('c_note');?></span>
							<textarea required  id="note_text" class="form-control field-input submit-host-textbar submit-h" form="wishlistForm" name="note_text"></textarea>
							<div class="field-input host-submit">
								<button onclick="addWishlist()" class="btn btn-secondary"><?=$this->lang->line('c_send_wish');?></button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>