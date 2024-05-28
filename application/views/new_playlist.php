<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
			</nav>
		</header>
		<form action="newPlaylist" method="post">
            <div>
                <label for="username">Nom de la playlist :</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <button type="submit">Créer la playlist</button>
            </div>
        </form>
	</article>
</div>
