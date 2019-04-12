<div class="modal-body host-modal-body">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php if($deal->preview_image_url==''){ ?>
				<img class="img-circle host-pic" src="<?=base_url()?>assets/img/placeholder.png">
				<?php }else{ ?>
				<img class="img-circle host-pic" src="<?=base_url()?>assets/media/listings/listings/<?=$deal->preview_image_url;?>">
				<?php } ?>
				<p class="host-message">Deal Details</p>
				<hr align="left" width="39%">
				<!-- 				<p class="hostPicSummary"><?=ucfirst($deal->summary);?></p> -->
				<ul class="nav-sidebar-blog host-bullets">
					<li>Home Type : <?=$deal->home_type;?></li>
					<li>Room Type : <?=$deal->room_type;?></li>
					<li>Accommodates :<?=$deal->accommodates;?></li>
					<li>Bedrooms : <?=$deal->bedrooms;?></li>
					<li>Beds : <?=$deal->beds;?></li>
					<li>bathrooms : <?=$deal->bathrooms;?></li>
				</ul>
				<p class="host-message">Availability Calendar</p>
				<hr align="left" width="65%">
				<p>From : <?=$deal->available_from;?></p> <p> To : <?=$deal->available_to;?></p>
			</div>
			<div class="col-md-9">
				<span class="wishlist-body-title"><?=ucfirst($deal->listing_name);?></span>
				<span class="wishlist-body-subtitle"><?=$deal->typed_address;?></span>
				<form id="wishlistForm" class="tbc-margins-adjust" method="post" name="wishlistForm">
					<input type="hidden" name="listing_id" id="listing_id" value="<?=$deal->id;?>">
					<div id="wishlist_dropdown">
						<?php foreach($wishlist_categoris as $category):?>
							<div class="form-field field-input col-md-12">
								<span style="display:inline-block;margin-right: 10px;">
									<input type="checkbox" class="checkbox" name="wishlist_category[]" value="<?=$category->id;?>" /></span>   
									<span><?php echo ucwords($category->name);?></span>
								</div>
							<?php endforeach;?>
						</div>
						<span class="error_msg alert alert-danger" style="display:inline-block;margin-left: 15px;color:red;display:none">Please select a Category</span>
						<div class="new_wishlist">
							<div class="form-field field-input col-md-12">
								<a href="#" class="modalNewBtn create_new btn btn-danger" onclick="showfields()">Create New</a>
							</div>
							<div class="form" style="display:none">
								<form></form>
								<form id="category" name="category" method="post">
									<div class="col-md-12 wishlistNewCategory">
										<div class="form-field field-input col-md-6">
											<input required="" type="text" id="wishlist_name" class="custom-host-input" placeholder="Make a new wish list">
										</div>
										<div class="form-field field-input col-md-6">
											<select class="custom-host-select" id="visibility">
												<option value="all">Everyone</option>
												<option value="me">Only Me</option>
											</select>
										</div>
									</div>
									<div class="form-field field-input col-md-12">
										<div class="field-input host-submit">
											<a href="javascript:;" class="createWishlist modalNewBtn btn btn-danger" onclick="addWishlistCategory()">Create</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-field form-field-host-area col-md-12">
							<span class="home-labels host-labels-adjust">Note</span>
							<textarea  id="note_text" class="field-input submit-host-textbar" form="wishlistForm" name="note_text"></textarea>
							<div class="field-input host-submit">
								<button onclick="addWishlist()" class="awe-btn awe-btn-1 awe-btn-medium">SUBMIT</button>
							</div>
						</div>   
					</form>  
				</div>
			</div>
		</div>
	</div>