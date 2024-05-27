<h5>Artist</h5>
<?php
	foreach($albums as $album){
		echo "<div><article>";
		echo "<header class='short-text'>";
		echo "$album->name";
		echo "</header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
		echo "<footer class='short-text'>";
		echo "<p>Année - {$album->year}<p>";
		echo "<p>Artrist - ".anchor("artistes/view/{$album->artist_id}","{$album->artistName}")."</p>";
		echo "<p>Genre - {$album->genreName}<p></footer>
		  </article></div>";
	}
	echo "<h5>Tracks</h5>";
	echo '<section class="list"> <ul>';
	foreach($musics as $music){
		echo "<li>";
		echo "<header class='short-text'>";
		echo anchor("musique/view/{$music->id}","{$music->name}");
		echo "</header></li>";
	}
?>
	</ul>
</section>
