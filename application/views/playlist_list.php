<h5>Albums list</h5>
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
