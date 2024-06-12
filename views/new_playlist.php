<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
			</nav>
		</header>
		<form action='<?="$what"?>' method="post">
            <div>
                <label for="username">Nom de la playlist :</label>
                <input type="text" id="name" name="name" placeholder="Nom de la playlist" required>
            </div>
            <?php
                if ($what == "newPlaylist/?named=true") {
                    echo '<div style="margin-bottom: 1em;">
                            <input type="checkbox" id="random" name="random" value="random">
                            <label for="random"> Préremplir avec des musiques aléatoires ?</label><br>
                          </div>';
                }
            ?>
            <div>
                <button type="submit">Créer la playlist</button>
            </div>
        </form>
	</article>
</div>
