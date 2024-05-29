<?php
	$CI =& get_instance();
?>
<h5>Playlist</h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3 class="titre"><?=$playlist->nom?></h3>
				<?=anchor("playlist/deleteConfirm/$playlist->id",
							"<img src='{$CI->config->base_url("assets/trash.png")}' alt='del' width='30px' />",
							['role'=>'button', 'class'=>'badbuttons', 'style'=>'padding: 10px;']);?>
			</nav>
		</header>
		<nav>
			<?php
				$message_recherche = 'par nom';
			?>
			<form action="" method="post" class='recherche'>
				<input type="text" name="search" placeholder="<?=$message_recherche?>">
				<button type="submit">Recherche</button>
			</form>
			<ul style="align-items: normal;">
			<?php
					if ($by == 'asc') {
						$bynext = "desc";
						$arrow = "up.png";
					}else {
						$bynext = "asc";
						$arrow = "down.png";
					}
				?>
				<li><?=anchor("playlist/view/$playlist->id?by=$bynext", 
								"<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",
								['role'=> 'button', 'class'=>'flipflop']);?></li>
			</ul>
		</nav>
		<section class="list">
			<?php
			foreach($songs as $song){
				echo "<article>";
				echo "<header style='margin-bottom: -50px'>";
				echo "---".anchor("musique/view/{$song->id}","{$song->name}")."    ";
				echo anchor("playlist/deleteSongFromPlaylist/?playlist=$playlist->id&track=$song->id",
							"<img src='{$CI->config->base_url("assets/trash_red.png")}' alt='del' width='25px' />",);
				echo "</header>";
				echo "</article>";
			}
			?>
		</section>
	</article>
</div>
