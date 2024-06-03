<?php
	$CI =& get_instance();
?>
<h5>Musique list</h5>
<nav>
	<!-- Ajout d'un formulaire de recherche pour les playlists -->
	<?php
        $message_recherche = 'par nom';
        if ($sorted == "artistes") {
            $message_recherche = 'par artiste';
        }elseif ($sorted == "genre") {
            $message_recherche = 'par genre';
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
		<li><?=anchor("musique/?sorted=nom&by=$by",'Nom',['role'=>($sorted=='nom'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=genre&by=$by",'Genre',['role'=>($sorted=='genre'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=artistes&by=$by",'Artistes',['role'=>($sorted=='artistes'?'button':'')]);?></li>
		<li><?=anchor("musique/?sorted=$sorted&by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
	</ul>
</nav>
<table class="play_list">
	<tr>
		<th style="display:flex;align-items: center;justify-content: center;"><img src='<?= $CI->config->base_url("assets/image-gallery.png")?>' width="50%" /></th>
		<th>Titre</th>
		<th>Album</th>
		<th>Artist</th>
		<th>Genre</th>
		<th>Temps</th>
	</tr>
	<?php
		foreach($musics as $music){
			echo '<tr><td class="column_image"><img src="data:image/jpeg;base64,'.base64_encode($music->jpeg).'"'.' width="100%" /></td>';
			echo "<td>".anchor("musique/view/{$music->id}","{$music->name}")."</td>";
			echo "<td>".anchor("album/view/$music->album_id","$music->album_name")."</td>";
			echo "<td>".anchor("artistes/view/$music->artiste_id","$music->artistName")."</td>";
			echo "<td>{$music->genreName}</td>";
			echo "<td>$music->duration</td></tr>";
		}
		
	?>
</table>