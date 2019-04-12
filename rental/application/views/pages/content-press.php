<h1>Press</h1>
<?php foreach($press as $row):?>
	<div class="col-md-2 pressDates">
		<p><?=$row->created_at;?></p>
	</div>
	<div class="col-md-10 pressDesc">
	<p class="more" id="more">
			<?=$row->description;?>
		</p>
	</div>
<?php endforeach;?>
</div>
</div>
</section>      
</div>
</div>
</div>
