<h5>Music</h5>
<?php
	foreach($musics as $music){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo "$music->song";
		echo "</header> <ul>";
		echo "<li>Album : $music->album</li>";
		echo "<li>Artist : $music->artist</li>";
		echo "<li>Disque N° : $music->diskNumber</li>";
		echo "<li>liiste N° : $music->number</li>";
		echo "<li>Durée : $music->duration</li>";
		echo "</ul></article></div>";
	}
?>

