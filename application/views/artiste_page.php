<?php
	$CI =& get_instance();
?>
<h5>Artist</h5>
<?php
	foreach ($artiste as $art) {
		echo "<div><article style='margin-bottom: 70px'><header class='short-text' style='margin-bottom: -50px'><nav class='centered'>";
		echo "<h3 class='titre'>$art->name</h3>";
		echo anchor("playlist/addArtistsTracks/$art->id",'Ajouter a la Playlist',['role'=>'button', 'class' => 'addbuttons']);
		echo "</nav></header></article></div>";
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
<table class="play_list">
	<tr>
		<th style="display:flex;align-items: center;justify-content: center;"><img src='<?= $CI->config->base_url("assets/image-gallery.png")?>' width="50%" /></th>
		<th>Titre</th>
		<th>Album</th>
		<th>Temps</th>
	</tr>
	<?php
		foreach($musics as $music){
			echo '<tr><td class="column_image"><img src="data:image/jpeg;base64,'.base64_encode($music->jpeg).'"'.' width="100%" /></td>';
			echo "<td>".anchor("musique/view/{$music->id}","{$music->name}")."</td>";
			echo "<td>".anchor("album/view/{$music->album_id}","{$music->album}")."</td>";
			echo "<td>$music->duration</td></tr>";
		}
		
	?>
</table>