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
			<h5></h5>
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
				<li><?=anchor("playlist/?sorted=year&by=$by",'Year',['role'=>($sorted=='year'?'button':'')]);?></li>
				<li><?=anchor("playlist/?sorted=nom&by=$by",'Nom',['role'=>($sorted=='nom'?'button':'')]);?></li>
				<li><?=anchor("playlist/?sorted=genre&by=$by",'Genre',['role'=>($sorted=='genre'?'button':'')]);?></li>
				<li><?=anchor("playlist/?sorted=$sorted&by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
			</ul>
		</nav>
		<section class="list">
		<?php
		foreach($playlists as $playlist){
			echo "<div><article>";
			echo "<header class='short-text'>";
			echo anchor("playlist/view/{$playlist->id}","{$playlist->name}");
			echo "</header>";
			echo "</article></div>";
		}
		?>
		</section>
	</article>
</div>
