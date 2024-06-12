<?php
	$CI =& get_instance();
	$CSS = "font-size: xx-large;"
?>
<h5>Playlist</h5>
<div>
	<article>
		<header class='short-text'>
			<nav class = "centered">
				<h3 class="titre">Voulez vous vraiment supprimer cette playlist ?</h3>
			</nav>
		</header>
		<nav style="justify-content: space-around;">
			<?=anchor("playlist/view/$id",'Non',['role'=>'button', 'style'=>$CSS ]);?>
			<?=anchor("playlist/deletePlaylist/$id",'Oui',['role'=>'button', 'class'=>'badbuttons', 'style'=>$CSS]);?>
		</nav>
	</article>
</div >
