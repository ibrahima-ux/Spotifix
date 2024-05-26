
<nav>
	<h5>Musique list</h5>
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
		<li><?=anchor("musique/?sorted=nom&by=$by",'Nom',['role'=>($sorted=='nom'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=genre&by=$by",'Genre',['role'=>($sorted=='genre'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=artistes&by=$by",'Artistes',['role'=>($sorted=='artistes'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=$sorted&by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
	</ul>
</nav>
<section class="list">
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo anchor("musique/view/{$music->id}","{$music->name} ");
		echo "</header><p>";
		echo anchor("$music->artiste_id", "$music->artistName");
		echo " - {$music->genreName}</p>";
		echo "</article></div>";
	}
	
?>
</section>