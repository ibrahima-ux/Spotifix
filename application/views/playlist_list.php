<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
				<ul>
					<li><?=anchor('playlist/new','Nouvelle playlist',['role'=> 'button']);?></li>
					<li><?=anchor('playlist/deconnection','Déconnection',['role'=> 'button', 'class'=> 'badbuttons']);?></li>
				</ul>
			</nav>
			
		</header>
		<nav>
			<?php
				$message_recherche = 'par date';
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
			foreach($playlists as $playlist){
				echo "<article>";
				echo "<header style='margin-bottom: -50px'>";
				echo "{$playlist->date} - ".anchor("playlist/view/{$playlist->id}","{$playlist->nom}");
				echo "</header>";
				echo "</article>";
			}
			?>
		</section>
	</article>
</div>
