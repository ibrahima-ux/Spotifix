<?php
	$CI =& get_instance();
	
?>
<h5>Playlist</h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3 class="titre"><?=$playlist->nom?></h3>
				<div>
					<?=anchor("playlist/duplication/$playlist->id",
								"<img src='{$CI->config->base_url("assets/dupliquer.png")}' alt='del' width='30px' />",
								['role'=>'button', 'style'=>'padding: 10px;']);?>
					<?=anchor("playlist/deleteConfirm/$playlist->id",
								"<img src='{$CI->config->base_url("assets/trash.png")}' alt='del' width='30px' />",
								['role'=>'button', 'class'=>'badbuttons', 'style'=>'padding: 10px;']);?>
					
				</div>
			</nav>
		</header>
		<nav>
			<?php
				$sorted == 'nom';
				if ($sorted == "album") {
					$message_recherche = 'par album';
				}elseif ($sorted == "duree") {
					$message_recherche = 'par durée';
				}else {
					$sorted = 'nom';
					$message_recherche = 'par titre';
				}
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
						$arrow = 'down.png';
					}
				?>
				<li><?=anchor("playlist/view/$playlist->id?sorted=nom&by=$by&search=$search",'Titre',['role'=>($sorted=='nom'?'button':'')]);?></li>
				<li><?=anchor("playlist/view/$playlist->id?sorted=album&by=$by&search=$search",'Album',['role'=>($sorted=='album'?'button':'')]);?></li>
				<li><?=anchor("playlist/view/$playlist->id?sorted=duree&by=$by&search=$search",'Durée',['role'=>($sorted=='duree'?'button':'')]);?></li>
				<li><?=anchor("playlist/view/$playlist->id?sorted=$sorted&by=$bynext&search=$search", 
								"<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",
								['role'=> 'button', 'class'=>'flipflop']);?></li>
			</ul>
		</nav>
		<nav style="display:inline-block;">Nombres de musiques : <b><?=$count?></b></nav>
		<table class="play_list">
			<tr>
				<th class="column_head_image"><img src='<?= $CI->config->base_url("assets/image-gallery.png")?>' alt="IMG"/></th>
				<th>Titre</th>
				<th>Album</th>
				<th>Durée</th>
				<th style="color:rgba(0,0,0,0);">HEIN</thsty>
			</tr>
			<?php
				foreach($songs as $song){
					echo '<tr><td class="column_image"><img src="data:image/jpeg;base64,'.base64_encode($song->jpeg).'"'.' width="100%" /></td>';
					echo "<td>".anchor("musique/view/{$song->id}","{$song->name}"."</td>");
					echo "<td>".anchor("albums/view/$song->album", $song->albumName)."</td>";
					echo "<td>$song->duration</td>";
					echo "<td>".anchor("playlist/deleteSongFromPlaylist/?playlist=$playlist->id&track=$song->id",
							"<img src='{$CI->config->base_url("assets/trash_red.png")}' alt='del' width='30px' />");"</td><tr/>";
				}
				
			?>
		</table>
</div>