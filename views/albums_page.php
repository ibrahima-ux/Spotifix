<?php
	$CI =& get_instance();
?>
<h5>Artist</h5>
<?php
	foreach($albums as $album){
		echo "<div><article><header class='short-text'><nav class='centered'>";
		echo "<h3 class='titre'>$album->name<h3>";
		echo anchor("playlist/addAlbumsTracks/$album->id",'Ajouter a la Playlist',['role'=>'button', 'class' => 'addbuttons']);
		echo "</nav></header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'"'.' width="30%" />';
		echo "<footer class='short-text'>";
		echo "<p>Année - {$album->year}<p>";
		echo "<p>Artrist - ".anchor("artistes/view/{$album->artist_id}","{$album->artistName}")."</p>";
		echo "<p>Genre - {$album->genreName}<p></footer>
		  </article></div>";
	}
	echo "<h5>Tracks</h5>";
?>

		<table class="play_list">
			<tr>
				<th class="column_head_image"><img src='<?= $CI->config->base_url("assets/image-gallery.png")?>' /></th>
				<th>Titre</th>
				<th>Durée</th>
			</tr>
			<?php
				foreach($musics as $music){
					echo '<tr><td class="column_image"><img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'"'.' width="100%" /></td>';
					echo "<td>".anchor("musique/view/{$music->id}","{$music->name}")."</td>";
					echo "<td>$music->duration</td></tr>";
				}
				
			?>
		</table>
</section>
