<h5>Music</h5>
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'><nav class='centered'>";
		echo "<h3 class='titre'>$music->song</h3>";
		echo anchor("playlist/addTrack/$music->track_id",'Ajouter a la Playlist',['role'=>'button', 'class' => 'addbuttons']);
		echo "</nav></header><section class='list' style='justify-content: flex-start; align-items: center;'>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($music->jpeg).'"'.' width="30%" /></td>';
		echo "<div style='margin: 0 20px'>";
		echo "<p class='margin'>Album : "; echo anchor("albums/view/{$music->album_id}","{$music->album}"); echo"</p>";
		echo "<p class='margin'>Artist : "; echo anchor("artistes/view/{$music->artist_id}","{$music->artist}"); echo"</p>";
		echo "<p class='margin'>Genre : $music->genre</p>";
		echo "<p class='margin'>Disque N° : $music->diskNumber</p>";
		echo "<p class='margin'>Piste N° : $music->number</p>";

		echo "<p class='margin'>Durée : $music->duration minutes </p>";
		echo "</div></section></article></div>";
	}
?>