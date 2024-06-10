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
			<?=anchor("Git_commandes/pull",'Pull');?>
			<?=anchor("Git_commandes/push",'Push');?>
		</nav>
	</article>
</div >
