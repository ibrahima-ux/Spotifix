<h5>Music</h5>
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo "$music->song";
		echo "</header>";
		echo "<p class='margin'>Album : "; echo anchor("albums/view/{$music->album_id}","{$music->album}"); echo"</p>";
		echo "<p class='margin'>Artist : "; echo anchor("artistes/view/{$music->artist_id}","{$music->artist}"); echo"</p>";
		echo "<p class='margin'>Genre : $music->genre</p>";
		echo "<p class='margin'>Disque N° : $music->diskNumber</p>";
		echo "<p class='margin'>Piste N° : $music->number</p>";

		$durer = round($music->duration / 60, 2);

		echo "<p class='margin'>Durée : $durer minutes </p>";
		echo "</article></div>";
	}
	echo anchor("playlist/add/$music->ID",'Ajouter a la Playlist',['role'=>'button', 'class' => 'buttons']);
?>
