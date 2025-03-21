<?php
	$CI =& get_instance();

?>
<h5>Musique list</h5>
<nav>
	<?php
        $message_recherche = 'par nom';
        if ($sorted == "album") {
            $message_recherche = 'par album';
        }elseif ($sorted == "artistes") {
            $message_recherche = 'par artiste';
        }elseif ($sorted == "genre") {
            $message_recherche = 'par genre';
        }elseif ($sorted == "duree") {
            $message_recherche = 'par durée';
        }
    ?>
    <form action="0" method="get" class='recherche'>
        <input type="text" name="search" placeholder="<?=$message_recherche?>">
		<input type="hidden" name="sorted" value="<?=$sorted?>">
		<input type="hidden" name="by" value="<?=$by?>">
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
			$page2 = $page+1;
		?>
		<li><?=anchor("musique/index/$page2?sorted=nom&by=$by",'Titre',['role'=>($sorted=='nom'?'button':'')]);?></li>
		<li><?=anchor("musique/index/$page2?sorted=album&by=$by",'Album',['role'=>($sorted=='album'?'button':'')]);?></li>
		<li><?=anchor("musique/index/$page2?sorted=artistes&by=$by",'Artistes',['role'=>($sorted=='artistes'?'button':'')]);?></li>
		<li><?=anchor("musique/index/$page2?sorted=genre&by=$by",'Genre',['role'=>($sorted=='genre'?'button':'')]);?></li>
		<li><?=anchor("musique/index/$page2?sorted=duree&by=$by",'Duree',['role'=>($sorted=='duree'?'button':'')]);?></li>
		<li><?=anchor("musique/index/$page2?sorted=$sorted&by=$bynext&search=$search", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
	</ul>
</nav>
<nav class="paginaire">
	<h6>Page <?=($page+1)." / ".round($pagesmax+1)?></h6>
	<div class="page">
		<?php echo $this->pagination->create_links();?>
	</div>
</nav>
<table class="play_list">
	<tr>
		<th class="column_head_image"><img src='<?= $CI->config->base_url("assets/image-gallery.png")?>' /></th>
		<th>Titre</th>
		<th>Album</th>
		<th>Artiste</th>
		<th>Genre</th>
		<th>Durée</th>
	</tr>
	<?php
		foreach($musics as $music){
			echo '<tr><td class="column_image"><img src="data:image/jpeg;base64,'.base64_encode($music->jpeg).'"'.' width="100%" /></td>';
			echo "<td>".anchor("musique/view/{$music->id}","{$music->name}")."</td>";
			echo "<td>".anchor("albums/view/$music->album_id","$music->album_name")."</td>";
			echo "<td>".anchor("artistes/view/$music->artiste_id","$music->artistName")."</td>";
			echo "<td>{$music->genreName}</td>";
			echo "<td>$music->duration</td></tr>";
		}
		
	?>
</table>

<div class="page">
	<?php echo $this->pagination->create_links();?>
</div>