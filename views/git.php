<?php
	$CI =& get_instance();
?>
<div>
	<article>
		<header class='short-text'>
			<nav class = "centered">
				<h3 class="titre">Voulez vous vraiment supprimer cette playlist ?</h3>
			</nav>
		</header>
		<nav style="justify-content: space-around;">
			<?=anchor("Git_commandes/pull",'Pull', ['role'=>'button']);?>
			<?=anchor("Git_commandes/push",'Push', ['role'=>'button']);?>
		</nav>
	</article><br><br>
	<span style="display : flex;justify-content: center;">
		<?=anchor("https://www.youtube.com/watch?v=dQw4w9WgXcQ","<img src='{$CI->config->base_url("assets/work-in-progress-png-work-in-progress-icon.png")}'alt=''>")?>
	</span>
</div >