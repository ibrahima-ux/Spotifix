<h5>Playlist</h5>
<div>
	<article>
		<header class='short-text'>
			<h3 class="titre"><?=$playlist->nom?></h3>
		</header>
		<nav>
			<?php
				$message_recherche = "par date dajout";
				if ($sorted == "nom") {
					$message_recherche = 'par nom';
				}
			?>
			<form action="" method="post" class='recherche'>
				<input type="text" name="search" placeholder="<?=$message_recherche?>">
				<button type="submit">Recherche</button>
			</form>
			<ul style="align-items: normal;">
			<?php
					$CI =& get_instance();
					if ($by == 'asc') {
						$bynext = "desc";
						$arrow = "up.png";
					}else {
						$bynext = "asc";
						$arrow = "down.png";
					}
				?>
				<li><?=anchor("playlist/?sorted=date&by=$by",'Date',['role'=>($sorted=='date'?'button':'')]);?></li>
				<li><?=anchor("playlist/?sorted=nom&by=$by",'Nom',['role'=>($sorted=='nom'?'button':'')]);?></li>
				<li><?=anchor("playlist/?sorted=$sorted&by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
			</ul>
		</nav>
		<section class="list">
			<?php
			foreach($songs as $song){
				echo "<article>";
				echo "<header style='margin-bottom: -50px'>";
				echo "{$song->date} - ".anchor("playlist/view/{$song->trackid}","{$playlist->nom}");
				echo "</header>";
				echo "</article>";
			}
			?>
		</section>
	</article>
</div>
