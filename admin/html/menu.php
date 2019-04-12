<div id="logo">
<a href="index.php"><img src="../admin/assets/logo.png" width="150px" /></a>
</div>
<!-- <div id="caption"><a href="index.php">ADMINISTRATION</a></div> -->
<a id="buy-button"></a>
<ul id="leftmenu">

	<?php

	      $icons =  array('fa-dashboard','fa-cogs','fa-mail-forward','fa-quote-right','fa-paper-plane','fa-list','fa-refresh','fa-user','fa-cogs','fa-th','fa-th-list','fa-exchange','fa-gg','fa-hashtag','fa-reorder','fa-navicon','fa-xing-square',' fa-inbox','fa-bell','fa-bar-chart','fa-chevron-down','fa-star-half-full','fa-square','fa-certificate','fa-power-off');
	?>
<?php


  $r=0;
	foreach($pagedata as $pk=>$pd){
?>
    <li class="<?php echo $page == $pk ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $pk ?>"><i class="fa <?=$icons[$r]?> "></i><span><?php echo $pd['title_1'] ?></span></a>
    </li>


<?php
$r++;
	}  ?>

</ul>