<h5>Artist</h5>
<?php
	foreach ($artiste as $art) {
		echo "<div><article>";
		echo "<h3 class='titre'>$art->name</h3>";
		echo "</article></div>";
	}

	echo '<section class="list">';
	foreach($albums as $album){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo anchor("albums/view/{$album->id}","{$album->name}");
		echo "</header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
		echo "<footer class='short-text'>{$album->year} - {$album->artistName} - {$album->genreName}</footer>
		  </article></div>";
	}
?>
</section>
<nav>
	<h5 id='tracks'>Tracks</h5>
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
		<li><?=anchor("artistes/view/$id/?sorted=titre&by=$by#tracks",'Titre',['role'=>($sorted=='titre'?'button':'')]);?></li>
		<li><?=anchor("artistes/view/$id/?sorted=album&by=$by#tracks",'Album',['role'=>($sorted=='album'?'button':'')]);?></li>
		<li><?=anchor("artistes/view/$id/?sorted=$sorted&by=$bynext#tracks", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
	</ul>
</nav>
<section class="list">
	<ul>
<?php
	
	foreach($musics as $music){
		echo "<li>";
		echo "<header class='short-text'><p>";
		echo anchor("musique/view/{$music->id}","{$music->name}");
		echo " - $music->album</p></header></li>";
	}
	
?>
	</ul>
</section>