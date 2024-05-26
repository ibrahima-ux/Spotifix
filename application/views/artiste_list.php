
<nav>
	<h5>Artistes list</h5>
	<ul style="align-items: normal;">
		<?php
			$CI =& get_instance();
			if ($by == 'asc') {
				$bynext = "desc";
				$arrow = "up.png";
			}else {
				$bynext = "asc";
				$arrow = "down.png";
			}
		?>
		<li><?=anchor("artistes/?by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
	</ul>
</nav>
<section class="list">
<?php
foreach($artistes as $artiste){
	echo "<div><article>";
	echo anchor("artistes/view/{$artiste->id}","{$artiste->name}");
	echo "</article></div>";
}
?>
</section>
<img src="" alt="" height="" >