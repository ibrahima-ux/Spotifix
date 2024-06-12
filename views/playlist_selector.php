<?php
	$CI =& get_instance();
	$CSS = "font-size: x-large;"
?>
<h5>Playlist</h5>
<div>
	<article>
		<header class='short-text'>
			<nav class = "centered">
				<h3 class="titre">Dans quelle playlist voulez-vous ajouter de la musique ?</h3>
			</nav>
		</header>
		<nav style="justify-content: space-around;">
			<?php 
				foreach ($playlists as $playlist) {
					echo anchor("playlist/$addWhat/$id?selected=true&playlist=$playlist->id","$playlist->nom",['role'=>'button', 'style'=>$CSS ]);
				}
			?>
		</nav>
	</article>
</div>
