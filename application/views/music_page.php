<h5>Music</h5>
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo "$music->song";
		echo "</header>";
		echo "<p>Album : $music->album</p>";
		echo "<p>Artist : $music->artist</p>";
		echo "<p>Disque N° : $music->diskNumber</p>";
		echo "<p>Piste N° : $music->number</p>";
		echo "<p>Durée : $music->duration</p>";
		echo "</article></div>";
	}
?>

