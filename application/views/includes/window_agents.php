'<a href="<?=site_url('booking/detail/'.$slug.'-'.$listid);?>"><div id="gm-map-content" class="table"><div class="table-cell"><img src="<?=$list_img;?>" width="90"></div><div class="table-cell"><p><b><?=pkrCurrencyFormat($price);?></b><br><?=($pieces == 0 ? 0 : $pieces)?> p - <?=($bedrooms == 0 ? 0: $bedrooms)?> chb<br><?=($sqrft);?> m²</p></div></div></a>';