<h5>Music</h5>
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'><nav class='centered'>";
		echo "<h3 class='titre'>$music->song</h3>";
		echo anchor("playlist/addTrack/$music->track_id",'Ajouter a la Playlist',['role'=>'button', 'class' => 'addbuttons']);
		echo "</nav></header>";
		echo "<p class='margin'>Album : "; echo anchor("albums/view/{$music->album_id}","{$music->album}"); echo"</p>";
		echo "<p class='margin'>Artist : "; echo anchor("artistes/view/{$music->artist_id}","{$music->artist}"); echo"</p>";
		echo "<p class='margin'>Genre : $music->genre</p>";
		echo "<p class='margin'>Disque N° : $music->diskNumber</p>";
		echo "<p class='margin'>Piste N° : $music->number</p>";

		echo "<p class='margin'>Durée : $music->duration minutes </p>";
		echo "</article></div>";
	}
?>
